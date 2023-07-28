export class Producto {

    saveProducto(url) {
        const formProducto = document.getElementById('formProducto');
        if (formProducto) {
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
                            const producto = document.getElementById("producto").value = "";
                            categoria.value = "";
                            const descripcion = document.getElementById("descripcion").value = "";
                        }
                        else {
                            Swal.fire({
                                icon: `error`,
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
        if (categoria) {
            window.addEventListener('DOMContentLoaded', () => {
                fetch(`/${url}/producto/getCategorias`, {
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        for (const info of data) {
                            categoria.innerHTML += `<option value="${info.id}">${info.categoria}</option>`;
                        }
                    })
            });
        }
    }

    mifuncion(id){
        console.log(id);
    }

}
