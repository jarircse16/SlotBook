<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\LatestResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\SMTP;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

class SlotUpdateController extends Controller
{
    public function testPHPMailer($UserMail, $UserSubject, $UserMessage)
    {

        try {

            $email = $UserMail;
            $subject = $UserSubject;
            $message = $UserMessage;

            $mail = new PHPMailer((bool) env('MAIL_SENDING_ENABLED'), true);
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP();      // Set mailer to use SMTP
            //$mail->Host = 'smtp.gmail.com';
            $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');       // Specify main and backup SMTP servers
            $mail->SMTPAuth = (bool) env('MAIL_SMTP_AUTH', true);           // Enable SMTP authentication
            $mail->Username = env('MAIL_USERNAME', 'abdurrrouf4530@gmail.com');
            $mail->Password = env('MAIL_APP_PASSWORD', 'xahf xjck ptsn ssqz');
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'ssl');
            $mail->Port = env('MAIL_PORT', 465);

            //Sender Email
            $mail->setFrom(env('MAIL_FROM_ADDRESS', 'abdurrrouf4530@gmail.com'));

            //Recepient
            $mail->addAddress($email);    // Add a recipient
            $mail->addReplyTo(env('MAIL_REPLY_TO', 'abdurrrouf4530@gmail.com'));

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients without debug';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
        }
    }

    public function fetchSlotUpdate(): JsonResponse
    {
        // URL of the external API
        $url = 'https://slotbot.zubayer.one/update';

        // Fetch the data using Laravel's Http client (alternative to cURL)
        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data from external API'], 500);
        }

        $jsonData = $response->body();

        // Check if there's any existing data
        $latestResponse = LatestResponse::latest()->first();

        if (! $latestResponse || $latestResponse->json_data !== $jsonData) {
            // If no data or data is different, save new data
            LatestResponse::create(['json_data' => $jsonData]);

            $decodedData = json_decode($jsonData, true);

            $users = Email::all(); // Retrieve all email entries

            foreach ($users as $user) {
                // Prepare the message
                $userMessage = 'Here is your new slot date(s): '.$decodedData['slot_date']."\nLast Updated: ".$user->updated_at;
                $userSubject = 'New Slot Date';

                // Send email using the existing function
                $this->testPHPMailer($user->email, $userSubject, $userMessage);
                $this->clearCache();
            }
        }

        // Decode JSON data for output if needed
        return response()->json(json_decode($jsonData, true));
    }

    public function clearLogs()
    {
        try {
            // Call the log:clear Artisan command
            Artisan::call('log:clear');
        } catch (\Exception $e) {

        }
    }

    public function clearCache()
    {
        // Clear the application cache
        Artisan::call('cache:clear');

        // Clear the compiled views cache
        Artisan::call('view:clear');

        // Clear the configuration cache
        Artisan::call('config:clear');

        // Clear the route cache
        Artisan::call('route:clear');

        // Clear the event cache
        Artisan::call('event:clear');

        // Clear all cached optimization files
        Artisan::call('optimize:clear');

        //Clear the Log Files
        $this->clearLogs();

        return redirect('/')->with('success');
    }
}
