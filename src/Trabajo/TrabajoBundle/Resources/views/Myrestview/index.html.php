<head>
    <meta charset="utf-8" />
    <title>Trabajo APP  EmberJS+symfony2</title>	
    <link rel="stylesheet" href="css/estilos.css">	
</head>
<body>

    <!-- Template para la vista trabajos -->
    <script type="text/x-handlebars" data-template-name="trabajos">
        <div>
        <div class="menu">
        <h2>Listado de Trabajos</h2>
        {{ partial "ui"}}
        <div id="trabajos">
        {{ partial "trabajosList"}}
        </div>
        </div>      
        <div class="content">
        {{ outlet }}
        </div>
        </div>
    </script>

    <!-- Template para la ruta inicial de trabajos, cuando no hay uno seleccionado, mostrar un mensaje -->
    <script type="text/x-handlebars" data-template-name="trabajos/index">
        <p><h3>Por favor seleccione un trabajo para ver su descripci&oacute;n!</h3></p>
    </script>

    <!--Partial con la interfaz de usuario para buscar/filtrar por ID o titulo del registro -->
    <script type="text/x-handlebars" data-template-name="_ui">      
        {{view App.FilterView}}        
    </script>

    <!-- Template para la vista filtrar por ID o titulo -->
    <script type="text/x-handlebars" data-template-name="filter">
        <p>
        <strong>Buscar:</strong>
        <br/>
        Título o Id del registro: <input id="filterField"/>
        </p>
    </script>

    <!-- Partial para listar trabajos en el modelo -->
    <script type="text/x-handlebars" data-template-name="_trabajosList">
        <ul>
        {{#each trabajo in controller }}  
        <hr><li>     
        <p>
        {{#linkTo "trabajo" trabajo }} {{ trabajo.titulo }} {{/linkTo}}
        <br/><br/>
        Fecha Creado:<strong>{{ trabajo.fechacreado }}</strong>
        <br/><br/>
        Fecha Expiraci&oacute;n:<strong>{{ trabajo.fechaexpiracion }}</strong>
        </p>  		
        </li>        
        {{/each}}
        <hr>
        </ul>
    </script>

    <!-- Template para la vista del detalle del trabajo, cuando seleccione uno en especifico-->
    <script type="text/x-handlebars" data-template-name="trabajo">
        <h2>Registro# {{ id }} </h2>
        <p>{{ descripcion }}</p>
    </script>

    <!--js usados por Ember -->
    <script src="src/libs/jquery-1.8.3.min.js"></script>
    <script src="src/libs/handlebars-1.0.0.rc.2.js"></script>
    <script src="src/libs/ember.js"></script>
    <script src="src/libs/ember-data.js"></script>	
    <script src="src/app.js"></script>
    <script src="src/models/trabajo_model.js"></script>   
</body>
</html>