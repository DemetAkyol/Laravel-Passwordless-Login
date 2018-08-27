<?php


namespace App\Auth\Traits;

use App\Http\Requests;
use App\Models\UserLoginCode;
use infobip;

trait SmsAuthenticatable
{
  //not used

    public function generateCode()
    {
        $codeLength = 4;
        $min = pow(10, $codeLength);
        $max = $min * 10 - 1;
        $code = mt_rand($min, $max);

        return $code;
    }


    public function storeCode()
    {$codeLength = 4;
        $min = pow(10, $codeLength);
        $max = $min * 10 - 1;

        $this->tokenCode()->delete();
        $this->tokenCode()->create([

            'LoginCode' => rand($min,$max),
        ]);

        return $this;

    }

    public function tokenCode()
    {

        return $this->hasOne(UserLoginCode::class);

    }


    public function sendVerfCode(array $data)
    {


        $code = $this->tokenCode->LoginCode;
        $msg = "{ " . $code . "} Aktivasyon kodunuz";
        $client = new infobip\api\client\SendSingleTextualSms(new infobip\api\configuration\BasicAuthConfiguration('hediyesepeti', 'hk159753'));
        $requestBody = new infobip\api\model\sms\mt\send\textual\SMSTextualRequest();
        $requestBody->setFrom('HDY SEPETI');
        $requestBody->setTo($data['phone']);
        $requestBody->setText($msg);
        try {
           // dd($msg);
            $response = $client->execute($requestBody);
            $sentMessageInfo = $response->getMessages()[0];
            echo "Msg:" . $msg . "\n";
            echo "Message ID: " . $sentMessageInfo->getMessageId() . "\n";
            echo "Receiver: " . $sentMessageInfo->getTo() . "\n";
            echo "Message status: " . $sentMessageInfo->getStatus()->getName();

        } catch (Exception $exception) {
            echo "HTTP status code: " . $exception->getCode() . "\n";
            echo "Error message: " . $exception->getMessage();
        }

    }

}