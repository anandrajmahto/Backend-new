@extends('admin.layout.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<style>
    .material-icons{
        margin-top:0px !important;
        margin-bottom:0px !important;
    }
</style>
@section ('content')
<div class="container-fluid">
    
 <div class="row">
<div class="col-lg-12">
@if (session()->has('success'))
<div class="alert alert-success">
@if(is_array(session()->get('success')))
        <ul>
            @foreach (session()->get('success') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        @else
            {{ session()->get('success') }}
        @endif
    </div>
@endif
 @if (count($errors) > 0)
  @if($errors->any())
    <div class="alert alert-danger" role="alert">
      {{$errors->first()}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  @endif
@endif
</div>
<div class="col-lg-12"> 

     <a href="{{route('AddProduct')}}" class="btn btn-primary ml-auto" style="width:15%;float:right;padding: 3px 0px 3px 0px;"><i class="material-icons">add</i>Add Product</a>
</div> 
<div class="col-lg-12">
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title ">Products List</h4>
    </div>
<div class="container"><br>    
<table class="display" id="myTable">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Product Name</th>
            <th>Product id</th>
            <th>Category</th>
            <th>Product_image</th>
            <th>Hide</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
           @if(count($product)>0)
          @php $i=1; @endphp
          @foreach($product as $products)
        <tr>
            <td class="text-center">{{$i}}</td>
            <td>{{$products->product_name}}</td>
            <td>{{$products->product_id}}</td>
            <td> {{$products->title}}</td>
            <td><img src="{{url($products->product_image)}}" alt="image"  style="width:50px;height:50px; border-radius:50%"/></td>
            <td><input type="checkbox" data-id="{{ $products->product_id }}" name="status" class="js-switch" {{ $products->hide == 1 ? 'checked' : '' }}></td>
            <td class="td-actions text-right">
                <a href="{{route('EditProduct',$products->product_id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </a>
                <a href="{{route('varient',$products->product_id)}}" rel="tooltip" class="btn btn-primary">
                    <i class="material-icons">layers</i>
                </a>
                <a href="{{route('DeleteProduct',$products->product_id)}}" rel="tooltip" class="btn btn-danger">
                    <i class="material-icons">close</i>
                </a>
            </td>
        </tr>
          @php $i++; @endphp
                 @endforeach
                  @else
                    <tr>
                      <td>No data found</td>
                    </tr>
                  @endif
    </tbody>
</table>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div>
    </div>
     <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
    });
    </script>
<script>
    $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let product_id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route("hideprod") }}',
            data: {'status': status, 'product_id': product_id},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});
</script>
     
    @endsection
</div>