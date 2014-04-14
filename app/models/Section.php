<?php

class Section extends \Eloquent {
	
	public function posts() {
		return $this->hasMany('Post');
	}

}

?>