import { validateDoc } from "./../user/User.js";
import { validateNameProducto } from "./../producto/Producto.js";
export class Pedido {

    getDataFormCreate() {

        const documento = document.getElementById("documento");
        const cliente = document.getElementById("cliente");
        const nombreProducto = document.getElementById("nombreProducto");
        const producto = document.getElementById("producto");
        const spanValorProducto = document.getElementById('valor-producto');

        documento.addEventListener("input", () => {
            if (documento.value.trim() != "") {
                cliente.disabled = false;
                const formData = new FormData();
                formData.append("documento", documento.value);
                fetch(`/${url}/pedido/getDataFormRegistrar`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            cliente.innerHTML = `<option value="">Seleccione el cliente</option>`;
                            for (const info of data) {
                                cliente.innerHTML += `<option value="${info.id}">${info.cliente}</option>`;
                            }
                        }
                        else {
                            cliente.innerHTML = `<option value="">${data}</option>`;
                        }
                    })
            }
            else {
                cliente.disabled = true;
                cliente.innerHTML = `<option value=""></option>`;
            }

        })

        nombreProducto.addEventListener("input", () => {
            if (nombreProducto.value.trim() != "") {
                producto.disabled = false;
                const formData = new FormData();
                formData.append("nombreProducto", nombreProducto.value);
                fetch(`/${url}/pedido/getDataFormRegistrar`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        console.log(data);
                        if (Array.isArray(data)) {
                            producto.innerHTML = `<option value="">Seleccione el producto</option>`;
                            for (const info of data) {
                                producto.innerHTML += `<option value="${info.id}">${info.producto}</option>`;
                            }
                            this.getPrecio(producto, data, spanValorProducto);
                        }
                        else {
                            producto.innerHTML = `<option value="">${data}</option>`;
                        }
                    })
            }
            else {
                producto.disabled = true;
                producto.innerHTML = `<option value=""></option>`;
            }

        })

    }

    validateFormData() {

        const formCreatePedido = document.getElementById('form-create-pedido');

        if (formCreatePedido) {

            const documento = document.getElementById('documento');
            const nombreProducto = document.getElementById('nombreProducto');
            const abonoProducto = document.getElementById('abonoProducto');
            const anotacion = document.getElementById('anotacion');

            validateDoc(documento);
            validateNameProducto(nombreProducto);
            validateAbonoProducto(abonoProducto);
            validateAnotacion(anotacion);
        }

    }

    getPrecio(producto, data, spanValorProducto){
        producto.addEventListener('input', () => {

            if(producto.value.trim() != ""){
                const indice = (producto.selectedIndex-1);
                spanValorProducto.innerText = data[indice].precio;
            }

        })
    }

    savePedido() {
        const formCreatePedido = document.getElementById('form-create-pedido');

        if (formCreatePedido) {

            formCreatePedido.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(formCreatePedido);
                fetch(`/${url}/pedido/create`, {
                    method: "POST",
                    body: formData
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
            })

        }

    }

}

function validateAbonoProducto(input) {

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

// numero.addEventListener("input", () => {

// })

function validateAnotacion(input){

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

function number_format(number, decimals = 0, decPoint = '.', thousandsSep = '.') {
    number = parseInt(number.toFixed(decimals)); // Redondear el número a la cantidad de decimales deseada
    const [integerPart, decimalPart] = number.toFixed(decimals).split('.');

    const regex = /\B(?=(\d{3})+(?!\d))/g;
    const formattedIntegerPart = integerPart.replace(regex, thousandsSep);

    return decimals > 0 ? formattedIntegerPart + decPoint + decimalPart : formattedIntegerPart;
}