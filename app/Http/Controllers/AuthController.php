<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth, Helper;
use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;

class AuthController extends Controller
{


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    public function getAuthInvalidToken(Request $q)
    {
        return back()->with('have_to_login', true);
//    return Helper::responseData('invalid_token',false,false,__('auth.invalid_token'));
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));
                event(new PasswordReset($user));
            }
        );

        if($status == Password::PASSWORD_RESET)
            return redirect()->route('home')->with('success-json-response' , Lang::get('site.reset_password_success'));
        else
            return \redirect()->back()->withErrors(['email' => [__($status)]]);

    }

    public function getResetPassword($token)
    {
        return view('site.auth.reset-password' , compact('token'));
    }

    /**
     * Register new merchant
     *
     * @param Request $q
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRegister(Request $q)
    {
        $validator = validator()->make($q->all(), [
            'name' => 'required|max:255',
            'password' => 'required',
            'email' => 'required|email|max:255|unique:users'
        ]);
        if ($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }
        $User = new User;
        $User->name = $q->name;
        $User->email = $q->email;
        $User->password = bcrypt($q->password);
        $User->save();

        $token = $this->guard()->attempt(['email' => $q->email, 'password' => $q->password]);

        \Mail::to($User->email)->send(new \App\Mail\UserRegisterWelcomeMail($User));
        return Helper::responseData('user_created', true, ['token' => $token, 'expires_in' => (auth('api')->factory()->getTTL() * 60), 'user' => auth()->user()], __('default.success_message.user_registered'));
    }

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $q
     * @return \Illuminate\Http\JsonResponse
     */
    public function postLogin(Request $q)
    {
        $rules = [
            'email' => 'email|max:255',
            'password' => 'required',
        ];
        $validator = validator()->make($q->all(), $rules);
        if ($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }

        $User = User::select('email', 'password')->where('email', $q->email)->first();
        if (!$User) {
            return Helper::responseData('login_failed', false, false, __('auth.failed'));
        }
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = $this->guard()->attempt($q->only('email', 'password'))) {
                return Helper::responseData('login_failed', false, false, __('auth.failed'));
            }
        } catch (JWTException $e) {
            return Helper::responseData('login_failed', false, false, __('auth.failed'));
        }
        $User = auth()->user();
        return Helper::responseData('logged_in', true, ['token' => $token, 'expires_in' => (auth('api')->factory()->getTTL() * 60), 'user' => auth()->user()], __('auth.logged_in'));
    }


    /**
     * Get current user info
     */
    public function getMe(Request $q)
    {
        $User = auth()->user();
        if ($User->is_admin) {
            $User = $User->makeVisible(['is_admin_permissions']);
        }
        if ($User) {
            return view('site.user.account');
//      return Helper::responseData('success',true,['user' => $User]);
        } else {
            return Helper::responseData('user_not_found', false);
        }
    }


    /**
     * Refresh token
     */
    public function getRefresh(Request $q)
    {
        try {
            if (auth()->user()) {
                return Helper::responseData('token_refreshed', true, ['token' => auth()->refresh(), 'expires_in' => auth('api')->factory()->getTTL() * 60]);
            } else {
                return Helper::responseData('token_failed', false);
            }
        } catch (JWTException $e) {
            return Helper::responseData('token_failed', false);
        }
    }


    /**
     * Log out
     */
    public function getLogout(Request $q)
    {
        if (auth()->user()) {
            auth()->logout();
//      return Helper::responseData('logged_out',true,false,__('auth.logged_out'));
//        return Redirect::back();
            return Redirect::to('/');
        } else {
//      return Helper::responseData('logout_failed',false);
            return Redirect::back();
        }
    }


    /**
     * Forget Password
     *
     * @param Request $q
     * @return \Illuminate\Http\JsonResponse
     */
    public function postForgetPassword(Request $q)
    {
        $validator = validator()->make($q->all(), [
            'email' => 'required|email|max:255'
        ]);
        if ($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }
        $User = User::select('id', 'password_reset_code', 'password_reset_expire_at')->where('email', $q->email)->first();
        if (!$User) {
            return Helper::responseData('user_not_found', false, false, __('default.error_message.user_not_found'));
        } else {
            // Check if the code sent before and not expired
//            if ($User->password_reset_expire_at) {
//                $secondsRemains = $User->password_reset_expire_at->timestamp - \Carbon\Carbon::now()->timestamp;
//                if ($secondsRemains > 0) {
//                    return Helper::responseData('code_already_sent', true, [
//                        'user_id' => $User->id,
//                        'seconds_remains' => $secondsRemains
//                    ], __('default.success_message.code_already_sent'));
//                }
//            }
//
//            // Prepare reset code and expire time
//            $Code = mt_rand(100000, 666666);
//            $expireDate = \Carbon\Carbon::now()->addMinutes(10);
//            $User->password_reset_code = $Code;
//            $User->password_reset_expire_at = $expireDate;
//            $User->save();
//            $secondsRemains = $User->password_reset_expire_at->timestamp - \Carbon\Carbon::now()->timestamp;
//            \Mail::to($q->email)->send(new \App\Mail\PasswordVerificationCodeMail($Code));

             Password::sendResetLink(
                $q->only('email')
            );

            return Helper::responseData('reset_code_sent', true, [
                'user_id' => $User->id,
            ], __('default.success_message.reset_code_sent'));
        }
    }


    /**
     * Verify Forget Password Code
     *
     * @param Request $q
     */
    public function postVerifyForgetPasswordCode(Request $q)
    {

        $validator = validator()->make($q->all(), [
            'code' => 'required',
            'user_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }

        $checkCode = User::where([['id', $q->user_id], ['password_reset_code', $q->code]])->select('password_reset_expire_at')->first();
        if ($checkCode) {
            if (!$checkCode->password_reset_expire_at->gt(\Carbon\Carbon::now())) {
                return Helper::responseData('expired_code', true, ['user' => $User], __('auth.password_reset.expired_code'));
            } else {
                return Helper::responseData('success', true, ['user_id' => intval($q->user_id)]);
            }
        } else {
            return Helper::responseData('invalid_code', false, false, __('auth.password_reset.invalid_code'));
        }
    }

    /**
     * Reset Password
     *
     * @param Request $q
     */
    public function postResetPassword(Request $q)
    {
        $validator = validator()->make($q->all(), [
            'code' => 'required',
            'user_id' => 'required|integer',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }

        $User = User::where([['id', $q->user_id], ['password_reset_code', $q->code]])->where('password_reset_expire_at', '>=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'))->first();
        if ($User) {
            $User->password = bcrypt($q->password);
            $User->password_reset_expire_at = null;
            $User->password_reset_code = null;
            $User->save();
            $token = $this->guard()->attempt(['email' => $q->email, 'password' => $q->password]);
            return Helper::responseData('success', true, ['token' => $token, 'expires_in' => (auth('api')->factory()->getTTL() * 60), 'user' => auth()->user()]);
        } else {
            return Helper::responseData('invalid_code', false, false, __('auth.password_reset.invalid_code'));
        }
    }

    /**
     * Update user profile
     *
     * @param Request $q
     */
    public function postUpdateProfile(Request $q)
    {

        $validator = validator()->make($q->all(), [
            'email' => 'email',
            'country_id' => [new \App\Rules\CountryRule],
            'bank_id' => [new \App\Rules\BankRule],
            'educations' => ['array']
        ]);
        if ($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }
        $User = User::where('id', auth()->user()->id)->first();
        if ($q->name) {
            $User->name = $q->name;
        }
        if ($q->about_me) {
            $User->about_me = $q->about_me;
        }
        if ($q->hasFile('avatar')) {
            $upload = new UploaderController();
            $upload->folder = 'users/avatars';
            $upload->thumbFolder = 'users/thumbs';
            $avatar = $upload->uploadSingle($q->file('avatar'),true,1000,0,320);
            if(isset($avatar['path']) && Storage::exists('users/avatars/'.$avatar['path'])){
                $User->avatar = $avatar['path'];
            }
        }
        if ($q->educations) {
            $User->educations = $q->educations;
        }
        if ($q->email) {
            if ($User->email != $q->email) {
                $checkEmail = User::where('email', $q->email)->select('id')->first();
                if ($checkEmail) {
                    return Helper::responseData('email_exists_before', false, false, __('auth.email_exists_before'));
                }
            }
            $User->email = $q->email;
        }
        if ($q->password) {
            $User->password = bcrypt($q->password);
        }
        if ($q->country_id) {
            $User->country_id = $q->country_id;
        }
        // Social accounts
        if ($q->facebook_url) {
            $User->facebook_url = $q->facebook_url;
        }
        if ($q->twitter_url) {
            $User->twitter_url = $q->twitter_url;
        }
        if ($q->instagram_url) {
            $User->instagram_url = $q->instagram_url;
        }
        if ($q->linkedin_url) {
            $User->linkedin_url = $q->linkedin_url;
        }
        // Bank info
        if ($q->bank_id) {
            $User->bank_id = $q->bank_id;
        }
        if ($q->bank_iban) {
            $User->bank_iban = $q->bank_iban;
        }
        if ($q->bank_account_owner_name) {
            $User->bank_account_owner_name = $q->bank_account_owner_name;
        }

        $User->user_skills()->delete();
        if($q->has('skills') && count($q->skills) > 0)
            foreach($q->skills as $key => $skill)
                $User->user_skills()->create(['skill_id' => $skill]);

        $User->save();
        return back()->with('success', 'تم حفظ التغيرات');

        // return Helper::responseData('updated',true,$User,__('auth.updated'));
    }

    /**
     * Add skill to user profile
     *
     * @param Request $q
     */
    public function postAddSkill(Request $q)
    {
        $validator = validator()->make($q->all(), [
            'skill_id' => [new \App\Rules\SkillRule]
        ]);
        if ($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }
        $UserSkill = UserSkill::firstOrNew(['user_id' => auth()->user()->id, 'skill_id' => $q->skill_id]);
        $UserSkill->save();
        $Skill = Skill::where('id', $q->skill_id)->selectCard()->first();
        return Helper::responseData('success', true, $Skill);
    }

    /**
     * Remove skill from user profile
     *
     * @param Request $q
     */
    public function deleteSkill(Request $q)
    {
        $validator = validator()->make($q->all(), [
            'skill_id' => [new \App\Rules\SkillRule]
        ]);
        if ($validator->fails()) {
            return Helper::responseValidationError($validator->messages());
        }
        UserSkill::where([['user_id', auth()->user()->id], ['skill_id', $q->skill_id]])->delete();
        return Helper::responseData('success', true);
    }
}
