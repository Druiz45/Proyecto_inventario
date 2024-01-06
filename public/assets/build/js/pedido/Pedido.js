import { validateDoc } from "./../user/User.js";
import { validateNameProducto } from "./../producto/Producto.js";
import { number_format } from "./../producto/Producto.js";
import { getBancos } from "./../banco/Banco.js";
export class Pedido {

    getDataFormCreate() {
        // getClienteForDoc();
        // getProductForCoincidencia();
        getBancos();
    }

    updatePedido() {
        const formUpdatePedido = document.getElementById('form-update-pedido');

        if (formUpdatePedido) {
            formUpdatePedido.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(formUpdatePedido);
                const gets = window.location.search;
                const params = new URLSearchParams(gets);
                const pedido = params.get('pedido');
                formData.append("pedido", pedido);
                fetch(`/${url}/pedido/update`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        // console.log(data);
                        if (data == "Pedido actualizado con exito!") {
                            Swal.fire({
                                icon: 'success',
                                title: data,
                            })
                            // document.getElementById('valor-producto').innerText = "Valor del producto:";
                        } else if (data == "Error al actualizar el pedido") {
                            Swal.fire({
                                icon: 'error',
                                text: data,
                            })
                            // document.getElementById('valor-producto').innerText = "Valor del producto:";
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: data,
                            })
                        }
                    })
            })

        }
    }

    // validateFormData() {

    //     const formCreatePedido = document.getElementById('form-create-pedido');

    //     if (formCreatePedido) {

    //         const docCliente = document.getElementById('docCliente');
    //         const nombreProducto = document.getElementById('nombreProducto');
    //         const abonoProducto = document.getElementById('abonoProducto');
    //         const anotacion = document.getElementById('anotacion');

    //         validateDoc(docCliente);
    //         validateNameProducto(nombreProducto);
    //         validateAbonoProducto(abonoProducto);
    //         validateAnotacion(anotacion);
    //     }

    // }

    // getDataFormUpdate() {

    //     const formUpdatePedido = document.getElementById('formUpdatePedido');

    //     if (formUpdatePedido) {
    //         const gets = window.location.search;
    //         const params = new URLSearchParams(gets);
    //         const pedido = params.get('pedido');
    //         const formData = new FormData();
    //         formData.append('pedido', pedido);
    //         window.addEventListener('load', () => {
    //             fetch(`/${url}/pedido/getDataFormUpdate`, {
    //                 method: "POST",
    //                 body: formData
    //             })
    //                 .then(respuesta => respuesta.json())
    //                 .then(data => {
    //                     this.setDataFormUpdate(data);
    //                 })
    //         });
    //     }
    // }

    // setDataFormUpdate(data) {
    //     const spanValorProducto = document.getElementById('valor-producto');
    //     const fechaLimite = document.getElementById("fecha-limite");
    //     const anotacion = document.getElementById("anotacion");
    //     const banco = document.getElementById("banco");
    //     docCliente.value = data[0].documento;
    //     docCliente.dispatchEvent(new Event('input', { bubbles: true }));
    //     setTimeout(() => {
    //         cliente.value = data[0].id_cliente;
    //     }, 100);
    //     nombreProducto.value = data[0].producto_nombre;
    //     nombreProducto.dispatchEvent(new Event('input', { bubbles: true }));
    //     setTimeout(() => {
    //         producto.value = data[0].id_producto;
    //     }, 100);
    //     spanValorProducto.innerText = `Valor del producto: $${number_format(data[0].precio)}`;
    //     fechaLimite.value = data[0].fecha_limite;
    //     anotacion.value = data[0].anotacion;
    //     banco.value = data[0].id_banco;
    // }

    // getPrecio(producto, data, spanValorProducto) {
    //     producto.addEventListener('input', () => {

    //         if (producto.value.trim() != "") {
    //             const indice = (producto.selectedIndex - 1);
    //             spanValorProducto.innerText = `Valor del producto: $${number_format(data[indice].precio)}`;
    //         } else {
    //             spanValorProducto.innerText = "";
    //         }

    //     })
    // }

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
                        if (data == "Pedido registrado con exito!") {
                            Swal.fire({
                                icon: 'success',
                                title: data,
                            })
                            // formCreatePedido.reset();
                            // document.getElementById('valor-producto').innerText = "Valor del producto:";
                        } else if (data == "Error al registrar el pedido") {
                            Swal.fire({
                                icon: 'error',
                                text: data,
                            })
                            // formCreatePedido.reset();
                            // document.getElementById('valor-producto').innerText = "Valor del producto:";
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: data,
                            })
                        }
                    })
            })

        }

    }

}

// function validateAbonoProducto(input) {

//     input.addEventListener("keypress", (e) => {

//         // setTimeout(() => {

