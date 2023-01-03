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
