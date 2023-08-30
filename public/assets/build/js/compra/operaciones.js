function abonos(compra, restante) {
    let botonAbonar = true;
    if (restante == 0) {
        botonAbonar = false;
    }

    Swal.fire({
        icon: 'question',
        title: `¿Que desea hacer?`,

        showCancelButton: true,
        cancelButtonColor: '#4A4A4A',
        cancelButtonText: 'Calcelar',

        confirmButtonColor: '#00B16E',
        confirmButtonText: 'Consultar abonos',

        showDenyButton: botonAbonar,
        denyButtonText: 'Abonar',
        denyButtonColor: '#0067AE',
    })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.assign(`../abonoCompra/consultar/?compra=${compra}`);
            } else if (result.isDenied) {
                Swal.fire({
                    icon: 'question',
                    title: `¿Cuánto desea abonar?`,
                    input: 'text',
                    showCancelButton: true,
                    cancelButtonColor: '#4A4A4A',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#0067AE',
                    confirmButtonText: 'Abonar',
                    inputAttributes: {
                        oninput: "number_format(this)",
                        style: 'text-align: center;'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        try {

                            if (result.value.replace(/[.$]/g, "") > restante) {
                                throw new Error("La cantidad de abono supera el precio maximo");
                            }

                            abonar(compra, result.value, restante);
                        } catch (error) {
                            Swal.fire({
                                icon: 'error',
                                title: error.message,
                            })
                        }
                    }
                });
            }
        })
}

function abonar(compra, abono, restante) {
    const formData = new FormData();
    formData.append("compra", compra);
    formData.append("abono", abono);
    formData.append("restante", restante);
    fetch(`/${url}/AbonoCompra/create`, {
        method: "POST",
        body: formData
    })
        .then(respuesta => respuesta.json())
        .then(data => {
            if (data == "exito") {
                Swal.fire({
                    icon: 'success',
                    title: `Abono registrado`,
                }).then(() => {
                    location.reload();
                })
            } else if (data == "error") {
                Swal.fire({
                    icon: 'error',
                    text: "Error al registrar el abono",
                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: data,
                })
            }
        })
}

function number_format(input, decimals = 0, decPoint = '.', thousandsSep = '.') {
    valor = input.value.replace(/[^\d,-]/g, '');
    const valorParseado = parseInt(valor);
    number = parseInt(valorParseado.toFixed(decimals));
    const [integerPart, decimalPart] = number.toFixed(decimals).split('.');
    const regex = /\B(?=(\d{3})+(?!\d))/g;
    const formattedIntegerPart = integerPart.replace(regex, thousandsSep);
    input.value = "$";
    input.value += decimals > 0 ? formattedIntegerPart + decPoint + decimalPart : formattedIntegerPart;
}

function updateEstate(compra, estado, mensaje) {
    Swal.fire({
        icon: 'question',
        title: `¿Esta seguro de ${estado} la orden de compra?`,

        showCancelButton: true,
        cancelButtonColor: '#4A4A4A',
        cancelButtonText: 'Calcelar',

        confirmButtonColor: '#00794B',
        confirmButtonText: estado,

    })
        .then((result) => {
            if (result.isConfirmed) {

                const formData = new FormData();
                formData.append("compra", compra);
                formData.append("estado", estado);
                fetch(`/${url}/compra/updateEstate`, {
                    method: "POST",
                    body: formData
                })
                    .then(respuesta => respuesta.json())
                    .then(data => {
                        if (data == "exito") {
                            Swal.fire({
                                icon: 'success',
                                title: `El estado de la compra a cambiado a ${mensaje}`,
                            }).then(() => {
                                location.reload();
                            })
                        } else if (data == "error") {
                            Swal.fire({
                                icon: 'error',
                                text: "Error al cambiar el estado de la compra",
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
}

function agregarAlStock(producto, ordenCompra) {

    const formData = new FormData();
    formData.append("producto", producto);
    formData.append("ordenCompra", ordenCompra);

    Swal.fire({
        title: '¿Esta seguro de añadir esta orden de compra al stock?',
        // text: "You won't be able to revert this!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            fetch(`/${url}/Inventario/agregarAStock`, {
                method: "POST",
                body: formData
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    if (data == "exito") {
                        Swal.fire({
                            icon: 'success',
                            title: `Se ha añadido una existencia al stock de este producto`,
                        }).then(() => {
                            location.reload();
                        })
                    } else if (data == "error") {
                        Swal.fire({
                            icon: 'error',
                            text: "Ha ocurrido un error al intentar actualizar el stock de este producto",
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