<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\SMSGatewayServices;
use App\Http\Services\VerificationServices;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $smsService;

    public $smsAdapter;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VerificationServices $smsService)
    {
        $this->middleware('guest');
        $this->smsService = $smsService;

        $this->smsAdapter=(SMSGatewayServices::getServiceAdapter('egypt'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        $verification = [];
        $user = User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // set new code && save this code in user_verifications table
        $verification['user_id'] = $user->id;
        $verificationData = $this->smsService->setVerificationCode($verification);
        $message= $this->smsService->getSMSVerifyMessageByAppName($verificationData->code);

        // sent code to user mobile by sms gateway && note there are gateway credentials in config file
       // app(ISMS::class)->sendSMS($user->mobile,$message);

        return $user;

    }
}
