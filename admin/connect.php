<?php

    $dsn    = 'mysql:host=localhost;dbname=newShop';       // Data Source Name
    $user   = 'root';
    $pass   = '';

    try {
        $con = new PDO($dsn,$user,$pass);
    } catch (PDOException $e){
        echo 'Failed To Connect ' . $e->getMessage();
    }

