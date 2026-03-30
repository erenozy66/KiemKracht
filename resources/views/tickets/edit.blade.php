@extends('layouts.app')

@section('title', 'Edit Ticket')

@section('content')
{{-- Bewerkformulier voor tickets --}}
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 bg-transparent">
            <div class="card-header text-center" style="background-color: #782F40; color: #FFF; font-weight: bold;">
                Edit Ticket #{{ $klanten->id }}
            </div>

            <div class="card-body">
                <form action="{{ route('tickets.update', $klanten) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label text-white">Volledige Naam</label>
                        <input 
                            type="text" 
                            name="full_name" 
                            class="form-control"
                            value="{{ old('full_name', $klanten->full_name) }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control"
                            value="{{ old('email', $klanten->email) }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Huidige Bestand</label>
                        <div>
                            <a href="{{ asset('storage/' . $klanten->file_path) }}" 
                               target="_blank" 
                               class="btn btn-sm"
                               style="background-color: #F1D09F; color: #242323; font-weight: bold;">
                                Zie Huidige Bestand
                            </a>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">
                            Bestand Vervangen (JPG, PNG, PDF)
                        </label>
                        <input 
                            type="file" 
                            name="file" 
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf"
                        >
                        <small class="text-white">
                            Laat leeg om huidige bestand te houden
                        </small>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn w-100" style="background-color: #F1D09F; color: #242323; font-weight: bold;">
                            Ticket Updaten
                        </button>

                        <a href="{{ route('tickets.index') }}" 
                           class="btn w-100"
                           style="background-color: #F1D09F; color: #242323; font-weight: bold;">
                           Annuleren
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
