@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        <div class="card border-0 shadow rounded">
            <div class="card-body">
                Selamat Datang <strong>{{ auth()->user()->name }}</strong>
                <hr>
                <a href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="btn btn-md btn-primary">LOGOUT</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <div class="row mt-5 mb-5">
                    <div class="col-lg-12 margin-tb">
                        <div class="float-left">
                            <h2>Tutorial CRUD</h2>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-success" href="{{ route('products.create') }}"> Add Product</a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
             
                <table class="table table-bordered">
                    <tr>
                        <th width="20px" class="text-center">No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th width="280px"class="text-center">Aksi</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td>{{ $product->nama }}</td>
                        <td>{{ $product->harga }}</td>
                        <td class="text-center">
                            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
             
                                <a class="btn btn-info btn-sm" href="{{ route('products.show',$product->id) }}">Show</a>
             
                                <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}">Edit</a>
             
                                @csrf
                                @method('DELETE')
             
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
             
               <div class="col-md-8" >
                {!! $products->links() !!}
               </div>
               
            </div>
        </div>
    </div>

@endsection