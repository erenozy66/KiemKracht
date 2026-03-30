@extends('layouts.app')

@section('title', 'All Tickets')

@section('content')
 {{-- Beveiligd overzicht van alle tickets met zoeken, sorteren, paginatie en beheeracties --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-white fw-bold">Overzicht</h3>

    <a href="{{ route('tickets.create') }}" class="btn" style="background-color: #F1D09F; color: #242323; font-weight: bold;">
        Nieuw Ticket
    </a>
</div>

<form method="GET" action="{{ route('tickets.index') }}" class="mb-4">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-md-4">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Zoek op naam of e-mail"
                value="{{ request('search') }}"
            >
        </div>

        <div class="col-auto">
            <select name="sort" class="form-select">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                    Nieuwste eerst
                </option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                    Oudste eerst
                </option>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn" style="background-color: #F1D09F; color: #242323; font-weight: bold;">
                Toepassen
            </button>
        </div>

        <div class="col-auto">
            <a href="{{ route('tickets.index') }}" class="btn" style="background-color: #F1D09F; color: #242323; font-weight: bold;">
                Reset
            </a>
        </div>
    </div>
</form>

@if(request('search'))
    <p class="text-white mb-1">
        Zoekresultaten voor: <strong>{{ request('search') }}</strong>
    </p>
    <p class="text-white fw-bold">
        Aantal gevonden tickets: {{ $totalTickets }}
    </p>
@else
    <p class="text-white fw-bold">
        Totaal aantal tickets: {{ $totalTickets }}
    </p>
@endif

<!-- ✅ BORDER WRAPPER -->
<div style="border: 2px solid #F1D09F; border-radius: 8px; overflow: hidden;">

<table class="table table-hover mb-0">
    <thead>
        <tr style="background-color: #782F40; color: #FFF;">
            <th>ID</th>
            <th>Volledige Naam</th>
            <th>Email</th>
            <th>Bestand</th>
            <th>Gemaakt op</th>
            <th>Acties</th>
        </tr>
    </thead>

    <tbody class="text-white">
        @forelse($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->full_name }}</td>
            <td>{{ $ticket->email }}</td>

            <td>
                <a href="{{ asset('storage/' . $ticket->file_path) }}" target="_blank" style="color: #1f1f1f;">
                    {{ basename($ticket->file_path) }}
                </a>
            </td>

            <td>{{ $ticket->created_at->format('d-m-Y H:i') }}</td>

            <td class="d-flex gap-1">
                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm" style="background-color: #F1D09F; color: #242323; font-weight: bold;">
                    Edit
                </a>

                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm" style="background-color: #1f1f1f; color: #cbc8c8; font-weight: bold;" onclick="return confirm('Weet je zeker dat je dit ticket wilt verwijderen?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="6" class="text-center" style="color: #1f1f1f;">
                Geen tickets gevonden.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

</div>


@if($tickets->lastPage() > 0)
    <div class="d-flex flex-column align-items-center mt-4">
        <p class="text-white mb-2 fw-bold">
            Pagina {{ $tickets->currentPage() }} van {{ $tickets->lastPage() }}
        </p>

        <div class="d-flex align-items-center gap-2 flex-wrap justify-content-center">
            @if($tickets->onFirstPage())
                <span class="btn btn-sm" style="background-color: #1f1f1f; color: #cbc8c8; font-weight: bold; opacity: 0.6; pointer-events: none;">
                    Vorige
                </span>
            @else
                <a href="{{ $tickets->previousPageUrl() }}" class="btn btn-sm" style="background-color: #1f1f1f; color: #cbc8c8; font-weight: bold;">
                    Vorige
                </a>
            @endif

            @for($page = 1; $page <= $tickets->lastPage(); $page++)
                @if($page == $tickets->currentPage())
                    <span class="btn btn-sm" style="background-color: #F1D09F; color: #242323; font-weight: bold;">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $tickets->url($page) }}" class="btn btn-sm" style="background-color: #782F40; color: #F1D09F; font-weight: bold; border: 1px solid #F1D09F;">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            @if($tickets->hasMorePages())
                <a href="{{ $tickets->nextPageUrl() }}" class="btn btn-sm" style="background-color: #1f1f1f; color: #cbc8c8; font-weight: bold;">
                    Volgende
                </a>
            @else
                <span class="btn btn-sm" style="background-color: #1f1f1f; color: #cbc8c8; font-weight: bold; opacity: 0.6; pointer-events: none;">
                    Volgende
                </span>
            @endif
        </div>
    </div>
@endif

<p class="text-center mt-3"
   style="color: #F1D09F; opacity: 0.5; font-size: 12px; cursor: default;"
   onmouseover="this.style.opacity='1'"
   onmouseout="this.style.opacity='0.5'">
    ↑ ↑ ↓ ↓ ← → ← →
</p>
 {{-- Hint: pijltjestoetsen --}}


@endsection
