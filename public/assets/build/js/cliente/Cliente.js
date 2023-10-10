import { validateName, validateDoc, validateEmail, validatePhone, validateAddress } from "../user/User.js";

export class Cliente{

    createCliente(){
      const formCreateCliente = document.getElementById('form-create-cliente');
      if (formCreateCliente) {
        formCreateCliente.addEventListener('submit', (e) => {
          e.preventDefault();
          const form = new FormData(formCreateCliente);
          fetch(`/${url}/cliente/create`, {
            method: "POST",
            body: form
          })
            .then(respuesta => respuesta.json())
            .then(data => {
              if (data == "Cliente registrado exitosamente!") {
                Swal.fire({
                  icon: 'success',
                  title: data,
                  // text: data,
                })
                formCreateCliente.reset();
              } else if (data == "ERROR AL REGISTAR EL CLIENTE") {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: data,
                })
                formCreateCliente.reset();
              } else {
                Swal.fire({
                  icon: 'warning',
                  title: data,
                  // text: data,
                })
              }
            })
        });
      }
    }

    validateFormData() {
        const formCreateCliente = document.getElementById('form-create-cliente');

        const formUpdate = document.getElementById('form-update-cliente');
    
        if (formCreateCliente || formUpdate) {
          const inputNombre = document.getElementById("nombres");
          const inputApellido = document.getElementById("apellidos");
          const inputDocumento = document.getElementById("documento");
          const inputEmail = document.getElementById("email");
          const inputCelular = document.getElementById("celular");
          const inputDireccion = document.getElementById("direccion");
    
          validateName(inputNombre);
          validateName(inputApellido);
          validateDoc(inputDocumento);
          validateEmail(inputEmail);
          validatePhone(inputCelular);
          validateAddress(inputDireccion);
    
        }
    
      }

      getDataFormUpdate(url) {

        const formUpdate = document.getElementById('form-update-cliente');

        if(formUpdate){

          document.addEventListener('DOMContentLoaded', () => {
            const gets = window.location.search;
            const params = new URLSearchParams(gets);
            const cliente = params.get('cliente');
            const formData = new FormData();
            formData.append('cliente', cliente);
            fetch(`/${url}/cliente/dataFormUpdate`, {
              method: "POST",
              body: formData,
            })
              .then(respuesta => respuesta.json())
              .then(data => {
                console.log(data);
                this.setDataFormUpdate(data);
              })
          });

        }
    
      }

      setDataFormUpdate(data) {
        const formUpdate = document.getElementById('form-update-cliente');
        if (formUpdate) {

          const inputNombre = document.getElementById("nombres");
          const inputApellido = document.getElementById("apellidos");
          const inputDocumento = document.getElementById("documento");
          const inputEmail = document.getElementById("email");
          const inputCelular = document.getElementById("celular");
          const inputCelularSecundario = document.getElementById("celularSecundario");
          const inputDireccion = document.getElementById("direccion");

          inputNombre.value = data[0].nombres;
          inputApellido.value = data[0].apellidos;
          inputDocumento.value = data[0].documento;
          inputEmail.value = data[0].email;
          inputCelular.value = data[0].telefono;
          inputDireccion.value = data[0].direccion;
          inputCelularSecundario.value = data[0].telefonoSecundario;

        }
    
      }

      updateCliente(url) {

        const formUpdateCliente = document.getElementById('form-update-cliente');
    
        if (formUpdateCliente) {
    
          formUpdateCliente.addEventListener('submit', (e) => {
            e.preventDefault();

            const gets = window.location.search;
            const params = new URLSearchParams(gets);
            const cliente = params.get('cliente');
            const form = new FormData(formUpdateCliente);

            form.append('cliente', cliente);
            fetch(`/${url}/cliente/update`, {
              method: "POST",
              body: form
            })
              .then(respuesta => respuesta.json())
              .then(data => {
                if (data == "Los datos del cliente se han actualizado corretamente!") {
                  Swal.fire({
                    icon: 'success',
                    title: data,
                    // text: data,
                  })
                  // formCreateUser.reset();
                } else if (data == "Ha ocurrido un error al intentar actualizar") {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data,
                  })
                  // formCreateUser.reset();
                } else {
                  Swal.fire({
                    icon: 'warning',
                    title: data,
                    // text: data,
                  })
                  // console.log(data);
                }
              })
          });
    
        }
    
      }

}