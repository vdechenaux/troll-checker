<?php
declare(strict_types=1);

use Bref\Bridge\Slim\SlimAdapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require __DIR__.'/vendor/autoload.php';

$slim = new Slim\App;
$slim->get('/dev', function (ServerRequestInterface $request, ResponseInterface $response) {
    $text = date('w') === 5 || isset($request->getQueryParams()['please']) ? 'OUI !' : 'NON :(';

    $response->getBody()->write(<<<HTML
        <!DOCTYPE html>
        <html>
            <head>
                <title>Est ce qu'on peut troller aujourd'hui?</title>
            </head>
            <body>
                <h1 style="text-align: center; font-size: 6em;">
                    $text
                </h1>
            </body>
        </html>
HTML
    );

    return $response;
});

$app = new \Bref\Application;
$app->httpHandler(new SlimAdapter($slim));
$app->run();
