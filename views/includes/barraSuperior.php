<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/images/user.png" alt=""><?= $_SESSION["user"] ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/usuario/perfil">Perfil</a>
                        <!-- <a class="dropdown-item" href="">
                            <span>Ajustes</span>
                        </a>
                        <a class="dropdown-item" href="">Ayuda</a> -->
                        <a class="dropdown-item" id="logOut"><i class="fa fa-sign-out pull-right"></i>Cerrar Sesion</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>