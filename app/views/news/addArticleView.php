<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<form id="articleForm" action="save_article.php" method="post" enctype="multipart/form-data">
  <label for="titleInput">Titre:</label><br>
  <input type="text" name="title" id="titleInput" required><br><br>

  <label for="contentEditor">Contenu:</label><br>
  <textarea name="content" id="contentEditor" rows="10" required></textarea><br><br>

  <label for="categorySelect">Categorie:</label><br>
  <select name="category" id="categorySelect" required>
    <?php foreach ($categories as $cat): ?>
      <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
    <?php endforeach; ?>
  </select><br><br>

  <label for="imageUpload">Image (format webp):</label><br>
  <input type="file" name="image" id="imageUpload" accept=".webp" required><br><br>

  <label for="thumbAltInput">Description de l'image :</label><br>
  <input type="text" name="thumbAlt" id="thumbAltInput" required><br><br>

  <button type="submit">Ajouter l'article</button>
</form>

<!-- jQuery + Trumbowyg -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/trumbowyg.min.js"></script>

<!-- Init Trumbowyg -->
<script>
  $('#contentEditor').trumbowyg({
    btns: [
      ['strong', 'em', 'underline'],
      ['unorderedList', 'orderedList'],
      ['link'],
      ['removeformat']
    ],
    autogrow: true,

    removeformatPasted: true,

    semantic: true,

    tagsToRemove: ['span', 'div', 'style', 'font']
  });
</script>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>