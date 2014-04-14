<?php

class Frontpage extends Eloquent
{

	// Recursive function that builds the Frontpage from an array or object of items
	// In a perfect world some parts of this function would be in a custom Macro or a View
	public function buildFrontpage($frontpage, $parentid = 0) 
	{ 
	  $result = null;
	  foreach ($frontpage as $item) 
	    if ($item->parent_id == $parentid) { 
	      $result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
	      <div class='dd-handle nested-list-handle'>
	        <span class='glyphicon glyphicon-move'></span>
	      </div>
	      <div class='nested-list-content'>{$item->title}
	        <div class='pull-right'>
	          <a href='".url("admin/frontpages/edit/{$item->id}")."'>Edit</a> |
	          <a href='#' class='delete_toggle' rel='{$item->id}'>Delete</a>
	        </div>
	      </div>".$this->buildFrontpage($frontpage, $item->id) . "</li>"; 
	    } 
	  return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null; 
	} 

	// Getter for the HTML Frontpage builder
	public function getHTML($items)
	{
		return $this->buildFrontpage($items);
	}

	public function title() {
		return $this->belongsTo('Post', 'post_id');
	}

}