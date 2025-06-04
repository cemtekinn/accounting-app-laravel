<?php

namespace App\Http\Controllers\Crm;

use App\Enums\UserLoginEvent;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Crm\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends ApiController
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::query()
            ->whereEmail($request->email)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            try {
                $user->loginActivities()->create([
                    'event' => UserLoginEvent::login,
                    'ip' => getIp(),
                    'user_agent' => $request->header('User-Agent'),
                ]);
            } catch (Exception $e) {
                Log::log('error', $e->getMessage());
            }

            return response()->json([
                'status' => 'success',
                'message' => __('Giriş işlemi başarılı.'),
                'data' => $user,
                'token' => $user->createToken(date('Y-m-d-H-i-s') . '--' . $user->id)->plainTextToken,
            ]);
        }

        throw ValidationException::withMessages([
            'email' => [__('auth.failed')],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $request->user()->loginActivities()->create([
                'event' => UserLoginEvent::logout,
                'ip' => getIp(),
                'user_agent' => $request->header('User-Agent'),
            ]);
        } catch (Exception $e) {
            Log::log('error', $e->getMessage());
        }

        $request->user()->currentAccessToken()->delete();
        return $this->success(__('Çıkış işlemi başarılı.'));
    }

//    public function register(RegisterRequest $request): JsonResponse
//    {
//        $data = $request->validated();
//        $data['username'] = 'user' . random_int(100000000000, 999999999999);
//        $data['password'] = Hash::make($data['password']);
//        $data['first_name'] = Str::title($data['first_name']);
//        $data['last_name'] = Str::title($data['last_name']);
//
//        $locales = config('auto-translate');
//        $locales = array_merge($locales['locales'], [$locales['base_locale']]);
//
//        $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
//        $data['language'] = in_array($browserLang, $locales) ? $browserLang : 'en';
//        $data['country_id'] = Country::whereIso(getCountryCode(getIp()))->first()?->id ?? 220;
//
//        $user = User::create($data);
//
//        $user->loadCount([
//            'posts',
//            'follows',
//            'followers',
//            'unreadNotifications'
//        ]);
//
//        try {
//            $user->loginActivities()->create([
//                'event' => UserLoginEvent::login,
//                'ip' => getIp(),
//                'user_agent' => $request->header('User-Agent'),
//            ]);
//        } catch (Exception $e) {
//            Log::log('error', $e->getMessage());
//        }
//
//        return response()->json([
//            'status' => 'success',
//            'message' => __('Hesabınız başarıyla oluşturuldu.'),
//            'data' => $user,
//            'token' => $user->createToken(date('Y-m-d-H-i-s') . '--' . $user->id)->plainTextToken,
//        ], 201);
//    }
//
//    // reset password ve verify password işlemleri için gerekli fonksiyonlar yazılacak
//    public function resetPassword(ResetPasswordRequest $request): JsonResponse
//    {
//        $q = DB::table('password_reset_tokens')
//            ->whereEmail($request->email)
//            ->whereToken($request->token)
//            ->first();
//
//        if (!$q) {
//            throw ValidationException::withMessages([
//                'token' => [__('passwords.token')],
//            ]);
//        }
//
//        DB::table('password_reset_tokens')->whereEmail($request->email)->delete();
//
//        $user = User::whereEmail($request->email)->first();
//
//        if (!$user) {
//            throw ValidationException::withMessages([
//                'email' => [__('passwords.user')],
//            ]);
//        }
//
//        $user->update([
//            'password' => Hash::make($request->password)
//        ]);
//
//        return $this->success(__('Şifreniz başarıyla sıfırlandı.'));
//    }
//
//    public function sendResetToken(SendResetTokenRequest $request): JsonResponse
//    {
//        $user = User::whereEmail($request->email)->first();
//
//        if (!$user) {
//            throw ValidationException::withMessages([
//                'email' => [__('passwords.user')],
//            ]);
//        }
//
//        $expire = config('auth.passwords.users.expire');
//
//        $check = DB::table('password_reset_tokens')
//            ->whereEmail($request->email)
//            ->where('created_at', '>=', now()->subMinutes($expire))
//            ->first();
//
//        if ($check)
//            return $this->success(__('Şifre sıfırlama kodu zaten gönderilmiş.'));
//
//        $token = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
//
//        DB::table('password_reset_tokens')->updateOrInsert(
//            ['email' => $user->email],
//            ['token' => $token, 'created_at' => now()]
//        );
//
//        $user->notify(new ResetPasswordNotification($token));
//
//        return $this->success(__('Şifre sıfırlama kodu e-posta adresinize gönderildi.'));
//    }
}
