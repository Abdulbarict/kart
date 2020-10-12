 
@extends('layouts.app')

@section('content')
 <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">{{__('Users')}}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{__('Users')}}</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
  <!--             <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
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
              <h3 class="mb-0">{{__('Users List')}}</h3>
            </div>
            <!-- Light table -->
      
             

            <div class="table-responsive py-4">
                <table class="table table-flush" id="datatable-user">
                    <thead class="thead-light">
             
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th >Slug</th>
                        <th >Expiry</th>
                        <th >Action</th>
                      
                      </tr>
                
              
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                    <td>{{ $loop->index+1}}</td>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->username}}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->mobile}}</td>
                    <td><button type="button" id="btnActive_{{ $User->id }}" data-userid="{{ $User->id }}" data-username="{{ $User->slug }}" data-user_firtsname="{{ $User->name }}"  data-email="{{ $User->email }}" data-password="{{ $User->password }}" class="activeApp  {{ $User->active_app ? 'btn btn-success' : 'btn btn-dark'}}"  > {{ $User->active_app ? 'Actived' : 'Active App'}} </button></td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th >Slug</th>
                          <th >Expiry</th>
                          <th >Action</th>
                        </tr>
                    </tfoot>
                   
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@push('javascript')
<script>
 

    $('#datatable-user').DataTable({
        language: {
            paginate: {
              next: '<i class="fas fa-angle-right"></i>',
              previous: '<i class="fas fa-angle-left"></i>'  
            }
        }
    });

    $('.activeApp').click(function() {

      if($(this).hasClass("btn-success"))
      {
           return;
      }
      
      var user_id=  $(this).attr('data-userid');

      var user_name=  $(this).attr('data-username');
     
      var email=  $(this).attr('data-email');
      var password=  $(this).attr('data-password');
      var name=  $(this).attr('data-user_firtsname');
      var picture= "";
  
      var data = {
                      id       : user_id,
                   
                     email          :email,
                     password       :password,
                     first_name:name,
                     last_name      :user_name,
                     picture      :picture
                 }
                 var UpdateData = {
                      id       : user_id,
                      _token      : "{{ csrf_token() }}",
                   
                   
                 }

                //alert(data); 
               // console.log(JSON.stringify(data));
        $.ajax({
          type:  "POST",
          dataType:  "json",
         url: "https://w.featurefast.com/api/person/person.php",
         data:JSON.stringify(data) ,
         success: function(res) {
         // alert(JSON.stringify(res));
             if(res.response=='DONE')
            {
               updateUser(UpdateData);
              $('#btnActive_'+user_id).removeClass("btn-dark").addClass("btn-success");
              $('#btnActive_'+user_id).text("Actived");


            } 
            else
             alert(res.response);
          
             //alert(JSON.stringify(res.success));
         },
         error: function(e) {

             console.log(e);
             alert("Something went wrong!!");
         }
     });
                 

    });
  function updateUser(dataUpdate) {
  $.ajax({
    method: "POST",
    url: "{{ url('account/api/users') }}",
    data: dataUpdate
  
  ,success: function(res) {
    alert(res.success);
    
  
  },
  
         error: function(e) {

             console.log(e);
             alert("Something went wrong!!");
         }
});
}
  
</script>
@endpush
