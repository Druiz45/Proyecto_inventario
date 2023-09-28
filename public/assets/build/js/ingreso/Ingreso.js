import { validatePrecio, validateDescription, number_format} from "../producto/Producto.js";
import { getBancos} from "./../banco/Banco.js";

export class Ingreso {
    getDataFormCreate(url) {
        getBancos();
        document.addEventListener('DOMContentLoaded', () => {
            fetch(`/${url}/ingreso/dataFormCreate`, {
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

            const ingreso = urlActual.searchParams.get("ingreso");

            const form = new FormData();
            form.append('ingreso', ingreso);
            fetch(`/${url}/ingreso/dataFormUpdate`, {
                method: "POST",
                body: form
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    // console.log(data);
                    this.setDataFormUpdate(data);
                })
        });

    }

    setDataFormCreate(data) {
        const selectIngresos = document.getElementById('tipoIngreso');
        if (selectIngresos) {
            const opciones = document.createDocumentFragment();

            for (const info of data) {
                const option = document.createElement('option');
                option.value = info.id;
                option.textContent = info.tipoIngreso;
                opciones.appendChild(option);
            }
            selectIngresos.appendChild(opciones);
        }

    }

    setDataFormUpdate(data){

        const formUpdate = document.getElementById('formUpdateIngreso');
        if (formUpdate) {
            
            const inputValorIngreso = document.getElementById('valorIngreso');
            const descripcion = document.getElementById('descripcion');
            const selectTipoIngreso = document.getElementById('tipoIngreso');
            const banco = document.getElementById('banco');

            inputValorIngreso.value = `$${number_format(data[0].valor)}`;
            selectTipoIngreso.value = data[0].id_tipo_ingreso;
            descripcion.value = data[0].descripcion;
            banco.value = data[0].id_banco;

        }

    }

    validateFormData(){

        const formCreateIngreso = document.getElementById('formCreateIngreso');
        const formUpdateIngreso = document.getElementById('formUpdateIngreso');

        if(formCreateIngreso || formUpdateIngreso){
            const valorIngreso = document.getElementById('valorIngreso');
            const descripcioningreso = document.getElementById('descripcion');
            validatePrecio(valorIngreso);
            validateDescription(descripcioningreso);

        }

    }

    createIngreso(url) {
        const formCreateIngreso = document.getElementById('formCreateIngreso');
        if (formCreateIngreso) {
            formCreateIngreso.addEventListener('submit', (e) => {
                e.preventDefault();
                const form = new FormData(formCreateIngreso);
                fetch(`/${url}/ingreso/create`, {
                    method: "POST",
                    body: form
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (data == "exito") {
                            Swal.fire({
                                icon: 'success',
                                text: "Ingreso registrado con exito",
                            })
                            formCreateIngreso.reset();
                        } else if (data == "error") {
                            Swal.fire({
                                icon: 'error',
                                text: "Error al registrar el ingreso",
                            })
                            formCreateIngreso.reset();
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

    updateIngreso(url) {
        const formUpdateIngreso = document.getElementById('formUpdateIngreso');
        if (formUpdateIngreso) {
            formUpdateIngreso.addEventListener('submit', (e) => {
                e.preventDefault();
                const urlActual = new URL(window.location.href);
                const ingreso = urlActual.searchParams.get("ingreso");
                const form = new FormData(formUpdateIngreso);
                form.append('ingreso', ingreso);
                fetch(`/${url}/ingreso/update`, {
                    method: "POST",
                    body: form
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        // console.log(data);
                        if (data == "exito") {
                            Swal.fire({
                                icon: 'success',
                                text: "Ingreso actualizado con exito",
                            })

                        } else if (data == "error") {
                            Swal.fire({
                                icon: 'error',
                                text: "Error al intentar actualizar el ingreso",
                            })

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