<?php
// ===================================================
// app/Http/Controllers/Frontend/ContactController.php
// ===================================================

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('frontend.contact');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10'
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être valide',
            'message.required' => 'Le message est obligatoire',
            'message.min' => 'Le message doit contenir au moins 10 caractères'
        ]);
        
        Contact::create($validated);
        
        return redirect()->route('contact.create')
            ->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }
}
