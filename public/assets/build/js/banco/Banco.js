export class Banco {
    createBanco() {
        const addBanco = document.getElementById('addBanco');

        if (addBanco) {
            addBanco.addEventListener('click', () => {
                Swal.fire({
                    icon: 'info',
                    title: `Escriba el nombre del banco`,
                    input: 'text',
                    showCancelButton: true,
                    cancelButtonColor: '#4A4A4A',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#0067AE',
                    confirmButtonText: 'Agregar',
                    inputAttributes: {
                        style: 'text-align: center; margin-left: auto; margin-right: auto; width: 300px;'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append("banco", result.value);
                        fetch(`/${url}/banco/create`, {
                            method: "POST",
                            body: formData
                        })
                            .then(respuesta => respuesta.json())
                            .then(data => {
                                if (data == "exito") {
                                    Swal.fire({
                                        icon: 'success',
                                        text: "Banco registrado con exito",
                                    })
                                    .then(()=>{
                                        location.reload(true);
                                    })
                                } else if (data == "error") {
                                    Swal.fire({
                                        icon: 'error',
                                        text: "Error al registrar el banco",
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: data,
                                    })
                                }
                            })
                    }
                });

            })
        }
    }
}

export function getBancos() {
    const banco = document.getElementById('banco');
    if (banco) {
        window.addEventListener("DOMContentLoaded", () => {
            fetch(`/${url}/banco/getDataFormCreate`, {
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    if (banco) {
                        const opciones = document.createDocumentFragment();
                        const option = document.createElement('option');
                        option.textContent = "Seleccione el banco";
                        opciones.appendChild(option);
                        for (const info of data) {
                            const option = document.createElement('option');
                            option.value = info.id;
                            option.textContent = info.banco;
                            opciones.appendChild(option);
                        }
                        banco.appendChild(opciones);
                    }
                })
        });
    }
}