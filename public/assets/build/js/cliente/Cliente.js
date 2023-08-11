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
    
        if (formCreateCliente) {
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

}