@extends('profile.index')
@section('tieude')
Change Password
@endsection
@section('noidung')

<div class=" alert alert-info">
    @if(session('msg'))
    <div class="alert alert-info">
        {{session('msg')}}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
    </div>
    @endif
    <h3> <span style='color:green'>{{ucwords(Auth::user()->name)}}</span> , Change Password</span></h3>
    {!! Form::open(['url' => 'updatePassword' , 'method' =>'post']) !!}


    <div class="form-group row">
        <div class="form-group col-md-6">
            <label for="example-text-input">old password</label>
            <input class="form-control" type="password" name="oldPassword">
            <span style="color:red">{{ $errors->first('oldPassword') }}</span>

            <br>

            <label for="example-text-input"> new passwordi</label>
            <input class="form-control" type="password" name="newPassword">
            <span style="color:red">{{ $errors->first('newPassword') }}</span>
            <br>
            <label for="example-text-input">Enter again the new password</label>
            <input class="form-control" type="password" name="rePassword">
            <span style="color:red">{{ $errors->first('rePassword') }}</span>
            <br>
            <div align="right"><input type="submit" value="Lưu" class="btn btn-primary"></div>
        </div>

    </div>
    {!! Form::close() !!}
</div>
@endsection