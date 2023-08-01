export class Pedido {

    getDataFormCreate() {

        const documento = document.getElementById("documento");
        const cliente = document.getElementById("cliente");
        const nombre = document.getElementById("nombre");
        const producto = document.getElementById("producto");

        documento.addEventListener("input", () => {
            fetch(`/${url}/producto/create`, {
            })
            .then(respuesta => respuesta.json())
            .then(data => {
                cliente.innerHTML = `<option value="">Seleccione el cliente</option>`;
            })
            cliente.disabled = false;
        })

        nombre.addEventListener("input", () => {
            fetch(`/${url}/producto/create`, {
            })
            .then(respuesta => respuesta.json())
            .then(data => {
                producto.innerHTML = `<option value="">Seleccione el producto</option>`;
            })
            producto.disabled = false;
        })

        // window.addEventListener("DOMContentLoaded", () => {
        
        // })

    }

    setDataFormCreate(data) {

        

        


    }

}