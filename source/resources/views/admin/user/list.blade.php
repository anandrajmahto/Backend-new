@extends('admin.layout.app')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

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
<div class="card">    
<div class="card-header card-header-primary">
      <h4 class="card-title ">App Users</h4>
    </div>
<div class="container"> <br> 
<table class="display" id="myTable">
    <thead>
        <tr>
            <th>#</th>
            <th>User_name</th>
            <th>User Phone</th>
            <th>User Email</th>
            <th>Registeration Date</th>
            <th>Is Verified</th>
            <th>Active/Block/Delete</th>
        </tr>
    </thead>
    <tbody>
           @if(count($users)>0)
          @php $i=1; @endphp
          @foreach($users as $user)
        <tr>
            <td class="text-center">{{$i}}</td>
            <td>{{$user->user_name}}</td>
            <td>{{$user->user_phone}}</td>
            <td>{{$user->user_email}}</td>
            <td>{{$user->reg_date}}</td>
            @if($user->is_verified==0)
            <td style="color:red">Not Verified</td>
            @else
            <td style="color:green">Verified</td>
            @endif
            
               
            <td class="td-actions text-right">
                 @if($user->block==1)
               <a href="{{route('userunblock',$user->user_id)}}" rel="tooltip" class="btn btn-danger">
                    <i class="material-icons">block</i>Blocked
                </a>
                @else
                <a href="{{route('userblock',$user->user_id)}}" rel="tooltip" class="btn btn-primary">
                    <i class="material-icons">check</i>Active
                </a>
                @endif
                 <a href="{{route('del_userfromlist',$user->user_id)}}" rel="tooltip" onclick="return confirm('Are You sure! It will remove all the addresses & orders related to this User.')" class="btn btn-danger">
                    <i class="material-icons">delete_forever</i>Delete
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