var message = null
var App = Ember.Application.create({
    read: function (id) //Get the json
    {
        var message = null;
        var xhr = $.ajax(
                {
                    url: 'http://localhost/symfony2trabajoV1.2/web/read',
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
        console.log(this.read())
        
        //this.bootstrap = this.read()
        var rr = this.read();
        var result = "[{";
        for (var i in rr) {
            result += i + ':"' + rr[i] + '",'
            //console.log(rr[i])
        }
        result += "}]";
        //this.bootstrap = result
        this.bootstrap = [{id: '1', titulo: 'titulo1', descripcion: 'descripcipn1', fechaexpiracion: '2012-4-6', fechacreado: '2012-4-5', }]

    }

});


//Router
App.Router.map(function ()
{
    this.resource('trabajos', function ()
    {
        this.resource('trabajo', {path: ':trabajo_id'});
    });
});

//Ruta index como redireccion a trabajos
App.IndexRoute = Ember.Route.extend({
    redirect: function () {
        this.transitionTo('trabajos');
    }
});

//en el caso de la ruta trabajos, no queremos ir al server a buscarlos (comportamiente por defecto)
//si no cargarlos de los datos del bootstrap ;)
App.TrabajosRoute = Ember.Route.extend({
    model: function ()
    {
        return App.bootstrap;
        //return App.Trabajo.find();

    }
});

//Controlador de los trabajos, con funciones para filtrar modelo de datos
App.TrabajosController = Ember.ArrayController.extend(
        {
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
            // Controllers
            read: function (id) {
                this.set('currentResult', this.store.read(id));
                if (!this.currentResult.errorCode) {
                    if (Ember.isArray(this.currentResult.data)) { // Read all
                        var array = Ember.ArrayController.create({content: []});
                        this.currentResult.data.forEach(function (item, index) {
                            array.pushObject(App.TrabajoModel.create(item));
                        });
                        return array;
                    }
                    else { // An object
                        var customer = this.get('trabajos').findProperty('id', this.currentResult.data.id)
                        customer && customer.setProperties(this.currentResult.data);
                        return customer;
                    }
                }
                else { // Empty result
                    return id ? null : Ember.ArrayController.create({content: []});
                }
            },
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