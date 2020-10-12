 
@extends('layouts.app')

@section('content')
 <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">{{__('Categories')}}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{__('Categories')}}</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a type="button" class="btn btn-default text-white" data-toggle="modal" data-target="#addNew">{{__('Add')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">

      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">{{__('Category List')}}</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive py-4">
                 <table class="table table-flush" id="datatable-category">
                        <thead class="thead-light">
                            <tr>
                                <th width="100">#</th>
                                <th>{{__('Name')}}</th>
                                <th width="150">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                    
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th >{{__('Action')}}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                           
                    </tbody>
                 </table>           
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- modal create new -->
    <!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('Add New Category')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('categories.store') }}" method="POST" id="addCategory">
        @csrf
            <div class="form-group">
                <label class="form-control-label" for="input-city">{{__('Category')}}</label>
                <input type="text" id="input-city" class="form-control " name="category" placeholder="E.g. Groceries,Food">
                <span class="errors error-category text-danger text-sm"></span>
        
            </div>
      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
        </div>
    </div>
  </div>
</div>
@endsection
@push('javascript')
<script>
function format ( d ) {
// `d` is the original data object for the row
    return `<div class="row p-4 bg-secondary">
                <form method="POST"  class="update" id="category-update-${d.id}" >
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="exampleFormControlInput1">{{__('Category')}}</label>
                    <input type="text" name="category" class="form-control form-control-sm " value="${d.name}" id="exampleFormControlInput1" placeholder="{{__('category')}}">
                </div>
                <button type="button" class="btn btn-danger btn-sm " onclick="return updateCategory(${d.id})">{{__('Update')}}</button>
                </form>
            </div>`;

}
        
$(document).ready(function() {
    $('#addCategory .errors').html('')

    $('#addCategory').submit(function(e){
        e.preventDefault();
        $('#addCategory .errors').html('')
        data = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data:data,
            cache:false,
            success:function(response){
               
                    $.notify({
                        
                        icon: 'fas fa-check-circle',
                        message: `${response.success}`
                    });
                    $('#addNew').modal('hide')
                    
                    $("#datatable-category").DataTable().ajax.reload();
            },      
            error: function(response) {
                 var errors = response.responseJSON.errors;
         
                $.each( errors, function( key, value ) {
                     $('.error-'+key).html(value)
                
                });
                $.notify({
                    // options
                        icon: 'fas fa-times-circle',
                        message: `${response.responseJSON.message}`,
                },{
                    // settings
                    type: 'danger'
                });
            }

        });

    });
     
 

    var t_table =  $('#datatable-category').DataTable({
        language: {
            paginate: {
              next: '<i class="fas fa-angle-right"></i>',
              previous: '<i class="fas fa-angle-left"></i>'  
            }
        },
        processing: true,
        serverSide: true,
        "ajax":{
                 "url": "{{ url('account/api/categories') }}",
                 "type": "GET",
                 "dataType":"json",
                 "data":{ _token: "{{csrf_token()}}"}
            },
     

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
                return ` <form  action="{{url('account/categories')}}/${data}" method="POST" id="delteform-${data}">
                        <button class="btn btn-icon btn-primary btn-sm edit" type="button">
                            <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                        </button>
                        <button class="btn btn-icon btn-primary btn-sm delete" type="button" data-id="${data}">
                            <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                        </button>
                        @csrf
                        @method('DELETE')
                        </form>`;
              },
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
      $('#datatable-category tbody').on('click', 'td .edit', function () {
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
               // edit
          
  
        }

    } );


 
      // delete
    $('#datatable-category').on('click', '.delete', function () {
        u_id = $(this).data('id');
    
        $.ajax({
            url: $('.details-control #delteform-'+u_id).attr('action'),
            type: "POST",
            data:$('.details-control #delteform-'+u_id).serialize(),
            cache:false,
            success:function(response){
               $.notify({
                        icon: 'fas fa-trash',
                        message: `${response.success}`
                    });
                $("#datatable-category").DataTable().ajax.reload();
            }

     
        });    

  });
});
function updateCategory(u_id){
    // alert();
    $.ajax({
        url: '{{url("account/categories")}}/'+u_id+'update',
        type: "POST",
        data:$('#category-update-'+u_id).serialize(),
        cache:false,
        success:function(response){
           $.notify({
                    icon: 'fas fa-trash',
                    message: `${response.success}`
                });
            $("#datatable-category").DataTable().ajax.reload();
        }
    });   
}
</script>
<!--   @if($errors->has('category'))
    <script>
    $(function() {
        $('#addNew').modal({
            show: true
        });
    });

     // delete
    
    </script>
@endif -->


@endpush