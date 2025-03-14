<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;



class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    private function verificarContrasenaIdempiere($inputPassword, $hashedPassword, $hexsalt)
    {
        // convertir el salt de hexadecimal a binario
        $salt = hex2bin($hexsalt);

        // crear la instancia del hash inicial (equivalente a `digest.update(salt)`)
        $hashCalculado = hash('sha512', $salt . $inputPassword, true);

        // iterar el hash 1000 veces
        for ($i = 0; $i < 1000; $i++) {
            $hashCalculado = hash('sha512', $hashCalculado, true);
        }

        // convertir el resultado final a hexadecimal (como lo hace `convertToHexString`)
        $hashCalculado = bin2hex($hashCalculado);
    
        return hash_equals($hashCalculado, $hashedPassword);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::authenticateUsing(function ($request) {
            $user = \App\Models\User::where('name', $request->email)->first();

            if (!$user || !$this->verificarContrasenaIdempiere($request->password, $user->password, $user->salt)) {
                return null; // Credenciales inválidas
            }

            // Verificamos el campo 'status'
            if ($user->status !== 1) {
                throw ValidationException::withMessages([
                    Fortify::username() => 'Tu cuenta está inactiva, contacta con soporte para activarla!',
                ]);
            }

            return $user; // Devolver usuario si todo está correcto
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
