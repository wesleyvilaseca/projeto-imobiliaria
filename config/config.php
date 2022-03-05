<?php
date_default_timezone_set('America/Belem');

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "33061",
    "dbname" => "imobiliaria",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define('CONTROLLER_PADRAO', 'admin');
define('METODO_PADRAO', 'index');
define('NAMESPACE_CONTROLLER', 'app\\controllers\\');

define('keytiny', 'pno1jzy3fokxrq842muonq3jfelg0kv5blqeryq4qxob95al');
define('URL_BASE', 'http://localhost/imobiliaria/');

#recaptchav2
define('SITE_KEY', '6LeCjroaAAAAAIZf_ByTo2gXDRqrKQv-6qQAWqN1');
define('SECRET_KEY', '6LeCjroaAAAAAFCIrrfSX6h9E-Lu8ZZY2nb67DVe');

define('EM_MANUTENCAO', 0);
