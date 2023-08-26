import { validatePrecio, validateDescription } from "../producto/Producto.js";
export class Ingreso {
    getDataFormCreate(url) {
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

    validateFormData(){

        const formCreateIngreso = document.getElementById('formCreateIngreso');

        if(formCreateIngreso){
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
}