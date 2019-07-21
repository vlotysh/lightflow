<?php

namespace Core\Services;

use Twig\{
    Loader\FilesystemLoader,
    Environment,
    Error\LoaderError,
    Error\RuntimeError,
    Error\SyntaxError
};
/**
 * Class TemplateService
 *
 * @package Core\Services
 */
class TemplateService
{
    /**
     * @param string $path
     * @param array $data
     *
     * @return string
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
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
