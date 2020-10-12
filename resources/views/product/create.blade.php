@extends('layouts.app')

@section('content')
 <!-- Header -->
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
                  <li class="breadcrumb-item active" aria-current="page">{{__('Create')}}</li>
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
              <form method="POST" id="productForm" action="{{route('products.store')}}" enctype="multipart/form-data">
              @csrf
                <h6 class="heading-small text-muted mb-4">{{__('Product informations')}}</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-name">Product</label>
                        <input type="text" id="input-name" required class="form-control" name="product" placeholder="{{__('Product')}}" >
                        @if ($errors->has('product'))
                            <span class="text-danger">{{ $errors->first('product') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-sku">{{__('SKU')}}</label>
                        <input type="text" id="input-sku" required name="sku" class="form-control" placeholder="{{__('SKU')}}" >
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
                        <input type="text" id="input-price" required name="price" class="form-control" placeholder="{{__('Price')}}" >
                         @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-discount">{{__('Discount Price')}}<small class="text-muted"> ({{__('Optional')}})</small></label>
                        <input type="text" id="input-discount"  name='discount' class="form-control" placeholder="{{__('Discount Price')}}" >
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
                        <input type="number" id="input-position"  name='position' class="form-control" placeholder="{{__('Position')}}" >
                         @if ($errors->has('position'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-status">{{__('Status')}}</label>
                        
                        <select class="form-control select2"   name="status" data-toggle="select" title="Simple select" data-placeholder="Select a state">
                        <option value="1" selected>Available</option>
                        <option value="0" >Not available</option>
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
                      <div class="custom-file">
                      
                        <input type="file" id="input-image" required name="image" class="custom-file-input" placeholder="{{__('Product Image')}}" >
                        <label class="custom-file-label" for="input-image">{{__('')}}</label>
                           @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-category">{{__('Category')}}</label>
                       <select class="form-control select2"  name="category" data-toggle="select" title="Simple select" data-placeholder="Select a state">
                        <option disabled="" selected>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            
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
                          <input class="btn btn-primary" id="usetype" value="1" name="usetype" type="checkbox" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                          </input>
                         
                          <span class="custom-toggle-slider rounded-circle" data-label-off="" data-label-on=""></span>
                       </label>
                       
                       <input id='usetypeHidden' type='hidden' value='0' name='usetype'>
                       <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                        <input type="text" id="input-type"  name='type_name' class="form-control" placeholder="{{__('Varient List Title')}}" >
                         @if ($errors->has('position'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif

                        <div class="table-responsive py-4">
                        <table class="table" id="types" name="types">  

<tr>

    <th>Name</th>

    <th>Price</th>

    <th>Disc.Price</th>

    <th><button type="button" name="add" id="add" class="btn btn-success">Add New</button></th>

</tr>

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

                        <button type="submit" class="btn btn-primary ">{{__('Save')}}</button>
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
   // alert(this.value);
}).change();


</script>

@endpush