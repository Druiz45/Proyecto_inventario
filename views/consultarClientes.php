<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php
        use App\Http\Models\ClienteModel;
        $i = 1;
        $user = new ClienteModel();
        $rows = $user->getClientes();
      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Informacion de los clientes<small>Clientes</small></h2>
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
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Documento</th>
                          <th>Celular</th>
                          <th>Email</th>
                          <th>Direccion</th>
                          <th>Operaciones</th>
                          <th>Fecha de creacion</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                        <?php foreach ($rows as $row) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row["nombres"] ?></td>
                            <td><?= $row["apellidos"] ?></td>
                            <td><?= $row["documento"] ?></td>
                            <td><?= $row["telefono"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td><?= $row["direccion"] ?></td>
                            <td>
                              <?php if ($row["estado"] == 1):  ?> <button type="button" class="btn btn-danger" onclick="return updateEstado(<?= $row['id'] ?>, 0)"><i class="fa fa-close"></i> Deshabilitar</button>
                              <?php else: ?> <button type="button" class="btn btn-success" onclick="return updateEstado(<?= $row['id'] ?>, 1)"><i class="fa fa-check"></i> Habilitar</button>
                              <?php endif; ?>
                              <a href="./editar/?cliente=<?= $row['id'] ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</button></a>
                            </td>
                            <td><?= getFecha($row["fecha_sys"]) ?></td>
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
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/cliente/index.js" type="module"></script>
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/cliente/operaciones.js"></script>
</body>