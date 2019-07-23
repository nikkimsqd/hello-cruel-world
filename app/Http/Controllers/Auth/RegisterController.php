<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Boutique;
use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/get-started';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showBoutiqueRegistrationForm()
    {
        return view('auth.registerseller');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'string|max:255',
            'lname' => 'string|max:255',
            'username' => 'required|string|max:255',
            'gender' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'boutiqueName' => 'string|max:255',
            'boutiqueAddress' => 'string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        if (!empty($data['fname'])) {

            return User::create([
                'fname' => ucwords($data['fname']),
                'lname' => ucfirst($data['lname']),
                'username' => $data['username'],
                // 'gender' => $data['gender'],
                'gender' => "Female",
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'roles' => "customer",
            ]);

        } else {

            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'roles' => "boutique",
            ]);

            $boutique = Boutique::create([
                'userID' => $user['id'],
                'boutiqueName' => $data['boutiqueName'],
                'boutiqueAddress' => $data['boutiqueAddress'],
                'contactNo' => $data['contactNo'],
                'status' => "Verified"
            ]);

            $address = Address::create([
                'userID' => $user['id'],
                'contactName' => $boutique['boutiqueName'],
                'phoneNumber' => $data['contactNo'],
                'completeAddress' => $data['boutiqueAddress'],
                'lat' => $data['lat'],
                'lng' => $data['lng'],
                'status' => "Default"
            ]);

            $boutique->update([
                'addressID' => $address['id']
            ]);


            $this->redirectTo = '/dashboard';

            return $user;
        }
    }
}
