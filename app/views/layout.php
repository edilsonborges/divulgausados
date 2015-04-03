<!DOCTYPE html>
<html lang="pt" data-ng-app="divulgausados">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Um website para divulgação de veículos usados">
    <title>Divulga Usados</title>

    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="app/core/divulgausados.css" />

    <!--[if lt IE 9]>
    <script type="text/javascript" src="vendor/es5-shim/es5-shim.js"></script>
    <![endif]-->
</head>
<body>

    <div class="page-header ">
        <h1>Divulga Usados <small>Um observatório de carros usados</small></h1>
    </div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                <span class="sr-only">Navegação</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <span class="glyphicon glyphicon-home"></span>
                Início
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-list-alt"></span> Cadastros <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#/body-style"><span class="glyphicon glyphicon-list-alt"></span> Categorias de veículo</a></li>
                        <li><a href="#/make"><span class="glyphicon glyphicon-list-alt"></span> Fabricantes de veículo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#/vehicle/create"><span class="glyphicon glyphicon-road"></span> Veículos</a>
                </li>
            </ul>
        </div>
    </nav>

    <message-box></message-box>
    <div class="container-fluid" data-ng-view=""></div>

    <script type="text/javascript" src="vendor/angular/angular.min.js"></script>
    <script type="text/javascript" src="vendor/angular-route/angular-route.min.js"></script>
    <script type="text/javascript" src="vendor/angular-resource/angular-resource.min.js"></script>
    <script type="text/javascript" src="vendor/angular-local-storage/dist/angular-local-storage.min.js"></script>
    <script type="text/javascript" src="vendor/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
    <script type="text/javascript" src="vendor/angular-file-upload/angular-file-upload.min.js"></script>

    <script type="text/javascript" src="vendor/lodash/dist/lodash.min.js"></script>
    <script type="text/javascript" src="vendor/restangular/dist/restangular.min.js"></script>

    <script type="text/javascript" src="app/core/divulgausados.js"></script>
    <script type="text/javascript" src="app/core/services.js"></script>
    <script type="text/javascript" src="app/core/directives.js"></script>

    <script type="text/javascript" src="app/home/home-module.js"></script>
    <script type="text/javascript" src="app/body-style/body-style-module.js"></script>
    <script type="text/javascript" src="app/make/make-module.js"></script>
    <script type="text/javascript" src="app/make/model/model-module.js"></script>
    <script type="text/javascript" src="app/make/model/model-series/model-series-module.js"></script>
    <script type="text/javascript" src="app/vehicle/vehicle-module.js"></script>
</body>
</html>
