<?php
    // Checks if form has been submitted
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     function post_captcha($user_response) {
    //         $fields_string = '';
    //         $fields = array(
    //             'secret' => '6LdbkqAUAAAAAAi6Ev63XZCwA9iSJaAba-W__FuE',
    //             'response' => $user_response
    //         );
    //         foreach($fields as $key=>$value)
    //         $fields_string .= $key . '=' . $value . '&';
    //         $fields_string = rtrim($fields_string, '&');

    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    //         curl_setopt($ch, CURLOPT_POST, count($fields));
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    //         $result = curl_exec($ch);
    //         curl_close($ch);

    //         return json_decode($result, true);
    //     }

    //     // Call the function post_captcha
    //     $res = post_captcha($_POST['g-recaptcha-response']);

    //     if (!$res['success']) {
    //         // What happens when the CAPTCHA wasn't checked
    //         echo '<p>Veuillez revenir en arrière et cocher le CAPTCHA !</p><br>';
    //     } else {
    //         // If CAPTCHA is successfully completed...

    //         // Paste mail function or whatever else you want to happen here!
    //         echo '<br><p>CAPTCHA was completed successfully!</p><br>';
    //     }
    // } else { 
    //     // Not a POST request, set a 403 (forbidden) response code.
    //     http_response_code(403);
    //     echo "There was a problem with your submission, please try again.";
    // }
?>



<?php
$errorMSG = "";
// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}
// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}
// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}
$EmailTo = "alexlaptran@gmail.com";
$Subject = "Vous avez reçu un nouveau mesage de $name !";
// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";
// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);
// redirect to success page
if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}
?>
