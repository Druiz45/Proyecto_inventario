function updateBanco(nameBanco, id) {
    Swal.fire({
        icon: 'info',
        title: `Reescriba el nombre del banco`,
        input: 'text',
        focusConfirm: false,
        showCancelButton: true,
        cancelButtonColor: '#4A4A4A',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#0067AE',
        confirmButtonText: 'Actualizar',
        inputAttributes: {
            id: 'banco',
            style: 'text-align: center; margin-left: auto; margin-right: auto; width: 300px;'
        },
        didOpen: () => {
            const banco = document.getElementById('banco');
            banco.value=nameBanco;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append("banco", result.value);
            formData.append("idBanco", id);
            fetch(`/${url}/banco/update`, {
                method: "POST",
                body: formData
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    if (data == "exito") {
                        Swal.fire({
                            icon: 'success',
                            text: "Banco actualizado con exito",
                        })
                        .then(()=>{
                            location.reload(true);
                        })
                    } else if (data == "error") {
                        Swal.fire({
                            icon: 'error',
                            text: "Error al actualizar el banco",
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

function updateEstate(estado, id) {
    const colorBtn=(estado=="Deshabilitar" ? "#A20000" : "#00794B");
    Swal.fire({
        icon: 'question',
        title: `¿Esta seguro de deshabilitar este banco?`,
        focusConfirm: false,
        showCancelButton: true,
        cancelButtonColor: '#4A4A4A',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: colorBtn,
        confirmButtonText: estado,
    }).then((result) => {
        if (result.isConfirmed) {
            const mensaje=(estado=="Deshabilitar" ? "deshabilitado" : "habilitado");
            const formData = new FormData();
            formData.append("estado", estado);
            formData.append("idBanco", id);
            fetch(`/${url}/banco/updateEstate`, {
                method: "POST",
                body: formData
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    if (data == "exito") {
                        Swal.fire({
                            icon: 'success',
                            text: "Banco "+mensaje+" con exito",
                        })
                        .then(()=>{
                            location.reload(true);
                        })
                    } else if (data == "error") {
                        
                        Swal.fire({
                            icon: 'error',
                            text: "Error al "+estado.toLowerCase()+" el banco",
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