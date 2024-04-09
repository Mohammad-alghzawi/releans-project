@extends('pages.layout')
@section('content')
    <div class="container">
    @if (Session::has('status'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            title: 'Message',
                            text: "{{ Session::get('status') }}",
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonText: "OK",
                        });
                    });
                </script>
            @endif
        <div class="row" style="margin:20px;">
          <form action="{{ route('logout') }}" method="post" >
    @csrf
    <input type="submit" value="Log out" style="background-color: grey; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">
</form>
        
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Product Catalog</h2>
                    </div>
                    <div class="card-body">
                       
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>Image</th>
                                        <th>Type</th>
                                        <th>Model by year</th>
                                        <th>Price</th>
                                        <th>Color</th>
                                        <th>Stock</th>
                                        <th>Discount %</th>
                                        <th>Price After Discount % </th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cars as $item)
    <tr>
    <td><a href="#"><img src="{{ url('/images/' . $item->image) }}" width="100px"
                                                height="100px" alt="Avatar"></a></td>
        <td>{{ $item->type }}</td>
        <td>{{ $item->model_year }}</td>
        <td>{{ $item->price }}</td>
        <td>{{ $item->color }}</td>
        
        <td class="{{ $item->stock <= 10 ? 'text-danger' : '' }}">{{ $item->stock }}</td>

                                                <td>{{ $item->discount }}</td>
                                                <td>{{ $item->price_after_discount }}</td>
                                                <td>
                         <form action="{{ route('buyCar', ['id' => $item->id]) }}" method="post">
    @csrf
    <input type="submit" value="Buy" class="btn btn-success">
</form>
               
                                            </td>

    </tr>
@endforeach

                                </tbody>
                            </table>
                        </div>
  
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection