<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Models\ImageProfil;
use Illuminate\Http\Request;


class ProfilController extends Controller
{

    public function create(Request $request)
    {
        $credentials = $request->validate([
            'description'=>['required'],
            'address'=>['required'],
            'name'=>['required'],
            'logo'=>['required'],
            'type'=>['required'],


        ],[
            'description.required'=>'Le champ description est requis.',
            'address.required'=>'Le champ adresse est requis',
            'name.required'=>'Le champ nom est requis',
            'logo.required'=>'Le champ logo est requis',
            'type.required'=>'Le champ type est requis',

        ]);

        $profil=Profil::create([
            'description'=>$request->description,
            'address'=>$request->address,
            'name'=>$request->name,
            'type'=>$request->type,
            'logo'=>$request->file('logo')->store('public/profil_images'),
            'user_id' => auth()->user()->id

        ]);



        return redirect()->back()->with('success', 'Les informations du profil ont été enregistrées');
    }

    public function update(Request $request, $id)
    {

        $credentials = $request->validate([
            'description'=>['required'],
            'address'=>['required'],
            'name'=>['required'],
            'type'=>['required'],

        ],[
            'description.required'=>'Le champ description est requis.',
            'address.required'=>'Le champ adresse est requis',
            'name.required'=>'Le champ nom est requis',
            'type.required'=>'Le champ type est requis',

        ]);
        $profil=Profil::findOrFail($id);
        if($profil->user_id==auth()->user()->id)
        {
            $profil->update([
                'type'=>$request->type,
                'description'=>$request->description,
                'address'=>$request->address,
                'name'=>$request->name,
            ]);
            if($request->hasFile('logo'))
            {
                $profil->update([
                    'logo'=>$request->file('logo')->store('public/profil_images')
                ]);
            }

            return redirect()->back()->with('success', 'Les informations du profil ont été enregistrées.');
        }else{
            abort(403);
        }
    }

    public function add_image( $id,Request $request)
    {

        $validatedData = $request->validate([
            'image' => 'required|file',
        ],[
            'image.required' => 'Les images sont réquises.',
        ]);
        $profil=Profil::findOrFail($id);
        if($profil->user_id!=auth()->user()->id){
            return redirect()->back()->with('error', 'Profil not found');
            }
        $profil_image=ImageProfil::create([
            'profil_id'=>$profil->id,
            'status'=>'0',
            'file_url'=>$request->file('image')->store('public/profil_images')
        ]);
        return redirect()->back()->with('success', 'Image ajoutée avec succès');
    }
    public function delete_image($id)
    {
        $profil_image=ImageProfil::findOrFail($id);
        if($profil_image->profil->user_id!=auth()->user()->id){
            abort(403);
        }
        $profil_image->delete();
        return redirect()->back()->with('success', 'Image supprimée avec succès');
    }

    public function update_image( $id,Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|file',
        ],[
            'image.required' => 'Les images sont réquises.',
        ]);
        $profil_image=ImageProfil::findOrFail($id);
        if($profil_image->profil->user_id!=auth()->user()->id){
            abort(403);
        }
        $profil_image->update([
            'file_url'=>$request->file('image')->store('public/profil_images')
        ]);
        return redirect()->back()->with('success', 'Image modifiée avec succès');
    }

}
