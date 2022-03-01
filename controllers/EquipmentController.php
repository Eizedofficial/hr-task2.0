<?php

class EquipmentController
{

    private static string $routerMaskRegEx;
    private static string $routerCode;
    private static array $alreadyStoredSerials = [];
    private static array $notValidSerials = [];

    public static function actionStore(): void
    {
        try {
            $_GET['serials'] = str_replace("\r", "", $_GET['serials']);

            $serials = explode("\n", $_GET['serials']);
            self::$routerCode = $_GET['routerCode'];
            self::$routerMaskRegEx = self::getRouterRegEx(self::$routerCode);

            self::getAlreadyStoredSerials($serials);
            self::getNotValidSerials($serials);
            self::storeCorrectSerials($serials);

            $wrongSerialsData = [
                'stored' => self::$alreadyStoredSerials,
                'wrong' => self::$notValidSerials
            ];
            Responser::response(true, $wrongSerialsData);
        } catch (Exception $e) {
            Responser::response(false, [], $e->getMessage());
        }
    }

    private static function getAlreadyStoredSerials(array $serials): void
    {
        $query = "SELECT serial FROM routers WHERE BINARY serial IN (";
        foreach ($serials as $index => $serial) {
            $query .= "?";
            if ($index < count($serials) - 1) {
                $query .= ", ";
            }
        }
        $query .= ")";

        $dbResponse = Connector::query($query, $serials);
        if(empty($dbResponse)) {
            self::$alreadyStoredSerials = [];
        } else {
            $b = array_column($dbResponse, 'serial');
            self::$alreadyStoredSerials = $b;
        }
    }

    private static function getNotValidSerials(array $serials)
    {
        foreach ($serials as $serial) {
            if (!preg_match(self::$routerMaskRegEx, $serial)) {
                self::$notValidSerials[] = $serial;
            }
        }
    }

    private static function storeCorrectSerials(array $serials): void
    {
        $query = "INSERT INTO routers (type_code, serial) VALUES ";
        $bindings = [];
        $delimiter = "";

        foreach ($serials as $index => $serial) {
            if (!in_array($serial, self::$notValidSerials) && !in_array($serial, self::$alreadyStoredSerials)) {

                $query .= $delimiter . "(?, ?)";
                $delimiter = ", ";
                $bindings[] = self::$routerCode;
                $bindings[] = $serial;

            }
        }

        if(empty($bindings)) {
            return;
        }

        Connector::query($query, $bindings);
    }

    private static function convertMaskToRegEx(string $mask): string
    {
        $hayStack = '/' . $mask . '/';
        $search = ["Z", "N", "a", "A", "X"];
        $replace = ["[\-\_\@]", "[0-9]", "[a-z]", "[A-Z]", "[A-Z0-9]"];

        return str_replace($search, $replace, $hayStack);
    }

    private static function getRouterRegEx(string $routerCode): string
    {
        $mask = Connector::query("SELECT mask FROM router_types WHERE BINARY code = ?", ["$routerCode"]);
        $mask = array_shift($mask)['mask'];

        return self::convertMaskToRegEx($mask);
    }
}