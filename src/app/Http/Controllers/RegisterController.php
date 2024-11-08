<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvanceRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;

class RegisterController extends Controller
{
    use VerifiesUsers;

    public function sendVerificationEmail(User $user){
        $verificationUrl = url('/verification?email=' . urlencode($user->email) . '&token=' . $user->verification_token);
        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));
    }

    public function register(AdvanceRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => null,
            'verification_token' => Str::random(40),
        ]);
        $this->sendVerificationEmail($user);
        return redirect()->route('register')->with('status', '確認メールを送信しました。');
    }

    public function getVerification(){
        $token = request()->get('token');
        $email = request()->get('email');
        $user = User::where('email', $email)->where('verification_token', $token)->first();

        if($user){
            $user->email_verified_at = now();
            $user->verification_token = null;
            $user->save();
            return redirect()->route('login')->with('status', 'メールアドレスが認証されました。ログインしてください。');
        }
        return redirect()->route('login')->with('error', '認証に失敗しました。');
    }

    public function againVerification(){
        return view('auth.verify');
    }

    public function resendVerificationEmail(Request $request){
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }
        $this->sendVerificationEmail($user);
        return redirect()->route('verification.notice')->with('status', '確認メールを再送信しました。');
    }

    public function addition_page(){
        return view('addition_page');
    }

    public function addition_create(AdvanceRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'verification_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'representative',
        ]);
        return redirect()->back()->with('status', '店舗代表者の登録が完了しました。');
    }
}
