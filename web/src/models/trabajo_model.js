// Models
//App.Store = DS.Store.extend({
//revision: 11,
//url: "http://localhost"
//adapter: 'DS.FixtureAdapter'
//});

	


DS.RESTAdapter.reopen({
    namespace: 'ember-js'
});


App.Trabajo = DS.Model.extend({
    titulo: DS.attr('string'),
    descripcion: DS.attr('string'),
    fechaexpiracion: DS.attr('string'),
    fechacreado: DS.attr('string')
});