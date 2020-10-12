 
@extends('layouts.app')

@section('content')
 <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">{{__('Products')}}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{__('Products')}}</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{route('products.create')}}" class="btn btn-default text-white">New</a>
              <a href="#" class="btn btn-default text-white">Filters</a>
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
              <h3 class="mb-0">{{__('Product List')}}</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
                <table class="table table-flush" id="datatable-product">
                    <thead class="thead-light">
                        <tr>
                            <th>Photo</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Disc.Price</th>
                            <th>Position</th>
                            <th>Action</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                       
           @foreach($products as $product)
          <tr>
          <td> <a href="#!" class="avatar avatar-xl rounded-circle">
    <img alt="Image placeholder" src="{{ $product->image }}">
</a></td>
           
            <td>{{ $product->sku }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->Category }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->discount_price }}</td>
            <td>{{ $product->Position }}</td>
            
            <td> <a href="{{route('products.edit',$product->id)}}" class="btn btn-icon btn-primary btn-sm edit" role="button">
                            <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                        </a>
                        <a class="btn btn-icon btn-primary btn-sm delete" role="button">
                            <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                        </a></td>
           
          </tr>
          @endforeach
                       </tbody>
                    <tfoot>
                        <tr>
                           <th>Photo</th>
                           <th>SKU</th>
                           <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Disc.Price</th>
                            <th>Position</th>
                            <th>Action</th>
                            
                        </tr>
                    </tfoot>
                  
                </table>
            </div>
            <!-- Card footer -->
  <!--           <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div> -->
          </div>
        </div>
      </div>
    </div>

@endsection

@push('javascript')
<script>
 

    $('#datatable-product').DataTable({
        language: {
            paginate: {
              next: '<i class="fas fa-angle-right"></i>',
              previous: '<i class="fas fa-angle-left"></i>'  
            }
        }
    });
  
</script>
 <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endpush
