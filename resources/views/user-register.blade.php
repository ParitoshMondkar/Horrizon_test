<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">
    <title>User Registration</title>
</head>

<body>

<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">

        <div class="form-group">
            <p align="center">
                <h2 class="text-center"><strong>User Registration</strong></h2>
            </p>
        </div>

        
        <div id="div_error_alert" class="alert alert-danger alert-block" style="display:none">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong style="color:red;" id="strong_error_alert"></strong>
        </div>
        
        
        <form name="form_user_register" id="form_user_register">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Customer Name" name='name' id='name' autocomplete="off">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter Email" name='email' id='email' autocomplete="off">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter Mobile" name='mobile' id='mobile' autocomplete="off">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Enter Password" name='password' id='password' autocomplete="off">
            </div>
            <p align="center">
                <input type="button" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Register">
            </p>
        </form>
    </div>

    <div class="col-md-3"></div>

</div>

<div class="row">

    <div class="col-md-12"><p align="center"><a href="{{url('user-login')}}">Login</a></p></div>

</div>

</body>

<script src="{{url('js/jquery.min.js')}}"></script>
<script>
    $("#btn_submit").on('click',function(event){

        $("#div_error_alert").hide();
        $("#strong_error_alert").text('');

        event.preventDefault();
        var formdata = new FormData($("#form_user_register")[0]);

        $.ajax({
            type:"POST",
            url:"{{url('validate-user-register')}}",
            data : formdata,
            contentType : false,
            processData : false,
            success : function(response){
                var data = JSON.parse(response);

                if(data.status == "success"){
                    $("#div_error_alert").hide();
                    $("#strong_error_alert").text('');
                    alert("Registered Successfully");
                    window.location.href = "{{url('user-login')}}";
                }

                if(data.status == "error"){
                    $("#div_error_alert").show();
                    $("#strong_error_alert").text(data.msg);
                }
            }

        });
    });
</script>

</html>