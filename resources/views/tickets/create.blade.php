@extends('layouts.app')

@section('title', 'Submit Ticket')

@section('content')
//Formulier voor ticketinvoer
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 bg-transparent">
            <div class="card-header text-center" style="background-color: #782F40; color: #FFF; font-weight: bold;">
                Ticket indienen
            </div>

            <div class="card-body">
                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="full_name" class="form-label text-white">Volledige naam</label>
                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label text-white">Upload Ticket (JPG, PNG, PDF)</label>
                        <input type="file" name="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                        @error('file')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn" style="background-color: #F1D09F; color: #242323; font-weight: bold;">
                            Verstuur Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection