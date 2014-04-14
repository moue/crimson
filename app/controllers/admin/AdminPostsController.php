<?php


class AdminPostsController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    /**
     * Show a list of all the post posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/posts/title.post_management');

        // Grab all the post posts
        $posts = $this->post;

        // Show the page
        return View::make('admin/posts/index', compact('posts', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/posts/title.create_a_new_post');

        // Show the page
        return View::make('admin/posts/create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {

            if (Input::hasFile('image')) {
                $file = Input::file('image');
                $name = time() . '-' . Input::get('section') . '-image.' . $file->getClientOriginalExtension();
                $path = $file->move(public_path() . '/img/', $name);
            }
            
            // Create a new post
            $post = new Post;
            
            // Update the post post data
            $post->slug         = Str::slug(Input::get('title'));
            $post->section_id   = Input::get('section');
            $post->title        = Input::get('title');
            $post->user_id      = Input::get('writer');
            $post->content      = Input::get('content');
            $post->img          = isset($name) ? $name : null;
            $post->photog       = Input::get('photog');
            $post->snippit      = Input::get('snippit');
            $post->save();
            
            // Was the post post created?
            if($this->post->save())
            {
                // Redirect to the new post post page
                return Redirect::to('admin/posts/' . $this->post->id . '/edit')->with('success', Lang::get('admin/posts/messages.create.success'));
            }

            // Redirect to the post post create page
            return Redirect::to('admin/posts/create')->with('error', Lang::get('admin/posts/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/posts/create')->withInput()->withErrors($validator);
        
	}

    /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getShow($post)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getEdit($post)
	{
        // Title
        $title = Lang::get('admin/posts/title.post_update');
        
        // Show the page
        return View::make('admin/posts/edit', compact('title', 'post'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $post
     * @return Response
     */
	public function postEdit($post)
	{

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            if (Input::hasFile('image')) {
                $file = Input::file('image');
                $name = time() . '-' . Input::get('section') . '-image.' . $file->getClientOriginalExtension();
                $path = $file->move(public_path() . '/img/', $name);
            }
            elseif (Input::get('path')) {
                $path = Input::get('path');
            }

            /// Update the post post data
            $post->slug         = Str::slug(Input::get('title'));
            $post->section_id   = Input::get('section');
            $post->title        = Input::get('title');
            $post->user_id      = Input::get('writer');
            $post->content      = Input::get('content');
            $post->img          = isset($name) ? $name : null;
            $post->photog       = Input::get('photog');
            $post->snippit      = Input::get('snippit');
            $post->save();

            // Was the post post updated?
            if($post->save())
            {
                // Redirect to the new post post page
                return Redirect::to('admin/posts/' . $post->id . '/edit')->with('success', Lang::get('admin/posts/messages.update.success'));
            }

            // Redirect to the posts post management page
            return Redirect::to('admin/posts/' . $post->id . '/edit')->with('error', Lang::get('admin/posts/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/posts/' . $post->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($post)
    {
        // Title
        $title = Lang::get('admin/posts/title.post_delete');

        // Show the page
        return View::make('admin/posts/delete', compact('post', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($post)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $post->id;
            $post->delete();

            // Was the post post deleted?
            $post = Post::find($id);
            if(empty($post))
            {
                // Redirect to the post posts management page
                return Redirect::to('admin/posts')->with('success', Lang::get('admin/posts/messages.delete.success'));
            }
        }
        // There was a problem deleting the post post
        return Redirect::to('admin/posts')->with('error', Lang::get('admin/posts/messages.delete.error'));
    }

    /**
     * Show a list of all the post posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = Post::select(array('posts.id', 'posts.title', 'posts.section_id as sections', 'posts.id as comments', 'posts.created_at as timestamp'));

        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')
        //->edit_column('sections', '{{ Section:: }}')
        //->edit_column('timestamp', '{{ Date::make($timestamp)->ago() }}')
        ->edit_column('timestamp', '{{ Date::make($timestamp)->format(\'short\') }}')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/posts/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/posts/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}