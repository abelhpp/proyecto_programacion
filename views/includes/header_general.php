<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/proyecto_programacion/inicio.php">Biblioteca</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="inicio.php#recientes" @click="toggleAutoresMenu">
                            Recientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="toggleGenerosMenu">
                            Géneros
                        </a>
                        <ul class="dropdown-menu" id="generos-dropdown">
                            <li v-for="genero in generos" :key="genero.id">
                                <a class="dropdown-item" :href="'#librosCarousel-' + genero.id">{{ genero.nombre
                                    }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>


                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">

                        <?php
                        // Obtener el rol del usuario de la sesión
                        $rol = $_SESSION["roles_id"];

                        // Botones específicos para Alumnos
                        if ($rol == 1) {
                            echo '<li class="nav-item"><a class="nav-link" href="mis_reservas.php">Mis Reservas</a></li>';
                        }

                        ?>
                    </ul>
                </div>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#mi-perfil">Mi Perfil</a></li>

                            <?php
                            // Botones específicos para Bibliotecarios y Superusuarios
                            if ($rol == 2 || $rol == 3) {
                                echo '<li class="nav-item"><a class="nav-link" href="x.php">Registro de Alumnos</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="x.php">Registro de Bibliotecario</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="listalibros.php">Todos los Libros</a></li>';
                                echo '<li class="nav-item"><a class="nav-link" href="x.php">Reservas de Alumnos</a></li>';
                            }
                            ?>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="salir.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
</header>