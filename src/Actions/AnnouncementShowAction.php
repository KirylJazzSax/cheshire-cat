<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 18:14
 */

namespace Src\Actions;

use PDO;
use Src\Exceptions\NotFoundException;
use Src\Http\HtmlResponse;
use Src\Http\JsonResponse;
use Src\Http\Request;
use Src\Models\Announcement;
use Src\Template\TemplateRenderer;

class AnnouncementShowAction
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
        $announcementModel = new Announcement($this->db);
        $announcement = $announcementModel->findOne($request->getAttribute('id'));
        if (!$announcement) {
            throw new NotFoundException();
        }

        if ($request->isAjax()) {
            return new JsonResponse($announcement);
        }

        return new HtmlResponse($this->template->render('show', ['announcement' => $announcement]));
    }
}