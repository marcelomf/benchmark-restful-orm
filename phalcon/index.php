<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

$loader = new \Phalcon\Loader();
$loader->registerDirs([__DIR__ . "/models/"])
       ->register();

// Configuração do banco
$di = new FactoryDefault();
$di->set("db", function () {
    return new PdoMysql([
        "host"     => "10.10.0.41",
        "dbname"   => "eventos",
        "username" => "root",
        "password" => "senha123",
    ]);
});

$app = new \Phalcon\Mvc\Micro($di);

// 404
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();

    echo 'Pagina não encontrada.';
});

// Lista todos os usuarios
$app->get("/usuarios", function () use ($app) {
    $usuarios = Usuarios::Find()
              ->toArray();

    $response = new Response();
    $response->setJsonContent($usuarios);

    return $response;
});

$app->post('/usuarios', function () use($app) {
        $dados = json_decode($app->request->getRawBody());
        $usuario = new Usuarios();
        $usuario->nome = $dados->nome;
        $usuario->login = $dados->login;
        $usuario->senha = $dados->senha;
        $usuario->email = $dados->email;
        $usuario->permissao = $dados->permissao;
        if ($usuario->save() === false) {
            echo "Umh, We can't store usuarios right now: \n";
            $messages = $usuario->getMessages();
            foreach ($messages as $message) {
                echo $message, "\n";
            }
        } 
        $response = new Response();
        $response->setJsonContent($usuario->toArray());
        return $response;
    }
);

$app->put('/usuarios/{id:[0-9]+}', function ($id) use($app) {
        $dados = json_decode($app->request->getRawBody());
        $usuario = Usuarios::findFirst($id);
        $usuario->nome = $dados->nome;
        $usuario->login = $dados->login;
        $usuario->senha = $dados->senha;
        $usuario->email = $dados->email;
        $usuario->permissao = $dados->permissao;
        if ($usuario->save() === false) {
            echo "Umh, We can't store usuarios right now: \n";
            $messages = $usuario->getMessages();
            foreach ($messages as $message) {
                echo $message, "\n";
            }
        } 
        $response = new Response();
        $response->setJsonContent($usuario->toArray());
        return $response;
    }
);

$app->delete('/usuarios/{id:[0-9]+}', function ($id) use($app) {
        $usuario = Usuarios::findFirst($id);
        if ($usuario->delete() === false) {
            echo "Umh, We can't delete usuarios right now: \n";
            $messages = $usuario->getMessages();
            foreach ($messages as $message) {
                echo $message, "\n";
            }
        }
        $response = new Response();
        $response->setJsonContent("{}");
        return $response;
    }
);

$app->handle();