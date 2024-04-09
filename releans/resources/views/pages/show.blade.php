@extends('pages.layout')
@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Car Page</div>
  <div class="card-body">
        <div class="card-body">
        <h5 class="card-title">Type : {{ $carShow->type }}</h5>
        <p class="card-text">Model By Year : {{ $carShow->model_year }}</p>
        <p class="card-text">Price : {{ $carShow->price }}</p>
        <p class="card-text">Color : {{ $carShow->color }}</p>
        <p class="card-text">Stock : {{ $carShow->stock }}</p>
        <p class="card-text">Discount : {{ $carShow->discount }}</p>
        <p class="card-text">Price After Discount : {{ $carShow->price_after_discount }}</p>
        @if($carShow->image)
      <img src="{{ asset('images/' . $carShow->image) }}" alt="Car Image" width="100px" height="100px"></br>
      @endif
       <div> <a  href="{{route('car.index')}}"><button class="btn btn-primary btn-sm">Back</button> </a></div>
  </div>
    </hr>
  </div>
</div>
@endsection