<?php
    // Checks if form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        function post_captcha($user_response) {
            $fields_string = '';
            $fields = array(
                'secret' => '6LdbkqAUAAAAAAi6Ev63XZCwA9iSJaAba-W__FuE',
                'response' => $user_response
            );
            foreach($fields as $key=>$value)
            $fields_string .= $key . '=' . $value . '&';
            $fields_string = rtrim($fields_string, '&');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

            $result = curl_exec($ch);
            curl_close($ch);

            return json_decode($result, true);
        }

        // Call the function post_captcha
        $res = post_captcha($_POST['g-recaptcha-response']);

        if (!$res['success']) {
            // What happens when the CAPTCHA wasn't checked
            echo '<p>Veuillez revenir en arrière et cocher le CAPTCHA !</p><br>';
        } else {
            // If CAPTCHA is successfully completed...

            // Paste mail function or whatever else you want to happen here!
            echo '<br><p>CAPTCHA was completed successfully!</p><br>';
        }
    } else { 
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }
?>

<?php

$email = '';
$message = '';
$name ='';
$error ='';

if(isset($_POST['submit'])){
    // echo '<h1>Submit Clicked !!!! '.$_POST['submit'].'</h1>';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if(!$_POST['name']){ $error .= 'Entrez votre nom et prénom ! <br>'; }
    if(!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ $error .= 'Entrez votre courriel ! <br>'; }
    if(!$_POST['message']){ $error .= 'Ecrivez un message ! <br>'; }
    }  
    

    if($error == ''){
        $from = '';
        $to =   ''; // email that you want to receive the email to. YOUR ADDRESS
        $subject = 'Message reçu venant du site Body Academy Paris';
        $body = "De: $name ($email) \n Message \n $message";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";  
        if(mail($to,$subject,$body,$headers)){
        $result = '<div class="alert alert-success">Votre message a été envoyé</div>';  
            }else{
                $result = '<div class="alert alert-danger">Votre message n\'a été envoyé</div>';    
            }
        $email = '';
        $message = '';
        $name ='';
        
        // Send email
    } else {
        $result = '<div class="alert alert-danger">Error Found:<br>'.$error.'</div>';
    }
}
?>