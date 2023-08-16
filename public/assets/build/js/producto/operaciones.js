function eliminar(producto) {
    Swal.fire({
        title: '¿Esta seguro de deshabilitar este producto?',
        showCancelButton: true,
        confirmButtonText: 'Si',
        confirmButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#3085d6',

    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('producto', producto);
            formData.append('estado', "deshabilitar");
            fetch(`/${url}/producto/delete`, {
                method: "POST",
                body: formData
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    if (data == "El producto se deshabilito correctamente") {
                        Swal.fire({
                            icon: 'success',
                            title: data,
                        }).then(() => {
                            location.reload();
                        })

                    } else if (data == "Ha ocurrido un error al intentar habilitar") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data,
                        })

                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: data,
                        })
                    }
                })
        }
    })
}

function agregarInventario(producto, nombre) {
    Swal.fire({
        title: `¿Esta seguro de agregar el producto "${nombre}" al inventario?`,
        showCancelButton: true,
        confirmButtonText: 'Si',
        confirmButtonColor: '#0067AE',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#4A4A4A',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: `Ingrese la cantidad de stock`,
                input: 'text',
                showCancelButton: true,
                cancelButtonColor: '#4A4A4A',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#0067AE',
                confirmButtonText: 'Agregar a inventario',
                inputAttributes: {
                    style: 'text-align: center;'
                }
            }).then((result) => {
                const formData = new FormData();
                formData.append('stock', result.value);
                formData.append('producto', producto);
                fetch(`/${url}/inventario/create`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (data=="exito") {
                            Swal.fire({
                                icon: 'success',
                                title: "Añadido a inventario",
                            }).then(() => {
                                location.reload();
                            })

                        } else if (data == "error") {
                            Swal.fire({
                                icon: 'error',
                                text: "Error al añadir al inventario",
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
    })
}