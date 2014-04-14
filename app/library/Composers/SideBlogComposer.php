<?php namespace library\Composers;

use Section;

class SideBlogComposer {

	public function compose($view) {
		// Get all sections and posts for each section
		$sections = Section::with(array('posts'=>function($query) { 
			$query->orderBy('posts.created_at', 'DESC')
				  ->leftJoin('users', 'users.id', '=', 'posts.user_id');	
		}))->get();

		$view->with('sections', $sections);
	}
}
