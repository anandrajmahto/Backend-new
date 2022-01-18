@extends('admin.layout.app')
<style>
/* The container */
.radicont {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.radicont input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.radio {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.radicont:hover input ~ .radio {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.radicont input:checked ~ .radio {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.radio:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.radicont input:checked ~ .radio:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.radicont .radio:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
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
                  <h4 class="card-title">map/location Setting</h4>
                  <b>@if($mset->mapbox == 1) Mapbox ON &nbsp;<span style="height: 12px;width: 12px;background-color: red;border-radius: 50%;display: inline-block;" class="dot"></span> @endif
                  @if($mset->google_map == 1) Google map On &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif </b>
                  
                 </div> 
    <br>
    <div class="container">
     <div class="form-group">    
      <div class="col-md-4" style="float:left">
            <label class="radicont"> 
                <input type="radio" name="colorRadio" 
                       value="mapbox" class="radio" @if($mset->mapbox == 1) checked @endif><span class="radio"></span>Mapbox</label>
        </div> 
        <div class="col-md-4" align="center" style="float:left">
            <label class="radicont"> 
                <input type="radio" name="colorRadio" 
                       value="google_map" class="radio" @if($mset->google_map == 1) checked @endif><span class="radio"></span> Google Map </label> 
              </div> 
        </div><br><br><hr>      

     <div class="col-md-12" style="float:left">
           <div id="dvPassport" style="display: none" class="mapbox selectt">
       
                  <form class="forms-sample" action="{{route('updatemapbox')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                <div class="card-body">
                     @if($m)
                     <div class="row">
                      
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mapbox API Key</label>
                          <input type="text" name="mapbox" value="{{($m->mapbox_api)}}" class="form-control">
                        </div>
                      </div>

                    </div>
                    @else
                     <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mapbox API Key</label>
                          <input type="text" name="mapbox" placeholder="mapbox api key" class="form-control">
                        </div>
                      </div>


                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary pull-center">ON MapBox</button>
                    <div class="clearfix"></div>
                  </form>
              </div>              
            </div>
             
        <div id="dv2Passport" style="display: none" class="google_map selectt">
           <form class="forms-sample" action="{{route('updatemap')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}      
                   @if($g)
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                           <label for="bmd-label-floating">Google map</label>
                        <input type="text" id="api" class="form-control" value="{{$g->map_api_key}}" name="api">
                        </div>
                      </div>
                    </div>
                    @else
                    <div class="row">
                     <div class="form-group">
                           <label for="bmd-label-floating">Google map</label>
                        <input type="text" id="api" class="form-control" placeholder="map api key" name="api">
                        </div>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary pull-center">ON Google Map</button>
                    <div class="clearfix"></div>
                    </form>
              </div> 
          
        </div>
              </div>
            </div>
			</div>
          </div>
          </div>
            <script type="text/javascript"> 
            $(document).ready(function() { 
                $('input[type="radio"]').click(function() { 
                    var inputValue = $(this).attr("value"); 
                    var targetBox = $("." + inputValue); 
                    $(".selectt").not(targetBox).hide(); 
                    $(targetBox).show(); 
                }); 
            }); 
        </script> 
    
<script type="text/javascript">
	var value = {{$mset->mapbox}};
	if(value=='1')
	{
		$('#dvPassport').show();
	}
	else
	{
		$('#dvPassport').hide();
	}
	
</script>
<script type="text/javascript">
	var value = {{$mset->google_map}};
	if(value=='1')
	{
		$('#dv2Passport').show();
	}
	else
	{
		$('#dv2Passport').hide();
	}
	
</script>
        
@endsection




