<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php

      use App\Http\Models\CategoriaModel;

      $i = 1;
      $categorias = new CategoriaModel();
      $rows = $categorias->getCategorias();

      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Informacion de categorias<small>categorias</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Categoria</th>
                          <th>Fecha de registro</th>
                          <th>Operaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($rows as $row) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row["categoria"] ?></td>
                            <td><?= getFecha($row["fecha_sys"]) ?></td>
                            <td>
                              <button type="button" class="btn btn-danger" onclick="return updateEstado(<?= $row['id'] ?>)"><i class="fa fa-close"></i> Deshabilitar</button>
                              <button type="button" class="btn btn-info" onclick="return editar('<?= $row['categoria'] ?>', <?= $row['id'] ?>)"><i class="fa fa-pencil"></i> Editar</button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <br>
                  <div class="col-md-3 col-sm-6  form-group has-feedback">
                    <button type="button" class="btn btn-success" id="btn-crear-categoria"><i class="fa fa-plus"></i> Añadir categoria</button>
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
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/categoria/index.js" type="module"></script>
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/categoria/operaciones.js"></script>

</body>