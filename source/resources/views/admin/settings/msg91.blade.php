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
                  <h4 class="card-title">Message/OTP Setting</h4>
                  <b>@if($smsby->status == 0 && $smsby->twilio == 0 && $smsby->msg91 == 0) OTP/SMS OFF &nbsp;<span style="height: 12px;width: 12px;background-color: red;border-radius: 50%;display: inline-block;" class="dot"></span> @endif
                  @if($smsby->status == 1 && $smsby->twilio == 1 && $smsby->msg91 == 0) Twilio is On &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif 
                  @if($smsby->status == 1 && $smsby->twilio == 0 && $smsby->msg91 == 1) Msg91 is On &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif</b>
                  
                 </div> <br>
    <div class="container">
     <div class="form-group"> 
     <div> 
     <div class="col-md-4" style="float:left">
            <label class="radicont"> 
                <input type="radio" name="colorRadio" 
                       value="msg91" class="radio" @if($smsby->status == 1 && $smsby->twilio == 0 && $smsby->msg91 == 1) checked @endif> <span class="radio"></span>Msg91</label>
        </div> 
        <div class="col-md-4" style="float:left">
            <label class="radicont"> 
                <input type="radio" name="colorRadio" 
                       value="twilio" class="radio" @if($smsby->status == 1 && $smsby->twilio == 1 && $smsby->msg91 == 0) checked @endif> <span class="radio"></span> Twilio </label> 
              </div> 
        <div class="col-md-4" style="float:left">      
            <label class="radicont"> 
                <input type="radio" name="colorRadio" 
                       value="msgoff" class="radio" @if($smsby->status == 0 && $smsby->twilio == 0 && $smsby->msg91 == 0) checked @endif> <span class="radio"></span> Off </label> 
            </div>            
        </div> 
     


    </div>  <br><br> <hr>   
           <div id="dvPassport" style="display: none" class="msg91 selectt">
       
                  <form class="forms-sample" action="{{route('updatemsg91')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                <div class="card-body">
                     @if($msg91)
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sender ID</label>
                          <input type="text" name="sender_id" value="{{($msg91->sender_id)}}" class="form-control">
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Msg91 API Key</label>
                          <input type="text" name="api" value="{{($msg91->api_key)}}" class="form-control">
                        </div>
                      </div>

                    </div>
                    @else
                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sender ID</label>
                          <input type="text" name="sender_id" placeholder="Insert Sender Id Of Six Letters Only" class="form-control" required>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Msg91 API Key</label>
                          <input type="text" name="api" placeholder="Msg91 API Key" class="form-control" required>
                        </div>
                      </div>

                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary pull-center">ON Msg91</button>
                    <div class="clearfix"></div>
                  </form>
              </div>              
            </div>
             
        <div id="dv2Passport" style="display: none" class="twilio selectt">
           <form class="forms-sample" action="{{route('updatetwilio')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}      
                   @if($twilio)
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                           <label for="bmd-label-floating">Twilio SID</label>
                        <input type="text" id="sid" class="form-control" value="{{$twilio->twilio_sid}}" name="sid">
                        </div>
                      </div>
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="bmd-label-floating">Twilio Token</label>
                        <input type="text" id="token" class="form-control" value="{{$twilio->twilio_token}}" name="token">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                         <label for="bmd-label-floating">Twilio Phone</label>
                        <input type="text" id="phone" class="form-control" value="{{$twilio->twilio_phone}}" name="phone">
                        </div>
                      </div>
                    </div>
                    @else
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                         <label for="bmd-label-floating">Twilio SID</label>
                        <input type="text" id="sid" class="form-control" placeholder="Twilio SID" name="sid" required>
                        </div>
                      </div>
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="bmd-label-floating">Twilio Token</label>
                        <input type="text" id="token" class="form-control" placeholder="Twilio Token" name="token" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                         <label for="bmd-label-floating">Twilio Phone</label>
                        <input type="text" id="phone" class="form-control" placeholder="Twilio Phone" name="phone" required>
                        </div>
                      </div>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary pull-center">ON Twilio</button>
                    <div class="clearfix"></div>
                    </form>
              </div> 
          
            <div id="dv3Passport" style="display: none" class="msgoff selectt">
             <form class="forms-sample" action="{{route('msgoff')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}} 
             <button type="submit" class="btn btn-primary pull-center">Otp/SMS OFF</button>
            <div class="clearfix"></div>
            </form>
             </div> 
              </div>
            </div>
            
                
                <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Firebase for OTP</h4>
                </div>
                <div class="card-body">
 
                     <div class="row">
                     <div class="col-md-12">
                    <label>Firebase for OTP : &nbsp;</label>     
                    <input align="center" type="checkbox" name="status" class="js-switch" {{ $firebase->status == 1 ? 'checked' : '' }}> {{ $firebase->status == 1 ? 'Active' : 'Deactive' }}
                    </div>
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
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route("updatefirebase") }}',
            data: {'status': status},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});
</script> 
          
          
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
	var value = {{$smsby->twilio}};
	var status = {{$smsby->status}};
	if(value=='1' && status == '1')
	{
		$('#dv2Passport').show();
	}
	else
	{
		$('#dv2Passport').hide();
	}
	
</script>
<script type="text/javascript">
	var value = {{$smsby->msg91}};
	var status = {{$smsby->status}};
	if(value=='1' && status == '1')
	{
		$('#dvPassport').show();
	}
	else
	{
		$('#dvPassport').hide();
	}
	
</script>

<script type="text/javascript">
	var value = {{$smsby->msg91}};
	var twilio = {{$smsby->twilio}};
	var status = {{$smsby->status}};
	if(value=='0' && status == '0' && twilio == '0')
	{
		$('#dv3Passport').show();
	}
	else
	{
		$('#dv3Passport').hide();
	}
	
</script>
   
@endsection




