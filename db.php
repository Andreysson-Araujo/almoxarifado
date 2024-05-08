<?php

    $db_name = "ORGANIZE";
    $db_host = "localhost";
    $db_user = "andreysson";
    $db_pass = "senha";

    $conn = new PDO("mysql:dbname=". $db_name .";host=". $db_host, $db_user, $db_pass);

    //habilitar erros PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);