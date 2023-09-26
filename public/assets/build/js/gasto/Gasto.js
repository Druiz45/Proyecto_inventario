import { validatePrecio, validateDescription, number_format } from "../producto/Producto.js";
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

    getDataFormUpdate(url) {
        document.addEventListener('DOMContentLoaded', () => {
            const urlActual = new URL(window.location.href);

            const gasto = urlActual.searchParams.get("gasto");

            const form = new FormData();
            form.append('gasto', gasto);
            fetch(`/${url}/gasto/dataFormUpdate`, {
                method: "POST",
                body: form
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    console.log(data);
                    this.setDataFormUpdate(data);
                })
        });

    }

    setDataFormCreate(data) {
        const formCreate = document.getElementById('formCreateGasto');
        const formUpdate = document.getElementById('formUpdateGasto');
        if (formCreate || formUpdate) {
            const selectGastos = document.getElementById('tipoGasto');
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

    setDataFormUpdate(data) {
        const formUpdate = document.getElementById('formUpdateGasto');
        if (formUpdate) {
            
            const inputValorGasto = document.getElementById('valorGasto');
            const descripcion = document.getElementById('descripcion');
            const selectTipoGasto = document.getElementById('tipoGasto');

            inputValorGasto.value = `$${number_format(data[0].valor)}`;
            selectTipoGasto.value = data[0].id_tipo_gasto;
            descripcion.value = data[0].descripcion;

        }

    }

    validateFormData(){

        const formCreateGasto = document.getElementById('formCreateGasto');
        const formUpdateGasto = document.getElementById('formUpdateGasto');

        if(formCreateGasto || formUpdateGasto){
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

    updateGasto(){

        const formUpdate = document.getElementById('formUpdateGasto');

        if(formUpdate){
            formUpdate.addEventListener('submit', (e) => {
                e.preventDefault();
                const urlActual = new URL(window.location.href);
                const gasto = urlActual.searchParams.get("gasto");
                const form = new FormData(formUpdate);
                form.append('gasto', gasto);

                fetch(`/${url}/gasto/update`, {
                    method: "POST",
                    body: form
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        console.log(data);
                        if (data == "exito") {
                            Swal.fire({
                                icon: 'success',
                                text: "Gasto actualizado con exito",
                            })

                        } else if (data == "error") {
                            Swal.fire({
                                icon: 'error',
                                text: "Error al intentar actualizar el gasto",
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