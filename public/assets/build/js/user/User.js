export class User{

  constructor(nombre = "") {
    this.nombre = nombre;
  }

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

      logOut() {

      }



}