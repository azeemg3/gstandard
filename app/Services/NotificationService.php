<?php

namespace App\Services;
use App\Models\User;

/**
 * Class NotificationService.
 */
class NotificationService
{
    public function send_notification($data, $user_id){
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::find($user_id);


        $serverKey = 'AAAA0o1MsA0:APA91bFi32QSlwa3Lf1Wldewu_EjnWLqCnicVoYeE3xusPod9XrakFU3QU33e4B2b68OXr0ih9kd2OOZMoVEKRADPDSNJaCmyWZycuj_VDU9P-wbRtLj58qUocQfbHD3LdFCCaaipt_F'; // ADD SERVER KEY HERE PROVIDED BY FCM

        $data = [
            "registration_ids" => [$FcmToken->device_token],
            "notification" => [
                "title" => $data['title'],
                "body" => $data['body'],
            ],
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === false) {
            //die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        //dd($result);
    }
}
