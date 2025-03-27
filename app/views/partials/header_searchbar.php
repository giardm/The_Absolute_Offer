<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script type="module" src="scripts/script.js"></script>
  <title><?= $action ?></title>

</head>

<body>
  <header>
    <div class="logo">
      <a href="?action=home"><img id="mobileLogo" src="./images/logo-03-b.png" alt=""></a>
      <a href="?action=home"><img id="desktopLogo" src="./images/logo-04-b.png" alt=""></a>
    </div>
    <div class="searchContainer">
      <div class="searchInput">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Recherchez un jeu au meilleur prix...">
      </div>
      <button class="searchButton">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </div>
    <div class="profil">
      <i class="fa-solid fa-bars"></i>
      <a href="?action=profil">
        <i class="fa-regular fa-user"></i>
      </a>
    </div>
  </header>