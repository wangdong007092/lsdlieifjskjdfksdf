<?php namespace WangDong\Http\Controllers\Auth;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use WangDong\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar,Request $request)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
        //注册auth.attemp事件(在用户名和密码验证之前触发)
        //加入验证码的验证
        $this->auth->attempting(function()use($request){
            $phrase = \Session::pull('login_phrase'); //获取验证码并删除
            if($request->input('phrase') != $phrase){
                throw new HttpResponseException(
                    redirect('/auth/login')->withInput($request->input())->withErrors(['phrase'=>'验证码错误'])
                );
            }
        });
		$this->middleware('guest', ['except' => 'getLogout']);
	}

}
