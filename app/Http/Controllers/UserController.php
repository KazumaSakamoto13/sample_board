<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{




/**-------------------スレッド保存------------------------ */  
    public function show(User $user)
    {
        $user->load('posts');
        return view('users.show', [
            'user' => $user,
         

            ]);
    }


/**-------------------プロフィールページ遷移------------------------ */  
    public function pro(User $user)
    {
        return view('profile.index', [
            'user' => $user,
         

            ]);
       
    }




    /**-------------------プロフィールページ更新------------------------ */ 
    public function profile(Request $request)
    {  $this->validate($request,[

        'name'=>'required',
        'email'=> 'required|string|email|max:255|unique:users|regex:/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
    
    ]);
        $user_id = auth()->user()->id;
   		
        User::where('id',$user_id)->update([
          'name'=>request('name'),
         'email'=>request('email')
             ]);
             return redirect()->back();
    }





    public function softdelete()
    {
        User::find(Auth::id())->delete();

        return redirect('/register');
    }

}
