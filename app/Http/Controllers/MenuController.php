<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\CommunityMember;
use App\Models\Dish;
use App\Models\ImageMenu;
use App\Models\MenuDish;
use App\Notifications\UserAlert;
use Illuminate\Http\Request;
use App\Models\AppNotificationToken;
use Notification;



class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function sendPushNotification($title,$body,$url)
     {
         $credentialsFilePath = config_path("firebase/fcm.json");
         $client = new \Google_Client();
         $client->setAuthConfig($credentialsFilePath);
         $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
         $apiurl = 'https://fcm.googleapis.com/v1/projects/restoactif/messages:send';
         $client->fetchAccessTokenWithAssertion();
         $token = $client->getAccessToken();
         $access_token = $token['access_token'];

         $headers = [
             "Authorization: Bearer $access_token",
             'Content-Type: application/json'
         ];

         // Example data payload
         $test_data = [
             "title" => $title,
             "body" => $body,
         ];

         $tokens = AppNotificationToken::all();

         foreach ($tokens as $token) {
             $data=[
                 "url" => $url,];

             $noti_data = [
                 "notification" => $test_data,
                 "token" => $token->token,
                 'data'=>$data
             ];
             $payload = [
                 'message' => $noti_data
             ];
             $payloadJson = json_encode($payload);

             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $apiurl);
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadJson);
             $response = curl_exec($ch);

             if (curl_errno($ch)) {
                 // Handle curl error
                 error_log('Curl error: ' . curl_error($ch));
             }

             curl_close($ch);
         }

         return response()->json([
             'message' => 'Notification has been Sent'
         ]);
     }


    public function index()
    {
        //
    }

    public function my_menus()
    {
        $menus=Menu::where('user_id',auth()->user()->id)->get();
        return response()->json(['menus' =>$menus]);

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( Request $request)
    {
         // Validation des données entrées par l'utilisateur
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'images' => 'required',
            'dishes' => 'required',
        ],[
            'name.required' => 'Le champ name est requis.',
            'description.required' => 'Le champ description est requis.',
            'start_date.required' => 'Le champ start_date est requis.',
            'end_date.required' => 'Le champ end_date est requis.',
            'price.required' => 'Le champ price est requis.',
            'images.required' => 'Les images sont réquises.',
        ]);




        $menu = Menu::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => auth()->user()->id
        ]);

        $is_principal = true;
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $path = $file->store('public/products_images');
                $menu_image = ImageMenu::create(
                    [
                        'menu_id' => $menu->id,
                        'file_url' => $path,
                        'status' => $is_principal ? 1 : 0
                    ]
                );
                $is_principal = false;
            }
        }

        // add dishes
        foreach ($request->dishes as $dish_id) {
            $dish=Dish::find($dish_id);
            if($dish!=null){
                MenuDish::create([
                    'dish_id'=>$dish->id,
                    'menu_id'=>$menu->id
                ]);
            }

        }
        // $users=CommunityMember::all();
        $title='Nouveau menu spécial';
        $body=$menu->user->profil()->name.' a ajouté un nouveau menu spécial';
        $url=route('landing.menu.detail',['id'=>$menu->id]);
        // foreach ($users as $user) {
        //         $user->notify(new UserAlert($title,$body,$url) );
        // }
        $this->sendPushNotification($title,$body,$url);

        return redirect()->back()->with('success', 'Menu  ajouté avec succès');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function update( Request $request,$id)
    {
        $menu=Menu::findOrFail($id);

        //remove event

        if($menu->user_id!=auth()->user()->id){
        return redirect()->back()->with('error', 'Event not found');
        }
         // Validation des données entrées par l'utilisateur
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ],[
            'name.required' => 'Le champ name est requis.',
            'description.required' => 'Le champ description est requis.',
            'start_date.required' => 'Le champ start_date est requis.',
            'end_date.required' => 'Le champ end_date est requis.',
            'price.required' => 'Le champ price est requis.',
            'images.required' => 'Les images sont réquises.',
        ]);




        $menu = $menu->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->back()->with('success', 'Menu modifié avec succès');
    }

    /**
     * Update the specified resource in storage.
     */

     public function updateDates(Request $request, $id) {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        if ($request->has('start_date')) {
            $menu->start_date = $request->input('start_date');
        }
        if ($request->has('end_date')) {
            $menu->end_date = $request->input('end_date');
        }
        $menu->save();

        return response()->json(['success' => true]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function menu_dishes($id)
    {

        $menu=Menu::findOrFail($id);
        if($menu->user_id!=auth()->user()->id){
            abort(403);
        }

        $dishes=$menu->plats()->get();
        return response()->json(['dishes' =>$dishes]);
    }
    public function add_dish( $id,Request $request)
    {
        $validatedData = $request->validate([
            'dish' => 'required',
        ],[
            'dish.required' => 'Le plat est réquis.',
        ]);
        $menu=Menu::findOrFail($id);
        $dish=Dish::findOrFail($request->dish);
        if($menu->user_id!=auth()->user()->id){
            abort(403);
        }
        if($dish->user_id!=auth()->user()->id){
            abort(403);
        }

        MenuDish::create([
            'dish_id'=>$dish->id,
            'menu_id'=>$menu->id
        ]);
        return response()->json(['dish' =>$dish]);

    }


    public function delete_menu_dish($menu_id,$dish_id)
    {

        $menu=Menu::findOrFail($menu_id);
        $dish=Dish::findOrFail($dish_id);
        if($menu->user_id!=auth()->user()->id){
            abort(403);
        }
        if($dish->user_id!=auth()->user()->id){
            abort(403);
        }

       $menu_dish= MenuDish::where('dish_id',$dish->id)
                ->where('menu_id',$menu->id)
                ->delete();
        return response()->json(['dish' =>$dish]);

    }
    public function delete( $id)
    {
        $menu=Menu::findOrFail($id);

        //remove event

        if($menu->user_id!=auth()->user()->id){
        return redirect()->back()->with('error', 'Menu not found');
        }

        $plats=$menu->plats()->get();
        foreach ($plats as $plat) {
            $this->delete_menu_dish($menu->id,$plat->id);
        }
        $menu->images()->delete();
        $menu->delete();

        return redirect()->back()->with('success', 'Menu supprimé avec succès');
    }

    public function add_image( $id,Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|file',
        ],[
            'image.required' => 'Les images sont réquises.',
        ]);
        $menu=Menu::findOrFail($id);
        if($menu->user_id!=auth()->user()->id){
            return redirect()->back()->with('error', 'Event not found');
            }
        $event_image=ImageMenu::create([
            'menu_id'=>$menu->id,
            'status'=>'0',
            'file_url'=>$request->file('image')->store('public/event_images')
        ]);
        return redirect()->back()->with('success', 'Image ajoutée avec succès');
    }
    public function delete_image($id)
    {
        $menu_image=ImageMenu::findOrFail($id);
        if($menu_image->menu->user_id!=auth()->user()->id){
            abort(403);
        }
        $menu_image->delete();
        return redirect()->back()->with('success', 'Image supprimée avec succès');
    }

    public function update_image( $id,Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|file',
        ],[
            'image.required' => 'Les images sont réquises.',
        ]);
        $menu_image=ImageMenu::findOrFail($id);
        if($menu_image->event->user_id!=auth()->user()->id){
            abort(403);
        }
        $menu_image->update([
            'file_url'=>$request->file('image')->store('public/menu_images')
        ]);
        return redirect()->back()->with('success', 'Image modifiée avec succès');
    }
}
