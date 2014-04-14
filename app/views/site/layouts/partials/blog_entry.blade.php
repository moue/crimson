<div class="blog-entry">
  <h3>{{ link_to($post->url(), $post->title) }}</h3>

  <div class="article-byline">
    <time class="article-date">{{ $post->formatted_date() }}</time>
  </div>
</div>