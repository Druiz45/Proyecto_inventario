export class User{

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

      logOut() {
        this.isLoggedIn = false;
        console.log(`Usuario ${this.username} ha cerrado sesión.`);
      }

}