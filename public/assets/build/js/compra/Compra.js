import { validateDoc } from "./../user/User.js";
import { validateNameProducto, validatePrecio, number_format  } from "./../producto/Producto.js";
import { validateAnotacion, getClienteForDoc, getProductForCoincidencia } from "./../pedido/Pedido.js";

export class Compra {

    getDataFormCreate() {
        getClienteForDoc();
        getProductForCoincidencia();
        this.getProveedorForDoc();
    }

    getProveedorForDoc(){
        const docProveedor = document.getElementById("docProveedor");
        const proveedor = document.getElementById("proveedor");
        docProveedor.addEventListener("input", () => {
            if (docProveedor.value.trim() != "") {
                proveedor.disabled = false;
                const formData = new FormData();
                formData.append("docProveedor", docProveedor.value);
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
    }

    saveCompra() {
        const formCreateCompra = document.getElementById('formCreateCompra');

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

            const docProveedor = document.getElementById('docProveedor');
            const docCliente = document.getElementById('docCliente');
            // const nombreProducto = document.getElementById('nombreProducto');
            const abonoProducto = document.getElementById('abonoProducto');
            const anotacion = document.getElementById('anotacion');
            const valorProducto = document.getElementById("valorProducto");

            validateDoc(docProveedor);
            validateDoc(docCliente);
            validateNameProducto(nombreProducto);
            validatePrecio(abonoProducto);
            validateAnotacion(anotacion);
            validatePrecio(valorProducto);
        }

    }

    getDataFormUpdate(){
        const formUpdateCompra=document.getElementById("formUpdateCompra");

        if (formUpdateCompra){
            const gets = window.location.search;
            const params = new URLSearchParams(gets);
            const compra = params.get('compra');
            const formData = new FormData();
            formData.append('compra', compra);
            window.addEventListener('load', () => {
                fetch(`/${url}/compra/getDataFormUpdate`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        console.log(data);
                        this.setDataFormUpdate(data);
                    })
            });
        }

    }

    setDataFormUpdate(data) {
        const fechaLimite = document.getElementById("fecha-limite");
        const anotacion = document.getElementById("anotacion");
        const valorProducto=document.getElementById("valorProducto");
        validatePrecio(valorProducto);
        docProveedor.value = data[0].documento;
        docProveedor.dispatchEvent(new Event('input', { bubbles: true }));
        setTimeout(() => {
            proveedor.value = data[0].id_proveedor;
        }, 100);
        nombreProducto.value = data[0].producto_nombre;
        nombreProducto.dispatchEvent(new Event('input', { bubbles: true }));
        setTimeout(() => {
            producto.value = data[0].id_producto;
        }, 100);
        valorProducto.value = `$${number_format(data[0].valor_total)}`;
        fechaLimite.value = data[0].fecha_limite;
        anotacion.value = data[0].anotacion;
    }

    updateCompra() {
        const formUpdateCompra = document.getElementById('formUpdateCompra');

        if (formUpdateCompra) {
            formUpdateCompra.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(formUpdateCompra);
                const gets = window.location.search;
                const params = new URLSearchParams(gets);
                const compra = params.get('compra');
                formData.append("compra", compra);
                fetch(`/${url}/compra/update`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (data == "exito") {
                            Swal.fire({
                                icon: 'success',
                                title: "Actualizacion exitosa",
                            })
                        } else if (data == "error") {
                            Swal.fire({
                                icon: 'error',
                                text: "Error al actualizar",
                            })
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


