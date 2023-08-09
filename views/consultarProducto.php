<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php
        use App\Http\Models\ProductoModel;
        $i = 1;
        $producto = new ProductoModel();
        $rows = $producto->getProductos();
      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Informacion de productos<small>Productos</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                    <!-- <p class="text-muted font-13 m-b-30">
                      Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                    </p> -->

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Categoria</th>
                          <th>Descripcion</th>
                          <th>Fecha</th>
                          <th>Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($rows as $row) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row["producto"] ?></td>
                            <td><?= $row["precio"] ?></td>
                            <td><?= $row["categoria"] ?></td>
                            <td><?= $row["descripcion"] ?></td>
                            <td><?= getFecha($row["fecha"]) ?></td>
                            <td><button type="button" class="btn btn-danger" onclick="return eliminar(<?= $row['id'] ?>)">Eliminar</button><button type="button" class="btn btn-info">Editar</button></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <?php require_once("./../views/includes/footer.php"); ?>
      <!-- /footer content -->
    </div>
  </div>
  <?php require_once("./../views/includes/scripts.php"); ?>
  <script>
    const url = JSON.parse('<?= json_encode(getUrl($_SERVER['SERVER_NAME'])) ?>');
  </script>
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/user/index.js" type="module"></script>
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/producto/index.js" type="module"></script>
  <script>
    function eliminar(producto) {

      Swal.fire({
        title: '¿Esta seguro de eliminar este producto?',
        // text: "You won't be able to revert this!",
        // icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        confirmButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#3085d6',

      }).then((result) => {
        if (result.isConfirmed) {
          // window.location = JSON.parse('<?php #json_encode("/" . getUrl($_SERVER['SERVER_NAME']) . "/usuario/delete") 
                                            ?>');
          const formData = new FormData();
          formData.append('producto', producto);
          formData.append('estado', "deshabilitar");
          fetch(`/${url}/producto/delete`, {
              method: "POST",
              body: formData
            })
            .then(respuesta => respuesta.json())
            .then(data => {
              if (data == "El producto se elimino correctamente") {
                Swal.fire({
                  icon: 'success',
                  title: data,
                  // text: data,
                }).then(() => {
                  location.reload();
                })

              } else if (data == "Ha ocurrido un error al intentar Eliminar") {
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
  </script>
</body>