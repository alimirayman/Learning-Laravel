<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Author;

class AdminController extends Controller
{
	
	public function getLogin()
	{
		return view('admin.login');
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('index');
	}

	public function getDashboard()
	{
		$authors = Author::all();
		return view('admin.dashboard', ['authors' => $authors]);
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'password' => 'required'
		]);
		$login = Auth::attempt(['name'=>$request['name'], 'password' =>$request['password']]);
		if(!$login){
			return redirect()->back()->with(['fail'=>'Could not Log In']);
		}
		return redirect()->route('admin_dashboard');
	}
}