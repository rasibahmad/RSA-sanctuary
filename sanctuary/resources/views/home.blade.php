@extends('layouts.app')
<!--Home Page-->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 class="header"> Welcome to Aston Animal Sanctuary </h1>
                    <h4 class="header"> Adopt Animal's Today! </h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
