<?php require VIEWS_PATH . "/partials/headerView.php"; ?>

<div id="loaderContainer">
  <video id="loaderVideo" autoplay muted loop playsinline>
    <source src="./public/videos/logo.webm" type="video/webm">
  </video>
</div>

<div class="container" id="searchResults" data-query="<?php echo htmlspecialchars($query); ?>"></div>

<?php require VIEWS_PATH . "/partials/footerView.php"; ?>