<div style="margin: 10px 0;">
      <section id="row">
        @foreach ($randoms as $post)
        <div class="row article">
           {{ HTML::image(URL::asset('img/'.$post->img), 'alt', ['width'=>'130', 'height'=>'90']) }}

          <div class="row-section article-section">
            <a href="/tag/columns">Columns</a>
          </div>

          <h3>{{ link_to($post->url(), $post->title) }}</h3>
        </div>

        
        @endforeach
      </section>
    </div>