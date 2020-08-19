<?php

try{
    $bdd = new PDO('mysql:host=covidplatform.cjwanrzqmgj7.eu-west-3.rds.amazonaws.com;dbname=covidplatform;charset=utf8', 'admin', 'covidplatform');
} catch (Exception $e){
        die($e->getMessage());
}

?>