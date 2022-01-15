

            @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">X</button>
                {{ session()->get('message') }}
            </div>
        @endif
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Latest Products</h2>
                    <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>

                    <form action="{{ url('search') }}" class="form-inline" style="float: right; padding: 10px">
                        @csrf
                        <input type="search" name="search" placeholder="Search" class="form-control">
                        <input style="background-color: red" type="submit" value="Search" class="btn btn-success">
                    </form>
                </div>
            </div>

            @foreach ($products as $product)

                <div class="col-md-4">
                    <div class="product-item">
                        <a href="#"><img style="height: 50vh; width:100%;" src="/productimage/{{ $product->image }}"
                                alt=""></a>
                        <div class="down-content">
                            <a href="#">
                                <h4>{{ $product->title }} </h4>
                            </a>
                            <h6>${{ $product->price }} </h6>
                            <p>{{ $product->description }} </p>

                            <form action="{{url('addcart', $product->id)}}" method="POST">
                                @csrf
                               <div style="display: flex; justify-content: space-between">
                                <input style="width: 100px" name="quantity" type="number" value="1" min="1" class="form-control">
                                <input style="float: right; background-color: red" type="submit" value="Add Cart" class="btn btn-danger"></div>
                            </form>

                        </div>
                    </div>
                </div>


            @endforeach

            @if (method_exists($products, 'links'))
                <div class="d-flex justtify-content-center">
                    {!! $products->links() !!}
                </div>
            @endif





        </div>
    </div>
</div>
