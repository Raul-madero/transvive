id="fetch_generated_wills"

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script> 

<?php 
   if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 6 || $_SESSION['rol'] == 8 || $_SESSION['rol'] == 9){
?>


<script>
        $( document ).ready(function() {
var table = $('#example1').dataTable({
"order": [[ 1, "asc" ]],
"bProcessing": true,
"sAjaxSource": "data/data_viajes.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'Id', "sWidth": "5%" } ,
{ mData: 'Fcha', "sWidth": "5%" } ,
{ mData: 'Hinicio', "sWidth": "5%", className: 'dt-center' } ,
{ mData: 'Hfin', "sWidth": "5%", className: 'dt-center' } ,
{ mData: 'semana', "sWidth": "6%" } ,
{ mData: 'cliente' ,"sWidth": "15%"},
{ mData: 'operador' ,"sWidth": "35%"},
{ mData: 'unidad' ,"sWidth": "5%"},
{ mData: 'num_unidad' ,"sWidth": "5%"},
{ mData: 'nombre' ,"sWidth": "10%"},
{ mData: 'jefe_operaciones' ,"sWidth": "10%"},
{ mData: 'Status' ,"sWidth": "5%"},
{
                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" style="color:#007bff;" href= \'edit_viaje.php?id=' + full.Id +  '\'><i class="far fa-edit"></i></a> | <a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id=\'' + full.Id +  '\' href="#" class="link_delete" style="color:#94456E" ><i class="fas fa-times-circle"></i></a>';
    }
                    
            
 } 

],

        "oLanguage": {
        "sEmptyTable": "No hay registros disponibles",
        "sInfo": "Hay _TOTAL_ registros. Mostrando de (_START_ a _END_)",
        "sLoadingRecords": "Por favor espera - Cargando...",
        "sSearch": "Buscar:",
        "sLengthMenu": "Mostrar _MENU_",
        "oPaginate": {
        "sFirst": "Primera",
        "sPrevious": "Previa",
        "sNext": "Siguiente",
        "sLast": "Ultima",
      }
        }


       
});
});
        
</script>

<?php }else {
   if($_SESSION['rol'] == 4  ){
?>

<script>
        $( document ).ready(function() {
var table = $('#example1').dataTable({
"order": [[ 1, "asc" ]],
"bProcessing": true,
"sAjaxSource": "data/data_viajes.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'Id', "sWidth": "5%" } ,
{ mData: 'Fcha', "sWidth": "5%" } ,
{ mData: 'Hinicio', "sWidth": "5%", className: 'dt-center' } ,
{ mData: 'Hfin', "sWidth": "5%", className: 'dt-center' } ,
{ mData: 'semana', "sWidth": "15px" } ,
{ mData: 'cliente' ,"sWidth": "15%"},
{ mData: 'operador' ,"sWidth": "40%"},
{ mData: 'unidad' ,"sWidth": "10%"},
{ mData: 'num_unidad' ,"sWidth": "10%"},
{ mData: 'id_supervisor' ,"sWidth": "10%"}, 
{ mData: 'jefe_operaciones' ,"sWidth": "10%"}, 
{ mData: 'Status' ,"sWidth": "8%"},
{
                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" style="color:#007bff;" href= \'edit_viaje.php?id=' + full.Id +  '\'><i class="far fa-edit"></i></a> | <a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id=\'' + full.Id +  '\' href="#" class="link_delete" style="color:#94456E" ><i class="fas fa-times-circle"></i></a>';
    }
          
            
 } 

],

"columnDefs":[
    {
        "targets": [9,10],
        "visible": false,
    }            
     
],

        "oLanguage": {
        "sEmptyTable": "No hay registros disponibles",
        "sInfo": "Hay _TOTAL_ registros. Mostrando de (_START_ a _END_)",
        "sLoadingRecords": "Por favor espera - Cargando...",
        "sSearch": "Buscar:",
        "sLengthMenu": "Mostrar _MENU_",
        "oPaginate": {
        "sFirst": "Primera",
        "sPrevious": "Previa",
        "sNext": "Siguiente",
        "sLast": "Ultima",
      }
        }


       
});
});
        
</script>

<?php }} ?>

<script>
        $( document ).ready(function() {
var table = $('#listaClientes').dataTable({
"bProcessing": true,
"sAjaxSource": "data/data_clientes.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"aoColumns": [
{ mData: 'Empid' } ,
{ mData: 'Name' },
{ mData: 'Salary' },
{ mData: 'Linea' },
{ mData: 'Lugar'},
{
                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" href= \'edit_viaje.php?id=' + full.Empid +  '\'><i class="far fa-edit"></i> Editar</a> | <a id="delete_cliente" data-id=\'' + full.Name +  '\' href="javascript:void(0)" class="link_delete" ><i class="far fa-trash-alt"></i> Borrar</a>';
    }
                    
            
 }                   

],

        "oLanguage": {
        "sEmptyTable": "No hay registros disponibles",
        "sInfo": "Hay _TOTAL_ registros. Mostrando de (_START_ a _END_)",
        "sLoadingRecords": "Por favor espera - Cargando...",
        "sSearch": "Buscar:",
        "sLengthMenu": "Mostrar _MENU_",
        
        }

       
});
});
        
            </script>

