<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\CommunityMember;
use App\Models\ImageOffer;
use App\Notifications\UserAlert;
use Illuminate\Http\Request;
use App\Models\AppNotificationToken;
use Notification;

class OfferController extends Controller
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
    public function my_offers()
    {
        $menus=Offer::where('user_id',auth()->user()->id)->get();
        return response()->json(['offers' =>$menus]);

        //
    }


    public function updateDates(Request $request, $id) {
        $offer = Offer::find($id);
        if (!$offer) {
            return response()->json(['error' => 'Offer not found'], 404);
        }

        if ($request->has('start_date')) {
            $offer->start_date = $request->input('start_date');
        }
        if ($request->has('end_date')) {
            $offer->end_date = $request->input('end_date');
        }
        $offer->save();

        return response()->json(['success' => true]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $credentials = $request->validate([
            'title'=>['required'],
            'description'=>['required'],
            'start_date'=>['required'],
            'end_date'=>['required','date','after:start_date'],
            'images_offer'=>['required'],

        ],[
            'title.required'=>'Le champ titre est requis',
            'description.required'=>'Le champ description est requis.',
            'start_date.required'=>'Le champ date début est requis',
            'end_date.required'=>'Le champ date fin est requis',
            'end_date.after'=>'La date fin ne peut être antérieure à la date de début',
            'images_offer.required'=>'Le champ images est requis. Vous devez ajouter au moins une image',

        ]);

        $offre=Offer::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'user_id' => auth()->user()->id

        ]);

        $is_principal = true;
        if ($request->hasFile('images_offer')) {
            $files = $request->file('images_offer');
            foreach ($files as $file) {
                $path = $file->store('public/offers_images');
                $offer_image = ImageOffer::create(
                    [
                        'offer_id' => $offre->id,
                        'file_url' => $path,
                        'status' => $is_principal ? 1 : 0
                    ]
                );
                $is_principal = false;
            }
        }
        // $users=CommunityMember::all();
        $title='Nouvelle offre';
        $body=$offre->user->profil()->name.' a ajouté une nouvelle offre promotionnelle';
        $url=route('landing.offers.detail',['id'=>$offre->id]);
        // foreach ($users as $user) {
        //         $user->notify(new UserAlert($title,$body,$url) );
        // }
        $this->sendPushNotification($title,$body,$url);

        return redirect()->back()->with('success', 'L\'offre a été ajoutée avec succès. Vous pouvez désormais la voir dans votre calendrier');
    }

   public function update(Request $request,$id)
   {
    $credentials = $request->validate([
        'title'=>['required'],
        'description'=>['required'],
        'start_date'=>['required'],
        'end_date'=>['required','date','after:start_date'],

    ],[
        'title.required'=>'Le champ titre est requis',
        'description.required'=>'Le champ description est requis.',
        'start_date.required'=>'Le champ date début est requis',
        'end_date.required'=>'Le champ date fin est requis',
        'end_date.after'=>'La date fin ne peut être antérieure à la date de début',


    ]);
    $offre=Offer::findOrFail($id);
    if($offre->user_id==auth()->user()->id)
    {
        $offre=$offre->update(
            [
                'titre'=>$request->title,
                'description'=>$request->description,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
            ]
            );
        return back()->with('success', 'L\'offre a été modifiée avec succès !');

    }else{
        abort(403);
    }

   }


   public function delete($id)
   {

    $offre=Offer::findOrFail($id);
    if($offre->user_id==auth()->user()->id)
    {
        $offre->offer_images()->delete();

        $offre->delete();
        return back()->with('success', 'L\'offre a été supprimée avec succès !');
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
       $offre=Offer::findOrFail($id);
       if($offre->user_id!=auth()->user()->id){
           return redirect()->back()->with('error', 'Offer not found');
           }
       $offer_image=ImageOffer::create([
           'offer_id'=>$offre->id,
           'status'=>'0',
           'file_url'=>$request->file('image')->store('public/offer_images')
       ]);
       return redirect()->back()->with('success', 'Image ajoutée avec succès');
   }
   public function delete_image($id)
   {
       $offer_image=ImageOffer::findOrFail($id);
       if($offer_image->offer->user_id!=auth()->user()->id){
           abort(403);
       }
       $offer_image->delete();
       return redirect()->back()->with('success', 'Image supprimée avec succès');
   }

   public function update_image( $id,Request $request)
   {
       $validatedData = $request->validate([
           'image' => 'required|file',
       ],[
           'image.required' => 'Les images sont réquises.',
       ]);
       $offer_image=ImageOffer::findOrFail($id);
       if($offer_image->offer->user_id!=auth()->user()->id){
           abort(403);
       }
       $offer_image->update([
           'file_url'=>$request->file('image')->store('public/offer_images')
       ]);
       return redirect()->back()->with('success', 'Image modifiée avec succès');
   }

}
