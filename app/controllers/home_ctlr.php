<?php
if (!isset($_SESSION)) {
  session_start();
}

require RACINE.

class HomeController
{
  public function index()
  {
    // Si c'est une requête AJAX
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
      $model = new DataModel();
      $data = $model->getData();
      echo json_encode($data);  // Retourner les données en format JSON
      exit;
    }
  }
}


require RACINE . "/app/views/partials/header_searchbar.php";

require_once RACINE . '/app/views/home.php';

require RACINE . "/app/views/partials/footer.php";
