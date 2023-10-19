<?php include 'views/includes/headerActivar.php'; ?>

<div id="app" class="container mt-5">
        <div class="row">
                <h2>Lista de Usuarios</h2>
            <?php    include 'views/partiales/tabla.php'   ?>
            
            
            
        </div>

        <!-- Modal para editar usuario -->
        <div class="modal" id="editarUsuarioModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="guardarCambios">
                            <div class="form-group">
                                <label for="editDni">DNI:</label>
                                <input type="number" class="form-control" id="editDni" v-model="usuarioEditado.dni"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="editNombre">Nombre:</label>
                                <input type="text" class="form-control" id="editNombre" v-model="usuarioEditado.nombre"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="editApellido">Apellido:</label>
                                <input type="text" class="form-control" id="editApellido"
                                    v-model="usuarioEditado.apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="editEmail">Email:</label>
                                <input type="email" class="form-control" id="editEmail" v-model="usuarioEditado.email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="editActivado">Activado:</label>
                                <input type="text" class="form-control" id="editActivado"
                                    v-model="usuarioEditado.activado" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include 'views/includes/footerActivar.php'; ?>