//         // // let a = numero.value.replace(/[^\d,-]/g, ''); // Eliminar cualquier caracter no numérico, excepto '-' y '.'
//         // let b = parseInt(a);
//         // numero.value = number_format(b, 0, '.', '.');

//         const tecla = e.key;
//         let valorProducto = input.value;

//         if (isNaN(tecla) || tecla.trim() === "" || valorProducto.length == 11) {
//             e.preventDefault();
//         } else {

//             input.addEventListener("input", () => {
//                 if (input.value.trim() != "" && input.value != "$") {
//                     valorProducto = input.value.replace(/[^\d,-]/g, '');
//                     const valorParseado = parseInt(valorProducto);

//                     input.value = "$" + number_format(valorParseado, 0, '.', '.');
//                 }
//             });

//         }


//         // }, 100);

//     });
// }

// // numero.addEventListener("input", () => {

// // })

// export function validateAnotacion(input) {

//     input.addEventListener("keypress", (e) => {

//         //   const tecla = e.key;
//         const textoIngresado = input.value;
//         //   const patron = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

//         if (textoIngresado.length == 100) {
//             e.preventDefault();
//             input.value = textoIngresado.substring(0, 100);
//         }

//     });

// }

// export function getProductForCoincidencia() {
//     const pedido = new Pedido();
//     const nombreProducto = document.getElementById("nombreProducto");
//     const producto = document.getElementById("producto");
//     const spanValorProducto = document.getElementById('valor-producto');
//     nombreProducto.addEventListener("input", () => {
//         if (nombreProducto.value.trim() != "") {
//             producto.disabled = false;
//             if (spanValorProducto) {
//                 spanValorProducto.innerText = "Valor del producto:";
//             }
//             const formData = new FormData();
//             formData.append("nombreProducto", nombreProducto.value);
//             fetch(`/${url}/pedido/getDataFormRegistrar`, {
//                 method: "POST",
//                 body: formData
//             })
//                 .then(respuesta => respuesta.json())
//                 .then(data => {
//                     if (Array.isArray(data)) {
//                         producto.innerHTML = `<option value="">Seleccione el producto</option>`;
//                         for (const info of data) {
//                             producto.innerHTML += `<option value="${info.id}">${info.producto}</option>`;
//                         }
//                         if (spanValorProducto) {
//                             pedido.getPrecio(producto, data, spanValorProducto);
//                         }
//                     }
//                     else {
//                         producto.innerHTML = `<option value="">${data}</option>`;
//                     }
//                 })
//         }
//         else {
//             producto.disabled = true;
//             producto.innerHTML = `<option value=""></option>`;
//         }

//     })
// }

// export function getClienteForDoc() {
//     const formUpdateCompra = document.getElementById('formUpdateCompra');
//     if (!formUpdateCompra) {

//         const docCliente = document.getElementById("docCliente");
//         const cliente = document.getElementById("cliente");
//         docCliente.addEventListener("input", () => {
//             if (docCliente.value.trim() != "") {
//                 cliente.disabled = false;
//                 const formData = new FormData();
//                 formData.append("docCliente", docCliente.value);
//                 fetch(`/${url}/pedido/getDataFormRegistrar`, {
//                     method: "POST",
//                     body: formData
//                 })
//                     .then(respuesta => respuesta.json())
//                     .then(data => {
//                         if (Array.isArray(data)) {
//                             cliente.innerHTML = `<option value="">Seleccione el cliente</option>`;
//                             for (const info of data) {
//                                 cliente.innerHTML += `<option value="${info.id}">${info.cliente}</option>`;
//                             }
//                         }
//                         else {
//                             cliente.innerHTML = `<option value="">${data}</option>`;
//                         }
//                     })
//             }
//             else {
//                 cliente.disabled = true;
//                 cliente.innerHTML = `<option value=""></option>`;
//             }

//         })

//     }

// }

export function setSaldo() {
    let total = document.getElementById("total");
    let abono = document.getElementById("abono");

    abono.addEventListener("input", () => {
        setTimeout(function () {
            let saldo = document.getElementById("saldo");
            saldo.value = number_format(total.value.replace(/[^\d,-]/g, '') - abono.value.replace(/[^\d,-]/g, ''));
        }, 1000);

    })
}


export function formatTotalAndAbono() {

    let total = document.getElementById("total");
    let abono = document.getElementById("abono");

    total.addEventListener('input', () => {
        let valor = parseInt(total.value.replace(/[^\d,-]/g, ''));
        total.value = number_format(valor, 0, '.', '.');
    })

    abono.addEventListener('input', () => {
        let valor = parseInt(abono.value.replace(/[^\d,-]/g, ''));
        abono.value = number_format(valor, 0, '.', '.');
    })

}

