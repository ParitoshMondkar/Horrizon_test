<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Add Categories</title>
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

    <div class="col-md-3"></div>

    <div class="col-md-6">

        <div class="form-group">
            <p align="center">
                <h2 class="text-center"><strong>Add Products</strong></h2>
            </p>
        </div>

        
        <div id="div_error_alert" class="alert alert-danger alert-block" style="display:none">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong style="color:red;" id="strong_error_alert"></strong>
        </div>
        
        
        <form name="form_add_products" id="form_add_products">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Add Product Title" name='product_title' id='product_title' autocomplete="off">
            </div>
            <div class="form-group">
                <select class="form-control" name='category_id' id='category_id'>
                    <option value="">Select Category</option>
                    @foreach($result_categories as $categories)
                        <option value="{{$categories->id}}">{{$categories->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Add Product Description" name='description' id='description' autocomplete="off">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Add Product Price" name='price' id='price' autocomplete="off">
            </div>
            <p align="center">
                <input type="button" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Add">
            </p>
        </form>
    </div>

    <div class="col-md-3"></div>

</div>

<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">
        @if(count($result_products) > 0)
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th>Product Title</th>
              <th>Category Name</th>
              <th>Product Description</th>
              <th>Price</th>
              <th>Created By</th>
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
                  <td>{{$products->username}}</td>
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
    $("#btn_submit").on('click',function(event){

        $("#div_error_alert").hide();
        $("#strong_error_alert").text('');

        event.preventDefault();
        var formdata = new FormData($("#form_add_products")[0]);

        $.ajax({
            type:"POST",
            url:"{{url('validate-add-products')}}",
            data : formdata,
            contentType : false,
            processData : false,
            success : function(response){
                var data = JSON.parse(response);

                if(data.status == "success"){
                    $("#div_error_alert").hide();
                    $("#strong_error_alert").text('');
                    window.location.reload();
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