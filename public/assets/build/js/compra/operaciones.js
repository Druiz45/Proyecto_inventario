function abonos(compra) {
    Swal.fire({
        icon: 'question',
        title: `¿Que desea hacer?`,

        showCancelButton: true,
        cancelButtonColor: '#4A4A4A',
        cancelButtonText: 'Calcelar',

        confirmButtonColor: '#00B16E',
        confirmButtonText: 'Consultar abonos',

        showDenyButton: true,
        denyButtonText: 'Abonar',
        denyButtonColor: '#0067AE',
    })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.assign(`../abono/consultar/?pedido=${pedido}`);
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

                            // if (result.value.replace(/[.$]/g, "") > restante) {
                            //     throw new Error("La cantidad de abono supera el precio maximo");
                            // }

                            abonar(compra, result.value);
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

function abonar(compra, abono) {
    const formData = new FormData();
    formData.append("compra", compra);
    formData.append("abono", abono);
    fetch(`/${url}/AbonoCompra/create`, {
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