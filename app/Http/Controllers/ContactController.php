<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $credentials = $request->validate([
            'name'=>['required'],
            'email'=>['required'],
            'message'=>['required'],
            'calcul'=>['required'],

        ],[
            'name.required'=>'Le champ nom est requis',
            'email.required'=>'Le champ email est requis.',
            'message.required'=>'Le champ message est requis',
            'calcul.required'=>'Le champ de vérification est requis',
        ]);
        if($request->calcul!=8)
        {
            return redirect()->back()->with('error', 'La vérification a échoué');
        }
        else
        {
            Mail::to('contact@restoactif.com')->send(new ContactMail($request));
            return redirect()->back()->with('success', 'Message envoyé avec succès');
        }


    }
}
