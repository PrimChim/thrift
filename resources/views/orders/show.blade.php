@extends('layouts.app')

@section('title', 'Order ID #' . $order->id . ' - Nidhi')

@section('content')
<div>
    <!-- Be present above all else. - Naval Ravikant -->
     <p>
        Order Id: {{$order->id}}
     </p>
     <p>
        Product Name: {{$order->product->name}}
     </p>
     <p>
        Total Price: {{$order->total_price}}
     </p>
</div>
@endsection