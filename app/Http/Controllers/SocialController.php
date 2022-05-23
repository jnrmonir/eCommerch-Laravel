<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    // public function redirectToProvider()
    // {
    //     return Socialite::driver('github')->redirect();
    // }

    // /**
    //  * Obtain the user information from GitHub.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function handleProviderCallback()
    // {
    //     $user = Socialite::driver('github')->user();

    //     echo $user->getId();
    //     echo "<br>";
    //     echo $user->getNickname();
    //     echo "<br>";
    //     echo $user->getName();
    //     echo "<br>";
    //     echo $user->getEmail();
    //     echo "<br>";
    //     echo $user->getAvatar();
    // }
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
            if($user_check=User::where('provider_id',$user->getId())->first()){
                Auth::login($user_check,true);

                return redirect(route('dashboard'));
            }
            elseif(User::where('email',$user->getEmail())->first()){
                return "Already Registered this email";
            }
            else{
                $data= new User;
                $data->name=$user->getName();
                $data->email=$user->getEmail();
                $data->provider='github';
                $data->provider_id=$user->getId();
                $data->save();

                Auth::login($data,true);
                return redirect(route('dashboard'));
            }
        
        // return "Registered";
    }

    public function googleredirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function googlehandleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
            if($user_check=User::where('provider_id',$user->getId())->first()){
                Auth::login($user_check,true);

                return redirect(route('dashboard'));
            }
            elseif(User::where('email',$user->getEmail())->first()){
                return "Already Registered this email";
            }
            else{
                $data= new User;
                $data->name=$user->getName();
                $data->email=$user->getEmail();
                $data->provider='google';
                $data->provider_id=$user->getId();
                $data->save();

                Auth::login($data,true);
                return redirect(route('dashboard'));
            }
    }
    
    
}
