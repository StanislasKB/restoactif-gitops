<?php

namespace App\Console\Commands;

use App\Models\AppNotificationToken;
use App\Models\CommunityMember;
use App\Models\User;
use App\Notifications\UserAlert;
use Illuminate\Console\Command;
use Google_client;

class NotifyCommnunityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-commnunity-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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

        $test_data = [
            "title" => "TITLE_HERE",
            "description" => "DESCRIPTION_HERE",
        ];

        $tokens = AppNotificationToken::all();

        foreach ($tokens as $token) {
            $data = [
                "notification" => $test_data,
                "token" => $token->token
            ];
            $payload = [
                'message' => $data
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
                $this->error('Curl error: ' . curl_error($ch));
            }

            curl_close($ch);
        }

        $this->info('Notifications have been sent');
    }
}
