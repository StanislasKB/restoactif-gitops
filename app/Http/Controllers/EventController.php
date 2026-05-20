<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\CommunityMember;
use App\Models\ImageEvent;
use App\Models\User;
use App\Notifications\UserAlert;
use Illuminate\Http\Request;
use App\Models\AppNotificationToken;
use Notification;
class EventController extends Controller
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
    public function my_events()
    {
        $menus=Event::where('user_id',auth()->user()->id)->get();
        return response()->json(['events' =>$menus]);

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( Request $request)
    {
         // Validation des données entrées par l'utilisateur
         $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'address' => 'required|string',
            'images' => 'required',
        ],[
            'title.required' => 'Le champ titre est requis.',
            'description.required' => 'Le champ description est requis.',
            'start_date.required' => 'Le champ start_date est requis.',
            'end_date.required' => 'Le champ end_date est requis.',
            'address.required' => 'Le champ address est requis.',
            'images.required' => 'Les images sont réquises.',
        ]);




        $event = Event::create([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'address' => $request->address,
            'user_id' => auth()->user()->id
        ]);

        $is_principal = true;
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $path = $file->store('public/products_images');
                $event_image = ImageEvent::create(
                    [
                        'event_id' => $event->id,
                        'file_url' => $path,
                        'status' => $is_principal ? 1 : 0
                    ]
                );
                $is_principal = false;
            }
        }
        // $users=CommunityMember::all();
        $title='Nouveau évènement';
        $body=$event->user->profil()->name.' a ajouté un nouvel évènement';
        $url=route('landing.events.detail',['id'=>$event->id]);
        // foreach ($users as $user) {
        //         $user->notify(new UserAlert($title,$body,$url) );
        // }
        $this->sendPushNotification($title,$body,$url);

        return redirect()->back()->with('success', 'Evènement ajouté avec succès');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update( Request $request,$id)
    {
        $event=Event::findOrFail($id);

        //remove event

        if($event->user_id!=auth()->user()->id){
        return redirect()->back()->with('error', 'Event not found');
        }
         // Validation des données entrées par l'utilisateur
         $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'address' => 'required|string'
        ],[
            'title.required' => 'Le champ titre est requis.',
            'description.required' => 'Le champ description est requis.',
            'start_date.required' => 'Le champ start_date est requis.',
            'end_date.required' => 'Le champ end_date est requis.',
            'address.required' => 'Le champ address est requis.',
            'images.required' => 'Les images sont réquises.',
        ]);




        $event = $event->update([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'address' => $request->address,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->back()->with('success', 'Evènement ajouté avec succès');
    }

    /**
     * Update the specified resource in storage.
     */

     public function updateDates(Request $request, $id) {
        $event = Event::find($id);
        if ($request->has('start_date')) {
            $event->start_date = $request->input('start_date');
        }
        if ($request->has('end_date')) {
            $event->end_date = $request->input('end_date');
        }
        $event->save();
        return response()->json(['success' => true]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete( $id)
    {
        $event=Event::findOrFail($id);

        //remove event

        if($event->user_id!=auth()->user()->id){
        return redirect()->back()->with('error', 'Event not found');
        }

        $event->images()->delete();
        $event->delete();

        return redirect()->back()->with('success', 'Evènement supprimé avec succès');
    }

    public function add_image( $id,Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|file',
        ],[
            'image.required' => 'Les images sont réquises.',
        ]);
        $event=Event::findOrFail($id);
        if($event->user_id!=auth()->user()->id){
            return redirect()->back()->with('error', 'Event not found');
            }
        $event_image=ImageEvent::create([
            'event_id'=>$event->id,
            'status'=>'0',
            'file_url'=>$request->file('image')->store('public/event_images')
        ]);
        return redirect()->back()->with('success', 'Image ajoutée avec succès');
    }
    public function delete_image($id)
    {
        $event_image=ImageEvent::findOrFail($id);
        if($event_image->event->user_id!=auth()->user()->id){
            abort(403);
        }
        $event_image->delete();
        return redirect()->back()->with('success', 'Image supprimée avec succès');
    }

    public function update_image( $id,Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|file',
        ],[
            'image.required' => 'Les images sont réquises.',
        ]);
        $event_image=ImageEvent::findOrFail($id);
        if($event_image->event->user_id!=auth()->user()->id){
            abort(403);
        }
        $event_image->update([
            'file_url'=>$request->file('image')->store('public/event_images')
        ]);
        return redirect()->back()->with('success', 'Image modifiée avec succès');
    }
}
