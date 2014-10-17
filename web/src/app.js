var message = null;
var App = Ember.Application.create({
    read: function (id) //Get the json
    {
        var message = null;
        urlrequest = 'http://localhost/symfony2trabajoV1.2/web/read';
        var xhr = $.ajax(
                {
                    url: urlrequest,
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    data: JSON.stringify({'id': id}),
                    type: 'POST',
                    async: false,
                    success: function (data) {
                        message = data;
                    }
                });
        if (xhr.status !== 200) {
            message = {errorCode: xhr.status, errorMessage: xhr.statusText};
        }
        return message;
    },
    ready: function ()
    {
        this.contentjson = this.read();
    }
});

//Router
App.Router.map(function ()
{
    this.resource('trabajos', function ()
    {
        this.resource('trabajo', {path: ':trabajo_id'});
        this.resource('about');
        this.resource("new");
    });
});



//Ruta index como redireccion a trabajos
App.IndexRoute = Ember.Route.extend({
    redirect: function () {
        this.transitionTo('trabajos');
    }
});

//Para no ir al server a buscarlos, si no cargarlos de los datos del contentjson
App.TrabajosRoute = Ember.Route.extend({
    model: function ()
    {
        return App.contentjson;
    }
});

//Controlador de los trabajos, con funciones para filtrar,crud en el modelo de datos
App.TrabajosController = Ember.ArrayController.extend({
    actions: {
        select: function (post) {
            console.log("###########");
        }
    },
    originalContent: [],
    sortProperties: ['titulo'],
    sortAscending: true,
    sortBy: function (sortField, sortOrder)
    {
        this.set('sortProperties', [sortField]);
        this.set('sortAscending', (sortOrder === 'asc'));
    },
    filterBy: function (letters)
    {
        if (letters === "")
        {
            this.set('content', this.get('originalContent'));
            return;
        }
        if (this.get('originalContent').length === 0)
            this.set('originalContent', this.get('content'));

        //filtramos por regexp, i flag para ignore case (no distinguir lowercase/uppercase)
        var pattern = new RegExp(letters, 'i');
        var newArray = this.get('originalContent').filter(function (item)
        {
            return (pattern.test(item.id) || pattern.test(item.titulo));
        });
        this.set('content', newArray);
    },
    destroyRecord: function () {
        var id = $(event.target).attr('value');
        if (typeof id !== "undefined") {
            if (window.confirm("Esta seguro de eliminar el registro #" + id + "?")) {
                var message = null;
                var xhr = $.ajax(
                        {
                            url: 'http://localhost/symfony2trabajoV1.2/web/delete/' + id,
                            dataType: 'json',
                            contentType: 'application/json; charset=utf-8',
                            data: JSON.stringify({'id': id}),
                            type: 'DELETE',
                            async: false,
                            success: function (data) {
                                alert(data);
                                setTimeout("location.href='http://localhost/symfony2trabajoV1.2/web/index'", 8);
                            }
                        });
                if (xhr.status != 200 && null !== message) {
                    message = {errorCode: xhr.status, errorMessage: xhr.statusText};
                    alert("An error ocurred:" + message)
                }
            }
        }
    }, createRecord: function () {
        var titulo = this.get('titulo');
        var descripcion = this.get('descripcion');
        var fechacreado = this.get('fechacreado');
        var fechaexpiracion = this.get('fechaexpiracion');
        if (typeof titulo !== "undefined" && typeof descripcion !== "undefined" && typeof fechacreado !== "undefined" && typeof fechaexpiracion !== "undefined") {
            if (window.confirm("Guardar el nuevo registro?")) {
                var message = null;
                var xhr = $.ajax(
                        {
                            url: 'http://localhost/symfony2trabajoV1.2/web/create',
                            dataType: 'json',
                            data: {
                                titulo: titulo,
                                descripcion: descripcion,
                                fechacreado: fechacreado,
                                fechaexpiracion: fechaexpiracion
                            },
                            type: 'POST',
                            async: false,
                            success: function (data) {
                                window.alert(data);
                            }
                        });
                if (xhr.status != 200 && null !== message) {
                    message = {errorCode: xhr.status, errorMessage: xhr.statusText};
                    alert("An error ocurred:" + message)
                }
            }
        }
    }


});

App.SortController = Ember.Controller.extend({
    sortBy: function (sortField, sortOrder) {
        this.controllerFor('trabajos').sortyBy(sortField, sortOrder);
    }
});

App.SortView = Ember.View.extend({
    templateName: 'sort',
    change: function () {
        this.get('controller').send('sortBy', $('#sortField').val(), $('#sortOrder').val());
    }
});

App.FilterController = Ember.Controller.extend({
    filterBy: function (filter) {
        this.controllerFor('trabajos').filterBy(filter);
    }
});

App.FilterView = Ember.View.extend({
    templateName: 'filter',
    keyUp: function () {
        this.get('controller').send('filterBy', $('#filterField').val());
    }
});