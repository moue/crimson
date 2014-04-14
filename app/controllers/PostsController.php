<?php

use library\Events\ViewPostHandler;
use Former\Facades\Former;

class PostsController extends BaseController {

    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Post $post, User $user)
    {
        parent::__construct();

        $this->post = $post;
        $this->user = $user;
    }
    
	/**
	 * Returns all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		
		$features = Section::with(array('posts'=>function($query) { 
			$query->where('img', '!=', 'null')
				  ->orderBy('posts.created_at', 'DESC')
				  ->leftJoin('users', 'users.id', '=', 'posts.user_id');	
			}))->get();

		// Get an array of post_id for each section that acts as the featured article
		$repeats = array();
		foreach($features as $index=>$feature) {
			$repeats[$index] = $feature->posts[0]->title;
		}

		// Get all sections and posts for each section
		$sections = Section::with(array('posts'=>function($query) { 
			$query->orderBy('posts.created_at', 'DESC')
				  ->leftJoin('users', 'users.id', '=', 'posts.user_id');	
		}))->get();

		$feat_post = $this->post->where('img', '!=', 'null')->first();
		
		// Get all news posts
		$posts = $this->post->where('section_id', '=', '1')->orderBy('created_at', 'DESC')->get();
		
		// Get 5 opinion posts
		$opinions = $this->post->where('section_id', '=', '2')->orderBy('created_at', 'DESC')->take(5)->get();
	
		// Get 3 Photos		
		$photos = $this->post->where('img', '!=', 'null')->take(3)->get();

		// Get all sports posts with photos
		$feat_sports = $this->post->where('img', '!=', 'null')->where('section_id', '=', '4')->take(4)->get();
		
		// Get all sports posts
		$sports = $this->post->where('img', '=', null)->where('section_id', '=', '4')->get();

		// Get all arts posts with photos
		$feat_arts = $this->post->where('img', '!=', 'null')->where('section_id', '=', '5')->take(4)->get();
		
		// Get all arts posts
		$arts = $this->post->where('img', '=', null)->where('section_id', '=', '5')->get();
		
		// Show the page
		return View::make('site/index', compact('sections', 'features', 'repeats', 'posts', 'feat_post', 'opinions', 'photos', 'sports', 'feat_sports', 'arts', 'feat_arts'));
	}

	/**
	 * View a blog post.
	 *
	 * @param  string  $slug
	 * @return View
	 * @throws NotFoundHttpException
	 */
	public function getView($slug)
	{
		// Get this blog post data
		$post = $this->post->where('slug', '=', $slug)->first();

		// Check if the blog post exists
		if (is_null($post))
		{
			// If we ended up in here, it means that
			// a page or a blog post didn't exist.
			// So, this means that it is time for
			// 404 error page.
			return App::abort(404);
		}

		// Get this post comments
		$comments = $post->comments()->orderBy('created_at', 'ASC')->get();

        // Get current user and check permission
        $user = $this->user->currentUser();
        $canComment = false;
        if(!empty($user)) {
            $canComment = $user->can('post_comment');
        }

        // Fire an event and pass along post as its payload
        Event::fire('posts.view', $post);

		// Show the page
		return View::make('site/view_post', compact('post', 'comments', 'canComment'));
	}

	/**
	 * View a blog post.
	 *
	 * @param  string  $slug
	 * @return Redirect
	 */
	public function postView($slug)
	{

        $user = $this->user->currentUser();
        $canComment = $user->can('post_comment');
		if ( ! $canComment)
		{
			return Redirect::to($slug . '#comments')->with('error', 'You need to be logged in to post comments!');
		}

		// Get this blog post data
		$post = $this->post->where('slug', '=', $slug)->first();

		// Declare the rules for the form validation
		$rules = array(
			'comment' => 'required|min:3'
		);

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
			// Save the comment
			$comment = new Comment;
			$comment->user_id = Auth::user()->id;
			$comment->content = Input::get('comment');

			// Was the comment saved with success?
			if($post->comments()->save($comment))
			{
				// Redirect to this blog post page
				return Redirect::to($slug . '#comments')->with('success', 'Your comment was added with success.');
			}

			// Redirect to this blog post page
			return Redirect::to($slug . '#comments')->with('error', 'There was a problem adding your comment, please try again.');
		}

		// Redirect to this blog post page
		return Redirect::to($slug)->withInput()->withErrors($validator);
	}
}
