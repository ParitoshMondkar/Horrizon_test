<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>

<body>

<div class="row">

    <div class="col-md-12">
        
        <ul>
            <li><a href="{{url('add-categories')}}">Add Categories</a></li>
            <li><a href="{{url('add-products')}}">Add Products</a></li>
            <li><a href="{{url('order-list')}}">Orders List</a></li>
            <li><a href="{{url('admin-logout')}}">Logout</a></li>
        </ul>
    </div>

</div>


</body>

</html>