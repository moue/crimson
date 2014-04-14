<?php namespace library\Events;

use Post;

class ViewPostHandler {
	public function handle(Post $post) {
		// Increment the view counter by one...
		$post->increment('view_count');

		// Increment the value on the model so we can display it
		// The increment value doesn't increment the value on the model
		$post->view_count += 1;
	}
}

?>