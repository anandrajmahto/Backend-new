@extends('admin.layout.app')
<style>
    .col-md-6{

        float:left !important;

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
                  <h4 class="card-title">FCM Server Key</h4>
                  <form class="forms-sample" action="{{route('updatefcm')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                     <div class="row">
                       <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">User App FCM Server Key</label>
                          <input type="text" name="fcm" value="{{($fcm->server_key)}}" class="form-control">
                        </div>
                      </div>

                    </div>
                    <div class="row">
                       <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Store App FCM Server Key</label>
                          <input type="text" name="fcm2" value="{{($fcm->store_server_key)}}" class="form-control">
                        </div>
                      </div>

                    </div>
                    <div class="row">
                       <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Driver App FCM Server Key</label>
                          <input type="text" name="fcm3" value="{{($fcm->driver_server_key)}}" class="form-control">
                        </div>
                      </div>

                    </div>
                    <button type="submit" class="btn btn-primary pull-center">UPDATE</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
                <div class="card col-md-6 col-sm-12">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Time Slot</h4>
                  <form class="forms-sample" action="{{route('timeslotupdate')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                  <form>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Open Hours</label>
                         
                          <input type="time" name="open_hrs" value="{{$city->open_hour}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Close Hours</label>
                          <input type="time" name="close_hrs" value="{{$city->close_hour}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Interval (Min)</label>
                          <input type="number" name="interval" value="{{$city->time_slot}}" class="form-control">
                        </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-center">UPDATE</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
               <div class="card col-md-6 col-sm-12">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Delivery Charge Setting</h4>
                  <form class="forms-sample" action="{{route('updatedel_charge')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                     <div class="row">
                       <div class="col-md-5">
                        <div class="form-group">
                          <label>Free delivery cart value(Min)</label>
                          <input type="text" name="min_cart_value" value="{{($del_charge->min_cart_value)}}" class="form-control">
                        </div>
                      </div>
                       <div class="col-md-5">
                        <div class="form-group">
                          <label>Delivery Charge</label>
                          <input type="text" name="del_charge" value="{{($del_charge->del_charge)}}" class="form-control">
                        </div>
                      </div>
                        <div class="col-md-5">
                        <div class="form-group">
                          <label>Delivery Credit Limit</label>
                          <input type="text" name="credit_limit" value="{{($del_charge->credit_limit)}}" class="form-control">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-center">UPDATE</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div><br><br><br><br></div>
               <div class="col-md-12">
              <div class="card col-md-6 col-sm-12">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Payment Method Setting</h4>
                  <b>@if($pymnt->razorpay == 1 && $pymnt->paypal == 0 && $pymnt->paystack == 0) Razorpay is ON &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif
                  @if($pymnt->razorpay == 0 && $pymnt->paypal == 1 && $pymnt->paystack == 0) Paypal is ON &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif 
                   @if($pymnt->razorpay == 0 && $pymnt->paypal == 0 && $pymnt->paystack == 1) Paystack is ON &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif 
                    @if($pymnt->razorpay == 1 && $pymnt->paypal == 1 && $pymnt->paystack == 0)Razorpay and Paypal is ON &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif 
                     @if($pymnt->razorpay == 1 && $pymnt->paypal == 0 && $pymnt->paystack == 1) Razorpay and Paystack is ON &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif 
                     @if($pymnt->razorpay == 0 && $pymnt->paypal == 1 && $pymnt->paystack == 1) Paypal and Paystack is ON &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif 
                  @if($pymnt->razorpay == 1 && $pymnt->paypal == 1 && $pymnt->paystack == 1) Razorpay, Paystack and Paypal all are ON &nbsp;<span style="height: 12px;width: 12px;background-color: green;border-radius: 50%;display: inline-block;" class="dot"></span> @endif</b>
                  
                 </div> 
                <div class="container">
            <form action="{{route('updategateway')}}" method="POST">     
            {{csrf_field()}}
                 <div class="form-group">    
                <span>Select Your Payment Method</span>
                <select id="ddlPassport" class="form-control" name="pymnt_via">
                    <option disabled selected>Select Your Payment Method <i class="material_icons">setting</i></option>
                    <option value="razor" @if($pymnt->razorpay == 1 && $pymnt->paypal == 0 && $pymnt->paystack == 0)selected @endif>Razorpay</option>
                    <option value="paypal" @if($pymnt->razorpay == 0 && $pymnt->paypal == 1 && $pymnt->paystack == 0)selected @endif>Paypal</option>
                     <option value="paystack" @if($pymnt->razorpay == 0 && $pymnt->paypal == 0 && $pymnt->paystack == 1)selected @endif>Paystack</option>
                   
                    <option value="razorpaypal" @if($pymnt->razorpay == 1 && $pymnt->paypal == 1 && $pymnt->paystack == 0)selected @endif>Razorpay and Paypal</option>
                   
                    <option value="paystackpaypal" @if($pymnt->razorpay == 0 && $pymnt->paypal == 1 && $pymnt->paystack == 1)selected @endif>Paystack and Paypal</option>
                    <option value="paystackrazor" @if($pymnt->razorpay == 1 && $pymnt->paypal == 0 && $pymnt->paystack == 1)selected @endif>Razorpay and Paystack</option>
                    <option value="all" @if($pymnt->razorpay == 1 && $pymnt->paypal == 1 && $pymnt->paystack == 1) selected @endif>All</option>
                </select>
                </div>
                 <button type="submit" class="btn btn-primary pull-center">UPDATE</button>
                <br><br>
            </form> 
              </div>
            </div>
               <div class="card col-md-6 col-sm-12">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Order Value</h4>
                  <p>Set minimum and maximum cart value</p>
                  <form class="forms-sample" action="{{route('amountupdate')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                  <form>

                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Minimum Value</label>
                          
                          <input type="text"name="min_value" value="{{$minmax->min_value}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-5" style=>
                        <div class="form-group">
                          <label class="bmd-label-floating">Maximum Value</label>
                          <input type="text"name="max_value" value="{{$minmax->max_value}}" class="form-control">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-center">UPDATE</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
                 <div class="card-body">
                 
                </div>
              </div>
            </div>
			</div>
          </div>
@endsection