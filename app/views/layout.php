<!DOCTYPE html>
<html lang="pt" data-ng-app="divulgausados">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Um website para divulgação de veículos usados">
    <meta name="author" content="Murilo Costa <murilo.nunes.jose@outlook.com>">
    <title>Divulga Usados</title>
    <!-- bower:css -->
    <link rel="stylesheet" href="bower_components/angular-bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css" />
    <!-- endbower -->
    <link rel="stylesheet" type="text/css" href="app/core/divulgausados.css"/>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="bower_components/es5-shim/es5-shim.js"></script>
    <![endif]-->
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-divulga-usados">
                <span class="sr-only">Navegação</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/#">Divulga Usados</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-navbar-divulga-usados">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#/vehicle/gallery/{{user.id}}">
                        <span class="glyphicon glyphicon-picture"></span> Galeria de veículos
                    </a>
                </li>
                <li>
                    <a href="#/dashboard">
                        <span class="glyphicon glyphicon-th-large"></span> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#/login">
                        <span class="glyphicon glyphicon-log-in"></span> Login
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<message-box></message-box>
<section data-ng-view=""></section>

<script type="text/javascript" src="bower_components/angular/angular.min.js"></script>
<script type="text/javascript" src="bower_components/angular-route/angular-route.min.js"></script>
<script type="text/javascript" src="bower_components/angular-resource/angular-resource.min.js"></script>
<script type="text/javascript" src="bower_components/angular-local-storage/dist/angular-local-storage.min.js"></script>
<script type="text/javascript" src="bower_components/angular-file-upload/angular-file-upload.min.js"></script>
<script type="text/javascript" src="bower_components/angular-input-masks/angular-input-masks-standalone.min.js"></script>

<script type="text/javascript" src="bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
<script type="text/javascript" src="bower_components/angular-bootstrap-colorpicker/js/bootstrap-colorpicker-module.min.js"></script>

<script type="text/javascript" src="bower_components/string-mask/src/string-mask.js"></script>
<script type="text/javascript" src="bower_components/br-validations/releases/br-validations.min.js"></script>

<script type="text/javascript" src="bower_components/lodash/dist/lodash.min.js"></script>
<script type="text/javascript" src="bower_components/restangular/dist/restangular.min.js"></script>

<script type="text/javascript" src="app/core/divulgausados.js"></script>
<script type="text/javascript" src="app/core/services.js"></script>
<script type="text/javascript" src="app/core/directives.js"></script>

<script type="text/javascript" src="app/home/home-module.js"></script>
<script type="text/javascript" src="app/login/login-module.js"></script>
<script type="text/javascript" src="app/body-style/body-style-module.js"></script>
<script type="text/javascript" src="app/make/make-module.js"></script>
<script type="text/javascript" src="app/make/model/model-module.js"></script>
<script type="text/javascript" src="app/make/model/model-series/model-series-module.js"></script>
<script type="text/javascript" src="app/feature-category/feature-category-module.js"></script>
<script type="text/javascript" src="app/feature-category/feature/feature-module.js"></script>
<script type="text/javascript" src="app/vehicle/vehicle-module.js"></script>
<script type="text/javascript" src="app/vehicle/showroom/showroom-module.js"></script>
</body>
</html>
