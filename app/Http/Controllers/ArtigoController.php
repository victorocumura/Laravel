<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artigo;
use App\Models\Desenvolvedor;
use Illuminate\Support\Facades\Storage;

class ArtigoController extends Controller
{
    public function index()
    {
        $artigos = Artigo::orderBy('data_publicacao', 'desc')->paginate(10);
        return view('artigos.index', compact('artigos'));
    }

    
    public function create()
    {
        $desenvolvedores = Desenvolvedor::all();
        return view('artigos.create', compact('desenvolvedores'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'slug' => 'required|string|unique:artigos,slug',
            'conteudo' => 'required|string',
            'data_publicacao' => 'required|date',
            'imagem_capa' => 'nullable|image|max:2048', // opcional, max 2MB
            'desenvolvedores' => 'array',
            'desenvolvedores.*' => 'exists:desenvolvedores,id',
        ]);

        
        if ($request->hasFile('imagem_capa')) {
            $validated['imagem_capa'] = $request->file('imagem_capa')->store('imagens', 'public');
        }

       
        $artigo = Artigo::create($validated);

        if (!empty($request->desenvolvedores)) {
            $artigo->desenvolvedores()->attach($request->desenvolvedores);
        }

        return redirect()->route('artigos.index')->with('success', 'Artigo criado com sucesso!');
    }

    
    public function edit(Artigo $artigo)
    {
        $desenvolvedores = Desenvolvedor::all();
        return view('artigos.edit', compact('artigo', 'desenvolvedores'));
    }

   
    public function update(Request $request, Artigo $artigo)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'slug' => 'required|string|unique:artigos,slug,' . $artigo->id,
            'conteudo' => 'required|string',
            'data_publicacao' => 'required|date',
            'imagem_capa' => 'nullable|image|max:2048',
            'desenvolvedores' => 'array',
            'desenvolvedores.*' => 'exists:desenvolvedores,id',
        ]);

        
        if ($request->hasFile('imagem_capa')) {
            if ($artigo->imagem_capa) {
                Storage::disk('public')->delete($artigo->imagem_capa);
            }
            $validated['imagem_capa'] = $request->file('imagem_capa')->store('imagens', 'public');
        }

        
        $artigo->update($validated);

       
        if (!empty($request->desenvolvedores)) {
            $artigo->desenvolvedores()->sync($request->desenvolvedores);
        } else {
            $artigo->desenvolvedores()->detach();
        }

        return redirect()->route('artigos.index')->with('success', 'Artigo atualizado com sucesso!');
    }

    
    public function destroy(Artigo $artigo)
    {
        
        if ($artigo->imagem_capa) {
            Storage::disk('public')->delete($artigo->imagem_capa);
        }

        
        $artigo->desenvolvedores()->detach();

        
        $artigo->delete();

        return redirect()->route('artigos.index')->with('success', 'Artigo excluído com sucesso!');
    }
}
