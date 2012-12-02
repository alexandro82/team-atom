<?php
require_once __DIR__.'/../../app/autoload.php';

use atom\model\Municipio;

$municipio = new Municipio();
$municipios = $municipio->getMunicipiosByMunicipioName('');

$indicadores = array (
    array('id' => '2', 'indicador' => 'Ejecución de Gasto'),
    array('id' => '1', 'indicador' => 'Ejecución de Recurso'),
    array('id' => '31', 'indicador' => 'Gestión Financiera'),
    array('id' => '32', 'indicador' => 'Gobernabilidad'),
);
?>

<!DOCTYPE html>
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
<style type="text/css">
body {
    padding-top: 60px;
    padding-bottom: 40px;
}
.span10 h4 {
    text-align: justify;
}
h4 {
    margin-top: 10px;
    margin-bottom: 10px;
}
.selectedMunicipality {
    background-image: url(/js/implementation/img/municipio_verde.jpg);
}
.deselectedMunicipality {
    background-image: url(/js/implementation/img/municipio_azul.jpg);
}
</style>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<body onload="init_lib();">
<!-- BODY -->
    <?php include '../navbar.php'; ?>

    <div class="container-fluid">
        <div class="row-fluid">
            <?php include '../leftbar.php'; ?>
<<<<<<< HEAD
    
            <div class="forms span3" style="position:relative;">
                <div id="form_consulta" class="forms">
                    <form  class="form">
                        <label for="anio">A&ntilde;o:</label>
                        <input name="anio" id="anio" />
                    </form>
                </div>
=======

            <div class="span3">
                <form  id="consulta_indice" class="form" style="width:100%">
                    <label for="indicador_a">Indicador 1</label>
                    <select name="indicador_a" id="indicador_a">
                        <?php foreach($indicadores as $i): ?>
                        <option value="<?php echo $i['id']; ?>">
                            <?php echo $i['indicador']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <label for="indicador_b">Indicador 2</label>
                    <select name="indicador_b" id="indicador_b">
                        <?php foreach($indicadores as $i): ?>
                        <option value="<?php echo $i['id']; ?>">
                            <?php echo $i['indicador']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="gestion">Gesti&oacute;n:</label>
                    <select name="gestion" id="gestion">
                        <?php foreach(range(2009, 2005) as $i): ?>
                        <option value="<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <label for="municipio">Municipio:</label>
                    <select name="municipio" id="municipio">
                        <option value="">Todos</option>
                        <?php foreach($municipios as $m): ?>
                        <option value="<?php echo $m['id']; ?>">
                            <?php echo $m['nombre']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <br/>
                    <br/>
                    <input type="submit" class="btn" value="ver" />
                </form>
            </div>
            
            <div class="forms offset5" style="position:relative;">
>>>>>>> 86b348e3dfc3f2fa9bde45033e936588b11e81ce
                <div id="canvas">
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        
        <hr>
        <footer>
            <p style="text-align:center">TEAM-ATOM 2012</p>
        </footer>
    </div> <!-- /container -->


<div class="modal-spinner" id="modal_spinner">
<img src="/assets/img/loading.gif" alt="Cargando..." />
</div>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery-1.8.0.min.js"></script>
<script src="/assets/js/jquery-ui-1.8.23.min.js"></script>
<script src="/assets/js/jquery.ui.datepicker-es.js"></script>
<script src="/assets/js/bootstrap-button.js"></script>
<script src="/assets/js/bootstrap-modal.js"></script>
    
    <script type="text/javascript" src="/js/graphics_lib/wz_jsgraphics.js"></script>
    <script type="text/javascript" src="/js/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="/js/graphics_lib/global_canvas.js"></script>

    <script type="text/javascript" src="/js/graphics_lib/point.js"></script>
    <script type="text/javascript" src="/js/graphics_lib/color.js"></script>
    <script type="text/javascript" src="/js/graphics_lib/wz_facade.js"></script>
    <script type="text/javascript" src="/js/graphics_lib/generic_object.js"></script>
    <script type="text/javascript" src="/js/graphics_lib/line.js"></script>
    <script type="text/javascript" src="/js/graphics_lib/axis.js"></script>
    <script type="text/javascript" src="/js/graphics_lib/canvas.js"></script>
    <script type="text/javascript" src="/js/graphics_lib/circle.js"></script>
    <script type="text/javascript" src="/js/graphics_lib/graphic.js"></script>



    <script type="text/javascript" src="/js/implementation/app_canvas.js"></script>
    <script type="text/javascript" src="/js/implementation/municipality.js"></script>
    <script type="text/javascript" src="/js/implementation/variable.js"></script>
    <script type="text/javascript" src="/js/implementation/index.js"></script>
    <script type="text/javascript" src="/js/implementation/indicator.js"></script>
    <script type="text/javascript" src="/js/implementation/dispersion_graphic.js"></script>
    <script type="text/javascript" src="/js/implementation/init_lib.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {
            $("#consulta_indice").on('submit', function(event){
                event.preventDefault();
                var indicador_a = $(this).find('#indicador_a option:selected').val();
                var indicador_b = $(this).find('#indicador_b option:selected').val();
                var gestion = $(this).find('#gestion option:selected').val();
                var municipio = $(this).find('#municipio option:selected').val();
                canvas.graphics[0].setParameters(indicador_a, indicador_b, gestion, municipio);
            });
        });
        
    </script>
<!--
<script src="assets/js/bootstrap-transition.js"></script>
<script src="assets/js/bootstrap-alert.js"></script>
<script src="assets/js/bootstrap-dropdown.js"></script>
<script src="assets/js/bootstrap-scrollspy.js"></script>
<script src="assets/js/bootstrap-tab.js"></script>
<script src="assets/js/bootstrap-tooltip.js"></script>
<script src="assets/js/bootstrap-popover.js"></script>
<script src="assets/js/bootstrap-collapse.js"></script>
<script src="assets/js/bootstrap-carousel.js"></script>
<script src="assets/js/bootstrap-typeahead.js"></script>
-->
<!-- END BODY -->
</body>
</html>


