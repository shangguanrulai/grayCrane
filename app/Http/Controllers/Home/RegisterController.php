<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require_once app_path().'/Org/Code.class.php';
use App\Org\Code\Code;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Model\Home\User_home;
  

class RegisterController extends Controller
{
    //注册
    public function register()
    {
    	return view('Home.register');
    	// return 1111;
    
	}
}