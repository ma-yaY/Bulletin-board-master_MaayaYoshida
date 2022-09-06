<?php

namespace App\Http\Controllers\Auth\Register;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Users\User;

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
    public function getRegister()
    {
        return view('auth.register');
    }


        protected function validator(array $data)
    {
        return Validator::make($data, [

            'username' => 'required|string|min:2|max:12',
            'email' => 'required|string|min:5|max:40|unique:users,email',
            'password' => 'required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'required|string|min:8|max:20',
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
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),

        ]);
    }



        public function register(Request $request){

        if($request->isMethod('post')){
            $data = $request->input();

            $validator = $this->validator($data);

            if ($validator->fails()) {
            return redirect('/register')
            ->withErrors($validator)
            ->withInput();
            }else {
                $this->create($data);

            return redirect('added')->with('username', $data['username']);
            }
            //usernameデータも一緒にaddedを表示
            }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }

}
