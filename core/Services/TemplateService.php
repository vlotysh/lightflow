<?php

namespace Core\Services;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * Class TemplateService
 *
 * @package Core\Services
 */
class TemplateService
{
    /**
     * @param string $path
     *
     * @param array $data
     */
    public function render(string $path, array $data = []): string
    {
        $loader = new FilesystemLoader(APP_ROOT . 'app/Views/');
        $twig = new Environment($loader, [
            'cache' => APP_ROOT . 'cache',
        ]);

        return $twig->render($path, $data);
    }
}
