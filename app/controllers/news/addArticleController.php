<?php
require_once MODELS_PATH . '/newsModel.php';

// ===============================
//  Traitement de la soumission AJAX (POST)
// ===============================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Vérifie que toutes les données attendues sont bien présentes dans $_POST
  if (!isset($_POST['title'], $_POST['content'], $_POST['category'], $_POST['thumbAlt'])) {
    header('Content-Type: application/json');
    echo json_encode([
      'success' => false,
      'message' => 'Le formulaire est incomplet ou invalide.'
    ]);
    exit;
  }

  // Récupération des données envoyées par le formulaire
  $title = $_POST['title'];
  $content = $_POST['content'];
  $categoryId = $_POST['category'];
  $thumbAlt = $_POST['thumbAlt'];
  $userId = $_SESSION['user_id'] ?? null;

  // Vérification de la présence des champs obligatoires
  if (empty($title) || empty($content) || empty($categoryId) || !$userId) {
    header('Content-Type: application/json');
    echo json_encode([
      'success' => false,
      'message' => 'Tous les champs sont requis.'
    ]);
    exit;
  }

  // Sécurisation basique contre injection HTML
  $title = strip_tags($title);
  $content = strip_tags($content, '<p><br><strong><em><u><ul><ol><li><a>');
  $thumbAlt = htmlspecialchars($thumbAlt);

  // ----------------------------------------
  // GESTION DE L’IMAGE UPLOADÉE
  // ----------------------------------------

  // L’image est obligatoire pour publier un article
  if (
    !isset($_FILES['image']) ||
    $_FILES['image']['error'] !== UPLOAD_ERR_OK
  ) {
    header('Content-Type: application/json');
    echo json_encode([
      'success' => false,
      'message' => 'Une image est requise pour publier l’article.'
    ]);
    exit;
  }

  $thumbPath = null;

  if (
    isset($_FILES['image']) &&
    $_FILES['image']['error'] === UPLOAD_ERR_OK
  ) {
    $tmpFile = $_FILES['image']['tmp_name'];
    $originalName = basename($_FILES['image']['name']);
    $uniqueName = uniqid() . '_' . $originalName;
    $uploadDir = 'public/images/uploads/';

    // Création du dossier de destination s’il n’existe pas
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }

    $destination = $uploadDir . $uniqueName;

    // Déplacement du fichier uploadé
    if (move_uploaded_file($tmpFile, $destination)) {
      $thumbPath = $destination;
    } else {
      // Échec du déplacement du fichier image
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de l’enregistrement de l’image.'
      ]);
      exit; // On stoppe ici si le fichier ne peut pas être déplacé
    }
  }

  // ----------------------------------------
  // AJOUT DE L’ARTICLE DANS LA BASE DE DONNÉES
  // ----------------------------------------

  $success = addArticle($title, $content, $thumbPath, $thumbAlt, $userId, $categoryId);

  if ($success) {
    header('Content-Type: application/json');
    echo json_encode([
      'success' => true,
      'message' => 'Article ajouté avec succès !'
    ]);
    exit;
  } else {
    header('Content-Type: application/json');
    echo json_encode([
      'success' => false,
      'message' => 'Erreur lors de l’ajout de l’article.'
    ]);
    exit;
  }
} else {
  // ===============================
  //  Affichage du formulaire (GET)
  // ===============================

  $categories = getCategories();

  require_once VIEWS_PATH . '/partials/headerView.php';
  require_once VIEWS_PATH . '/addArticleView.php';
  require_once VIEWS_PATH . '/partials/FooterView.php';
}
