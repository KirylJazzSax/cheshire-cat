<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 16:47
 */

namespace Src\Template;

class TemplateRenderer
{
    private $templateFolder = 'templates/';

    public function render($view, $data = []): string
    {
        $template = $this->templateFolder . $view . '.php';

        ob_start();
        extract($data);
        $data = [];
        $extends = null;
        require $template;
        $content = ob_get_clean();

        if ($extends === null) {
            return $content;
        }

        return $this->render($extends, [
            'content' => $content
        ]);
    }
}