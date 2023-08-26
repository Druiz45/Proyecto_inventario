import { validatePrecio, validateDescription } from "../producto/Producto.js";
export class Gasto {

    getDataFormCreate(url) {
        document.addEventListener('DOMContentLoaded', () => {
            fetch(`/${url}/gasto/dataFormCreate`, {
                method: "POST",
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    this.setDataFormCreate(data);
                })
        });

    }

    setDataFormCreate(data) {
        const selectGastos = document.getElementById('tipoGasto');
        if (selectGastos) {
            const opciones = document.createDocumentFragment();

            for (const info of data) {
                const option = document.createElement('option');
                option.value = info.id;
                option.textContent = info.tipoGasto;
                opciones.appendChild(option);
            }
            // select.innerHTML = '';
            selectGastos.appendChild(opciones);
        }

    }

    validateFormData(){

        const formCreateGasto = document.getElementById('formCreateGasto');

        if(formCreateGasto){
            const valorGasto = document.getElementById('valorGasto');
            const descripcionGasto = document.getElementById('descripcion');
            validatePrecio(valorGasto);
            validateDescription(descripcionGasto);

        }

    }

    createGasto(url) {
        const formCreateGasto = document.getElementById('formCreateGasto');
        if (formCreateGasto) {
            formCreateGasto.addEventListener('submit', (e) => {
                e.preventDefault();
                const form = new FormData(formCreateGasto);
                fetch(`/${url}/gasto/create`, {
                    method: "POST",
                    body: form
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (data == "exito") {
                            Swal.fire({
                                icon: 'success',
                                text: "Gasto registrado con exito",
                            })
                            formCreateGasto.reset();
                        } else if (data == "error") {
                            Swal.fire({
                                icon: 'error',
                                text: "Error al registrar el gasto",
                            })
                            formCreateGasto.reset();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: data,
                            })
                        }
                    })
            });
        }
    }

}