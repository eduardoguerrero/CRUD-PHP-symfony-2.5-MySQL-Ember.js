<head>
    <meta charset="utf-8" />
    <title>Trabajo APP  EmberJS+symfony2</title>	
    <link rel="stylesheet" href="css/estilos.css">	
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
</head>
<body>

    <!-- Template para la vista trabajos -->
    <script type="text/x-handlebars" data-template-name="trabajos">
        <div>
            <div class="menu">   
            {{ partial "ui"}}
        <div id="trabajos">
            {{ partial "trabajosList"}}
            </div>
        </div>      
        <div class="content">
            {{ partial "createRecord" }}
            {{ outlet }}
        </div>
        </div>
    </script>

    <!-- Template para la ruta inicial de trabajos, cuando no hay uno seleccionado, mostrar un mensaje -->
    <script type="text/x-handlebars" data-template-name="trabajos/index">
       <div class="alert alert-info" role="alert">Por favor seleccione un trabajo para editarlo</div>
     </script>

    <!--Partial con la interfaz de usuario para buscar/filtrar por ID o titulo del registro -->
    <script type="text/x-handlebars" data-template-name="_ui">      
        {{view App.FilterView}}        
    </script>    

    <!-- Template para la vista filtrar por ID o titulo y agregar nuevo-->
    <script type="text/x-handlebars" data-template-name="filter">
         <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input id="filterField" type="text" class="form-control" placeholder="Buscar por Titulo o ID   ">
            </div>
          </form>
          <br/>
     </script>  
       
    <!-- Partial para mostrar barra de menu -->
    <script type="text/x-handlebars">
     <br/>
     <div class="navbar">
       <div class="navbar-inner">
         <a class="brand" href="#">Inicio</a>
         <ul class="nav">       
           <li>{{#linkTo 'about'}}Acerca de{{/linkTo}}</li>
         </ul>       
       </div>
     </div> 
     {{outlet}} 
   </script>
   
    <!-- Partial para mostrar acerca de -->
    <script type="text/x-handlebars" data-template-name="about">        
        <div class="about">
           <div class="alert alert-success" role="alert">Sobre el demo</div>
           <div class="alert alert-info" role="alert">Usando symfony2, Ember js y MySql.</div>
    </script> 
    
     <!-- Partial para mostrar formulario de nuevo registro -->
    <script type="text/x-handlebars" data-template-name="_createRecord">
          <h4>Nuevo Registro</h4>
         <form {{action createRecord on="submit"}}>
            {{view Ember.TextField valueBinding="titulo" placeholder="Titulo"}}<br />
            {{view Ember.TextArea valueBinding="descripcion" placeholder="Descripcion"}}<br />
            {{view Ember.TextField valueBinding="fechacreado" placeholder="Fecha Creado"}}<br />
            {{view Ember.TextField valueBinding="fechaexpiracion" placeholder="Fecha expiracion"}}<br />
            <button class='btn btn-success' {{action 'createRecord'}}>Guardar</button>
            <hr>    
         </form>
    </script> 
  
    <!-- Partial para listar trabajos en el modelo -->
    <script type="text/x-handlebars" data-template-name="_trabajosList">
       <h4>Listado de Trabajos</h4>
      <form {{action destroyRecord on="submit"}}>
        <table  class='table table-striped'>
          <tr class='info'>
             <td>Titulo</td>
             <td>Fecha Creado</td>
             <td>Fecha Expiraci&oacute;n</td>
             <td>Acci&oacute;n</td>
          </tr>
        {{#each trabajo in controller }}  
            <tr class='success' {{bindAttr class="this.active:active:normal"}} {{bindAttr id="trabajo.id"}}>
            <td>
                {{#linkTo "trabajo" trabajo }} {{ trabajo.titulo }} {{/linkTo}}
            </td>
            <td>
                {{ trabajo.fechacreado }}
            </td>
            <td>
                {{ trabajo.fechaexpiracion }}
            </td>
            <td>
              <button  class='btn btn-warning' {{action destroyRecord this}} {{bindAttr value="trabajo.id"}}>Eliminar</button>
            </td> 
          </tr>
        {{/each}}        
        </table>
        </form>   
    </script> 

    <!-- Template para la vista del detalle del trabajo, cuando seleccione uno en especifico-->
    <script type="text/x-handlebars" data-template-name="trabajo">
        <h4>Editar Registro# {{ id }} </h4>
        <form {{action updateRecord on="submit"}}>
            <strong>Titulo:</strong><br />
            {{view Ember.TextField valueBinding="titulo"  }}<br />
            <strong>Descripcion:</strong><br />
            {{view Ember.TextArea valueBinding="descripcion"}}<br />
            <strong>Fecha creado:</strong><br />
            {{view Ember.TextField valueBinding="fechacreado"}}<br />
            <strong>Fecha expiraci&oacute;n:</strong><br />
            {{view Ember.TextField valueBinding="fechaexpiracion"}}<br />
            <button class='btn btn-success' {{action 'updateRecord'}} {{bindAttr value="id"}}>Editar</button>
            <hr>    
         </form>     
            
    </script>
    
    <script src="src/libs/jquery-1.8.3.min.js"></script>
    <script src="src/libs/handlebars-1.0.0.rc.2.js"></script>
    <script src="src/libs/ember.js"></script>
    <script src="src/libs/ember-data.js"></script>	
    <script src="src/app.js"></script>
    <script src="src/models/trabajo_model.js"></script>   
</body>
</html>