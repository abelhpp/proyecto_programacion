<!-- Rodal medio propio y mmedio busstrap -->
<div class="rodal" id="myRodal">
  <div class="modal-header">
    <h2>VALIDACIÓN</h2>
    <button type="button" class="btn-close" aria-label="Close" id="closeButton"></button>
  </div>
  <div class="modal-body">
    <p><?php echo $error_message; ?></p>
  </div>
  <div class="modal-footer">
    <a href="correo" class="btn btn-primary">Aceptar</a>
  </div>
</div>
<div class="modal-backdrop fade show" id="modal-backdrop"></div>