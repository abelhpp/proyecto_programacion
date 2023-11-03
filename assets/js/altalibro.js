async function obtenerGeneros() {
    try {
        const response = await fetch('http://localhost/proyecto_programacion/controllers/generos_altalibro.php');
        const data = await response.json();
        if (Array.isArray(data)) {
            return data;
        } else {
            console.error('Error: Los datos recibidos no son un arreglo.');
            return [];
        }
    } catch (error) {
        console.error('Error al obtener los géneros:', error);
        return [];
    }
}

async function obtenerAutores() {
    try {
        const response = await fetch('http://localhost/proyecto_programacion/controllers/autores_altalibro.php');
        const data = await response.json();
        if (Array.isArray(data)) {
            return data;
        } else {
            console.error('Error: Los datos recibidos no son un arreglo.');
            return [];
        }
    } catch (error) {
        console.error('Error al obtener los géneros:', error);
        return [];
    }
}

async function agregarNuevoAutor() {
    const nuevoAutor = $('#nuevoAutor').val();
    if (nuevoAutor) {
        try {
            const response = await fetch('http://localhost/proyecto_programacion/controllers/agregar_autor.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `nuevoAutor=${encodeURIComponent(nuevoAutor)}`,
            });
            const data = await response.json();
            if (data.success) {
                alert(data.message);
                cargarAutores();
            } else {
                alert(data.error);
            }
        } catch (error) {
            console.error('Error al agregar autor:', error);
        }
    }
}

async function cargarAutores() {
    obtenerAutores().then(autores => {
        const autorSelect = $('#autor');
        const autorSelect2 = $('#eliminarAutor');
        // Limpiar opciones existentes
        autorSelect.empty();
        autorSelect2.empty();
        autores.forEach(autor => {
            autorSelect.append(`<option value="${autor.id}">${autor.nombre}</option>`);
            autorSelect2.append(`<option value="${autor.id}">${autor.nombre}</option>`);
        });
    });
}

async function agregarNuevoGenero() {
    const nuevoGenero = $('#nuevoGenero').val();
    if (nuevoGenero) {
        try {
            const response = await fetch('http://localhost/proyecto_programacion/controllers/agregar_genero.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `nuevoGenero=${encodeURIComponent(nuevoGenero)}`,
            });
            const data = await response.json();
            if (data.success) {
                alert(data.message);
                cargarGeneros();
            } else {
                alert(data.error);
            }
        } catch (error) {
            console.error('Error al agregar género:', error);
        }
    }
}

async function cargarGeneros() {
    obtenerGeneros().then(generos => {
        const generoSelect = $('#genero');
        const generoSelect2 = $('#eliminarGenero');
        // Limpiar opciones existentes
        generoSelect.empty(); 
        generoSelect2.empty(); 
        generos.forEach(genero => {
            generoSelect.append(`<option value="${genero.id}">${genero.nombre}</option>`);
            generoSelect2.append(`<option value="${genero.id}">${genero.nombre}</option>`);
        });
    });
}

function eliminarAutor() {
    const idAutor = document.getElementById('eliminarAutor').value;
    if (!idAutor) return;

    // Hacer una solicitud al archivo PHP para eliminar el autor
    fetch(`http://localhost/proyecto_programacion/controllers/procesar_eliminar_autor.php?id=${idAutor}`, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cargarAutores();
            alert('Autor eliminado correctamente');
        } else {
            alert('Error al eliminar autor');
        }
    })
    .catch(error => console.error('Error:', error));
}

function eliminarGenero() {
    const idGenero = document.getElementById('eliminarGenero').value;
    if (!idGenero) return;

    // Hacer una solicitud al archivo PHP para eliminar el género
    fetch(`http://localhost/proyecto_programacion/controllers/procesar_eliminar_genero.php?id=${idGenero}`, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cargarGeneros();
            alert('Género eliminado correctamente');
        } else {
            alert('Error al eliminar género');
        }
    })
    .catch(error => console.error('Error:', error));
}