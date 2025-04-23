<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<!--
  ======================================================
  Vue : Formulaire d’ajout d’un article.
  Utilisé par les administrateurs pour publier du contenu.
  Le contenu est enrichi avec l’éditeur Trumbowyg.
  ======================================================
-->

<form id="articleForm" action="save_article.php" method="post" enctype="multipart/form-data">
  <h2>Ajouter un article</h2>

  <!-- Champ : Titre de l'article -->
  <label for="titleInput">Titre:</label>
  <input type="text" name="title" id="titleInput" aria-required="true">

  <!-- Champ : Contenu de l'article -->
  <label for="contentEditor">Contenu:</label>
  <textarea name="content" id="contentEditor" rows="10" aria-required="true"></textarea>

  <!-- Sélection de la catégorie -->
  <label for="categorySelect">Categorie:</label>
  <select name="category" id="categorySelect" aria-required="true">
    <?php foreach ($categories as $cat): ?>
      <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
    <?php endforeach; ?>
  </select>

  <!-- Upload de l'image de couverture (webp uniquement) -->
  <label for="imageUpload">Image (format webp):</label>
  <input type="file" name="image" id="imageUpload" accept=".webp" aria-label="Choisir une image au format WebP">

  <!-- Texte alternatif pour l’image -->
  <label for="thumbAltInput">Description de l'image :</label>
  <input type="text" name="thumbAlt" id="thumbAltInput" aria-required="true">

  <!-- Bouton de soumission du formulaire -->
  <button id="addBtn" type="submit" aria-label="Soumettre le formulaire d’ajout d’article">Ajouter l'article</button>
</form>

<!-- ======================================================
     Chargement de jQuery et de l’éditeur Trumbowyg pour le champ contenu
     ====================================================== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/trumbowyg.min.js"></script>

<!-- Initialisation de l’éditeur Trumbowyg -->
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