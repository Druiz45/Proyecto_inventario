<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php

      use App\Http\Models\GastoModel;

      $i = 1;
      $gasto = new GastoModel();
      $gastos = $gasto->getGastos();
      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Informacion de gastos<small>Gastos</small></h2>
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
            <form action="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/gasto/consultar/?" method="get">
              <div class="row justify-content-center">
                <div class="form-group row col-md-4 col-sm-6">
                  <label>Fecha incio:</label>
                  <input class="form-control" type="date" name="startDate" value="<?= isset($_GET["startDate"]) ? $_GET["startDate"] : "" ?>" required>
                </div>
                <div class="form-group row col-md-4 col-sm-6">
                  <label>Fecha Final:</label>
                  <input class="form-control" type="date" name="finalDate" value="<?= isset($_GET["finalDate"]) ? $_GET["finalDate"] : "" ?>" required>
                </div>
                <div class="actionBar">
                  <a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/gasto/consultar/" class="buttonNext btn btn-secondary btn-round"><i class="fa fa-minus"></i> Limpiar</a>
                  <button class="buttonNext btn btn-success btn-round"><i class="fa fa-filter"></i> Filtrar</button>
                </div>
              </div>
            </form>
            <div class="x_content">
              <div class="row">

                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                    <div class="x_content">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card-box table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Codigo</th>
                                  <th>Banco</th>
                                  <th>Valor</th>
                                  <th>Tipo de gasto</th>
                                  <th>Descripcion</th>
                                  <th>Hecho por</th>
                                  <th>Fecha</th>
                                  <th>Operaciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($gastos as $row) : ?>
                                  <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row["id"] ?></td>
                                    <td><?= $row["banco"] ?></td>
                                    <td><?= numberFormat($row["valor"]) ?></td>
                                    <td><?= $row["tipoGasto"] ?></td>
                                    <td><?= $row["descripcion"] ?></td>
                                    <td><?= $row["usuario"] ?></td>
                                    <td><?= getFecha($row["fecha_sys"]) ?></td>
                                    <td>
                                      <a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/gasto/editar/?gasto=<?= $row["id"] ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</button></a>
                                      <button type="button" class="btn btn-danger" onclick=""><i class="fa fa-close"></i> Deshabilitar</button>
                                    </td>
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
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/producto/operaciones.js"></script>

</body>