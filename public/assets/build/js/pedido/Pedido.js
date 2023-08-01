export class Pedido {

    getDataFormCreate() {

        const documento = document.getElementById("documento");
        const cliente = document.getElementById("cliente");
        const nombreProducto = document.getElementById("nombreProducto");
        const producto = document.getElementById("producto");

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

}