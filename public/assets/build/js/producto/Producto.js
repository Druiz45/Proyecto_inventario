export class Producto {

    saveProducto(url) {
        const formProducto = document.getElementById('formProducto');
        if(formProducto){

            formProducto.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(formProducto);
                fetch(`/${url}/producto/create`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            Swal.fire({
                                icon: `${data[1]}`,
                                title: `${data[0]}`,
                                confirmButtonText: 'Aceptar',
                                text: ``,
                            })
    
                            formProducto.reset();
                        }
                        else if(data == "Error al registrar producto"){
                            Swal.fire({
                                icon: `error`,
                                title: `${data}`,
                                // text: ``,
                            })
                        }
                        else{
                            Swal.fire({
                                icon: `warning`,
                                title: `${data}`,
                                // text: ``,
                            })
                        }
                    })
            });

        }

    }

    getCategorias(url) {
        const categoria = document.getElementById("categoria");
        if(categoria){
            window.addEventListener('DOMContentLoaded', () => {
                fetch(`/${url}/producto/getCategorias`, {
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        this.setCategorias(data, categoria);
                    })
            });
        }
    }

    setCategorias(data, categoria){

      const opciones = document.createDocumentFragment();

      for (const info of data) {
        const option = document.createElement('option');
        option.value = info.id;
        option.textContent = info.categoria;
        opciones.appendChild(option);
      }
      
      categoria.appendChild(opciones);
      
    }

    validateFormData(){

        const formCreateProduct = document.getElementById('formProducto');
    
        if (formCreateProduct) {
          const inputProducto = document.getElementById("producto");
          const inputDescricion = document.getElementById("descripcion");
          const inputPrecio = document.getElementById("valorProducto");
    
          validateNameProducto(inputProducto);
          validateDescriptionProduct(inputDescricion);
          validatePrecio(inputPrecio);

          function validateDescriptionProduct(input) {
    
            input.addEventListener("keypress", (e) => {
    
            //   const tecla = e.key;
              const textoIngresado = input.value;
            //   const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    
              if (textoIngresado.length == 100) {
                e.preventDefault();
                input.value = textoIngresado.substring(0, 100);
              }
    
            });
    
          }
    
        //   function validateDoc(input) {
    
        //     input.addEventListener("keypress", (e) => {
    
        //       // setTimeout(() => {
    
        //       const tecla = e.key;
    
        //       const docIngresado = input.value;
    
        //       if (isNaN(tecla) || tecla.trim() === "" || docIngresado.length == 12) {
        //         e.preventDefault();
        //       }
    
        //       // }, 100);
    
        //     });
        //   }
    
        //   function validateEmail(input) {
    
        //     input.addEventListener("keypress", (e) => {
    
        //       const tecla = e.key;
        //       // const textoIngresado = inputNombre.value;
        //       const patron = /^[a-zA-Z0-9._%+-@]+$/;
    
        //       const emailIngresado = input.value;
    
        //       if (!patron.test(tecla) || tecla === "Backspace" || !tecla === "Delete" || emailIngresado.length > 100) {
        //         e.preventDefault();
        //       }
    
        //     });
    
        //   }

        }

    }

    mifuncion(){

    }

}

export function validateNameProducto(input) {
    
  input.addEventListener("keypress", (e) => {

  //   const tecla = e.key;
    const textoIngresado = input.value;
  //   const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

    if (textoIngresado.length == 25) {
      e.preventDefault();
      input.value = textoIngresado.substring(0, 25);
    }

  });

}

export function validatePrecio(input) {

  input.addEventListener("keypress", (e) => {

      // setTimeout(() => {

      // // let a = numero.value.replace(/[^\d,-]/g, ''); // Eliminar cualquier caracter no numérico, excepto '-' y '.'
      // let b = parseInt(a);
      // numero.value = number_format(b, 0, '.', '.');

      const tecla = e.key;
      let valorProducto = input.value;

      if (isNaN(tecla) || tecla.trim() === "" || valorProducto.length == 11) {
          e.preventDefault();
      } else {

          input.addEventListener("input", () => {
              if (input.value.trim() != "" && input.value != "$") {
                  valorProducto = input.value.replace(/[^\d,-]/g, '');
                  const valorParseado = parseInt(valorProducto);
          
                  input.value = "$"+number_format(valorParseado, 0, '.', '.');
              }
          });

      }


      // }, 100);

  });
}

export function number_format(number, decimals = 0, decPoint = '.', thousandsSep = '.') {
  number = parseInt(number.toFixed(decimals)); // Redondear el número a la cantidad de decimales deseada
  const [integerPart, decimalPart] = number.toFixed(decimals).split('.');

  const regex = /\B(?=(\d{3})+(?!\d))/g;
  const formattedIntegerPart = integerPart.replace(regex, thousandsSep);

  return decimals > 0 ? formattedIntegerPart + decPoint + decimalPart : formattedIntegerPart;
}