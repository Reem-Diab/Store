@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-center align-items-start" style="min-height: 100vh; padding-top: 50px;">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @else
                    <div class="alert alert-success" role="alert">
                        You are logged in!
                    </div>
                @endif

                <p>Welcome to your dashboard!</p>
            </div>
        </div>
    </div>
</div>
@endsection
