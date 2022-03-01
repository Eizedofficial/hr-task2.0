<?php

class IndexController
{
    public static function actionIndex(): void
    {
        $routerTypes = Connector::query("SELECT code, name FROM router_types");
        include_once ROOT . '/views/index.php';
    }
}