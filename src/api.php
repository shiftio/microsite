<?php

class ApiClass {

    function login($username,$password,$hostname){

        $apiurl = "https://api.mediasilo.com/v3/session";

        $fields = array(
            'userName' => $username,
            'password' => $password,
            'accountName' => $hostname
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$apiurl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result=curl_exec($ch);
        curl_close ($ch);

        $resp = json_decode($result);

        return $resp;
    }

    function getUserInfo($hostname,$sessionkey){
        $apiurl = "https://api.mediasilo.com/v3/me/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$apiurl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("MediaSiloHostContext: " . $hostname, "MediaSiloSessionKey: " . $sessionkey));
        $result=curl_exec($ch);
        curl_close ($ch);
        return $result;
    }


    function getUserProjects($sessionkey,$hostname){

        $apiurl = "https://api.mediasilo.com/v3/projects/?_page=1&_pageSize=25&_sort=asc&_sortBy=name";


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$apiurl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("MediaSiloHostContext: " . $hostname, "MediaSiloSessionKey: " . $sessionkey));
        $result=curl_exec($ch);
        curl_close ($ch);

        return $result;
    }

    function getProject($projectid,$hostname,$sessionkey){
        global $phoenix;
        $apiurl = $phoenix."/projects/".$projectid;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$apiurl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("MediaSiloHostContext: " . $hostname, "MediaSiloSessionKey: " . $sessionkey));
        $result=curl_exec($ch);
        curl_close ($ch);
        return $result;
    }

    function getAssets($projectid,$sessionkey,$hostname){

        $apiurl = "https://api.mediasilo.com/v3/projects/".$projectid."/assets/?_page=1&_pageSize=50&_sort=asc&_sortBy=title";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$apiurl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("MediaSiloHostContext: " . $hostname, "MediaSiloSessionKey: " . $sessionkey));
        $result=curl_exec($ch);
        curl_close ($ch);
        return $result;
    }

    function getAsset($hostname,$assetid,$sessionkey){

        $apiurl = "https://api.mediasilo.com/v3/assets/".$assetid;


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$apiurl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("MediaSiloHostContext: " . $hostname, "MediaSiloSessionKey: " . $sessionkey));
        $result=curl_exec($ch);
        curl_close ($ch);

        return $result;
    }


}

?>
