@extends('layouts.app')

@section('content')
<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">{{__('Product')}}</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{__('Edit')}}</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">{{__('Create Product')}}</h3>
            </div>
              <div class="card-body">
              <form method="POST" id="productForm" action="{{route('products.update',$products->id)}}" enctype="multipart/form-data">
              @method('PATCH') 
              @csrf
                <h6 class="heading-small text-muted mb-4">{{__('Product informations')}}</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-name">Product</label>
                        <input type="text" id="input-name" value="{{ $products->name }}"   class="form-control" name="product" placeholder="{{__('Product')}}" >
                        @if ($errors->has('product'))
                            <span class="text-danger">{{ $errors->first('product') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-sku">{{__('SKU')}}</label>
                        <input type="text" id="input-sku" value="{{ $products->sku }}" name="sku" class="form-control" placeholder="{{__('SKU')}}" >
                         @if ($errors->has('sku'))
                            <span class="text-danger">{{ $errors->first('sku') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-price">{{__('Price')}}</label>
                        <input type="text" id="input-price" value="{{ $products->price }}" name="price" class="form-control" placeholder="{{__('Price')}}" >
                         @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-discount">{{__('Discount Price')}}<small class="text-muted"> ({{__('Optional')}})</small></label>
                        <input type="text" id="input-discount" value="{{ $products->discount_price }}" name='discount' class="form-control" placeholder="{{__('Discount Price')}}" >
                         @if ($errors->has('discount'))
                            <span class="text-danger">{{ $errors->first('discount') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-position">{{__('Position')}}</label>
                        <input type="number" id="input-position" value="{{ $products->postion }}" name='position' class="form-control" placeholder="{{__('Position')}}" >
                         @if ($errors->has('position'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-status">{{__('Status')}}</label>
                        
                        <select class="form-control"  name="status"  title="Simple select" data-placeholder="Select a state">
                        <option value="1"   {{$products->status=="1"?'selected':''}}>Available</option>
                        <option value="0"  {{$products->status=="0"?'selected':''}} >Not available</option>
                      </select> 
                         @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        </div>
                    </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                     <label class="form-control-label" for="input-category">{{__('Picture')}}</label>
                     <div class="form-group">
    @if ("{{ $products->image }}")
    <a href="#!" class="avatar avatar-xl rounded-circle">
        <img id="imgshow" src="{{ $products->image }}">
        </a>
    @else
            <p>No image found</p>
    @endif
        image <input type="file" name="image" id="imagefile" data-default-file ="{{ $products->image}}"/>
    </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-category">{{__('Category')}}</label>
                       <select class="form-control select2"  name="category" data-toggle="select" title="Simple select" data-placeholder="Select a state">
                        <option disabled="" selected>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ ( $products->category_id == $category->id ) ? 'selected' : '' }} >{{$category->name}}</option>
                            
                        @endforeach
                      </select> 
                        @if ($errors->has('category'))
                            <span class="text-danger">{{ $errors->first('category') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                    <label class="form-control-label">{{__('Product Varient')}}</label>
                      <div class="form-group">
                       
                      <label class="custom-toggle">
                          <input class="btn btn-primary"  id="usetype" value="{{$products->use_type}}" name="usetype"  type="checkbox"  {{$products->use_type=="1"?'checked':''}} data-toggle="collapse" data-target="#collapseExample"  aria-expanded="{{$products->use_type=="1"?'true':'false'}}" aria-controls="collapseExample">
                          </input>
                         
                          <span class="custom-toggle-slider rounded-circle" data-label-off="" data-label-on=""></span>
                       </label>
                       
                       <input id='usetypeHidden' type='hidden' value='0' name='usetype'>
                       <div class="{{$products->use_type=="1"?"collapse show":"collapse"}} " id="collapseExample">
                        <div class="card card-body">
                        <input type="text" id="input-type"  value="{{$products->type_name}}" name='type_name' class="form-control" placeholder="{{__('Varient List Title')}}" >
                         @if ($errors->has('type_name'))
                            <span class="text-danger">{{ $errors->first('type_name') }}</span>
                        @endif
                        <div class="table-responsive py-4">
                        <table class="table" id="types" name="types">  

                           <tr>

                           <th>Name</th>

                           <th>Price</th>

                          <th>Disc.Price</th>

                           <th><button type="button" name="add" id="add" class="btn btn-success">Add New</button></th>

                          </tr>
                          @if(!is_null( $products['types']))
                         @foreach( $products['types'] as $type)

                        
                         <tr>
                         <td> <input type="text" id="name"  name="types[{{  $loop->index}}][name]" value="{{ $type['name'] }}" class="form-control" /></td>
                         <td> <input type="text" id="price" type="number"  name="types[{{  $loop->index}}][price]" value="{{ $type['price'] }}" class="form-control" /></td>
                         <td> <input type="text" id="disc" type="number"  name="types[{{  $loop->index}}][disc]" value="{{ $type['disc'] }}" class="form-control" /></td>
                         </td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
                         </tr>
                         
                        @endforeach
                        @endif

                        </table> 
                       </div>
                         </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                      <div class="col-lg-12">
                        <a href="{{route('products.index')}}" type="button" class="btn btn-danger text-white"><span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>{{__('Back')}}</a>

                        <button type="submit" class="btn btn-primary ">{{__('Update')}}</button>
                      </div>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('javascript')
<script type="text/javascript">

$('document').ready(function () {
    $("#imagefile").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});


var i = 0;

       

$("#add").click(function(){

// alert("dsdasd");
if($("#types td").closest("tr").length==0)
{
 i=0;
}
else
{
    i=$("#types td").closest("tr").length;
}

    $("#types").append('<tr><td><input type="text" id="name" name="types['+i+'][name]" placeholder="Enter  Name" class="form-control" /></td><td><input type="number" id="price" name="types['+i+'][price]" placeholder="Enter  Price" class="form-control" /></td><td><input type="number" id="disc" name="types['+i+'][disc]" placeholder="Enter  Disc.Price" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
 
});



$(document).on('click', '.remove-tr', function(){  

     $(this).parents('tr').remove();
     var i=0;
    var j = 1;
    // $('tr td input[type="text"]').each(function(index){
     $('tr td input').each(function(index){
    var id = $(this).attr('id');
    
    if(id == 'name')
    {
      $(this).attr('name','types['+i+'][name]')
      
    }else if(id == 'price')
    {
      $(this).attr('name','types['+i+'][price]')
    }
    else if(id == 'disc')
    {
      $(this).attr('name','types['+i+'][disc]')
    }

    if(j == 3)
    {
      j = 1;
      i++;
    }else{
        j++;
    }

  })
});  

$('#productForm').submit(function() {
    // DO STUFF...
    //alert("Block");
   // return false; // return false to cancel form action
   if(document.getElementById("usetype").checked) {
    
    document.getElementById('usetypeHidden').disabled = true;
     }

});


$('#usetype').on('change', function(){
   this.value = this.checked ? 1: 0;
   
}).change();



</script>

@endpush