export class User{

  // constructor(nombre = "", apellidos = "", documento = "", email = "", celular = "", direccion = "", pass = "", confirmPass = "") {
  //   this.nombre = nombre;
  //   this.apellidos = apellidos;
  // }

    login() {

        const formLogin = document.getElementById('form-login');

        const formData = new FormData(formLogin);

        formLogin.addEventListener('submit', (e) =>{
            e.preventDefault();
            fetch("./home/user", {
              method: "POST",
              body: formData
            })
            .then(respuesta => respuesta.json())
            .then(data => {
              console.log(data)
            })
        });

      }

      getDataFormCreate(url){

        document.addEventListener('DOMContentLoaded', () =>{
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

      setDataFormCreate(data){
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

      saveUser(url){

        const formCreateUser = document.getElementById('form-create-user');
        formCreateUser.addEventListener('submit', (e) =>{
          e.preventDefault();
          const form = new FormData(formCreateUser);
          fetch(`/${url}/usuario/create`,{
            method: "POST",
            body: form
          })
          .then(respuesta => respuesta.json())
          .then(data =>{
            console.log(data);
              formCreateUser.reset();
          })
        });

      }

      validateFormData(){

        const inputNombre = document.getElementById("nombres");
        const inputApellido = document.getElementById("apellidos");
        const inputDocumento = document.getElementById("documento");

        validateName(inputNombre);
        validateName(inputApellido);
        validateDoc(inputDocumento);
        function validateName(input){

          input.addEventListener("keypress", (e) => {

            const tecla = e.key;
            // const textoIngresado = inputNombre.value;
            const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/;
          
            if (!patron.test(tecla) || !e.key === "Backspace" || !e.key === "Delete") {
              e.preventDefault();
            }
  
          });

        }

        function validateDoc(input){

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

      logOut() {

      }



}