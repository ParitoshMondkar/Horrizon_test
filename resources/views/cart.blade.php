<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Cart</title>
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
        @if(count($cart_data) > 0)
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
            @foreach($cart_data as $products)
              @if($products->add_to_cart == "Added")
                <tr>
                  <th scope="row">{{$products->product_id}}</th>
                  <td>{{$products->product_title}}</td>
                  <td>{{$products->category_name}}</td>
                  <td>{{$products->description}}</td>
                  <td>{{$products->price}}</td>
                  <td><input type="button" class="btn btn-primary" name="cart_{{$products->product_id}}" id="cart_{{$products->product_id}}" data-product_id="{{$products->product_id}}" data-user_id="{{$user_id}}" data-cart_id="{{$products->cart_id}}" onclick="remove_from_cart(this.id)" value="Remove"></td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
        @endif
    </div>

    <div class="col-md-3"></div>

</div>


<div class="row">
  <div class="col-md-12"><p align="center"><input type="button" data-user_id="{{$user_id}}" class="btn btn-primary" name="place_order" id="place_order" value="Place Order" onclick="p_place_order(this.id)"></p></div>
</div>

</body>

<script src="{{url('js/jquery.min.js')}}"></script>
<script>
    function remove_from_cart(this_id){
        var user_id = $("#" + this_id).attr('data-user_id');
        var product_id = $("#" + this_id).attr('data-product_id');
        var cart_id = $("#" + this_id).attr('data-cart_id');

        $.ajax({
            type:"POST",
            url:"{{url('remove-from-cart')}}",
            data : {
               _token : "{{csrf_token()}}",
               user_id : user_id,
               product_id : product_id,
               cart_id : cart_id,
            },
            success : function(response){
                var data = JSON.parse(response);

                if(data.status == "success"){
                  alert("Product Removed From Cart");
                  window.location.reload();
                }else{
                  alert("Something Went Wrong");
                }
            }

        });
    }

    function p_place_order(this_id){

      var user_id = $("#" + this_id).attr('data-user_id');

      $.ajax({
          type:"POST",
          url:"{{url('place-order')}}",
          data : {
             _token : "{{csrf_token()}}",
             user_id : user_id,
          },
          success : function(response){
              var data = JSON.parse(response);

              if(data.status == "success"){
                alert("Order Placed Successfully");
                window.location.reload();
              }else{
                alert("Something Went Wrong");
              }
          }

      });
    }
</script>
</html>