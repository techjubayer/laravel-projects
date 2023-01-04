## Creat laravel app

```
~$ laravel new passport-auth
```

## Make sure MongoDB installed in the machine

```
~$ npm install mongodb

```

## Add the following line to your composer.json file:

```
"jenssegers/mongodb": "^3.6"
```

### Run the following command to install the jenssegers/mongodb package:

```
~$ composer update
```

### Update .env file with the connection details for your MongoDB database:

```
MongoDB_CONNECTION=mongodb
MongoDB_HOST=127.0.0.1
MongoDB_PORT=27017
MongoDB_DATABASE=your-database-name
MongoDB_USERNAME=root
MongoDB_PASSWORD=
```

### Add the MongoDB connection details to your config/database.php file

```
'mongodb' => [
    'driver'   => 'mongodb',
    'host'     => env('DB_HOST', 'localhost'),
    'port'     => env('DB_PORT', 27017),
    'database' => env('DB_DATABASE'),
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'options'  => [
        'database' => 'admin' // sets the authentication database required by mongo 3
    ]
],

```
