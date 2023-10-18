<?php include ("../templates/header.php"); ?>
<br/> 

<!-- Card para registros de empleados -->
<div class="card">
    <div class="card-header">
        <!--Botón agregar Registros -->
        <a name="" id="" class="btn btn-primary" 
        href="crear.php" role="button">
        Agregar registro
        </a>
    </div>
    <div class="card-body">
    <!-- Creamos una tabla para empleados-->
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Fecha de ingreso</th>
                    <th scope="col">Fotocopia de DNI</th>
                    <th scope="col">Activado</th>
                    <th scope="col">Token</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="row">Diego</td>
                    <td>Maidana</td>
                    <td>38102136</td>
                    <td>dsmaidana@gmail.com</td>
                    <td>*******</td>
                    <td>17/10/2023</td>
                    <td>dni.jpg</td>
                    <td>Si</td>
                    <td>0</td>
                    <td>Bibliotecario</td>
                    <td>
                        <a name="" id="" class="btn btn-info" href="#" role="button">Editar</a>
                        <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    
    </div>
</div>

<?php include ("../templates/footer.php"); ?>