<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">Forgot password</div>

            @if(session('status'))

            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            {!! Form::open(['url' =>'password/email' , 'method' =>"POST"])!!}

            {{ Form::label('email' , 'Email address:')}}
            {{ Form::email('email', null, ['class' =>'form-control'])}}

            {{ Form::submit('Get password' , ['class' =>'btn btn-primary'])}}

            {{ Form::close() }}
        </div>
    </div>
</div>