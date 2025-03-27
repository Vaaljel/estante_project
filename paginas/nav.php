<header>

  

  <nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color: black; padding-top: 0.5rem; padding-bottom: 0.5rem; min-height: 60px;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="../img/logo-nav.png" height='30' />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link <?= ($pagina == 'index') ? 'active' : '' ?>" aria-current="page" href="../paginas/index.php">Início</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($pagina == 'sobre') ? 'active' : '' ?>" href="../paginas/sobre.php">Sobre</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link <?= ($pagina == 'login') ? 'active' : '' ?>" href="../paginas/login.php">Entrar</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link <?= ($pagina == 'registar') ? 'active' : '' ?>" href="../paginas/registar.php">Registar</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</header>