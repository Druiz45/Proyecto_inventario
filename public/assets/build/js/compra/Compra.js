export class Compra {

    getDataFormCreate() {

        const documento = document.getElementById("documento");
        const provedor = document.getElementById("provedor");
        const nombreProducto = document.getElementById("nombreProducto");
        const producto = document.getElementById("producto");
        const spanValorProducto = document.getElementById('valor-producto');

        documento.addEventListener("input", () => {
            if (documento.value.trim() != "") {
                provedor.disabled = false;
                const formData = new FormData();
                formData.append("documento", documento.value);
                fetch(`/${url}/compra/getDataFormRegistrar`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            provedor.innerHTML = `<option value="">Seleccione el provedor</option>`;
                            for (const info of data) {
                                provedor.innerHTML += `<option value="${info.id}">${info.provedor}</option>`;
                            }
                        }
                        else {
                            provedor.innerHTML = `<option value="">${data}</option>`;
                        }
                    })
            }
            else {
                provedor.disabled = true;
                provedor.innerHTML = `<option value=""></option>`;
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
                        if (data == "Pedido registrado con exito!") {
                            Swal.fire({
                                icon: 'success',
                                title: data,
                                // text: data,
                            })
                            formCreatePedido.reset();
                            document.getElementById('valor-producto').innerText = "Valor del producto:";
                        } else if (data == "Error al registrar el pedido") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data,
                            })
                            formCreatePedido.reset();
                            document.getElementById('valor-producto').innerText = "Valor del producto:";
                        } else {
                            console.log(data);
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