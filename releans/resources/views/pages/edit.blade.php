@extends('pages.layout')
@section('content')
    <div class="card" style="margin:20px;">
        <div class="card-header">Edit car</div>
        <div class="card-body">

            <form action="{{ route('car.update', $car->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="id" value="{{ $car->id }}" id="id" />

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" name="type" id="type"
                        class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $car->type) }}">
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" name="model" id="model"
                        class="form-control @error('model') is-invalid @enderror"
                        value="{{ old('model', $car->model_year) }}">
                    @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $car->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="color" name="color" id="color"
                        class="form-control @error('color') is-invalid @enderror" value="{{ old('color', $car->color) }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" id="stock"
                        class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $car->stock) }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="discount" class="form-label">Discount %</label>
                    <input type="number" name="discount" id="discount"
                        class="form-control @error('discount') is-invalid @enderror"
                        value="{{ old('discount', $car->discount) }}">
                    @error('discount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input name="image" type="file" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <img src="/images/{{ $car->image }}" width="150px" class="mt-4"><br><br>

                <div class="d-flex gap-1">
                    <input type="submit" value="Update" class="btn btn-success">
                    <a href="{{ route('car.index') }}" class="btn btn-primary btn-sm">Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
