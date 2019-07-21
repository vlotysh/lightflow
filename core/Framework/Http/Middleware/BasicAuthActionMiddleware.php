<?php

namespace Core\Framework\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class BasicAuthActionMiddleware
 *
 * @package Core\Framework\Http\Middleware
 */
class BasicAuthActionMiddleware extends BaseMiddleware
{
    /**
     *
     */
    public const ATTRIBTE = '_user';

    /**
     * @var
     */
    private $user;

    /**
     * BasicAuthActionMiddleware constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param ServerRequestInterface $request
     * @param callable|null $next
     *
     * @return EmptyResponse
     */
    public function __invoke(ServerRequestInterface $request, ?callable $next = null)
    {
        $username = $request->getServerParams()['PHP_AUTH_USER'] ?? null;
        $password = $request->getServerParams()['PHP_AUTH_PW'] ?? null;

        if ($username == 'vlad' && $password == 'vlad1') {
            return $next($request->withAttribute(self::ATTRIBTE, $username));
        }

        return  new EmptyResponse(401, ['WWW-Authenticate' => 'Basic realm=Restrict area']);
    }
}
