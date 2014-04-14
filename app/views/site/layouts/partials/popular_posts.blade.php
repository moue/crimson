<div class="sidebar" id="most-read-shell">
  <div id="most-read-box">
    <h3>Most Read</h3>

    <ol>
      @foreach($popularPosts as $post)
      	<li><a href="{{{ $post->url() }}}">{{ String::title($post->title) }}</a></li>
      @endforeach
    </ol>
  </div>
</div>