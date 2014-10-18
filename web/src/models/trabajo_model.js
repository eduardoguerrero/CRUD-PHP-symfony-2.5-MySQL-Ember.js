// Models

App.ApplicationAdapter = DS.SocketAdapter;	



App.Trabajo = DS.Model.extend({
    titulo: DS.attr('string'),
    descripcion: DS.attr('string'),
    fechacreado: DS.attr('string'),
    fechaexpiracion: DS.attr('string')    
});