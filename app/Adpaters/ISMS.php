<?php

namespace App\Adpaters;

interface ISMS
{
    public function sendSMS($phone,$message,$lang);

}
