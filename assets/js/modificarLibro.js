$(document).ready(function() {
    
    const idLibro = obtenerIdLibroDeLaURL();

    // Cargar la información del libro
    obtenerInfoDelLibro(idLibro).then(info => {
        if (info.id) {
            $('#idLibroVer').text(info.id);
            $('#idLibro').val(info.id);
            $('#nombre').val(info.nombre);
            $('#foto').val(info.foto);
            $('#descripcion').val(info.descripcion);
            $('#autor').val(info.autores_id);
            $('#genero').val(info.generos_id);
            
        } else {
            console.error('No se pudo obtener la información del libro.');
        }
    });
});

async function obtenerInfoDelLibro(idLibro) {
    try {
        const response = await fetch(`http://localhost/proyecto_programacion/controllers/obtener_info_libro.php?id=${idLibro}`);
        const data = await response.json();
        if (data.id) {
            const autor = await obtenerNombreAutor(data.autores_id);
            const genero = await obtenerNombreGenero(data.generos_id);
            data.autor_nombre = autor;
            data.genero_nombre = genero;
            return data;
        }
        return data;
    } catch (error) {
        console.error('Error al obtener información del libro:', error);
        return {};
    }
}

function obtenerIdLibroDeLaURL() {
    // Define cómo obtendrás el id del libro de la URL
    // Por ejemplo, si la URL es "modificarLibro.html?id=123", puedes usar:
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('id');
}

async function obtenerNombreAutor(idAutor) {
    try {
        const response = await fetch(`http://localhost/proyecto_programacion/controllers/obtener_nombre_autor.php?id=${idAutor}`);
        const data = await response.json();
        return data.nombre; // Supongo que el nombre del autor está en el campo 'nombre'
    } catch (error) {
        console.error('Error al obtener nombre del autor:', error);
    }
    return 'Autor Desconocido'; // O un valor por defecto
}

async function obtenerNombreGenero(idGenero) {
    try {
        const response = await fetch(`http://localhost/proyecto_programacion/controllers/obtener_nombre_genero.php?id=${idGenero}`);
        const data = await response.json();
        return data.nombre; // Supongo que el nombre del género está en el campo 'nombre'
    } catch (error) {
        console.error('Error al obtener nombre del género:', error);
    }
    return 'Género Desconocido'; // O un valor por defecto
}
