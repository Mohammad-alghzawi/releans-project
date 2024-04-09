@extends('pages.layout')
@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Create New Car</div>
  <div class="card-body">
       
    <form action="{{ route('car.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      
      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}">
        @error('type')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="model_year" class="form-label">Model</label>
        <input type="number" name="model_year" id="model_year" class="form-control @error('model_year') is-invalid @enderror" value="{{ old('model_year') }}">
        @error('model_year')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
        @error('price')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="color" class="form-label">Color</label>
        <input type="color" name="color" id="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}">
        @error('color')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input name="image" type="file" class="form-control @error('image') is-invalid @enderror" id="image">
        @error('image')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
        @error('stock')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="discount" class="form-label">Discount %</label>
        <input type="number" name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror" value="{{ old('discount') }}">
        @error('discount')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex gap-1">
        <input type="submit" value="Save" class="btn btn-success">
        <a href="{{ route('car.index') }}" class="btn btn-primary btn-sm">Back</a>
      </div>
    </form>    
  </div>
</div>
  
@stop
