<?php
session_start();
validateLogin();
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/assets/images/logo.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bienvenido a MakFrio</span>
                <h2><?= $_SESSION["user"] ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <!-- <h3>Secciones</h3> -->
                <ul class="nav side-menu">
                    <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/home"><i class="fa fa-home"></i>Home</a></li>
                    <div class="menu_section"></div>
                    <?php if ($_SESSION["idPerfil"] == 3) : ?>
                        <li><a><i class="fa fa-briefcase"></i>Cartera<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="./">Consultar cartera</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-users"></i>Usuarios<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/usuario/registrar">Registrar usuario</a></li>
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/usuario/consultar">Consultar usuarios</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION["idPerfil"] != 2) : ?>
                        <li><a><i class="fa fa-user"></i>Clientes<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/cliente/registrar">Registrar cliente</a></li>
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/cliente/consultar">Consultar clientes</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-shopping-cart"></i>Pedidos<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/pedido/registrar">Registrar pedido</a></li>
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/pedido/consultar">Consultar pedidos</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-truck"></i>Compras<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/compra/registrar">Registrar orden de compra</a></li>
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/compra/consultar">Consultar ordenes de compra</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-arrow-circle-up"></i>Gastos<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/gasto/registrar">Registrar gasto</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-arrow-circle-down"></i>Ingresos<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="./">Consultar ingresos</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-archive"></i>Producto<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/producto/registrar">Registrar producto</a></li>
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/producto/consultar">Consultar productos</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-cubes"></i>Inventario<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/inventario/consultar">Consultar inventario</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION["idPerfil"] == 2) : ?>
                        <li><a><i class="fa fa-outdent"></i>Compras<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/<?= getUrl($_SERVER['SERVER_NAME']) ?>/compra/consultar">Mis ordenes de compra</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>