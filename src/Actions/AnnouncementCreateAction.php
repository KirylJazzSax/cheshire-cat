<?php

namespace Src\Actions;

use PDO;
use Src\Exceptions\BadRequestException;
use Src\Http\HtmlResponse;
use Src\Http\JsonResponse;
use Src\Http\Request;
use Src\Models\Announcement;
use Src\Template\TemplateRenderer;

class AnnouncementCreateAction
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

        if ($request->isPost() && $request->isAjax()) {

            $this->guardForm($request);

            $announcement->title = $request->getParsedBody()['title'];
            $announcement->price = $request->getParsedBody()['price'];
            $announcement->description = $request->getParsedBody()['description'];

            if ($announcement->validate() && $announcement->save()) {
                return new JsonResponse(['flash' => 'Вы добавили объявление, id: ' . $this->db->lastInsertId()]);
            }
            return new JsonResponse($announcement->getErrors(), 400);
        }

        return new HtmlResponse($this->template->render('create', ['token' => $request->getSessionValue('token')]));
    }

    private function guardForm(Request $request)
    {
        if (!hash_equals($request->getSessionValue('token'), $request->getParsedBody()['token'])) {
            throw new BadRequestException();
        }
    }
}