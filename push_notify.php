<?php
function sendGCM($message,$device_id){
#API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'AAAACKAnJ1Q:APA91bGhMWeEepIoyTZ0swyCkY1X3gTdQAP1Z0OQ2C_34A7VgVjgSMpcn8FgZMMswWB97c1IrH6BHYuCTcLjPmvJAvyjIjMcIrIv-S9VRkNCjVtLU-fbBRlecl9Kw0dBATANSSofwL2D' );
    $registrationIds = $device_id;
    #prep the bundle
     $msg = $message;
	$fields = array
			(
				'to'		=> $registrationIds,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . 'AIzaSyCOgx1VGp0Ctjl5CyP5ASRmpDfHfE1ivyM',
				'Content-Type: application/json'
			);
#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
#Echo Result Of FireBase Server
//echo $result;

}


?>