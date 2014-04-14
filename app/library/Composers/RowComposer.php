<?php namespace library\Composers;

use Post;
use DB;

class RowComposer {

	public function compose($view) {
		$randoms = Post::where('img', '!=', 'null')->orderBy(DB::raw('RAND()'))->take(4)->get();
		$view->with('randoms', $randoms);
	}
}
