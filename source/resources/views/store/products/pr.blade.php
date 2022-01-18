@extends('store.layout.app')
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
             <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Update Stock</h4>
                 </div>
                     <div class="container"> <br> 
                        <table class="display" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Product Name</th>
                                <th>Id</th>
                                <th class="text-center">Current Stock</th>
                                <th class="text-center">Add Stock</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                             
                              @if(count($selected)>0)
                      @php $i=1; @endphp
                      @foreach($selected as $sel)
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td><p>{{$sel->product_name}}({{$sel->quantity}} {{$sel->unit}})</p></td>
                        <td><b>{{$sel->p_id}}</b></td>
                        <td>{{$sel->stock}}</td>
                        <td>
                            
                         <form class="forms-sample" action="{{route('stock_update', $sel->p_id)}}" method="post" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="col-md-12">
                          <div class="col-md-8" style="float:left">
                             <div class="form-group">
                              <label class="bmd-label-floating">stock</label>
                              <input type="number" name="stock" class="form-control" value="0">
                            </div>
                          </div>
                          <div class="col-md-4" style="float:left;margin-left: -20px;">
                          <button type="submit" style="border:none;background-color:transparent;float:left;width: 40px !important;height: 40px;border-radius: 50%;"><img style="float:left;width: 40px !important;height: 40px;border-radius: 50%;" src="{{url('images/icon/add.png')}}" alt="add"/></button>
                            </div>
                          </form>
                          </div>
                        </td>
                        <td class="td-actions text-right">
                           <a href="{{route('delete_product', $sel->p_id)}}" rel="tooltip" class="btn btn-danger">
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
          </div>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
@endsection




