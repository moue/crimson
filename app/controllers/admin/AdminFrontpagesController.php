<?php

class AdminFrontpagesController extends AdminController {

	public function getIndex()
	{	
		/*
		 * Load news posts by most recent
		 */

		$posts = Post::where('section_id', '=', '1')->orderBy('created_at', 'DESC')->lists('title', 'id');
		
		/*
		 * Load a custom view
		 */

		/*$items 	= Frontpage::with(array('title' => function($query){
			$query->select('*');
		}))->orderBy('order')->get();*/
		
		$items = DB::table('frontpages')
			->join('posts', 'posts.id', '=', 'frontpages.post_id')
			->select('frontpages.id', 'frontpages.order', 'frontpages.parent_id', 'frontpages.post_id', 'posts.title')
			->orderBy('order')
			->get();

		$layouts = DB::table('layouts')->get();

		$frontpage 	= new Frontpage;
		$frontpage   = $frontpage->getHTML($items);

		return View::make('admin.frontpages.builder', compact('items', 'frontpage', 'posts', 'layouts'));
	}

	public function getEdit($id)
	{	
		$item = Frontpage::find($id);
		$this->layout->content = View::make('admin.frontpages.edit', array('item'=>$item));
	}

	public function postEdit($id)
	{	
		$item = Frontpage::find($id);
		$item->title 	= e(Input::get('title','untitled'));
		$item->label 	= e(Input::get('label',''));	
		$item->url 		= e(Input::get('url',''));	

		$item->save();
		return Redirect::to("admin/frontpagess/edit/{$id}");
	}

	// AJAX Reordering function
	public function postIndex()
	{	
	    $source       = e(Input::get('source'));
	    $destination  = e(Input::get('destination',0));

	    $item             = Frontpage::find($source);
	    $item->parent_id  = $destination;  
	    $item->save();

	    $ordering       = json_decode(Input::get('order'));
	    $rootOrdering   = json_decode(Input::get('rootOrder'));

	    if($ordering){
	      foreach($ordering as $order=>$item_id){
	        if($itemToOrder = Frontpage::find($item_id)){
	            $itemToOrder->order = $order;
	            $itemToOrder->save();
	        }
	      }
	    } else {
	      foreach($rootOrdering as $order=>$item_id){
	        if($itemToOrder = Frontpage::find($item_id)){
	            $itemToOrder->order = $order;
	            $itemToOrder->save();
	        }
	      }
	    }

	    return 'ok ';
	}

	public function postNew()
	{
		// Create a new frontpage item and save it
		$item = new Frontpage;

		$item->post_id 	= e(Input::get('title'));
		$item->order 	= Frontpage::max('order')+1;

		$item->save();

		return Redirect::to('admin/frontpages');
	}

	public function postDelete()
	{
		$id = Input::get('delete_id');
		// Find all items with the parent_id of this one and reset the parent_id to zero
		$items = Frontpage::where('parent_id', $id)->get()->each(function($item)
		{
			$item->parent_id = 0;  
			$item->save();  
		});

		// Find and delete the item that the user requested to be deleted
		$item = Frontpage::find($id);
		$item->delete();

		return Redirect::to('admin/frontpages');
	}

	public function postSelect() {
		return Input::all();
		$layouts = SelectedLayout::find(1);
		$layouts->recent = Input::get('recent');
		$layouts->custom = Input::get('custom');
		$layouts->save();
		return Redirect::to('admin/frontpages');
	}
}
