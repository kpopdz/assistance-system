@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('message'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <div class="offcanvas offcanvas-end" id="demo">
                        <div class="offcanvas-header">
                          <h1 class="offcanvas-title">Heading</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                        </div>
                        <div class="offcanvas-body">
                          <p>Some text lorem ipsum.</p>
                          <p>Some text lorem ipsum.</p>
                          <p>Some text lorem ipsum.</p>
                          <button class="btn btn-secondary" type="button">A Button</button>
                        </div>
                      </div>

                      <div class="container-fluid mt-3">
                        <h3>Right Offcanvas</h3>
                        <p>The .offcanvas-end class positions the offcanvas to the right of the page.</p>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                          Toggle Right Offcanvas
                        </button>
                      </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
