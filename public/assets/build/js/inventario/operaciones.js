function editarProductoInventario(stock, nStock){

    Swal.fire({
        title: 'Editar stock',
        html:
            '<input id="stock-producto" class="swal2-input" placeholder="stock">', //+
        //   '<input id="input2" class="swal2-input" placeholder="Campo 2">',
        focusConfirm: false,
        didOpen: () => {
            const stockProducto = document.getElementById('stock-producto');
            stockProducto.value = stock;

            stockProducto.addEventListener('input', () => {
                console.log(stockProducto.value);
            });

        },
        preConfirm: () => {
            const stockProducto = document.getElementById('stock-producto').value;
            //   const input2 = document.getElementById('input2').value;
            return [stockProducto];
        }
    }).then(result => {
        if (result.isConfirmed) {
            const [stockProducto] = result.value;
            //   Swal.fire(`Ingresaste: Campo 1 - ${value1}`);

            const formData = new FormData();
            formData.append('stockProducto', stockProducto);
            formData.append('numStock', nStock);

            fetch(`/${url}/inventario/update`, {
                method: "POST",
                body: formData
            })
                .then(respuesta => respuesta.json())
                .then(data => {
                    if (data == "El stock se actualizo correctamente") {
                        Swal.fire({
                            icon: 'success',
                            title: data,
                        }).then(() => {
                            location.reload();
                        })
                    } else if (data == "Ha ocurrido un error al intentar actualizar el stock de este producto") {
                        Swal.fire({
                            icon: 'error',
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
    });
    
}