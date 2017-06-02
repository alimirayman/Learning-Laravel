<?php 

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
	
	public function getIndex($author = null)
	{
		if(!is_null($author)){
			$quote_author = Author::where('name', $author)->first();
			if($quote_author){
				$quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(4);
			}
		}else{
			$quotes = Quote::orderBy('created_at', 'desc')->paginate(4);	
		}
		return view('index', ['quotes' => $quotes]);
	}
	public function postQuote(Request $request)
	{
		$this->validate($request, [
			'author' => 'required|max:60',
			'quote' => 'required|max:500'
		]);
		$authorText = ucfirst($request['author']);
		$quoteText = $request['quote'];

		$author = Author::where('name', $authorText)->first();
		if(!$author){
			$author = new Author();
			$author->name = $authorText;
			$author->save();
		}

		$quote = new Quote();
		$quote->quote = $quoteText;
		$author->quotes()->save($quote);

		return redirect()->route('index')->with([
			'success' => 'Quote Saved!'
		]);
	}

	public function getDeleteQuote($quote_id)
	{
		$quote = Quote::find($quote_id);
		$author_deleted = false;

		if(count($quote->author->quotes) === 1){
			$quote->author->delete();
			$author_deleted = true;
		}

		$quote->delete();
		$msg = $author_deleted ? 'Quote and Author Deleted' : 'Quote Deleted';

		return redirect()->route('index')->with(['success' => $msg]) ;
	}
}
