<div class="sidebar" id="most-read-shell">
  <div id="most-read-box">
    <h3>Most Read</h3>

    <ol>
      @foreach($recentPosts as $post)
        <li>{{link_to_route('post.show',$post->title,$post->id)}}</li>
      @endforeach
    </ol>
  </div>
</div>