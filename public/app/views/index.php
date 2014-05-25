<!DOCTYPE html>
<html lang="pt" data-ng-app="DivulgaUsadosApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Um website para divulgação de veículos usados">
    <title>Divulga Usados</title>
    
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="app/styles/divulgausados.css" />

    <!--[if lt IE 9]>
    <script type="text/javascript" src="vendor/es5-shim/es5-shim.js"></script>
    <![endif]-->

    <script type="text/javascript" src="vendor/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>

<div class="page-header ">
    <h1>Divulga Usados <small>Um observatório de carros usados</small></h1>
</div>

<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-navegacao-principal">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Início</a>
    </div>

    <div class="container-fluid">
        <div id="menu-navegacao-principal" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Cadastros <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#/vehicle-body-style">Categoria de veículo</a></li>
                        <li><a href="#/vehicle-make">Marca de veículo</a></li>
                        <li><a href="#/vehicle-model">Modelo de veículo</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid" data-ng-view=""></div>

<script type="text/javascript" src="vendor/angular/angular.min.js"></script>
<script type="text/javascript" src="vendor/angular-route/angular-route.min.js"></script>
<script type="text/javascript" src="vendor/angular-resource/angular-resource.min.js"></script>
<script type="text/javascript" src="vendor/angular-file-upload/angular-file-upload.min.js"></script>
<script type="text/javascript" src="app/app.js"></script>
<script type="text/javascript" src="app/vehicle-body-style/vehicle-body-style.js"></script>
<script type="text/javascript" src="app/vehicle-body-style/vehicle-body-style-index.js"></script>
<script type="text/javascript" src="app/vehicle-body-style/vehicle-body-style-form.js"></script>
<script type="text/javascript" src="app/vehicle-body-style/vehicle-body-style-create.js"></script>
<script type="text/javascript" src="app/vehicle-body-style/vehicle-body-style-edit.js"></script>

</body>
</html>