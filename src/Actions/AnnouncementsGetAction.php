<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.05.2020
 * Time: 14:21
 */

namespace Src\Actions;


use PDO;
use Src\Exceptions\BadRequestException;
use Src\Exceptions\NotFoundException;
use Src\Http\HtmlResponse;
use Src\Http\JsonResponse;
use Src\Http\Request;
use Src\Models\Announcement;
use Src\Template\TemplateRenderer;

class AnnouncementsGetAction
{
    private $template;
    private $db;

    public function __construct(PDO $db, TemplateRenderer $template)
    {
        $this->template = $template;
        $this->db = $db;
    }

    public function __invoke(Request $request)
    {
        $announcement = new Announcement($this->db);
        $announcements = $announcement->findAll($request->getQueryParams());

        if (count($request->getQueryParams()) > 0 && $announcements === false) {
            throw new BadRequestException();
        }
        if (count($announcements) === 0) {
            throw new NotFoundException();
        }

        if ($request->isAjax()) {
            return new JsonResponse($announcements);
        }

        return new HtmlResponse($this->template->render('index', ['pages' => $announcement->getPages()]));
    }
}