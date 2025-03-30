<?php

require dirname(__DIR__) . "/config/config.php";

if (isset($_GET["action"])) {
  $action = $_GET["action"];
} else {
  $action = "home";
}
require APP_PATH . "/controllers/router.php";
