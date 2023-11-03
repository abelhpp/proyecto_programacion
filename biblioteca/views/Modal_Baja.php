<!-- modal -->
<div class="modal fade" id="BajaModal" tabindex="-1" aria-labelledby="bajaLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="bajaLabel">va a baja de :</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./controllers/DardeBajaPrestamo.php" method="post" enctype="multipart/form-data">

                    <div class="mb-3 row">
                        <label for="id" class="col-sm-2 col-form-label">Id</label>
                        <input type="text" readonly class="form-control-plaintext" id="id" name="id" value="ID">
                    </div>
                    <div class="mb-3 row">
                        <label for="fechaprestamo" class="col-sm-2 col-form-label">Fecha Prestamo</label>
                        <input type="text" readonly class="form-control-plaintext" id="fechaprestamo" name="fechaprestamo" value="fecha_prestamo">
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">email</label>
                        <input type="text" readonly class="form-control-plaintext" id="email" name="email" value="email">
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick=actualizarpag()>Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>