@extends('profile.index')
@section('tieude')
account information
@endsection
@section('noidung')
    <div class=" alert alert-info">

                 @if(session('msg'))
                <div class="alert alert-info">
                {{session('msg')}}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                </div>
                @endif

                     <h3> <span style='color:green'>{{ucwords(Auth::user()->name)}}</span> , information</span></h3>
                     {!! Form::open(['url' => 'updateAddress' , 'method' =>'post']) !!} 
                      
                        <div class="form-group row">
                          
                          <div class="form-group col-md-6">
                          <label for="example-text-input">Full name</label>
                            <input class="form-control" type="text" name="fullname" value="{{Auth::user()->name}}">
                             <span style="color:red">{{ $errors->first('fullname') }}</span>
                          </div>
                        </div>
                         <div class="form-group row">
                          
                          <div class="form-group col-md-6">
                          <label for="example-text-input">Email</label>
                            <input class="form-control" disabled type="text" name="email" value="{{Auth::user()->email}}">
                             
                          </div>
                        </div>
                         <div class="form-group row">
                          
                          <div class="form-group col-md-6">
                          <label for="example-text-input">Address </label>
                            <input class="form-control" type="text" name="diachi" value="{{Auth::user()->address}}">
                             <span style="color:red">{{ $errors->first('diachi') }}</span>
                          </div>
                        </div>
                         <div class="form-group row">
                          
                          <div class="form-group col-md-6">
                          <label for="example-text-input">Phone</label>
                            <input class="form-control" type="text" name="sdt" value="{{Auth::user()->phone}}">
                             <span style="color:red">{{ $errors->first('sdt') }}</span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="form-group col-md-6" align="right">
                            <input class="btn btn-primary" type="submit" value="Cập nhật" class="btn btn-primary">
                          </div>
                        </div>
                     {!! Form::close() !!} 
                     </div>
@endsection











