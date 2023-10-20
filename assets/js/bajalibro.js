$(document).ready(function() {
    const idLibro = obtenerIdLibroDeLaURL();

    obtenerInfoStockLibro(idLibro).then(info => {
        $('#cantidad').val(info.cantidad);
        $('#nombreLibro').text(info.nombre);
        document.getElementById('cantidadMAX').value = info.cantidad;
    });

    if (idLibro !== null) {
        document.getElementById('idLibro').value = idLibro;
    } else {
        console.error('No se pudo obtener el ID del libro desde la URL');
    }
});

async function obtenerInfoStockLibro(idLibro) {
    try {
        const response = await fetch(`http://localhost/proyecto_programacion/controllers/obtener_info_baja_libro.php?id=${idLibro}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error al obtener información del stock del libro:', error);
        return {};
    }
}

function obtenerIdLibroDeLaURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('id');
}

