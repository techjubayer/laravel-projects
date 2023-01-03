```
~$ laravel new passport-auth
~$ composer require laravel/passport
~$ php artisan migrate //To create tables in connected database
~$ php artisan passport:install
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

## Deploying Passport

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
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@getUserDetails');
});


// In /app/Http/Controllers/UserControler.php
public function getUserDetails()
    {
        $user = Auth::user();
        if($user){
            return response()->json([ 'response'=>true, 'data' => $user], $this-> successStatus);
        }else{
            return response()->json(['response'=>false, 'message' => 'Authenticate fail'], $this-> successStatus);
        }
    }
```
