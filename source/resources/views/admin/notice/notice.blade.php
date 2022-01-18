@extends('admin.layout.app')

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
                  <h4 class="card-title">Notification</h4>
                  <form class="forms-sample" action="{{route('app_noticeupdate')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                </div>
                <div class="card-body">
                     <div class="row">
                       
                      <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-6" style="float:left">
                           <input type="radio" id="male" name="status" value="1" @if($notice->status == 1) checked @endif>
                              <label for="On">Active</label>
                              </div>
                              <div class="col-md-6" style="float:left">
                              <input type="radio" id="female" name="status" value="0" @if($notice->status == 0) checked @endif>
                              <label for="Off">Deactive</label><br>
                              </div> 
                        </div>
                      </div><br><br>
                       <div class="col-md-12">
                        <div class="form-group">
                          <label>Notice</label>
                          <textarea name="notice" class="form-control">@if($notice) {{$notice->notice}} @endif</textarea>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-center">Update Notice</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
			</div>
          </div>
@endsection