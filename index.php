<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require(__DIR__ . '/config/config.php');

if (isset($_GET["action"])) {
  $action = $_GET["action"];
} else {
  $action = "home";
}


require CONTROLLERS_PATH . "/core/router.php";
