$(document).ready(function(){

   // Datapicker 
   $( ".datepicker" ).datepicker({
      "dateFormat": "yy-mm-dd",
      changeYear: true
   });

   // Iniciamos el DataTable
   var dataTable = $('#Tabla_personal').DataTable({
     "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
     'processing': true,
     'serverSide': true,
     'serverMethod': 'post',
     'searching': true,
     'ajax': {
       'url':'data/extraer.php',
       'data': function(data){
          // Leer valores de fecha
          var buscar_inicio = $('#buscar_inicio').val();
          var buscar_fin = $('#buscar_fin').val();

          // Append to data
          data.buscarFechaInicio = buscar_inicio;
          data.buscarFechaFin = buscar_fin;
       }
     },
     'columns': [
        { data: 'nombres' },
        { data: 'email' },
        { data: 'salario' },
        { data: 'ciudad' },
    { data: 'fecha_ingreso' },
     ]
  });

  // Boton Buscar
  $('#btn_search').click(function(){
     dataTable.draw();
  });

});