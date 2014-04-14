<div class="large-screen-only">
  <div class="blog-shell">
    <div class="blog-box">
      @foreach ($sections['6']->posts->slice(0,1) as $post)

      <div class="blog-feature">
        <div class="article-image">
          {{ HTML::image(URL::asset('img/'.$post->img), 'alt', ['width'=>'100%']) }}
        </div>

        <h2 class="blog-title" id="flyby-title"><a href=
        "/section/flyby"><span class="flyby-flyby">Flyby</span>
        Blog</a></h2>

        @include('site.layouts.partials.blog_entry')
      </div>
      @endforeach

      <div class="blog-more">
        @foreach ($sections['6']->posts->slice(1,3) as $post)
        <div class="blog-another">
          <div class="article-thumbnail">
            {{ HTML::image(URL::asset('img/'.$post->img), 'alt', ['width'=>'100%']) }}
          </div>

          @include('site.layouts.partials.blog_entry')
        </div>
        @endforeach

      </div>
    </div>
  </div>
</div>