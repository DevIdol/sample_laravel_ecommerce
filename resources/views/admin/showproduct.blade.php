<!DOCTYPE html>
<html lang="en">

<head>

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
    <div style="padding-bottom: 40px" class="container-fluid page-body-wrapper">
        <div class="container" align="center">
            <h1 class="product-title">Product List</h1>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    {{ session()->get('message') }}
                </div>
            @endif

            <table class=" table-bordered mt-4">
                <tr align="center" style="background-color: black">
                    <td style="padding:1rem; color:white">Id</td>
                    <td style="padding:1rem; color:white">Image</td>
                    <td style="padding:1rem; color:white">Title</td>
                    <td style="padding:1rem; color:white">Price</td>
                    <td style="padding:1rem; color:white">Description</td>
                    <td style="padding:1rem; color:white">Quantity</td>
                    <td style="padding:1rem; color:white">Edit</td>
                    <td style="padding:1rem; color:white">Delete</td>
                </tr>
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        <tr align="center" style="background-color: rgb(71, 70, 70);">
                            <td style="padding:1rem; color:white">{{ $product->id }} </td>
                            <td style="padding:1rem;">
                                <img style="height:10vh; width: 10vh" src="/productimage/{{ $product->image }}"
                                    alt="product-img">
                            </td>
                            <td style="padding:1rem; color:white">{{ $product->title }}</td>
                            <td style="padding:1rem; color:white">$ {{ $product->price }} </td>
                            <td style="padding:1rem; color:white">{{ $product->description }} </td>
                            <td style="padding:1rem; color:white">{{ $product->quantity }} </td>
                            <td style="padding:1rem; color:white"><a class="btn btn-success"
                                    href="{{ url('updateproducts', $product->id) }} ">Edit</a></td>
                            <td style="padding:1rem; color:white"><a class="btn btn-danger"
                                    href="{{ url('deleteproducts', $product->id) }} ">Delete</a> </td>
                        </tr>
                    @endforeach


                @endif
            </table>

        </div>

    </div>
    <!-- plugins:js -->
    @include('admin.script')
</body>

</html>
