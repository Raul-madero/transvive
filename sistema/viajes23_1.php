<script type="text/javascript">

      load_data(); // first load

      function load_data(inicio_date, fin_date, buscaid){
        var ajax_url = "data/datadetorders2_jo_1.php";
        $.ajax({
            url: ajax_url,
            type: "POST",
            data: { 
                "action" : "fetch_userss", 
                "inicio_date" : inicio_date, 
                "fin_date" : fin_date,
                "buscaid" : buscaid,
                "records": 
            },
            dataType: "json",
            success: function(response) {
                console.log(response)
                $('#fetch_generated_willss').DataTable({
                  "order": [[ 1, "desc" ]],
                  dom: 'Bfrtip',
                  lengthMenu: [
                  [20, 25, 50, -1],
                  ['20 rows', '25 rows', '50 rows', 'Show all']
                  ],
                  buttons: [
                  'excelHtml5',
                  'pageLength'
                  ],
                  "processing": true,
                  "serverSide": true,
                  "stateSave": true,
                  "responsive": true,
                  "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                  "ajax" : {
                    "url" : ajax_url,
                    "dataType": "json",
                    "type": "POST",
                    "data" : { 
                      "action" : "fetch_userss", 
                      "inicio_date" : inicio_date, 
                      "fin_date" : fin_date,
                      "buscaid" : buscaid 
                      
                    },
                    "dataSrc": "records"
                  },
                  "columns": [
                    { "data" : "pedidono", "width": "10px", className: "text-right" },
                    { "data" : "fecha", "width": "60px"},
                    { "data" : "horainicio", "width": "50px", className: "text-center", "orderable": false },
                    { "data" : "horafin", "width": "50px", className: "text-center", "orderable": false },
                    { "data" : "nosemana", "width": "80px", "orderable": false },
                    { "data" : "razonsocial", "width": "100px", "orderable":false },
                    { "data" : "rutacte", "width": "40px", "orderable":false },
                    { "data" : "conductor", "width": "100px", "orderable":false },
                    { "data" : "tipounidad", "width": "80px", "orderable":false },
                    { "data" : "nounidad", "width": "30px", "orderable":false },
                    { "data" : "supervisor", "width": "50px", "orderable":false },
                    { "data" : "jefeopera", "width": "50px", "orderable":false },
                    { "data" : "estatusped", "width": "30px", "orderable":false },
                    {
                            "render": function ( data, type, full, meta ) {
                return '<center><a href=\'edit_viaje.php?id=' + full.pedidono +  '\' class="btn btn-primary btn-xs"><i class="fa fa-edit" style="color:white;  font-size: 1.2em"></i></a> | <a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id=\'' + full.pedidono +  '\' href="#" class="btn btn-danger btn-xs" ><i class="fas fa-times-circle"></i></a></center>';
            }
                            
                    
        }   
                    
                  ],
                  "sDom": "B<'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-4'i>><'row'p>B",
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',     
                {
                    extend: 'colvis',
                    postfixButtons: [ 'colvisRestore' ],
                    columns: '0,1,2,3,4,5,6'
                }
            ],
                
                }); 
      }});
      }  