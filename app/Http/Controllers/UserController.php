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
     * Update API Settings (social media usernames)
     * Example url: updateUserAPI?facebook={facebook}&instagram={instagram}&twitter={twitter}
     * @return Response
     */
    public function updateAPISettings(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->facebook = $request->input('facebook');
        $user->instagram = $request->input('instagram');
        $user->twitter = $request->input('twitter');
        $user->save();
        return redirect('settings');
    }
}