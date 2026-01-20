<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class MemeController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memes = Meme::with('user')
			->latest('fecha_subida')
			->paginate(10);

        return view('feed', ['memes' => $memes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'meme_url' => 'required|string|max:500',
            'explicacion' => 'required|string|max:1000',
        ], [
            'meme_url.required' => '¡Por favor, proporciona el contenido del meme (URL o texto)!',
            'meme_url.max' => 'El contenido del meme debe tener máximo 500 caracteres.',
            'explicacion.required' => '¡Por favor, escribe una explicación para el meme!',
            'explicacion.max' => 'La explicación debe tener máximo 1000 caracteres.',
        ]);

        $user = auth()->user();

        $data = [
            'meme_url' => $validated['meme_url'],
            'explicacion' => $validated['explicacion'],
            'fecha_subida' => now(),
        ];

        if ($user) {
            $user->memes()->create($data);
        } else {
            Meme::create($data);
        }

        return redirect('/')->with('success', '¡Tu meme ha sido publicado!');
    }

    public function edit(Meme $meme)
    {
        $this->authorize('update', $meme);

        return view('memes.edit', compact('meme'));
    }

    public function update(Request $request, Meme $meme)
    {
        $this->authorize('update', $meme);

        $validated = $request->validate([
            'meme_url' => 'required|string|max:500',
            'explicacion' => 'required|string|max:1000',
        ], [
            'meme_url.required' => '¡Por favor, proporciona el contenido del meme (URL o texto)!',
            'meme_url.max' => 'El contenido del meme debe tener máximo 500 caracteres.',
            'explicacion.required' => '¡Por favor, escribe una explicación para el meme!',
            'explicacion.max' => 'La explicación debe tener máximo 1000 caracteres.',
        ]);

        // Update the meme
        $meme->update($validated);

        return redirect('/')->with('success', '¡Meme actualizado correctamente!');
    }

    public function destroy(Meme $meme)
    {
        $this->authorize('delete', $meme);

        $meme->delete();

        return redirect('/')->with('success', '¡Meme eliminado correctamente!');
    }
}
