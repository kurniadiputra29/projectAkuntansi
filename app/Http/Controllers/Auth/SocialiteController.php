<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Traits\SocialCheckService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    use SocialCheckService;
    public function register($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function registered(Request $request, $provider)
    {
        if(isset($request->error))
            return redirect()
                ->to('auth.login.index');
        try {
            $userProvider = Socialite::driver($provider)->stateless()->user();
            $user = $this->checkUser($userProvider, $provider);
            auth()->login($user);
            return redirect()
                ->to('/dasbor');
            // $user->token;
        } catch (Exception $e) {
            return redirect()
                ->to('auth.login.index');
        }
    }
}
