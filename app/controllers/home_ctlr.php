<?php
if (!isset($_SESSION)) {
  session_start();
}



require VIEWS_PATH . "/partials/header_searchbar.php";

require_once VIEWS_PATH . '/home.php';

require VIEWS_PATH . "/partials/footer.php";
