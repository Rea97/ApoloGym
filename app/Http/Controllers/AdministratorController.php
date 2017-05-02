<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function show(Request $request, Administrator $administrator)
    {
        if ($request->ajax()) {
            return response()->json(['admin' => $administrator]);
        }
        return redirect()->route('dashboard.start');
    }

    public function delete(Administrator $administrator)
    {
        $administrators = Administrator::all()->count();
        if ($administrators <= 1) {
            return response()->json(['error' => 'Debe agregar otro administrador antes de eliminar su propio perfil.']);
        }
        $administrator->delete();
        return response()->json(['success' => true]);
    }
}
