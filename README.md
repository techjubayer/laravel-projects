```
~$ laravel new passport-auth
~$ composer require laravel/passport

~$ php artisan migrate
//To create tables in connected database

~$ php artisan passport:install
This command will create the encryption keys needed to generate secure access tokens. In addition, the command will create "personal access" and "password grant" clients which will be used to generate access tokens. This keys we can find in 'oauth_clients' table in the database.
```

## Passport Configuration app/User.php

```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
}
```

## Add the below code in /config/auth.php

```
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
```

## Deploying Passport (Optional)

```
~$ php artisan passport:keys

// AuthServiceProvider Configuration \app\Providers\AuthServiceProvider.php
public function boot()
{
    $this->registerPolicies();

    Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
}
```

## Token Lifetimes

```
use Laravel\Passport\Passport;
/**
 * Register any authentication / authorization services.
 *
 * @return void
 */
public function boot()
{
    $this->registerPolicies();

    Passport::tokensExpireIn(now()->addDays(15));
    Passport::refreshTokensExpireIn(now()->addDays(30));
    Passport::personalAccessTokensExpireIn(now()->addMonths(6));
}
```

## Create api or web route

```
// In /routes/api.php
<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::post("signup", 'newRegister');
    Route::post("login", 'userLogin');
    Route::post("user", 'getUserDetails');
});

```

```
// In /app/Http/Controllers/UserControler.php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function newRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCode' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success' => $success], 201);
    }


    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ip' => 'required|numeric|min:10',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $idPhone = $request->input('ip');
        $password = bcrypt($request->input('password'));

        $user = User::where('phone', $idPhone)->orWhere('idCode', $idPhone)->first();
        if ($user == null) {
            $responseArray['response'] = false;
            $responseArray['message'] = "User not found";
            return json_encode($responseArray);
        }

        $dbPassword = $user->password;
        if ($dbPassword != $password) {
            $responseArray['response'] = false;
            $responseArray['message'] = "Invalid password";
            $responseArray['Password'] = $dbPassword;
            $responseArray['password'] = $password;
            return json_encode($responseArray);
        }

        $responseArray['response'] = true;
        $responseArray['user'] = $user;
        $responseArray['token'] = $user->createToken('Access Token')->accessToken;
        return json_encode($responseArray);
    }


    public function getUserDetails(Request $request)
    {
        $isLogedIn = auth()->check();

        if ($isLogedIn) {
            $user = auth()->user();
            $responseArray['response'] = true;
            $responseArray['user'] = $user;
        } else {
            $responseArray['response'] = false;
            $responseArray['message'] = "Unauthorized user";
        }
        return json_encode($responseArray);
    }
}

```
