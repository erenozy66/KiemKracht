<?php
// Implementeert opslag, update en verwijdering van bestanden en data

namespace App\Http\Controllers;

use App\Models\Klanten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KlantenController extends Controller
{
    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'full_name' => 'required|string|max:255',
                'email'     => 'required|email|max:255',
                'file'      => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]
        );

        $file = $request->file('file');

        //Geen speciale characters
        $baseName = Str::slug($validated['full_name'], '_');

        $extension = $file->getClientOriginalExtension();
        $folder = 'uploads';

        $counter = 1;
        $filename = $baseName . '_' . $counter . '.' . $extension;

        //Unieke bestandsnamen
        while (Storage::disk('public')->exists($folder . '/' . $filename)) {
            $counter++;
            $filename = $baseName . '_' . $counter . '.' . $extension;
        }

        $path = $file->storeAs($folder, $filename, 'public');

        Klanten::create([
            'full_name' => $validated['full_name'],
            'email'     => $validated['email'],
            'file_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Ticket succesvol verzonden.');
    }

    public function index(Request $request)
    {
        $query = Klanten::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $sort = $request->get('sort', 'newest');

        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $tickets = $query->paginate(10)->withQueryString(); //max aantal tickets op één pagina
        $totalTickets = $tickets->total();

        return view('tickets.index', compact('tickets', 'totalTickets'));
    }

    public function edit(Klanten $klanten)
    {
        return view('tickets.edit', compact('klanten'));
    }

    public function update(Request $request, Klanten $klanten)
    {
        $validated = $request->validate(
            [
                'full_name' => 'required|string|max:255',
                'email'     => 'required|email|max:255',
                'file'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]
        );

        if ($request->hasFile('file')) {
            // delete old file
            Storage::disk('public')->delete($klanten->file_path);

            $file = $request->file('file');

            $baseName = Str::slug($validated['full_name'], '_');
            $extension = $file->getClientOriginalExtension();
            $folder = 'uploads';

            $counter = 1;
            $filename = $baseName . '_' . $counter . '.' . $extension;

            while (Storage::disk('public')->exists($folder . '/' . $filename)) {
                $counter++;
                $filename = $baseName . '_' . $counter . '.' . $extension;
            }

            $validated['file_path'] = $file->storeAs($folder, $filename, 'public');
        }

        $klanten->update($validated);

        return redirect()->route('tickets.index')->with('success', 'Ticket bijgewerkt.');
    }

    public function destroy(Klanten $klanten)
    {
        Storage::disk('public')->delete($klanten->file_path);
        $klanten->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket verwijderd.');
    }
}