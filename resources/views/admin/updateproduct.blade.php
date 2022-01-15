<!DOCTYPE html>
<html lang="en">

<head>

    <base href="/public">
    @include('admin.css')

    <style type="text/css">
        .product-title {
            color: white;
            padding-top: 25px;
            font-size: 26px;
        }

        label {
            display: inline-block;
            width: 200px;
        }

    </style>

</head>

<body>

    @include('admin.sidebar')

    @include('admin.nav')
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">
        <div class="container" align="center">
            <h1 class="product-title">Add Product</h1>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    {{ session()->get('message') }}
                </div>
            @endif

            <form action="{{ url('editproducts', $product->id) }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div style="padding: 15px;">
                    <label for="product-title">Product Title</label>
                    <input style="color: black;" type="text" name="title" id="product-title"
                        placeholder="Enter a product title" value="{{ $product->title }}" required="">
                </div>

                <div style="padding: 15px;">
                    <label for="product-price">Product Price</label>
                    <input style="color: black;" type="number" name="price" id="product-price"
                        placeholder="Enter a product price" value="{{ $product->price }}" required="">
                </div>

                <div style="padding: 15px;">
                    <label for="product-description">Product Description</label>
                    <input style="color: black;" type="text" name="description" id="product-description"
                        placeholder="Enter a product description" value="{{ $product->description }}" required="">
                </div>

                <div style="padding: 15px;">
                    <label for="product-quantity">Product Quantity</label>
                    <input style="color: black;" type="text" name="quantity" id="product-quantity"
                        placeholder="Enter a product quantity" value="{{ $product->quantity }}" required="">
                </div>

                <div style="padding: 15px;">
                    <label for="product-quantity">Old Image</label>
                    <img style="height: 20vh; widht: 20vh" src="/productimage/{{ $product->image }}" alt="img">
                </div>

                <div style="padding: 15px;">
                    <input type="file" name="file">
                </div>

                <div style="padding: 15px;">
                    <input class="btn btn-success" type="submit">
                </div>

            </form>



        </div>

    </div>
    <!-- plugins:js -->
    @include('admin.script')
</body>

</html>
