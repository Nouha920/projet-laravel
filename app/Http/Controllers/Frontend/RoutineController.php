<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TypePeau;

class RoutineController extends Controller
{
    public function index()
    {
        $typesPeau = TypePeau::with(['routinesMatin', 'routinesSoir'])->get();
        return view('frontend.routines.index', compact('typesPeau'));
    }
}
