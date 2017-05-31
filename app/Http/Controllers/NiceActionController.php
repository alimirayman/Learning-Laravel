<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use App\NiceAction;
use App\NiceActionLog;

/**
* name: NiceActionController
* description: does routing based on action and basically grees user
*/
class NiceActionController extends Controller
{

	public function getHome($value='')
	{
		$actions = NiceAction::orderBy('niceness', 'desc')->get();
		$logged_actions = NiceActionLog::paginate(5);

		return view('home', ['actions'=>$actions, 'logged_actions'=>$logged_actions]);
	}

	public function getNiceAction($action, $name=null)
	{
		if($name === null){
			$name = 'you';
		}

		$nice_action = NiceAction::where('name', $action)->first();
		$nice_action_log = new NiceActionLog();
		$nice_action->log_action()->save($nice_action_log);
		
		$actions = NiceAction::all();
		
		return view('actions.nice', ['actions'=>$actions,'act'=> $action,'name'=>$name]);
	}

	public function postAddNiceAction(Request $request)
	{
		$this->validate($request, [
			'name'   => 'required|alpha|unique:nice_actions',
			'niceness'   => 'required|numeric'
		]);

		$nice_action = new NiceAction();
		$nice_action->name = ucfirst(strtolower($request['name']));
		$nice_action->niceness = $request['niceness'];
		$nice_action->save();

		$actions = NiceAction::all();

		if ($request->ajax()) {
			return response()->json();
		}

		return redirect()->route('home');
	}
}
