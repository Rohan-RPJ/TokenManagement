<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Students;
use App\Teachers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(array_search('Register', $data) == 'sRegister'){
            $data['email'] = $data['sEmail'];       
            return Validator::make($data, [
            'sEmail' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'sRollNo' => ['required', 'integer',
                Rule::unique('students')->where(function ($query) use($data) {
                    $query->where('sYear', $data['sYear'])->where('sBranch', $data['sBranch']);
                })
            ],

        ]);
            //dd($validator->fails());
        }
        elseif (array_search('Register', $data) == 'tRegister') {
            $data['email'] = $data['tEmail'];      
            return Validator::make($data, [
            'tEmail' => ['required', 'string', 'email', 'max:255', 'unique:teachers'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if(array_search('Register', $data) == 'sRegister'){


            $user = User::create([
                'email' => $data['sEmail'],
                'password' => Hash::make($data['sPassword']),
                'type' => 'Student',
            ]);

            Students::create([
            'sName' => $data['sName'],
            'sEmail' => $data['sEmail'],
            'sYear' => $data['sYear'],
            'sBranch' => $data['sBranch'],
            'sRollNo' => $data['sRollNo'],
            ]);
            
        }
        elseif (array_search('Register', $data) == 'tRegister') {
            
            $user = User::create([
                'email' => $data['tEmail'],
                'password' => Hash::make($data['tPassword']),
                'type' => 'Teacher',
            ]);
            Teachers::create([
            'tName' => $data['tName'],
            'tEmail' => $data['tEmail'],
            //'tBranch' => $data['tBranch'],
            ]);

        }
        return $user;
    }
}
