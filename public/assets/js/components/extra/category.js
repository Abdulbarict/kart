// category js


   $(document).ready(function() {

    function format ( d ) {
    // `d` is the original data object for the row
        return `<div class="row p-4 bg-secondary">
                    <form method="POST" id="category-form">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">{{__('Category')}}</label>
                        <input type="text" class="form-control form-control-sm " value="${d.name}" id="exampleFormControlInput1" placeholder="{{__('category')}}">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" >{{__('Update')}}</button>
                    </form>
                </div>`;

    }

    var t_table =  $('#datatable-buttons').DataTable({
        language: {
            paginate: {
              next: '<i class="fas fa-angle-right"></i>',
              previous: '<i class="fas fa-angle-left"></i>'  
            }
        },
        processing: true,
        serverSide: true,
        "ajax":{
                 "url": "{{ url('admin/api/categories') }}",
                 "type": "GET",
                 "data":{ _token: "{{csrf_token()}}"}
            },
        ajax: "{{ url('admin/api/categories') }}",

        columns: [
            {
              data:null,
              "searchable": false,
              "orderable": false,
              "targets": 0
            },
            { data: 'name' },
            {
              "data":'id',
              "className":'details-control',
              "searchable": false,
              "orderable": false,
              render:function(data, type, row){
                return ` <form  data-id="${data}" method="POST">
                        <button class="btn btn-icon btn-primary btn-sm edit" type="button">
                            <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                        </button>
                        <button class="btn btn-icon btn-primary btn-sm" type="button" onclick="deleteData()">
                            <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                        </button>
                        @csrf
                        @method('DELETE')
                        </form>`;
              }
            }
          ],
     
          order: [[1, 'asc']] /// sort columns 2

      });  
      t_table.on( 'order.dt search.dt', function () {
            t_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();



     // edit expand
      $('#datatable-buttons tbody').on('click', 'td .edit', function () {
        var tr = $(this).closest('tr');
        var row = t_table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');

   
        }
    } );
     
       

        
     
    });    

  

