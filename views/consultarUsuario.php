<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <?php require_once("./../views/includes/barraLateral.php"); ?>
      <!-- top navigation -->
      <?php

      use App\Http\Models\UsuarioModel;

      $i = 1;
      $user = new UsuarioModel();
      $rows = $user->getUsers();
      ?>
      <?php require_once("./../views/includes/barraSuperior.php"); ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Informacion de usuarios<small>Usuarios</small></h2>
              <!-- <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul> -->
              <div class="clearfix"></div>
            </div>
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
                                  <th>Informacion</th>
                                  <th>Celular</th>
                                  <th>Email</th>
                                  <th>Direccion</th>
                                  <th>Empresa</th>
                                  <th>Nit</th>
                                  <th>Ultimo Log</th>
                                  <th>Fecha de creacion</th>
                                  <th>Operaciones</th>
                                </tr>
                              </thead>
                              <tbody id="tbody">
                                <?php foreach ($rows as $row) : ?>
                                  <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["id"] ?></td>
                                    <td>
                                      <li class="media event">
                                        <a class="pull-left border-aero profile_thumb">
                                          <i class="fa fa-user aero"></i>
                                        </a>
                                        <div class="media-body">
                                          <p><strong>Nombre: </strong><?= $row["nombres"] . " " . $row["apellidos"] ?></p>
                                          <p><strong>Documento: </strong><?= $row["documento"] ?></p>
                                          <p><strong>Perfil: </strong><?= $row["perfil"] ?></p>
                                        </div>
                                      </li>
                                    </td>
                                    <td><?= "-".$row["telefono"]."-" ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td><?= $row["direccion"] ?></td>
                                    <td><?= $row["empresa"] == null ? "No Aplica" : $row["empresa"] ?></td>
                                    <td><?= $row["nit"] == null ? "No Aplica" : $row["nit"] ?></td>
                                    <td><?= $row["ultimoLog"] == null ? "Nunca" : getFecha($row["ultimoLog"]) ?></td>
                                    <td><?= getFecha($row["fecha"]) ?></td>
                                    <td>
                                      <?php if ($row["estado"] == 1) :  ?> <button type="button" class="btn btn-danger btn-round" onclick="return updateEstado(<?= $row['id'] ?>, 0)"><i class="fa fa-close"></i> Deshabilitar</button>
                                      <?php else : ?> <button type="button" class="btn btn-success btn-round" onclick="return updateEstado(<?= $row['id'] ?>, 1)"><i class="fa fa-check"></i> Habilitar</button>
                                      <?php endif; ?>
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
  <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/user/operaciones.js"></script>
</body>