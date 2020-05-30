<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 18:49
 */

namespace Src\Actions\Error;

use Src\Http\HtmlResponse;
use Src\Http\JsonResponse;
use Src\Http\Request;
use Src\Template\TemplateRenderer;

class ErrorAction
{
    private $template;

    public function __construct(TemplateRenderer $template)
    {
        $this->template = $template;
    }

    public function __invoke($message, $code, Request $request)
    {
        if ($request->isAjax()) {
            return new JsonResponse(['error' => $message], $code);
        }

        return new HtmlResponse(
            $this->template->render('error/error', ['message' => $message, 'code' => $code]),
            $code
        );
    }
}