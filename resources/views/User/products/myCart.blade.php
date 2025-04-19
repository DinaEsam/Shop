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

    @if (!empty($cart))
    @foreach ($cart as $id => $product)
        <div class="product-item">
            <a href="#"><img src="{{ asset('storage/' . $product['image']) }}" alt=""></a>
            {{-- <div class="down-content">
                <a href="#"><h6>{{ $product['name'] }}</h6></a>
                <h6>{{ $product['price'] }}</h6>
                <span>Quantity {{ $product['qty'] }}</span>
            </div> --}}
            <div class="down-content">
                <a href="#"><h4>{{$product['name']}}</h4></a>
                <h6>{{$product['price']}}</h6>
               
                <span>Quantitiy :{{$product['qty']}}</span>
              
              </div>
        </div>
    @endforeach
@else
    <p>Your cart is empty.</p>
@endif


<form action="{{ route('user-makeOrder') }}" method="post">
    @csrf
        <input type="date" name="requireDate" id="">
        <button type="submit">Make Order</button>
    </form>

</div>

@endsection
