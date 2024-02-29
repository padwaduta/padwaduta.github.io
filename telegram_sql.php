<?php 
$content = file_get_contents("php://input");
if($conten)
{
    $token = '7181881405:AAGwYngR8zvZR9rLjBQ41vGfGMPZhDm_CQk'

    $apilink="https://api.telegram.org/bot$token";

    $update = file_get_contents('php://input');
    $val = json_decode($update, TRUE);

    $chat_id = $val['message']['chat']['id'];
    $text = $val['message']['text'];
    $update_id + $val['message']['from'];
    $uid=$val ['message']['from']['username'];
    $uid_stat=$val['message']['chat']['type'];

    $databaseHost = 'localhost';
    $databaseName = 'database_proyek';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqi = mysqli_connect($databaseHost, $databaseName, $databaseUsername, $databasePassword);
    $getpendaftaran = mysqli_query($mysqli,"select * from database_proyek where chat_id='$chat_id");
    $getdata=mysqli_fecht_array($getpendaftaran);

    if (($getdata['id']=='') || ($getdata['nama']=='') || ($getdata['alamat']=='') || ($getdata['agama']==''))
    {
        if(($text=='/daftar') and ($getdata['id']==''))
        {
            $reply.="Masukkan nama anda :";
            $key = ['remove_keyboard' => true,];
            sendTyping($apilink, $chat_id);
            sendMessage($key,$apilink, $char_id, $reply);
        }
        elseif ($getdata['nama']=='');
        {
            mysqli_query($mysqli, "insert into database_proyek value ('','$text','','',$chat_id)");
            $reply.="Alamat :";
            $key = ['remove_keyboard'=>true,];
            sendTyping($apilink, $chat_id);
            sendMessage($key, $apilink, $chat_id, $reply);
        }
        else if ($getdata['alamat']=='')
        {
            mysqli_query($mysqli, "update database_proyek set alamat='$text' where chat_id='$chat_id");
            $reply.="Agama: ";
            $key =['remove_keyboard'=>true,];
            sendTyping($apilink, $chat_id);
            sendMessage($key, $apilink, $chat_id, $reply);
        }
        else if ($getdata['agama']=='')
        {
            mysqli_query($mysqli, "update database_proyek set agama='$text' where chat_id='$chat_id");
            $reply.="Registrasi Berhasil!!";
            $key =['remove_keyboard'=>true,];
            sendTyping($apilink, $chat_id);
            sendMessage($key, $apilink, $chat_id, $reply);
        }
        else
        {
            $reply.="Anda telah terdaftar";
            $key =['remove_keyboard'=>true,];
            sendTyping($apilink, $chat_id);
            sendMessage($key, $apilink, $chat_id, $reply);
        }
    }
    else
    {
        $reply.="Anda Telah terdaftar";
        $key =['remove_keyboard'=>true,];
        sendTyping($apilink, $chat_id);
        sendMessage($key, $apilink, $chat_id, $reply);
    }           
}
function sendTyping($key, $chatid, $message){
    $encodedMarkup = json_encode($key);
    $message = urlencode($message);
    $ch = curl_init($website."/sendmessage?chat_id=$chatId&parse_mode=HTML&text=$message&reply_markup=$encodedMarkup");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    $result = curl_exec($ch);
    curl_close($ch);
}