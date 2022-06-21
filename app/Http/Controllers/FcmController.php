<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FcmController extends Controller
{
    public function  index(){
        return view('fcm');
    }
    public function send()
    {
        $token = '';
        $from = 'AAAA1fL8i4M:APA91bEjxMSkp-Q1EW0Co6C5AWZBkaQNF4GzIFLwcRb3CQBaLasBiX-zhutVbzuFJe3uzhIWpGCpGEvcNFzA4q9C1Sk8g7Hjl_9tdu3ZdqLa1NnD9EQDIEp5PzlD6F6wJuXS2uDH-fCO
';
        $msg = array
        (
            'body' => 'Testing Testing',
            'title' => 'Hi, From Raj',
            'receiver' => 'erw',
            'icon' => 'https://image.flaticon.com/icons/png/512/270/270014.png',/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array
        (
            'to' => $token,
            'notification' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . $from,
            'Content-Type: application/json'
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        dd($result);
        curl_close($ch);
    }
}

