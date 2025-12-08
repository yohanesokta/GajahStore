<?php
require_once __DIR__."/lib/loaders.php";

$Router = new Routes();

$Router->GET("/", "HomeControllers@home"); 

$Router->JalankanRouting();
