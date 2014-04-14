<?php

use Illuminate\Support\Facades\URL; # not sure why i need this here :c
use Robbo\Presenter\PresentableInterface;
use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class Post extends Ardent implements PresentableInterface {

	protected $guarded = ['id'];
	protected $fillable = ['title', 'content', 'img'];
	
	public $timestamps = true;
	
	public static $rules = array(
	    'title' 		=> 'required',
	    'content' 		=> 'required'
    );

	/**
	 * Deletes a blog post and all
	 * the associated comments.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->comments()->delete();

		// Delete the blog post
		return parent::delete();
	}

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Get the post's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * Get the post's comments.
	 *
	 * @return array
	 */
	public function comments()
	{
		return $this->hasMany('Comment');
	}

    /**
     * Get the date the post was created.
     *
     * @param \Carbon|null $date
     * @return string
     */
    public function date()
    {
        return $this->created_at->toDateString();
    }

    public function formatted_date() 
    {
        if ($this->created_at->diffInDays() > 30) {
            return $this->created_at->toFormattedDateString();
        } 
        else {
            return $this->created_at->diffForHumans();
        }
    }

	/**
	 * Get the URL to the post.
	 *
	 * @return string
	 */
	public function url()
	{
		return Url::to($this->slug);
	}

	/**
	 * Returns the date of the blog post creation,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function created_at()
	{
		return $this->date($this->created_at);
	}

	/**
	 * Returns the date of the blog post last update,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function updated_at()
	{
        return $this->date($this->updated_at);
	}

    public function getPresenter()
    {
        return new PostPresenter($this);
    }

    public function section() {
    	return $this->belongsTo('Section');
    }

}