<script type="text/javascript">


/* it will load products when document loads */

$(document).on('click', '#delete_cliente', function(e){

e.preventDefault();
      var empleadoId = $(this).data('id');
       var action = 'infoBorraTarea';
       swal({
 title: "Desea Cerrar el Registro ?",
 text: "No. ID: " + empleadoId,
 icon: "warning",
 buttons: true,
 dangerMode: true,
})
.then((willDelete) => {
 if (willDelete) {
   $.ajax({
           url: 'includes/ajax.php',
           type: "POST",
           async : true,
           data: {action:action,empleadoId:empleadoId},
           success: function(response)
           {
               if(response != 0){
                   swal('Eliminado','Tarea Cerrada Correctamente','success').then((value) => {
                   location.reload();
})
                 
               }else{
                   swal("Poof! Error!", {
     icon: "warning",
   });
               
                  
               }
           },
           error: function(error) {

           }

       });

  
 } else {
   swal("Accion Cancelada Tarea no Cerrada !");
 }
});
       
       

        }); 
   
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalCancelViaje').on('show.bs.modal', function(e) { 

     var idc    = $(e.relatedTarget).data().id;
  
    
      $(e.currentTarget).find('#form_pass_idcc').val(idc);
 
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalCancelViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Cancelar Vuelta</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_idcc" name="form_pass_idcc" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Motivo de Cancelación:</label>
           <div class="col-sm-9">
             <textarea class="form-control" rows="1" id="comentarios" name="comentarios">Cancelado / Reprogramado por el Cliente</textarea>
           </div>
        </div>  

   
       
 

        <!--<div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Imagen:</label>
           <div class="col-sm-10">
              <input type="file" class="form-control" id="image" name="image" multiple>
           </div>
        </div>-->

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaVuelta"><i class="fa fa-save"></i>&nbsp;Cancelar Vuelta</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaVuelta').click(function(e){
        e.preventDefault();

        var idcc      = $('#form_pass_idcc').val();       
        var motivoc   = $('#comentarios').val();

       var action       = 'AddCancelaVuelta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idcc:idcc, motivoc:motivoc},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            alert('Cancelación Registrada Correctamente');

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            
    
                        }else{
                           console.log('no data');
                           alert('faltan datos');
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>   


 <div class="modal fade" id="modalEditPeriodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Detalle Viajes por Día</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Empleado:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_noempleado" name="form_pass_noempleado" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Inicio de Contrato:</label>
           <div class="col-sm-9">
              <input type="date" class="form-control" id="form_pass_finicio" name="form_pass_finicio">
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Fin de Contrato:</label>
           <div class="col-sm-9">
              <input type="Date" class="form-control" id="form_pass_ffin" name="form_pass_ffin">
           </div>
        </div> 

       <div class="col-sm-12">
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                               <th style="width:20%; background-color:#e9ecef; text-align: center;" >No. Empleado</th>
                               <th style="width:35%; background-color:#e9ecef; text-align: center;">Inicia Contrato</th>
                               <th style="width:35%; background-color:#e9ecef; text-align: center;">Vence Contrato</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Acciones</th>
                            </tr>
                          </thead>
                          <tbody id="detalle_periodo">
                          </tbody>
                          </table>
                     
                      </div>

        <!--<div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Imagen:</label>
           <div class="col-sm-10">
              <input type="file" class="form-control" id="image" name="image" multiple>
           </div>
        </div>-->

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaclientes"><i class="fa fa-save"></i>&nbsp;Registra Periodo</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var noempleado = $('#form_pass_noempleado').val();
        var dateinicio = $('#form_pass_finicio').val();
        var datefin    = $('#form_pass_ffin').val();
  


       var action       = 'AddPeridoContrato';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, noempleado:noempleado, dateinicio:dateinicio, datefin:datefin},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            alert('Periodo Almacenado Correctamente');
                             $('#detalle_periodo').html(info.detalle);
                            $('#modalEditPeriodo').modal('hide');
                           // location.reload(true);
                            
    
                        }else{
                           console.log('no data');
                           alert('faltan datos');
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script> 


    <!-- <script type="text/javascript">
    $(document).ready(function(){
        var c_fecha = '<?php echo $fcha1; ?>';
        searchForDetalleViajes(c_fecha);
     });
  </script> -->

 <script>
 function searchForDetalleViajes(c_fecha){
    var action = 'searchForDetalleViajes';
    var fechadia = c_fecha;

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, fechadia:fechadia},

        success: function(response)
        {
                
           
                var info = JSON.parse(response);
                $('#detalle_periodo').html(info.detalle);

            

               console.log(response);

               
                           
           
            //viewProcesarCot();        
        },
        error: function(error) {
        }

    });
}
 
</script> 

<script>
  let refresh = document.getElementById('refresh');
refresh.addEventListener('click', _ => {
            location.reload();
})
</script>
