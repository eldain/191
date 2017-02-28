<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\MyFacebookApi;
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
        $request->session()->flash('alert-success', 'User settings updated!');
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
        // Facebook
        $user->facebook = $request->input('facebook');
        try{
            $fb = new MyFacebookApi();
            $fb->getPageLikeCount($user->facebook, $user->fb_api_key, $user->fb_api_secret);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', 'Facebook Page name: ' . $user->facebook 
                . ' does exists. Changes not saved');
            return redirect('settings');
        }
        $user->instagram = $request->input('instagram');
        $user->twitter = $request->input('twitter');
        $user->save();
        $request->session()->flash('alert-success', 'Facebook, Instagram, and Twitter updated succesfully!');
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
        try{
            $fb = new MyFacebookApi();
            $fb->getPageLikeCount($user->facebook, $user->fb_api_key, $user->fb_api_secret);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', 'Facebook app key: ' . $user->fb_api_key .
                ' and secret key: ' . $user->fb_api_secret . ' do not exist. Changes not saved');
            return redirect('settings');
        }
        $user->save();
        $request->session()->flash('alert-success', 'Api keys updated!');
        return redirect('settings');
    }
}