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
                            <h2>Edit Post</h2>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-secondary" href="{{ route('products.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
             
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
             
                <form action="{{ route('products.update',$product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
             
                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nama:</strong>
                                <input type="text" name="nama" value="{{ $product->nama }}" class="form-control" placeholder="Nama Produk">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Deskripsi</strong>
                                <textarea class="form-control" style="height:150px" name="deskripsi" placeholder="Deskripsi">{{ $product->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Berat:</strong>
                                <input type="text" name="berat" value="{{ $product->berat }}" class="form-control" placeholder="Berat">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Harga:</strong>
                                <input type="text" name="harga" value="{{ $product->harga }}" class="form-control" placeholder="Harga">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Foto Produk:</strong>
                                @if($product->foto)
                                <br>
                                Current Foto : <img src="{{asset('storage/'.$product->foto)}}" alt="">
                                @endif
                                <br>
                                <input type="file" name="foto"  class="form-control" placeholder="Foto">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
             
                </form>
            </div>
        </div>
    </div>

@endsection