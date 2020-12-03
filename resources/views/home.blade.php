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
                    </div>
                    <div class="col-md-12">
                        <div class="float-left">
                            <a class="btn btn-primary" href="{{route('customers.index')}}">Go To Customers</a>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-warning" href="{{route('products.index')}}">Go To Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection