<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Méthode pour afficher le tableau de bord admin
    public function index()
    {
        // retourne la vue 'admin.dashboard'
        return view('admin.dashboard');
    }
}
