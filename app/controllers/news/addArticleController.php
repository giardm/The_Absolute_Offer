<?php

/**
 * ======================================================
 * Contrôleur de gestion d'ajout d'article par un administrateur.
 * Gère à la fois le formulaire HTML (GET) et la soumission via POST (AJAX).
 * ======================================================
 */

require_once MODELS_PATH . '/newsModel.php';
require_once MODELS_PATH . '/favorites.php';
require_once MODELS_PATH . '/userModel.php';

// S'assure que la session est bien démarrée
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

// Vérifie que l'utilisateur est administrateur
if (isAdmin()) {

  // ===============================
  //  Traitement de la soumission AJAX (POST)
  // ===============================
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérifie que toutes les données attendues sont bien présentes
    if (!isset($_POST['title'], $_POST['content'], $_POST['category'], $_POST['thumbAlt'])) {
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'message' => 'Le formulaire est incomplet ou invalide.'
      ]);
      exit;
    }

    // Récupération des données du formulaire
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category'];
    $thumbAlt = $_POST['thumbAlt'];
    $userId = $_SESSION['user_id'] ?? null;

    // Vérifie que tous les champs sont valides et présents
    if (
      empty($title) || empty($content) || empty($categoryId) || empty($thumbAlt) || !$userId
    ) {
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'message' => 'Tous les champs sont requis.'
      ]);
      exit;
    }

    if (strlen($title) > 150) {
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'message' => 'Le titre est trop long (150 caractères max).'
      ]);
      exit;
    }

    if (strlen($thumbAlt) > 150) {
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'message' => "Le texte alternatif de l'image est trop long (150 caractères max)."
      ]);
      exit;
    }


    // Sécurisation des champs texte
    $title = strip_tags($title);
    $content = strip_tags($content, '<p><br><strong><em><u><ul><ol><li><a>');
    $thumbAlt = htmlspecialchars($thumbAlt);

    // ----------------------------------------
    // GESTION DE L’IMAGE UPLOADÉE
    // ----------------------------------------

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

    // Vérifie la taille du fichier (max 2 Mo)
    if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'message' => 'L’image est trop lourde (2 Mo max).'
      ]);
      exit;
    }

    $thumbPath = null;

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $tmpFile = $_FILES['image']['tmp_name'];
      $originalName = basename($_FILES['image']['name']);
      $fileExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

      // Vérifie que l'extension est bien .webp
      if ($fileExtension !== 'webp') {
        header('Content-Type: application/json');
        echo json_encode([
          'success' => false,
          'message' => 'Seuls les fichiers WebP sont autorisés.'
        ]);
        exit;
      }

      // Vérifie le type MIME du fichier
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mimeType = finfo_file($finfo, $tmpFile);
      finfo_close($finfo);

      if ($mimeType !== 'image/webp') {
        header('Content-Type: application/json');
        echo json_encode([
          'success' => false,
          'message' => 'Le fichier n’est pas une image WebP valide.'
        ]);
        exit;
      }

      // Génère un nom de fichier unique sécurisé
      $uniqueName = uniqid('', true) . '.webp';
      $uploadDir = 'public/images/uploads/';

      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
      }

      $destination = $uploadDir . $uniqueName;

      if (move_uploaded_file($tmpFile, $destination)) {
        $thumbPath = $destination;
      } else {
        header('Content-Type: application/json');
        echo json_encode([
          'success' => false,
          'message' => 'Erreur lors de l’enregistrement de l’image.'
        ]);
        exit;
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
    require_once VIEWS_PATH . '/news/addArticleView.php';
  }
} else {
  // Redirige vers la page d'accueil si l'utilisateur n'est pas admin
  require_once CONTROLLERS_PATH . '/home/homeController.php';
}
