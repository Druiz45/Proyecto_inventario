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
                    <form id="form-login">
                        <h1>Inicio de sesion</h1>
                        <div class="col-md-12 col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Usuario" />
                        </div>
                        <div class="form-group col-md-12 col-sm-6">
                            <input class="form-control pass" type="password" id="pass" name="pass" placeholder="Contraseña">
                            <span style="position: absolute; right: 15px; top: 7px;" class="ver">
                                <i class="fa fa-eye-slash" style="display: none;"></i>
                                <i class="fa fa-eye" style="display: block;"></i>
                            </span>
                        </div>
                        <div>
                            <button class="btn btn-dark" type="submit">Iniciar sesion</button>
                            <a class="reset_pass" href="./password/recover">¿Olvidaste tu contraseña?</a>
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
    <script src="./assets/build/js/index.js" type="module"></script>
</body>