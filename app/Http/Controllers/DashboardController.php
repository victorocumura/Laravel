<?php 


namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\Desenvolvedor;

class DashboardController extends Controller
{
    public function index()
    {
        $desenvolvedores = Desenvolvedor::withCount('artigos')->get();
        $artigos = Artigo::withCount('desenvolvedores')->get();

        return view('dashboard', compact('desenvolvedores', 'artigos'));
    }
}
