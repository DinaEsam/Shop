<div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Latest Products</h2>
            <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
@foreach ($products as $product)
<div class="col-md-4">
  <div class="product-item">
    <a href="{{route('user-show-product',$product->id)}}"><img src="{{asset("Storage/$product->image")}}" alt=""></a>
    <div class="down-content">
      <a href="#"><h4>{{$product->name}}</h4></a>
      <h6>{{$product->price}}</h6>
      <p>{{$product->desc}}</p>
     
      <span>Quantitiy :{{$product->quantity}}</span>
      <form action="{{route('user-addToWishlist',$product->id)}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Add to Wishlist</button>
      </form>
    </div>
  </div>
</div>
@endforeach




       
      
      </div>
    </div>
  </div>