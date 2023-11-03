<!-- modal -->
<div class="modal fade" id="DetalleModal" tabindex="-2" aria-labelledby="confirmLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="DetalleLabel">Detalles del Usuario:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="post" enctype="multipart/form-data">

                    <div class="mb-4 row">
                        <label for="id" class="col-sm-2 col-form-label">Id</label>
                        <input type="text" readonly class="form-control-plaintext" id="id" name="id">
                    </div>
                    <div class="mb-4 row">
                        <label for="static_id" class="col-sm-2 col-form-label">nombre</label>
                        <input type="text" readonly class="form-control-plaintext" id="nombreusuario" name="nombreusuario">
                    </div>
                    <div class="mb-4 row">
                        <label for="email" class="col-sm-2 col-form-label">apellido</label>
                        <input type="text" readonly class="form-control-plaintext" id="apellidousuario" name="apellidousuario">
                    </div>
                    <div class="mb-4 row">
                        <label for="dni" class="col-sm-2 col-form-label">email</label>
                        <input type="text" readonly class="form-control-plaintext" id="emailusuario" name="emailusuario">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-lg" data-bs-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>