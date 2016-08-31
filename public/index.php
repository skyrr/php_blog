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

    $router->add("/user/login", ["controller" => "user", "action" => "login"]);

    $router->add("/user/signin", ["controller" => "user", "action" => "signin"]);

    $router->add("/post/create", ["controller" => "post", "action" => "create"]);

    $router->add("/post/{id}/edit", ["controller" => "post", "action" => "edit"]);

    $router->add("/post/{id}/comment", ["controller" => "post", "action" => "comment"]);


    $di->set('router', $router);

    $assets = $di->get('assets');
    $assets->addCss('assets/plugins/pace/pace-theme-flash.css')
        ->addCss('assets/plugins/boostrapv3/css/bootstrap.min.css')
        ->addCss('assets/plugins/boostrapv3/css/bootstrap-theme.min.css')
        ->addCss('assets/plugins/font-awesome/css/font-awesome.css')
        ->addCss('assets/css/animate.min.css')
        ->addCss('assets/css/style.css')
        ->addCss('assets/css/responsive.css')
        ->addCss('assets/css/custom-icon-set.css')
        ->addJs('assets/plugins/jquery-1.8.3.min.js')
        ->addJs('assets/plugins/bootstrap/js/bootstrap.min.js')
        ->addJs('assets/plugins/pace/pace.min.js');

    // Настраиваем сервис для работы с БД
    $di->set('db', function () {
        return new DbAdapter(array(
            "host"     => "localhost",
            "port"     => "4040",
            "username" => "root",
            "password" => "314",
            "dbname"   => "blog",
            "charset" => "utf8"
        ));
    });


    // Настраиваем компонент View
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        $view->setPartialsDir('partial/');
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
        $url->setBaseUri('/');
        return $url;
    });

    // Обрабатываем запрос
    $application = new Application($di);

    $response = $application->handle();

    $response->send();

} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage(), "FILE: ", $e->getFile(), " LINE: ", $e->getLine();
}