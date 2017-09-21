<?php 
namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMailTemplate;
use Mail;
use App\Emailtemplate;

class UpdatePasswordController extends Controller
{
    /*
     * Ensure the user is signed in to access this page
     */
    public function __construct() {

        $this->middleware('auth');

    }

    /**
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Auth::id());
        $hashedPassword = $user->password;

        if (Hash::check($request->old, $hashedPassword)) {
            //Change the password
            $user->fill([ 'password' => Hash::make($request->password) ])->save();

            $emailtemplate = Emailtemplate::where('keyword','Change Password')->first();
            
            $to_email = Auth::user()->email;
            // $to_email = 'tejas.sassyinfotech@gmail.com';

            // $test = Mail::to($to_email)->send(new SendMailTemplate);

            Mail::send([],[], function($message) use ($emailtemplate,$request)
            { 
                $message->to(Auth::user()->email)->subject($emailtemplate->subject);
                $message->setBody( $emailtemplate->content, 'text/html');
            });

            $request->session()->flash('success', 'Your password has been changed.');

            return back();
        }

        $request->session()->flash('failure', 'Your old password is wrong.');

        return back();


    }
}