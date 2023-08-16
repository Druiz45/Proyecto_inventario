function editar(nombreCategoriacategoria, numCategoria) {
    Swal.fire({
        title: 'Editar categoria',
        html:
          '<input id="nombre-categoria" class="swal2-input" placeholder="Nombre categoria">', //+
        //   '<input id="input2" class="swal2-input" placeholder="Campo 2">',
        focusConfirm: false,
        didOpen: () => {
          const nombreCategoria = document.getElementById('nombre-categoria');
          nombreCategoria.value = nombreCategoriacategoria;
      
          nombreCategoria.addEventListener('input', () => {
            console.log(nombreCategoria.value);
          });
          
        },
        preConfirm: () => {
          const nombreCategoria = document.getElementById('nombre-categoria').value;
        //   const input2 = document.getElementById('input2').value;
          return [nombreCategoria];
        }
      }).then(result => {
        if (result.isConfirmed) {
          const [nombreCategoria] = result.value;
        //   Swal.fire(`Ingresaste: Campo 1 - ${value1}`);

        const formData = new FormData();
        formData.append('nombre-categoria', nombreCategoria);
        formData.append('num-categoria', numCategoria);

        fetch(`/${url}/categoria/update`, {
            method: "POST",
            body: formData
        })
            .then(respuesta => respuesta.json())
            .then(data => {
                if (data == "La categoria se actualizo correctamente") {
                    Swal.fire({
                        icon: 'success',
                        title: data,
                    }).then(() => {
                        location.reload();
                    })
                } else if (data == "Ha ocurrido un error al intentar actualizar") {
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