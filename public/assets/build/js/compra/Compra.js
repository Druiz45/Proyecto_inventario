import { validateDoc } from "./../user/User.js";
import { validateNameProducto } from "./../producto/Producto.js";
import { validatePrecio } from "./../producto/Producto.js";
import { validateAnotacion } from "./../pedido/Pedido.js";
export class Compra {

    getDataFormCreate() {

        const documento = document.getElementById("documento");
        const proveedor = document.getElementById("proveedor");
        const nombreProducto = document.getElementById("nombreProducto");
        const producto = document.getElementById("producto");

        documento.addEventListener("input", () => {
            if (documento.value.trim() != "") {
                proveedor.disabled = false;
                const formData = new FormData();
                formData.append("documento", documento.value);
                fetch(`/${url}/compra/getDataFormRegistrar`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            proveedor.innerHTML = `<option value="">Seleccione el proveedor</option>`;
                            for (const info of data) {
                                proveedor.innerHTML += `<option value="${info.id}">${info.provedor}</option>`;
                            }
                        }
                        else {
                            proveedor.innerHTML = `<option value="">${data}</option>`;
                        }
                    })
            }
            else {
                proveedor.disabled = true;
                proveedor.innerHTML = `<option value=""></option>`;
            }

        })

        nombreProducto.addEventListener("input", () => {
            if (nombreProducto.value.trim() != "") {
                producto.disabled = false;
                const formData = new FormData();
                formData.append("nombreProducto", nombreProducto.value);
                fetch(`/${url}/compra/getDataFormRegistrar`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            producto.innerHTML = `<option value="">Seleccione el producto</option>`;
                            for (const info of data) {
                                producto.innerHTML += `<option value="${info.id}">${info.producto}</option>`;
                            }
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

    saveCompra() {
        // const formCreateCompra = document.getElementById('formCreateCompra');

        if (formCreateCompra) {

            formCreateCompra.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(formCreateCompra);
                fetch(`/${url}/compra/create`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            Swal.fire({
                                icon: data[1],
                                text: data[0],
                            })
                            formCreateCompra.reset();
                        } else if (data == "Error") {
                            Swal.fire({
                                icon: 'error',
                                text: "Error al registrar la compra",
                            })
                            formCreateCompra.reset();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                text: data,
                            })
                        }
                    })
            })

        }

    }

    validateFormData() {

        const formCreateCompra = document.getElementById('formCreateCompra');

        if (formCreateCompra) {

            // const documento = document.getElementById('documento');
            // const nombreProducto = document.getElementById('nombreProducto');
            const abonoProducto = document.getElementById('abonoProducto');
            const anotacion = document.getElementById('anotacion');
            const valorProducto = document.getElementById("valorProducto");

            validateDoc(documento);
            validateNameProducto(nombreProducto);
            validatePrecio(abonoProducto);
            validateAnotacion(anotacion);
            validatePrecio(valorProducto);
        }

    }

}


