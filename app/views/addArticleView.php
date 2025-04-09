<form id="articleForm" action="save_article.php" method="post" enctype="multipart/form-data">
  <label for="title">Titre :</label><br>
  <input type="text" name="title" id="title" required><br><br>

  <label for="content">Contenu :</label><br>
  <textarea name="content" id="content" rows="10" required></textarea><br><br>

  <label for="category">Catégorie :</label><br>
  <select name="category" id="category" required>
    <?php foreach ($categories as $cat): ?>
      <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
    <?php endforeach; ?>
  </select><br><br>

  <label for="image">Image :</label><br>
  <input type="file" name="image" id="image" accept="image/png" required><br><br>

  <button type="submit">Créer l’article</button>
</form>