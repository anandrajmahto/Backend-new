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
     <a href="{{route('AddD_boy')}}" class="btn btn-primary ml-auto" style="width:15%;float:right;padding: 3px 0px 3px 0px;"><i class="material-icons">add</i>Add Delivery Boy</a>
</div> 
<div class="col-lg-12">
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title" style="width:50%;float:left;">Delivery Boy List</h4>
    </div>
    
<div class="container"><br> 
<table class="display" id="myTable">
    <thead>
        <tr>
            <th> # </th>
            <th>Boy Name</th>
            <th>Boy Phone</th>
            <th>Boy Password</th>
            <th>Status</th>
            <th>Wallet Balance</th>
            <th>Orders</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
           @if(count($d_boy)>0)
          @php $i=1; @endphp
          @foreach($d_boy as $d_boys)
        <tr>
            <td class="text-center">{{$i}}</td>
            <td>{{$d_boys->boy_name}}</td>
           
            <td>{{$d_boys->boy_phone}}</td>
       
            <td>{{$d_boys->password}}</td>
            
            @if($d_boys->status == 1)
            <td><p style="color:green">on duty</p></td>
            @else
            <td><p style="color:red">off duty</p></td>
            @endif
            <td>{{$d_boys->wallet}}</td>
            <td><a href="{{route('admin_dboy_orders',$d_boys->dboy_id)}}" rel="tooltip" class="btn btn-primary">
                    <i class="material-icons">layers</i></td>
            <td class="td-actions text-right">
                <a href="{{route('EditD_boy',$d_boys->dboy_id)}}" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </a>
               <a href="{{route('DeleteD_boy',$d_boys->dboy_id)}}" rel="tooltip" class="btn btn-danger">
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