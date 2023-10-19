const app = Vue.createApp({
    data() {
        return {
            usuarios: [],
            usuario: {
                dni: '',
                nombre: '',
                apellido: '',
                email: '',
                contraseña: '',
                fecha_registro: '',
                fotocopia_dni: '',
                activado: ''
            },
            usuarioEditado: {
                id: '',
                dni: '',
                nombre: '',
                apellido: '',
                email: '',
                activado: ''
            }
        };
    },
    methods: {
        obtenerFechaActual() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
        async obtenerUsuarios() {
            try {
                const response = await fetch('http://localhost/proyecto_programacion/biblioteca/API.php');
                const data = await response.json();
                this.usuarios = data;
            } catch (error) {
                console.error('Error:', error);
            }
        },
        async crearUsuario() {
            try {
                const headers = new Headers({
                    'Content-Type': 'application/json',
                });

                const requestOptions = {
                    method: 'POST',
                    headers: headers,
                    body: JSON.stringify(this.usuario),
                };

                const response = await fetch('http://localhost/biblioteca/api/usuarios.php', requestOptions);

                if (!response.ok) {
                    console.error('Error al agregar el usuario');
                    return;
                }

                // Actualizar la lista de usuarios después de agregar uno nuevo
                await this.obtenerUsuarios();

            } catch (error) {
                console.error('Error:', error);
            }
        },
        async eliminarUsuario(id) {
            try {
                const response = await fetch(`http://localhost/biblioteca/api/usuarios.php?id=${id}`, {
                    method: 'DELETE'
                });

                if (!response.ok) {
                    console.error('Error al eliminar el usuario');
                    return;
                }

                // Actualizar la lista de usuarios después de eliminar uno
                await this.obtenerUsuarios();

            } catch (error) {
                console.error('Error:', error);
            }
        },
        async editarUsuario(id) {
            // Buscar el usuario por su ID en el array de usuarios
            const usuarioEditar = this.usuarios.find(usuario => usuario.id === id);

            // Asignar los valores del usuario a usuarioEditado para que aparezcan en el formulario de edición
            this.usuarioEditado = {
                id: usuarioEditar.id,
                dni: usuarioEditar.dni,
                nombre: usuarioEditar.nombre,
                apellido: usuarioEditar.apellido,
                email: usuarioEditar.email,
                activado: usuarioEditar.activado
            };

            // Abre el modal de edición usando un framework de modal, como Bootstrap, si lo estás utilizando
            // Ejemplo: $('#editarUsuarioModal').modal('show');
            $('#editarUsuarioModal').modal('show');
        },

        async guardarCambios() {
            // Encuentra el índice del usuario a editar en el array de usuarios
            const index = this.usuarios.findIndex(usuario => usuario.id === this.usuarioEditado.id);

            // Actualiza los valores del usuario con los valores de usuarioEditado
            this.usuarios[index].dni = this.usuarioEditado.dni;
            this.usuarios[index].nombre = this.usuarioEditado.nombre;
            this.usuarios[index].apellido = this.usuarioEditado.apellido;
            this.usuarios[index].email = this.usuarioEditado.email;
            this.usuarios[index].activado = this.usuarioEditado.activado;

            // Cierra el modal de edición si estás usando un framework de modal, como Bootstrap
            $('#editarUsuarioModal').modal('hide');
            // Cierra el modal usando la API de Bootstrap modal
            

            // Realiza una solicitud para guardar los cambios en el servidor si es necesario
            try {
                const headers = new Headers({
                    'Content-Type': 'application/json',
                });

                const requestOptions = {
                    method: 'PUT', // O PATCH, dependiendo de la API
                    headers: headers,
                    body: JSON.stringify(this.usuarioEditado),
                };

                const response = await fetch(`http://localhost/biblioteca/api/usuarios.php?id=${this.usuarioEditado.id}`, requestOptions);

                if (!response.ok) {
                    console.error('Error al guardar los cambios del usuario');
                    return;
                }

                // Limpia los valores en usuarioEditado después de guardar los cambios
                this.usuarioEditado = {
                    id: '',
                    dni: '',
                    nombre: '',
                    apellido: '',
                    email: '',
                    activado: '',
                };

            } catch (error) {
                console.error('Error:', error);
            }
        },

        async verificarDNI() {
            try {
                const response = await fetch(`http://localhost/biblioteca/api/verificar_dni.php?dni=${this.usuario.dni}`);
                const data = await response.json();
    
                if (data.existe) {
                    // Si el DNI existe en la base de datos, llenar los campos con los datos del usuario
                    this.usuario = {
                        dni: data.usuario.dni,
                        nombre: data.usuario.nombre,
                        apellido: data.usuario.apellido,
                        email: data.usuario.email,
                        pass: data.usuario.pass,  // Asegúrate de manejar correctamente la contraseña, idealmente no deberías enviarla al cliente
                        // ...otros campos
                    };
                } else {
                    // Si el DNI no existe, dejar los campos en blanco
                    this.usuario = {
                        dni: '',
                        nombre: '',
                        apellido: '',
                        email: '',
                        pass: '',  // Asegúrate de manejar correctamente la contraseña, idealmente no deberías enviarla al cliente
                        // ...otros campos
                    };
                }
            } catch (error) {
                console.error('Error:', error);
            }
        },
    },

    mounted() {
        this.obtenerUsuarios();
    },
});

app.mount('#app');
