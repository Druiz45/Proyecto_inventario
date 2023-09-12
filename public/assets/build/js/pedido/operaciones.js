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
                        // Agregar el evento oninput
                        oninput: "number_format(this)",
                        style: 'text-align: center;'
                      }
                }).then((result) => {
                    if (result.isConfirmed) {
                        try {

                            if (result.value.replace(/[.$]/g, "")>restante) {
                                throw new Error("La cantidad de abono supera el precio maximo");
                            }
        
                            abonar(result.value, pedido);
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

function pagarComision(pedido, vendedor, numVendedor, valorComision) {
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
                pagar(pedido, numVendedor, valorComision);
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

function estado(pedido, aprobacion, restante, producto) {

    Swal.fire({
        icon: 'question',
        title: `¿Que desea hacer?`,

        showCancelButton: true,
        cancelButtonColor: '#4A4A4A',
        cancelButtonText: 'Cancelar',

        confirmButtonColor: '#00794B',
        confirmButtonText: 'Entregar',

        showDenyButton: true,
        denyButtonText: 'Anular',
        denyButtonColor: '#9A2100',
    })
        .then((result) => {
            if (result.isConfirmed) {
                
                try {
                    if (aprobacion!=2) {
                        throw new Error("No es posible cambiar el estado del pedido a entregado sin antes haberlo aprobado");
                    }
                    if (restante!=0){
                        throw new Error("No es posible entregar el producto sin antes pagarlo por completo");
                    }

                   updateEstate(pedido, "entregado", "cambiarEstado", producto);
                } catch (error) {
                    Swal.fire({
                        icon: 'warning',
                        title: error.message,
                    })
                }
                   
            } else if (result.isDenied) {
                updateEstate(pedido, "anulado", "cambiarEstado");
            }
        })
}

function updateEstate(pedido, mensaje, ruta, producto = "") {
    Swal.fire({
        title: `¿Esta seguro de cambiar el pedido a ${mensaje}?`,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#4A4A4A',
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            if(producto != ""){
                formData.append('producto', producto);
            }
            formData.append("pedido", pedido);
            formData.append((ruta == "cambiarEstado") ? "estado" : "aprobacion", mensaje);
            fetch(`/${url}/pedido/${ruta}`, {
                method: "POST",
                body: formData
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    console.log(data);
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

function pagar(pedido, numVendedor, valorComision) {
    const formData = new FormData();
    formData.append("pedido", pedido);
    formData.append('numVendedor', numVendedor);
    formData.append('valorComision', valorComision);
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
    const formData = new FormData();
    formData.append("pedido", pedido);
    formData.append("abono", abono);
    fetch(`/${url}/abono/create`, {
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


