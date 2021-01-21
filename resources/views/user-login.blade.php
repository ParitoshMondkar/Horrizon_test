<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">
    <title>User Login</title>
</head>

<body>

<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">

        <div class="form-group">
            <p align="center">
                <h2 class="text-center"><strong>User Login</strong></h2>
            </p>
        </div>

        @if(Session::get('user_id') != null or Session::get('user_id') != '')
            <script>window.location="{{url('/user-dashboard')}}";</script>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{URL::to('check-login-user')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Email Id" name='email' id='email' autocomplete="off">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name='password' id='password'>
            </div>
            <p align="center">
                <button type="submit" class="btn btn-primary">Login</button>
            </p>
        </form>
           
    </div>

    <div class="col-md-3"></div>
</div>

<div class="row">

    <div class="col-md-12"><p align="center"><a href="{{url('user-register')}}">Register</a></p></div>

</div>

</body>

</html>