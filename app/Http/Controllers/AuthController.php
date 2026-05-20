<?php

namespace App\Http\Controllers;

use App\Mail\CommunityJoiningMail;
use App\Mail\ConfirmEmail;
use App\Mail\ConfirmMail;
use App\Models\AppNotificationToken;
use App\Models\CommunityMember;
use App\Models\Event;
use App\Models\Menu;
use App\Models\MenuDish;
use App\Models\Dish;
use App\Models\Offer;
use App\Models\Profil;
use App\Models\Roles;
use App\Models\StatutCompte;
use App\Models\User;
use App\Notifications\ForgetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // login_view
    public function login_view()
    {
        return view("auth.pages.login");
    }
    public function register_view()
    {
        return view("auth.pages.register");
    }
    public function join_community_view()
    {
        return view('auth.pages.rejoin_community');
    }
    public function suspended_view()
    {
        return view('auth.pages.deactivate_message');
    }


    //   register function
    public function register(Request $requete)
    {
        $credentials = $requete->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'password2' => ['required', 'same:password'],
            'nom' => ['required'],
            'prenom' => ['required'],
            // 'telephone' => ['required'],
            'check_term' => ['required'],
        ], [
            'email.required' => 'Le champ email est requis.',
            // 'telephone.required' => 'Le champ telephone est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Le champ mot de passe est requis.',
            'password2.required' => 'Le champ de confirmation du mot de passe est requis.',
            'password2.same' => 'Les champs de mot de passe doivent être identiques.',
            'nom.required' => 'Le champ nom est requis.',
            'prenom.required' => 'Le champ prénom est requis.',
            'check_term.required' => 'Veuillez accepter les termes et conditions.',
        ]);

        $user = User::create([
            'last_name' => $requete->nom,
            'first_name' => $requete->prenom,
            // 'phone_number' => $requete->telephone,
            'email' => $requete->email,
            'password' => Hash::make($requete->password),
            'confirmation_token' => Str::random(16)
        ]);
        Mail::to($user->email)->send(new ConfirmMail($user));
        return view('auth.pages.email_verified_message', ['email' => $user->email]);
    }

    public function join_community(Request $request)
    {

        // dd($request);
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:community_members'],
            'address' => ['required'],
            'nom' => ['required'],
            'prenom' => ['required'],
            // 'telephone' => ['required'],
            'check_term' => ['required'],
        ], [
            'email.required' => 'Le champ email est requis.',
            // 'telephone.required' => 'Le champ telephone est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'address.required' => 'Le champ adresse est requis.',
            'nom.required' => 'Le champ nom est requis.',
            'prenom.required' => 'Le champ prénom est requis.',
            'check_term.required' => 'Veuillez accepter les termes et conditions.',
        ]);
        // for community
        if ($request->endpoint) {
            $credentials2 = $request->validate([
                'endpoint'    => 'required',
                'key'   => 'required',
                'authSecret' => 'required'
            ]);
        }

        // subscription
        $user = CommunityMember::create([
            'last_name' => $request->nom,
            'first_name' => $request->prenom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'address' => $request->address,
        ]);


        //subscription
        if ($request->endpoint) {
            $endpoint = $request->endpoint;
            $token = $request->authSecret;
            $key = $request->key;
            $user->updatePushSubscription($endpoint, $key, $token);
        }
        Mail::to($user->email)->send(new CommunityJoiningMail($user));

        return view('auth.pages.rejoin_community_success');
    }



    public function register_notification_token(Request $request)
    {
        $credentials = $request->validate([
            'token' => ['required'],
        ], [
            'token.required' => 'Le champ token est requis.',
            ]);
            $token_exist=AppNotificationToken::where('token',$request->token)->first();
            if($token_exist!=null){
                return response()->json(['token_exist' =>$token_exist]);
            }else{
                $token = AppNotificationToken::create([
                    'token' => $request->token,
                ]);
            }

        return response()->json(['token' =>$token]);
    }



    //login function
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'password.required' => 'Le champ mot de passe est requis.',
        ]);
        if (Auth::attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();
            if (auth()->user()->email_verified_at) {
                if (auth()->user()->role == 0) {
                    return redirect()->intended(route('admin.dashboard.view'));
                } else {
                    if (auth()->user()->status == 1) {
                        return redirect()->intended(route('dashboard.index.view'));
                    } else {
                        auth()->logout();
                        return redirect(route('suspended.view'));
                    }
                }
            } else {
                $user = User::find(auth()->user()->id);
                auth()->logout();
                Mail::to($user->email)->send(new ConfirmMail($user));
                return view('auth.pages.email_verified_message', ['email' => $user->email]);
            }
        }
        return back()->withErrors([
            'incorrect_information' => 'Mot de passe ou email incorrect.',
        ]);
    }


    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }


    public function confirmEmail($token)
    {
        $user = User::where('confirmation_token', $token)->firstOrFail();
        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();
        return redirect('/login')->with('success', 'Votre adresse e-mail a été confirmée avec succès.');
    }

    public function password_reset_view()
    {
        return view('auth.pages.forget_password_request');
    }




    public function password_reset(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.required' => 'Le champ Adresse e-mail est obligatoire.',
            'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            'email.exists' => 'L\'adresse e-mail n\'existe pas dans notre système.',
        ]);


        // Vérifier si le jeton existe dans la table "password_resets"
        $token = Str::random(60);

        $tokenData = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if (!$tokenData) {
            DB::table('password_reset_tokens')->insert(
                ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
            );
        } else {
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update(['token' => $token, 'created_at' => now()]);
        }

        //envoie mail
        $user = User::where('email', $request->email)->first();
        $user->notify(new ForgetPasswordNotification($token));
        return view('auth.pages.password_forget_message', ['email' => $request->email]);
    }
    public function change_password_view($token)
    {
        // Vérifier si le jeton existe dans la table "password_resets"
        $tokenData = DB::table('password_reset_tokens')->where('token', $token)->first();
        if (!$tokenData) {
            // Le jeton n'existe pas dans la table
            return redirect()->back()->withErrors(['token' => 'Jeton de réinitialisation de mot de passe invalide']);
        }

        // Vérifier si le jeton a expiré
        if (Carbon::parse($tokenData->created_at)->addMinutes(60)->isPast()) {
            // Le jeton a expiré
            return redirect()->back()->withErrors(['token' => 'Jeton de réinitialisation de mot de passe expiré']);
        }
        return view('auth.pages.password_reset', ['token' => $token]);
    }

    public function change_password(Request $request)
    {
        $credentials = $request->validate([
            'password' => ['required'],
            'password2' => ['required', 'same:password'],
            'token' => ['required', 'exists:password_reset_tokens,token'],
        ], [
            'password.required' => 'Le champ Mot de passe est obligatoire.',
            'password2.required' => 'Le champ Confirmation du mot de passe est obligatoire.',
            'password2.same' => 'Les mots de passe ne correspondent pas.',
            'token.required' => 'Le jeton de réinitialisation du mot de passe est obligatoire.',
            'token.exists' => 'Le jeton de réinitialisation du mot de passe n\'est pas valide.',
        ]);

        $tokenData = DB::table('password_reset_tokens')->where('token', $request->token)->first();


        $user = User::where('email', $tokenData->email)->firstOrFail();

        $user->password = Hash::make($request->input('password'));
        $user->save();
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();
        return view('auth.pages.change_password_success');
    }

    public function update_email(Request $request)
    {
        $credentials = $request->validate([
            'old_email' => ['required'],
            'new_email' => ['required'],
            'new_email2' => ['required', 'same:new_email'],
            'password' => ['required'],
            'check' => ['required'],

        ], [
            'password.required' => 'Le champ Mot de passe est obligatoire.',
            'old_email.required' => 'Le champ Ancien email  est obligatoire.',
            'new_email.required' => 'Le champ Nouveau email est obligatoire.',
            'new_email2.required' => 'Le champ Confirmer email est obligatoire.',
            'check.required' => 'Vous devez cocher',
            'new_email2.same' => 'Les emails ne correspondent pas.',
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            'email' => $request->new_email
        ]);
        return redirect()->back()->with('success', 'Email modifié avec succès');
    }

    public function delete_account_view()
    {
        return view(('auth.pages.delete_account'));
    }
    public function delete_account(Request $request)
    {

        $credentials = $request->validate([
            'confirm' => ['required'],
            'password' => ['required'],
            'check' => ['required'],

        ], [
            'password.required' => 'Le champ Mot de passe est obligatoire.',
            'confirm.required' => 'Entrez supprimer/*** pour confirmer',
            'check.required' => 'Vous devez cocher',
        ]);
        $user = User::findOrFail(auth()->user()->id);
        $confirm_tag = 'supprimer/' . $user->last_name;
        if (Hash::check($request->input('password'), $user->password) && $confirm_tag == $request->input('confirm')) {

            $events = Event::where('user_id', $user->id)->get();

            foreach ($events as $event) {
                $images = $event->images()->get();
                foreach ($images  as $image) {
                    $image->delete();
                }
                $event->delete();
            }

            $offers = Offer::where('user_id', $user->id)->get();
            foreach ($offers as $offer) {
                $images = $offer->offer_images()->get();
                foreach ($images  as $image) {
                    $image->delete();
                }
                $offer->delete();
            }

            $menus = Menu::where('user_id', $user->id)->get();

            foreach ($menus as $menu) {
                $images = $menu->images()->get();
                foreach ($images  as $image) {
                    $image->delete();
                }

                $plats = $menu->plats()->get();
                foreach ($plats as $plat) {

                    $menu_dish= MenuDish::where('dish_id',$plat->id)
                ->where('menu_id',$menu->id)
                ->delete();
                }

            $menu->delete();

            }
            $plats=Dish::where('user_id', $user->id)->get();
            foreach ($plats  as $plat) {
                $plat->delete();
            }

            $profil = Profil::where('user_id', $user->id)->first();
            $profil_images = $profil->images()->get();
            foreach ($profil_images as $image) {
                $image->delete();
            }
            $profil->delete();
            auth()->logout();
            $user->delete();
            return redirect(route('landing.accueil.accueil'));
        } else {
            return redirect()->back()->withErrors(['infos' => 'Le mot de passe ou le texte entré est incorrect']);
        }
    }
}
