<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 16:14
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

class AnnouncementsIndexAction
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
        return new HtmlResponse($this->template->render('index', ['pages' => $announcement->getPages()]));
    }
}