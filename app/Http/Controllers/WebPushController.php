<?php

namespace App\Http\Controllers;

use App\Models\AppNotificationToken;
use App\Models\User;
use App\Notifications\UserAlert;
use Illuminate\Http\Request;
use Notification;
class WebPushController extends Controller
{
    //

    public function store(Request $request)
    {

        $credentials = $request->validate([
            'endpoint' => 'required',
            'keys.auth' => 'required',
            'keys.p256dh' => 'required'
        ]);

        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = User::find(auth()->user()->id);
        $user->updatePushSubscription($endpoint, $key, $token);

        return response()->json(['success' => true], 200);
    }

    public function push()
    {
        $user = User::find(auth()->user()->id);
        $user->notify(new UserAlert());
        return redirect()->back();
    }







    public function sendPushNotification()
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
        "title" => "Bienvenu",
        "body" => "Stanislas est un con",
    ];

    $tokens = AppNotificationToken::all();

    foreach ($tokens as $token) {
        $data=[
            "url" => "https://restoactif.com/login",];

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

}
