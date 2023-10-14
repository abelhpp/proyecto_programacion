<?php include 'views/includes/header_login.php'; ?>

<div id="login">
        <h3 class="text-center text-white display-4">Login con PHP</h3>
        <div class="container">                        
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12  bg-light text-dark">
                        <form id="formLogin" class="form" action="" method="post">
                            <h3 class="text-center text-dark">Inicio de Sesión</h3>
                            <div class="form-group">
                                <label for="usuario" class="text-dark">Usuario</label><br>
                                <input type="text" name="usuario" id="usuario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Password</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group text-center">                                
                                <input type="submit" name="submit" class="btn btn-dark btn-lg btn-block" value="Iniciar Sesión">
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'views/includes/footer_login.php'; ?>