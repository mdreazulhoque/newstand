<?php
namespace App\Http\Controllers;


class EmailController extends Controller {

    /**
     * Send email
     * @param  string  $to
     * * @param  string  $subject
     * * @param  string  $message
     */

    public function sendEmail($to, $subject, $message){

        $headers = 'From: admin@pms.com' . "\r\n" .
                   'Reply-To: admin@pms.com' . "\r\n" .
                   'MIME-Version: 1.0' . "\r\n" .
                   'Content-type: text/html; charset=ISO-8859-1' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }
    


}