@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="row justify-content-center">
    
    <div class="col-md-5">
        <div class="card border-0 bg-transparent">
            <div class="card-header text-center" style="background-color: #782F40; color: #FFF; font-weight: bold;">
                Admin Login
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login.perform') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email</label>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-white">Wachtwoord</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn" style="background-color: #F1D09F; color: #242323; font-weight: bold;">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection