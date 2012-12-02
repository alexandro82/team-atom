<!DOCTYPE html>
<?php
session_start();
?>
<html lang="es" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Team - Atom</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <script type="text/javascript" src="/assets/js/modernizr-2.6.1.js"></script>

        <!-- Le styles -->
        <link href="/lib/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="/lib/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="/assets/css/start/jquery-ui-1.8.23.custom.css" rel="stylesheet">
        <link href="/assets/css/modal_spinner.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/lib/modal/css/ventanas-modales.css">
        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
            }
            .span10 h4 {
                text-align: justify;
            }
            h4 {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            /* Carousel base class */
            .carousel {
                margin-bottom: 50px;
            }

            .carousel .container {
                position: absolute;
                right: 0;
                bottom: 0;
                left: 0;
            }

            .carousel-control {
                background-color: transparent;
                border: 0;
                font-size: 120px;
                margin-top: 0;
                text-shadow: 0 1px 1px rgba(0,0,0,.4);
            }

            .carousel .item {
                height: 500px;
            }
            .carousel img {
                min-width: 100%;
                height: 500px;
            }

            .carousel-caption {
                background-color: transparent;
                position: static;
                max-width: 550px;
                padding: 0 20px;
                margin-bottom: 100px;
            }
            .carousel-caption h1,
            .carousel-caption .lead {
                margin: 0;
                line-height: 1.25;
                color: #fff;
                text-shadow: 0 1px 1px rgba(0,0,0,.4);
            }
            .carousel-caption .btn {
                margin-top: 10px;
            }


            @media (max-width: 979px) {

                .container.navbar-wrapper {
                    margin-bottom: 0;
                    width: auto;
                }
                .navbar-inner {
                    border-radius: 0;
                    margin: -20px 0;
                }

                .carousel .item {
                    height: 500px;
                }
                .carousel img {
                    width: auto;
                    height: 500px;
                }

                .featurette {
                    height: auto;
                    padding: 0;
                }
                .featurette-image.pull-left,
                .featurette-image.pull-right {
                    display: block;
                    float: none;
                    max-width: 40%;
                    margin: 0 auto 20px;
                }
            }


            @media (max-width: 767px) {

                .navbar-inner {
                    margin: -20px;
                }

                .carousel {
                    margin-left: -20px;
                    margin-right: -20px;
                }
                .carousel .container {

                }
                .carousel .item {
                    height: 300px;
                }
                .carousel img {
                    height: 300px;
                }
                .carousel-caption {
                    width: 65%;
                    padding: 0 70px;
                    margin-bottom: 40px;
                }
                .carousel-caption h1 {
                    font-size: 30px;
                }
                .carousel-caption .lead,
                .carousel-caption .btn {
                    font-size: 18px;
                }

                .marketing .span4 + .span4 {
                    margin-top: 40px;
                }

                .featurette-heading {
                    font-size: 30px;
                }
                .featurette .lead {
                    font-size: 18px;
                    line-height: 1.5;
                }

            }
        </style>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="js/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
    </head>
    <body>
        <!-- BODY -->

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.php">AtOm - DAL2012</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="active"><a class="clsVentanaIFrame" href="/upload/index.php" rel="Cargar">Cargar</a></li>
                            <li><a class="clsVentanaIFrame" href="/dispersion/index.php" rel="Disepersi&oacute;n">Dispersi&oacute;n</a></li>                            
                            <li><a class="clsVentanaIFrame" href="/Map/index.php" rel="Mapas">Geolocalizaci&oacute;n</a></li>                          
                            
                            <li><a class="clsVentanaIFrame" href="/tree/index.php" rel="&Aacute;rbol">&Aacute;rbol</a></li>
                            <li><a class="clsVentanaIFrame" href="/contacto/index.php" rel="Contacto">Contacto</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- ##################### CONTAINER ############ -->

        <!-- Carousel
            ================================================== -->
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="/assets/img/slide-01.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Modelo de Dispersi&oacute;n.</h1>
                            <p class="lead">El diagrama de dispersión es un instrumento útil para analizar distribuciones de puntos que representan un valor para identificar algún patrón reconocible.</p>
                            <a class="btn btn-large btn-primary clsVentanaIFrame" href="/dispersion/index.php">Graficar</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/assets/img/slide-02.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>&Aacute;rbol de &Iacute;ndices</h1>
                            <p class="lead">Crear variables de Gesti&oacute;n Municipal.</p>
                            <a class="btn btn-large btn-primary clsVentanaIFrame" href="/tree/index.php" rel="&Aacute;rbol">Graficar</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/assets/img/slide-03.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Cargar Informaci&oacute;n</h1>
                            <p class="lead">Este m&oacute;dulo permite subir archivos con indicadores, indices a la base de datos del sistema.</p>
                            <a class="btn btn-large btn-primary clsVentanaIFrame" href="/upload/index.php" rel="Cargar">Cargar</a>

                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="/assets/img/slide-02.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Geolocalizaci&oacute;n de Indices</h1>
                            <p class="lead">A partir de informaci&oacute;n estrat&eacute;gica georeferenciarla a nivel Nacional.</p>                            
                            <a class="btn btn-large btn-primary clsVentanaIFrame" href="/Map/index.php" rel="Map">Mapas</a>
                        </div>
                    </div>
                </div>

            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div><!-- /.carousel -->
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="forms">
                </div>
            </div>
            <hr>
            <footer>
                <p style="text-align:center">TEAM-ATOM 2012</p>
            </footer>
            <div id="divContenedor">
                <div id="divLogo">
                </div>
                <div id="divContenido">
                </div>
            </div>

        </div> <!-- /container -->
        <!-- ##################### CONTAINER ############ -->
        <div class="modal-spinner" id="modal_spinner">
            <img src="/assets/img/loading.gif" alt="Cargando..." />
        </div>

        <!-- FOOTER -->
        <footer>
            <p>&copy; 2012 Atom, Inc. &middot;</p>
        </footer>

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/assets/js/jquery-1.8.0.min.js"></script>
        <script src="/assets/js/jquery-ui-1.8.23.min.js"></script>
        <script src="/assets/js/jquery.ui.datepicker-es.js"></script>
        <script src="/assets/js/bootstrap-button.js"></script>
        <script src="/assets/js/bootstrap-modal.js"></script>

        <script src="/assets/js/bootstrap-transition.js"></script>
        <script src="/assets/js/bootstrap-alert.js"></script>
        <script src="/assets/js/bootstrap-dropdown.js"></script>
        <script src="/assets/js/bootstrap-scrollspy.js"></script>
        <script src="/assets/js/bootstrap-tab.js"></script>
        <script src="/assets/js/bootstrap-tooltip.js"></script>
        <script src="/assets/js/bootstrap-popover.js"></script>
        <script src="/assets/js/bootstrap-collapse.js"></script>
        <script src="/assets/js/bootstrap-carousel.js"></script>
        <script src="/assets/js/bootstrap-typeahead.js"></script>
        <script src="/lib/modal/js/ventanas-modales.js"></script>
        <script>
                !function ($) {
                $(function(){
                    // carousel demo
                    $('#myCarousel').carousel()
                })
            }(window.jQuery)
        </script>
        <!-- END BODY -->
    </body>
</html>


