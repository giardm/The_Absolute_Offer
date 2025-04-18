<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<form id="articleForm" action="save_article.php" method="post" enctype="multipart/form-data">
  <h2>Ajouter un article</h2>
  <label for="titleInput">Titre:</label>
  <input type="text" name="title" id="titleInput">

  <label for="contentEditor">Contenu:</label>
  <textarea name="content" id="contentEditor" rows="10"></textarea>

  <label for="categorySelect">Categorie:</label>
  <select name="category" id="categorySelect">
    <?php foreach ($categories as $cat): ?>
      <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
    <?php endforeach; ?>
  </select>

  <label for="imageUpload">Image (format webp):</label>
  <input type="file" name="image" id="imageUpload" accept=".webp">

  <label for="thumbAltInput">Description de l'image :</label>
  <input type="text" name="thumbAlt" id="thumbAltInput">

  <button id="addBtn" type="submit">Ajouter l'article</button>
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