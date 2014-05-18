<!doctype html>
<html lang="pt" ng-app="DivulgaUsadosApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Um website para divulgação de veículos usados">
    <title>Divulga Usados</title>

    <!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" href="vendor/pure/pure-min.css" />
    <link rel="stylesheet" href="app/styles/divulgausados.css" />
</head>
<body>

<h1 class="main-application-title"><a href="/">Divulga Usados</a></h1>

<nav class="pure-menu pure-menu-open pure-menu-horizontal">
	<ul>
		<li>
			<a href="#/vehicle-body-style">Listar categorias de veículo</a>
		</li>
	</ul>
</nav>

<div ng-view=""></div>

<script type="text/javascript" src="vendor/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="vendor/angular/angular.min.js"></script>
<script type="text/javascript" src="vendor/angular-route/angular-route.min.js"></script>
<script type="text/javascript" src="vendor/angular-resource/angular-resource.min.js"></script>
<script type="text/javascript" src="app/app.js"></script>
<script type="text/javascript" src="app/vehicle-body-style/vehicle-body-style.js"></script>
<script type="text/javascript" src="app/vehicle-body-style/vehicle-body-style-index.js"></script>
<script type="text/javascript" src="app/vehicle-body-style/vehicle-body-style-create.js"></script>
<script type="text/javascript" src="app/vehicle-body-style/vehicle-body-style-edit.js"></script>

</body>
</html>