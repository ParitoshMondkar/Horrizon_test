<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">
    <title>User Dashboard</title>
</head>

<body>

<div class="row">

    <div class="col-md-12">
        
        <ul>
            <li><a href="{{url('user-dashboard')}}">Dashboard</a></li>
            <li><a href="{{url('cart')}}">Cart</a></li>
            <li><a href="{{url('user-logout')}}">Logout</a></li>
        </ul>
    </div>

</div>

<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">
        @if(count($result_products) > 0)
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Product id</th>
              <th>Product Title</th>
              <th>Category Name</th>
              <th>Product Description</th>
              <th>Price</th>
              <th>Cart</th>
            </tr>
          </thead>
          <tbody>
            @foreach($result_products as $products)
                <tr>
                  <th scope="row">{{$products->product_id}}</th>
                  <td>{{$products->product_title}}</td>
                  <td>{{$products->category_name}}</td>
                  <td>{{$products->description}}</td>
                  <td>{{$products->price}}</td>
                  <td><input type="button" class="btn btn-primary" name="cart_{{$products->product_id}}" id="cart_{{$products->product_id}}" data-product_id="{{$products->product_id}}"data-user_id="{{$user_id}}" onclick="add_to_cart(this.id)" value="{{$products->add_to_cart}}"></td>
                </tr>
            @endforeach
          </tbody>
        </table>
        @endif
    </div>

    <div class="col-md-3"></div>

</div>

</body>

<script src="{{url('js/jquery.min.js')}}"></script>
<script>
    function add_to_cart(this_id){
        var user_id = $("#" + this_id).attr('data-user_id');
        var product_id = $("#" + this_id).attr('data-product_id');

        $.ajax({
            type:"POST",
            url:"{{url('add-to-cart')}}",
            data : {
               _token : "{{csrf_token()}}",
               user_id : user_id,
               product_id : product_id,
            },
            success : function(response){
                var data = JSON.parse(response);

                if(data.status == "added"){
                    $("#cart_" + product_id).val("Added");
                   alert("Product Added to Cart");
                }

                if(data.status == "exist"){
                    alert("Product Alredy Added to Cart");
                }
            }

        });
    }
</script>
</html>