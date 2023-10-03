<?php
validateLogOut();
?>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <!-- <div class="alert alert-success" role="alert">
                        <span style="font-size: large;">Se ha enviado un correo con la informacion para restablecer su contraseña.</span>
                    </div> -->
                    <form id="form-change-password">
                        <h1>Cambiar contraseña</h1>
                        <div style="text-align:center; font-size:large;">
                            Para restablecer tu contraseña por favor complete los cambios y envie el formulario.
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Nueva contraseña" />
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirmar contraseña" />
                        </div>
                        <!-- <div class="form-group col-md-12 col-sm-6">
                            <input class="form-control pass" type="password" id="pass" name="pass" placeholder="Contraseña">
                            <span style="position: absolute; right: 15px; top: 7px;" class="ver">
                                <i class="fa fa-eye-slash" style="display: none;"></i>
                                <i class="fa fa-eye" style="display: block;"></i>
                            </span>
                        </div> -->
                        <div>
                            <button class="btn btn-dark" type="submit">Cambiar contraseña</button>
                            <!-- <a class="btn btn-dark" href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/password/recoverPassword">Recuperar Contraseña</a> -->
                            <a class="reset_pass" href="./../">Iniciar Sesion</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <!-- <p class="change_link">New to site?
                                <a href="#signup" class="to_register"> Create Account </a>
                            </p> -->

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-barcode">&#160</i>Makfrio - Sistema de inventario</h1>
                                <!-- <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p> -->
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/sweetAlert.js"></script>
    <script>
        const url = JSON.parse('<?= json_encode(getUrl($_SERVER['SERVER_NAME'])) ?>');
    </script>
    <script src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/build/js/index.js" type="module"></script>
</body>