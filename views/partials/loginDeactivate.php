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
                                            echo '<li class="dropdown-item"><a class="nav-link" href="biblioteca/activar.php">Registro de Alumnos</a></li>';
                                            echo '<li class="dropdown-item"><a class="nav-link" href="alta.php">Registro de Bibliotecario</a></li>';
                                            echo '<li class="dropdown-item"><a class="nav-link" href="lista.php">Todos los Libros</a></li>';
                                            echo '<li class="dropdown-item"><a class="nav-link" href="listaResUsuarios.php">Reservas de Alumnos</a></li>';
                                        } else{
                                            echo '<li><a class="dropdown-item" href="mis_prestamos.php">Mis Prestamos</a></li>';
                                        } 
                                    ?>
                
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="proyecto_programacion/salir">Cerrar Sesión</a></li>
                                </ul>
                            </li>
</ul>
              
