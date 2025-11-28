<?php

// ===================================================
// app/Http/Controllers/Admin/ContactController.php
// ===================================================

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Afficher tous les messages de contact
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }
    
    /**
     * Afficher un message spécifique
     */
    public function show(Contact $contact)
    {
        // Marquer comme lu automatiquement
        if (!$contact->lu) {
            $contact->marquerCommeLu();
        }
        
        return view('admin.contacts.show', compact('contact'));
    }
    
    /**
     * Supprimer un message
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Message supprimé avec succès');
    }
    
    /**
     * Marquer un message comme lu
     */
    public function marquerLu(Contact $contact)
    {
        $contact->marquerCommeLu();
        
        return back()->with('success', 'Message marqué comme lu');
    }
}