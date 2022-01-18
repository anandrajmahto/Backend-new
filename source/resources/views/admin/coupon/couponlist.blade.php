@extends('admin.layout.app')
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
     <a href="{{route('coupon')}}" class="btn btn-primary ml-auto" style="width:10%;float:right;padding: 3px 0px 3px 0px;"><i class="material-icons">add</i>Add Coupon</a>
</div> 
<div class="col-lg-12">
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title ">Coupon List</h4>
    </div>
<div class="container"><br>
<table class="display" id="myTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Coupon Name</th>
            <th>Discount Value</th>
            <th>Amount Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Uses Limit Per User</th>
            <th>Cart Value</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
           @if(count($coupon)>0)
          @php $i=1; @endphp
          @foreach($coupon as $cities)
        <tr>
            <td class="text-center">{{$i}}</td>
            <td>{{$cities->coupon_name}}</td>
            <td>{{$cities->amount}}</td>
            <td>{{$cities->type}}</td>
            <td>{{$cities->start_date}}</td>
            <td>{{$cities->end_date}}</td>
            <td>{{$cities->uses_restriction}}</td>
            <td>{{$cities->cart_value}}</td>

            <td class="td-actions text-center">
                <a href="{{route('editcoupon',$cities->coupon_id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </a>
               <a href="{{route('deletecoupon',$cities->coupon_id)}}" rel="tooltip" class="btn btn-danger">
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
    @endsection
</div>