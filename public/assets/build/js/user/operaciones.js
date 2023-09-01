function updateEstado(usuario, updateMessage) {

  let messagePost = updateMessage == 0 ? 'deshabilitar' : 'habilitar';
  let message = updateMessage == 0 ? 'deshabilito' : 'habilito';

  Swal.fire({
    title: `¿Esta seguro de ${messagePost} este usuario?`,
    // text: "You won't be able to revert this!",
    // icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si',
    confirmButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#3085d6',

  }).then((result) => {
    if (result.isConfirmed) {
      // window.location = JSON.parse('<?php #json_encode("/" . getUrl($_SERVER['SERVER_NAME']) . "/usuario/delete") ?>');
      const formData = new FormData();
      formData.append('usuario', usuario);
      formData.append('estado', messagePost);
      fetch(`/${url}/usuario/delete`, {
      method: "POST",
      body: formData
    })
      .then(respuesta => respuesta.json())
      .then(data => {
        if (data == `El usuario se ${message} correctamente`) {
          Swal.fire({
            icon: 'success',
            title: data,
            // text: data,
          }).then(() =>{
            location.reload();
          })

        } else if (data == `Ha ocurrido un error al intentar ${messagePost}`) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data,
          })

        } else {
          Swal.fire({
            icon: 'warning',
            title: data,
            // text: data,
          })
        }
      })
    }
  })
}