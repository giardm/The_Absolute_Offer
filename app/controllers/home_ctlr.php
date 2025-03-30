<?php
if (!isset($_SESSION)) {
  session_start();
}



require APP_PATH . "/views/partials/header_searchbar.php";

require_once APP_PATH . '/views/home.php';

require APP_PATH . "/views/partials/footer.php";
