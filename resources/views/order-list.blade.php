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

<div class="row">

    <div class="col-md-1"></div>

    <div class="col-md-10">

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Order Id</th>
                  <th>Customer Name</th>
                  <th>Product id</th>
                  <th>Product Title</th>
                  <th>Category Name</th>
                  <th>Product Description</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order_data as $orders)
                    <tr>
                      <th scope="row">{{$orders->unique_order_id}}</th>
                      <th>{{$orders->CustomerName}}</th>
                      <th>{{$orders->product_id}}</th>
                      <td>{{$orders->product_title}}</td>
                      <td>{{$orders->category_name}}</td>
                      <td>{{$orders->description}}</td>
                      <td>{{$orders->price}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>

    </div>

    <div class="col-md-1"></div>

</div>


</body>

</html>