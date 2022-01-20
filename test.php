<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  // connect to mongodb
  $m = new MongoDB\Driver\Manager("mongodb+srv://ggc_staging:1H%25Xv%246xm4iN@cluster0.t1po0.mongodb.net/ggs_staging?retryWrites=true&w=majority");

  echo "Connection to database successfully";
  // select a database
  $db = $m->examplesdb;

  var_dump($db);

  echo "Database examplesdb selected";
?>