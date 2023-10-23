<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style_general.css">
<?php echo $script;                                                              ?>    
    <link rel="stylesheet" <?php echo $style;?> >
    <title><?php echo $title; ?></title>
</head>

<body>
    <div id="app">
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
                                <a class="nav-link" href="#recientes" @click="toggleAutoresMenu">
                                    Recientes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $generoButton; ?>" href="#" @click="toggleGenerosMenu">
                                    Géneros
                                </a>
                                <ul class="dropdown-menu" id="generos-dropdown">
                                    <li v-for="genero in generos" :key="genero.id">
                                        <a class="dropdown-item" :href="'#librosCarousel-' + genero.id">{{ genero.nombre }}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
    
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                        $rol = $_SESSION['roles_id']; 
                                        echo $_SESSION['username']; 
                                    ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="#mi-perfil">Mi Perfil</a></li>
                                    <?php
                                        // Botones específicos para Bibliotecarios y Superusuarios
                                        if ($rol == 2 || $rol == 3) {
                                            echo '<li class="dropdown-item"><a class="nav-link" href="x.php">Registro de Alumnos</a></li>';
                                            echo '<li class="dropdown-item"><a class="nav-link" href="x.php">Registro de Bibliotecario</a></li>';
                                            echo '<li class="dropdown-item"><a class="nav-link" href="listalibros.php">Todos los Libros</a></li>';
                                            echo '<li class="dropdown-item"><a class="nav-link" href="x.php">Reservas de Alumnos</a></li>';
                                        } else{
                                            echo '<li><a class="dropdown-item" href="mis_prestamos.php">Mis Prestamos</a></li>';
                                        } 
                                    ?>
                                    
                
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="../salir.php">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>