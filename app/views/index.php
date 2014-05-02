<!doctype html>
<html lang="pt" ng-app="divulgaUsadosApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Um website para divulgação de veículos usados">
    <title>Divulga Usados</title>

    <!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" href="vendor/pure/pure-min.css" />
</head>
<body>
<h1>Divulga Usados</h1>
<p>Um lugar para mostrar seu veículo e quem sabe fazer um bom negócio.</p>

<div ng-view=""></div>

<script type="text/javascript" src="vendor/angular/angular.min.js"></script>
<script type="text/javascript" src="resources/scripts/divulgausados.min.js"></script>
</body>
</html>