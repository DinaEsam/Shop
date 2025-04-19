{{-- @extends('user.app.layout')

@section( 'content')
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="col-md-4">

   @if(session()->has('Wishlist') && is_array(session('Wishlist')))
    @foreach (session('Wishlist') as $id => $product)
   
        <div class="product-item">
            <a href="#"><img src="{{ asset("storage")}}/{{$product['image'] }}" alt=""></a>
            <div class="down-content">
                <a href="#"><h4>{{$product['name']}}</h4></a>
                <h6>{{$product['price']}}</h6>
              </div>
        </div>
        @auth
        <form action="{{route('user-addToCart',$id)}}" method="POST">
            @csrf
            <input type="number" name="qty" id="">
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
        
        
        @endauth
        @endforeach
        @endif


</div>

@endsection --}}

 @extends('user.app.layout')

@section( 'content')
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="col-md-4">
    @if(isset($Wishlist) && is_array($Wishlist) && count($Wishlist) > 0)
        @foreach ($Wishlist as $id => $product)
            <div class="product-item">
                <a href="#"><img src="{{ asset("storage/".$product['image']) }}" alt=""></a>
                <div class="down-content">
                    <a href="#"><h4>{{$product['name']}}</h4></a>
                    <h6>{{$product['price']}}</h6>
                </div>
            </div>
            @auth
            <form action="{{route('user-addToCart',$id)}}" method="POST">
                @csrf
                <input type="number" name="qty" id="">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
            
            
            @endauth
        @endforeach
    @else
        <p>قائمة الأمنيات فارغة</p>
    @endif
</div>


@endsection