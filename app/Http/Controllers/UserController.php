<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * update general user settings
     * Example url: updateUserGeneral?name={name}&email={email}&password={password}
     * @return Response
     */
    public function updateGeneralSettings(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('password') != ""){
            $user->password = $request->input('password');
        }
        $user->save();
        return redirect('settings');
    }

    /**
     * Update Social Settings (social media usernames)
     * Example url: updateSocialSettings?facebook={facebook}&instagram={instagram}&twitter={twitter}
     * @return Response
     */
    public function updateSocialSettings(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->facebook = $request->input('facebook');
        $user->instagram = $request->input('instagram');
        $user->twitter = $request->input('twitter');
        $user->save();
        return redirect('settings');
    }

    /**
     * Update API Keys (social media usernames)
     * Example url: updateAPISettings?fb_api_key={fb_api_key}&fb_api_secret={fb_api_secret}
     * @return Response
     */
    public function updateAPISettings(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->fb_api_key = $request->input('fb_api_key');
        $user->fb_api_secret = $request->input('fb_api_secret');
        $user->save();
        return redirect('settings');
    }
}