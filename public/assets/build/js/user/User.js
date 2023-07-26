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
          window.location.assign(`/${url}/${data}`);
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

  setDataFormCreate(data) {
    const select = document.getElementById('select-perfiles');
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

  saveUser(url) {

    const formCreateUser = document.getElementById('form-create-user');
    formCreateUser.addEventListener('submit', (e) => {
      e.preventDefault();
      const form = new FormData(formCreateUser);
      fetch(`/${url}/usuario/create`, {
        method: "POST",
        body: form
      })
        .then(respuesta => respuesta.json())
        .then(data => {
          console.log(data);
          formCreateUser.reset();
        })
    });

  }

  validateFormData() {

    const inputNombre = document.getElementById("nombres");
    const inputApellido = document.getElementById("apellidos");
    const inputDocumento = document.getElementById("documento");

    validateName(inputNombre);
    validateName(inputApellido);
    validateDoc(inputDocumento);
    function validateName(input) {

      input.addEventListener("keypress", (e) => {

        const tecla = e.key;
        // const textoIngresado = inputNombre.value;
        const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/;

        if (!patron.test(tecla) || !e.key === "Backspace" || !e.key === "Delete") {
          e.preventDefault();
        }

      });

    }

    function validateDoc(input) {

      input.addEventListener("keypress", (e) => {

        const tecla = e.key;
        // const textoIngresado = inputNombre.value;
        const patron = !/^\d$/;

        if (!patron.test(tecla) || !e.key === "Backspace" || !e.key === "Delete") {
          e.preventDefault();
        }

      });
    }

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
            tbody.innerHTML+=`<tr>
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

  logOut(url) {
    const logOut = document.getElementById('logOut');
    logOut.addEventListener('click', (e) => {
      e.preventDefault();
      fetch(`/${url}/usuario/logOut`, {
      })
        .then(respuesta => respuesta.json())
        .then(data => {
          window.location.assign(`/${url}/${data}`);
        })
    });
  }

}