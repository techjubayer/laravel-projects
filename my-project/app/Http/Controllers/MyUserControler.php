<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyUserControler extends Controller
{
    function loadMyView($id1)
    {
        echo "This is my controler <b>" . $id1 . "</b>";
        echo "<br> Try this: http://127.0.0.1:8000/controller/any-paramerter";

        return view('resume'); //We also can load views from here
    }
}
