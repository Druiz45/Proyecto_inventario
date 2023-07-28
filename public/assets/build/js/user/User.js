export class User {

  // constructor(nombre = "", apellidos = "", documento = "", email = "", celular = "", direccion = "", pass = "", confirmPass = "") {
  //   this.nombre = nombre;
  //   this.apellidos = apellidos;
  // }

  login(url) {

    const formLogin = document.getElementById('form-login');

    formLogin.addEventListener('submit', (e) => {
      e.preventDefault();
      const formData = new FormData(formLogin);
      fetch(`/${url}/index/login`, {
        method: "POST",
        body: formData
      })
        .then(respuesta => respuesta.json())
        .then(data => {
          if (Array.isArray(data)) {
            window.location.assign(`/${url}/${data[0]}`);
          } else if (data == "Porfavor Complete los campos") {

            Swal.fire({
              icon: 'warning',
              title: data,
              // text: data,
            })

          }
          else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data,
            })
          }
        })
    });

  }

  getDataFormCreate(url) {

    document.addEventListener('DOMContentLoaded', () => {
      fetch(`/${url}/usuario/dataFormRegistrar`, {
        method: "POST",
      })
        .then(respuesta => respuesta.json())
        .then(data => {
          // console.log(data);
          this.setDataFormCreate(data);
        })
    });

  }

  getDataFormUpdate(url) {

    document.addEventListener('DOMContentLoaded', () => {
      fetch(`/${url}/usuario/dataFormUpdate`, {
        method: "POST",
      })
        .then(respuesta => respuesta.json())
        .then(data => {
          console.log(data);
          this.setDataFormUpdate(data);
        })
    });

  }

  setDataFormCreate(data) {
    const select = document.getElementById('select-perfiles');
    if (select) {
      const opciones = document.createDocumentFragment();

      for (const info of data) {
        const option = document.createElement('option');
        option.value = info.id;
        option.textContent = info.perfil_nombre;
        opciones.appendChild(option);
      }
      // select.innerHTML = '';
      select.appendChild(opciones);
    }

  }

  setDataFormUpdate(data) {
    const formUpdateUser = document.getElementById('form-update-user');
    if (formUpdateUser) {

      document.getElementById('nombres').value = data[0].nombres;
      document.getElementById('apellidos').value = data[0].apellidos;
      document.getElementById('documento').value = data[0].documento;
      document.getElementById('email').value = data[0].email;
      document.getElementById('celular').value = data[0].telefono;
      document.getElementById('direccion').value = data[0].direccion;

      document.getElementById('info-perfil').innerText += ` ${data[0].perfil_nombre}`;
      
    }

  }

  saveUser(url) {
    const formCreateUser = document.getElementById('form-create-user');
    if (formCreateUser) {
      formCreateUser.addEventListener('submit', (e) => {
        e.preventDefault();
        const form = new FormData(formCreateUser);
        fetch(`/${url}/usuario/create`, {
          method: "POST",
          body: form
        })
          .then(respuesta => respuesta.json())
          .then(data => {
            if (data == "Usuario registrado exitosamente!") {
              Swal.fire({
                icon: 'success',
                title: data,
                // text: data,
              })
              formCreateUser.reset();
            } else if (data == "ERROR AL REGISTAR EL USUARIO") {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data,
              })
              formCreateUser.reset();
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

  updateUser(url){

    const formUpdateUser = document.getElementById('form-update-user');

    if(formUpdateUser){

      formUpdateUser.addEventListener('submit', (e) => {
        e.preventDefault();
        const form = new FormData(formUpdateUser);
        fetch(`/${url}/usuario/update`, {
          method: "POST",
          body: form
        })
          .then(respuesta => respuesta.json())
          .then(data => {
            if (data == "Sus datos se han actualizado corretamente!") {
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

  validateFormData() {
    const formCreateUser = document.getElementById('form-create-user');
    const formUpdateUser = document.getElementById('form-update-user');

    if (formCreateUser || formUpdateUser) {
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

      function validateName(input) {

        input.addEventListener("keypress", (e) => {

          const tecla = e.key;
          const textoIngresado = input.value;
          const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

          if (!patron.test(tecla) || !tecla === "Backspace" || !tecla === "Delete" || textoIngresado.length == 50) {
            e.preventDefault();
            input.value = textoIngresado.substring(0, 50);
          }

        });

      }

      function validateDoc(input) {

        input.addEventListener("keypress", (e) => {

          // setTimeout(() => {

          const tecla = e.key;

          const docIngresado = input.value;

          if (isNaN(tecla) || tecla.trim() === "" || docIngresado.length == 12) {
            e.preventDefault();
          }

          // }, 100);

        });
      }

      function validateEmail(input) {

        input.addEventListener("keypress", (e) => {

          const tecla = e.key;
          // const textoIngresado = inputNombre.value;
          const patron = /^[a-zA-Z0-9._%+-@]+$/;

          const emailIngresado = input.value;

          if (!patron.test(tecla) || tecla === "Backspace" || !tecla === "Delete" || emailIngresado.length > 100) {
            e.preventDefault();
          }

        });

      }

      function validatePhone(input) {

        input.addEventListener("keypress", (e) => {

          const tecla = e.key;

          const celularIngresado = input.value;

          if (isNaN(tecla) || tecla.trim() === "" || celularIngresado.length == 10) {
            e.preventDefault();
          }

        });

      }

      function validateAddress(input) {

        input.addEventListener("keypress", (e) => {

          const tecla = e.key;
          // const textoIngresado = inputNombre.value;
          const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ#\s0-9-]+$/;

          const direccionIngresada = input.value;

          if (!patron.test(tecla) || !tecla === "Backspace" || !tecla === "Delete" || direccionIngresada.length == 100) {
            e.preventDefault();
          }

        });

      }
    }

  }

  logOut(url) {
    const logOut = document.getElementById('logOut');
    logOut.addEventListener('click', (e) => {
      e.preventDefault();
      Swal.fire({
        title: '¿Esta seguro de que desea cerrar sesion?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Si',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`/${url}/usuario/logOut`, {

          })
          .then(respuesta => respuesta.json())
          .then(data => {
              window.location.assign(`/${url}/${data}`);
            })
        }
      })
    });
  }

  setUsers() {
    const tbody = document.getElementById('tbody');
    window.addEventListener('DOMContentLoaded', () => {
      fetch(`/${url}/usuario/getUsers`, {
      })
        .then(respuesta => respuesta.json())
        .then(data => {
          let i = 0;
          const tr = document.createElement('tr');
          for (const usuario of data) {
            // const td = document.createElement('td');
            // td.textContent = usuario.nombres;
            // tr.appendChild(td);
            i++;
            tbody.innerHTML += `<tr>
                  <td>${i}</td>
                  <td>${usuario.nombres}</td>
                  <td>${usuario.apellidos}</td>
                  <td>${usuario.documento}</td>
                  <td>${usuario.telefono}</td>
                  <td>${usuario.email}</td>
                  <td>${usuario.direccion}</td>
                  <td>${usuario.empresa}</td>
                  <td>${usuario.nit}</td>
                  <td>${usuario.ultimoLog}</td>
                  <td>${usuario.fecha}</td>
                </tr>`;
          }
          tbody.appendChild(tr);
        })
    });
  }

}