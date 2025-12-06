<?php

namespace app\middleware;

class Middleware
{
    public static function authentication()
    {
        #retorna uma clousure(função anônima)
        $middleware = function ($request, $handeler) {
            #Verifica se o usuário está autenticado
            $response = $handeler->handle($request);
            #captura o método 
            $method = $request->getMethod();

            $pagina = $request->getrequestTarget();
            if ($method === 'GET') {
                #verificando se o usuário está autenticado, caso não esteja redireciona para a página de login
                $usuariologado = empty($_SESSION['usuario']) || empty($_SESSION['usuario']['logado']);
                #captura a rota atual
                if ($usuariologado && $pagina !== '/login') {
                    #destruir a sessão
                    session_destroy();
                    #redireciona para a página de login
                    return $response->withHeader('Location', '/login')->withStatus(302);
                }
                if ($pagina === '/Login') {
                    if (!$usuariologado) {
                        #redireciona para a página home
                        return $response->withHeader('Location', '/')->withStatus(302);
                    }
                    if (empty($_SESSION['usuario']['ativo']) || !$_SESSION['usuario']['ativo']) {
                        #destruir a sessão
                        session_destroy();
                        #redireciona para a página de login
                        return $response->withHeader('Location', '/login')->withStatus(302);
                    }
                }
            }
            return $handeler->handle($request);
        };
        return $middleware;
    }
}
