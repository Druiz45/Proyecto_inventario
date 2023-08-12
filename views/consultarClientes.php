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
              <!-- <ul class="nav navbar-right panel_toolbox">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                    </ul> -->
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
                              <?php if ($row["estado"] == 1):  ?> <button type="button" class="btn btn-danger" onclick="return updateEstado(<?= $row['id'] ?>, 0)">Deshabilitar</button>
                              <?php else: ?> <button type="button" class="btn btn-success" onclick="return updateEstado(<?= $row['id'] ?>, 1)">Habilitar</button>
                              <?php endif; ?>
                              <a href="./editar/?cliente=<?= $row['id'] ?>"><button type="button" class="btn btn-info">Editar</button></a>
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
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/cliente/index.js" type="module"></script>
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/cliente/operaciones.js"></script>
</body>