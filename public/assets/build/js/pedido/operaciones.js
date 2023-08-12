function abonos(pedido, estado, aprobacion, restante) {
    let botonAbonar=false;
    if (estado == 1 && aprobacion == 2) {
        botonAbonar = true;
    }
    if (restante==0){
        botonAbonar=false;
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
                if (estado == 1) {
                    window.location.assign("");
                }
                else {
                    Swal.fire({
                        icon: 'warning',
                        title: "No es posible hacer abonos",
                    })
                }
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
                        // Agregar el evento oninput
                        oninput: "number_format(this)",
                        style: 'text-align: center;'
                      }
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value.replace(/[.$]/g, "")<=restante){
                            abonar(result.value, pedido);
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: "La cantidad de abono supera el precio maximo",
                            })
                        }  
                    }
                });
            }
        })
}

  function number_format(input, decimals = 0, decPoint = '.', thousandsSep = '.') {
    valor = input.value.replace(/[^\d,-]/g, '');
    const valorParseado = parseInt(valor);
    number = parseInt(valorParseado.toFixed(decimals)); // Redondear el número a la cantidad de decimales deseada
    const [integerPart, decimalPart] = number.toFixed(decimals).split('.');
    const regex = /\B(?=(\d{3})+(?!\d))/g;
    const formattedIntegerPart = integerPart.replace(regex, thousandsSep);
    input.value="$";
    input.value+=decimals > 0 ? formattedIntegerPart + decPoint + decimalPart : formattedIntegerPart;
  }

function pagarComision(pedido, vendedor) {
    Swal.fire({
        icon: 'question',
        title: `¿Desea pagar la comision al vendedor ${vendedor}?`,

        showCancelButton: true,
        cancelButtonColor: '#4A4A4A',
        cancelButtonText: 'Calcelar',

        confirmButtonColor: '#00794B',
        confirmButtonText: 'Pagar',

    })
        .then((result) => {
            if (result.isConfirmed) {
                pagar(pedido);
            }
        })
}

function aprobacion(pedido, aprobacion) {
    let noAprobar=true, aprobar=true;
    if (aprobacion==2){
        aprobar=false;
    }
    else if (aprobacion==3){
        noAprobar=false;
    }
    Swal.fire({
        icon: 'question',
        title: `¿Que desea hacer?`,

        showCancelButton: true,
        cancelButtonColor: '#4A4A4A',
        cancelButtonText: 'Calcelar',

        showConfirmButton: aprobar,
        confirmButtonColor: '#00794B',
        confirmButtonText: 'Aprobar',

        showDenyButton: noAprobar,
        denyButtonText: 'No aprobar',
        denyButtonColor: '#A20000',
    })
        .then((result) => {
            if (result.isConfirmed) {
                updateEstate(pedido, "aprobado", "cambiarAprobacion");
            } else if (result.isDenied) {
                updateEstate(pedido, "no aprobado", "cambiarAprobacion");
            }
        })
}

function estado(pedido, aprobacion) {

    Swal.fire({
        icon: 'question',
        title: `¿Que desea hacer?`,

        showCancelButton: true,
        cancelButtonColor: '#A9A9A9',
        cancelButtonText: 'Calcelar',

        confirmButtonColor: '#00794B',
        confirmButtonText: 'Entregar',

        showDenyButton: true,
        denyButtonText: 'Anular',
        denyButtonColor: '#9A2100',
    })
        .then((result) => {
            if (result.isConfirmed) {
                if (aprobacion == 2) {
                    updateEstate(pedido, "entregado", "cambiarEstado");
                }
                else {
                    Swal.fire({
                        icon: 'warning',
                        title: "No es posible cambiar el estado del pedido a entregado sin antes haberlo aprobado",
                    })
                }
            } else if (result.isDenied) {
                updateEstate(pedido, "anulado", "cambiarEstado");
            }
        })
}

function updateEstate(pedido, mensaje, ruta) {
    Swal.fire({
        title: `¿Esta seguro de cambiar el pedido a ${mensaje}?`,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append("pedido", pedido);
            formData.append((ruta == "cambiarEstado") ? "estado" : "aprobacion", mensaje);
            fetch(`/${url}/pedido/${ruta}`, {
                method: "POST",
                body: formData
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    if (data == "pedido") {
                        Swal.fire({
                            icon: 'success',
                            title: `El pedido a cambiado a ${mensaje}`,
                        }).then(() => {
                            location.reload();
                        })
                    } else if (data == "error") {
                        Swal.fire({
                            icon: 'error',
                            text: "Error al cambiar el estado del pedido",
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

function pagar(pedido) {
    const formData = new FormData();
    formData.append("pedido", pedido);
    fetch(`/${url}/pedido/pagarComision`, {
        method: "POST",
        body: formData
    })
        .then(respuesta => respuesta.json())
        .then(data => {
            if (data == "pedido") {
                Swal.fire({
                    icon: 'success',
                    title: `Comision pagada`,
                }).then(() => {
                    location.reload();
                })
            } else if (data == "error") {
                Swal.fire({
                    icon: 'error',
                    text: "Error al pagar la comision",
                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: data,
                })
            }
        })
}

function abonar(abono, pedido) {
    console.log(abono);
    const formData = new FormData();
    formData.append("pedido", pedido);
    formData.append("abono", abono);
    fetch(`/${url}/abono/abonarPedido`, {
        method: "POST",
        body: formData
    })
        .then(respuesta => respuesta.json())
        .then(data => {
            if (data == "exito") {
                Swal.fire({
                    icon: 'success',
                    title: `Abono exitoso`,
                }).then(() => {
                    location.reload();
                })
            } else if (data == "error") {
                Swal.fire({
                    icon: 'error',
                    text: "Error al hacer el abono",
                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: data,
                })
            }
        })
}


