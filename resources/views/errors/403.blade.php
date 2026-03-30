@extends('layouts.app')

@section('title', 'Forbidden')

@section('content')

{{-- 403 pagina die niet-geauthenticeerde gebruikers blokkeert --}}

<div class="d-flex flex-column justify-content-center align-items-center text-center" style="min-height: 70vh;">

    <h1 style="font-size: 80px; color: #F1D09F;">403</h1>

    <h3 class="text-white mb-3">Geen toegang</h3>

    <p class="text-white mb-4">
        Je moet ingelogd zijn om deze pagina te bekijken.
    </p>

    <a href="{{ route('login.show') }}" 
       class="btn"
       style="background-color: #F1D09F; color: #242323; font-weight: bold;">
        Ga naar login
    </a>

</div>
@endsection
