


let confirmar_Modal = document.getElementById("ConfirmarModal");
confirmar_Modal.addEventListener('shown.bs.modal',event =>{
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id');

    let inputId = confirmar_Modal.querySelector('.modal-body #id');
    let inputFprestamo = confirmar_Modal.querySelector('.modal-body #fechaprestamo');
    let inputFvencimiento = confirmar_Modal.querySelector('.modal-body #fechavencimiento');
    let inputEmail = confirmar_Modal.querySelector('.modal-body #email');



    let formData = new FormData();
    formData.append('id',id);

    fetch("./controllers/consultarPrestamo.php",{
        method: 'POST',
        body: formData,

    }).then(response => response.json())
    .then(data =>{
        // console.log(data); //confirmacion de que trajo los datos

        inputId.value  = data[0].id
        inputFprestamo.value = data[0].fecha_prestamo
        inputFvencimiento.value = data[0].fecha_vencimiento
        inputEmail.value = data[0].email




    }).catch(err =>console.log(err));
});

let Detalles_modal = document.getElementById("DetalleModal");

Detalles_modal.addEventListener('shown.bs.modal',event =>{
    let btonDetalles  = event.relatedTarget;
    let id  =btonDetalles.getAttribute('data-bs-id');

    let valueDetallesid = Detalles_modal.querySelector('.modal-body #id');
    let valueDetallesNombre = Detalles_modal.querySelector('.modal-body #nombreusuario');
    let valueDetallesApellido = Detalles_modal.querySelector('.modal-body #apellidousuario');
    let valueDetallesDNI = Detalles_modal.querySelector('.modal-body #emailusuario');

    let formData = new FormData();
    formData.append('id',id);

    fetch("./controllers/consultarDetalles.php",{
        method: 'POST',
        body: formData,

    }).then(response => response.json())
    .then(data =>{
        // console.log(data); //confirmacion de que trajo los datos

        valueDetallesid.value  = data[0].id
        valueDetallesNombre.value = data[0].nombre
        valueDetallesApellido.value = data[0].apellido
        valueDetallesDNI.value = data[0].email




    }).catch(err =>console.log(err));
});

let BajaModal = document.getElementById("BajaModal");

BajaModal.addEventListener('shown.bs.modal', event=>{
    let btonBaja = event.relatedTarget;
    let id = btonBaja.getAttribute('data-bs-id');

    let valueBajaid = BajaModal.querySelector('.modal-body #id');
    let valueBajaprestamo = BajaModal.querySelector('.modal-body #fechaprestamo');
    let valueBajaEmail =  BajaModal.querySelector('.modal-body #email');
    
    let formdata = new FormData();
    formdata.append("id",id);
    

    fetch("./controllers/consultarPrestamo.php",{
        method: 'POST',
        body: formdata
    }).then(response =>{
        if(response.ok){
            return response.json()
        }
    }).then(data =>{
        valueBajaid.value = data[0].id
        valueBajaprestamo.value = data[0].fecha_prestamo
    }).then(
        fetch("../controllers/consultarDetalles.php",{
            method: 'POST',
            body: formdata
        }).then(response => response.json())
        .then(datas =>{
            valueBajaEmail.value = datas[0].email
        })
    );
});

function actualizarpag(){
    window.location.reload();
}
