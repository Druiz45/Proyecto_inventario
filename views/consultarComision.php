<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php

      use App\Http\Models\ComisionModel;

      $i = 1;
      $comision = new ComisionModel();
      $rows = $comision->getComisiones();
      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Informacion de comisiones<small>Comisiones</small></h2>
              <div class="clearfix"></div>
            </div>
            <form action="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/comision/consultar/?" method="get">
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
                <a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/comision/consultar/" class="buttonNext btn btn-secondary btn-round"><i class="fa fa-minus"></i> Limpiar</a>
                  <button class="buttonNext btn btn-success btn-round"><i class="fa fa-filter"></i> Filtrar</button>
                </div>
              </div>
            </form>
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Vendedor</th>
                          <th>Realizado por</th>
                          <th>Valor</th>
                          <th>Pedido</th>
                          <th>Fecha</th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                        <?php foreach ($rows as $row) : ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row["vendedor"] ?></td>
                            <td><?= $row["usuario"] ?></td>
                            <td><?= numberFormat($row["valor"]) ?></td>
                            <td><?= encrypt($row["pedido"]) ?></td>
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