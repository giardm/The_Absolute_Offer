<?php
require_once MODELS_PATH . '/newsModel.php';

// ===============================
//  Traitement de la soumission AJAX (POST)
// ===============================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sécurité & nettoyage
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category = intval($_POST['category'] ?? 0);
    $image = $_FILES['image'] ?? null;

    // Validation simple
    if (!$title || !$content || !$category || !$image || $image['error'] !== 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Données invalides ou image manquante.'
        ]);
    }

    // Gérer l'upload de l'image
    $uploadDir = __DIR__ . '/public/images/news';
    $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $filename = uniqid('img_') . '.' . $extension;
    $targetPath = $uploadDir . $filename;

    // Vérifier extension et MIME type
    $allowedExt = 'png';
    $allowedMime = 'image/png';

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $image['tmp_name']);
    finfo_close($finfo);

    if ($extension !== $allowedExt || $mimeType !== $allowedMime) {
        echo json_encode([
            'success' => false,
            'message' => 'Seuls les fichiers PNG sont autorisés.'
        ]);
    }


    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!move_uploaded_file($image['tmp_name'], $targetPath)) {
        die('Échec de l’upload de l’image.');
    }

    // Appel à la fonction d'insertion
    if (createArticle($title, $content, $category, $filename)) {
        echo json_encode([
            'success' => true,
            'message' => 'Article ajouté !'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de l’ajout de l’article.'
        ]);
    }
} else {
    http_response_code(405);
    echo "Méthode non autorisée.";
}


// ===============================
//  Affichage du formulaire (GET)
// ===============================

require_once VIEWS_PATH . '/partials/headerView.php';
require_once VIEWS_PATH . '/addArticleView.php';
require_once VIEWS_PATH . '/partials/FooterView.php';
