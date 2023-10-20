// Obtén el modal y el fondo oscuro por su ID
const modal = document.getElementById('myRodal');
const modalBackground = document.getElementById('modal-backdrop');

// Obtén el botón de cierre por su IDmodal-backdrop
const closeButton = document.getElementById('closeButton');

// Función para cerrar el modal
function closeModal() {
  modal.style.display = 'none';
  modalBackground.style.display = 'none';
}


// Evento para cerrar el modal al hacer clic en el botón de cierre
closeButton.addEventListener('click', closeModal);

// Evento para cerrar el modal al hacer clic en el fondo oscuro
modalBackground.addEventListener('click', closeModal);

function validarFormulario() {
  // Obtener valores de los campos
  const email = document.getElementById('email').value;
  const name = document.getElementById('name').value;
  const apellido = document.getElementById('apellido').value;
  const dni = parseInt(document.getElementById('dni').value);
  const password = document.getElementById('password').value;

  // Validar DNI
  if (dni < 12000000 || dni >= 60000000) {
      alert('El DNI ingresado no es valido');
      return false;
  }

  // Validar contraseña (al menos 8 caracteres y una mayúscula)
  if (password.length < 8 || !/[A-Z]/.test(password)) {
      alert('La contraseña debe tener al menos 8 caracteres y al menos una letra mayúscula.');
      return false;
  }

  if (name.length > 45) {
    alert('El campo "Nombre" tiene que ser menor a 45 caracteres.');
    return false;
  }

  if (apellido.length > 45) {
      alert('El campo "Apellido" tiene que ser menor a 45 caracteres.');
      return false;
  }

  if (email.length > 45) {
      alert('El campo "Correo" tiene que ser menor a 45 caracteres.');
      return false;
  }

  // Validar que el archivo cargado sea .jpeg o .jpg
  const archivoInput = document.getElementById('formFile');
  const archivo = archivoInput.files[0];
  if (archivo) {
      const extensionesPermitidas = ['.jpeg', '.jpg'];
      const archivoNombre = archivo.name.toLowerCase();
      const tieneExtensionValida = extensionesPermitidas.some(extension => archivoNombre.endsWith(extension));

      if (!tieneExtensionValida) {
          alert('El frente de DNI de debe ser en formato .jpeg o jpg');
          return false;
      }
  }
  return true; // Envía el formulario si todas las validaciones pasan
}