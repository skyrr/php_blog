<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

try {

    // Регистрируем автозагрузчик
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    // Создаем DI
    $di = new FactoryDefault();

    $router = new \Phalcon\Mvc\Router(false);
    $router->add("/", ["controller" => "post", "action" => "index"]);

    $di->set('router', $router);


    // Настраиваем сервис для работы с БД
    $di->set('db', function () {
        return new DbAdapter(array(
            "host"     => "localhost",
            "username" => "root",
            "password" => "314",
            "dbname"   => "blog"
        ));
    });


    // Настраиваем компонент View
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        $view->registerEngines(
            [
                ".volt" => View\Engine\Volt::class
            ]
        );
        return $view;

    });

    // Настраиваем базовый URI так, чтобы все генерируемые URI содержали директорию "tutorial"
    $di->set('url', function () {
        $url = new UrlProvider();
        $url->setBaseUri('/tutorial/');
        return $url;
    });

    // Обрабатываем запрос
    $application = new Application($di);

    $response = $application->handle();

    $response->send();

} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
}