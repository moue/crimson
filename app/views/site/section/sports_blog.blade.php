<div class="blog-shell">
    <div class="blog-box">
        
        <div class="blog-feature">
            <div class="article-image">
                {{ HTML::image(URL::asset('img/'.$feat_sports[1]->img)) }}
            </div>

            <h2 class="blog-title" id="backpage-title"><a href=
            "/blog/the-back-page/"><span class=
            "backpage-backpage">The Back Page</span> The Crimson
            Sports Blog</a></h2>

            <div class="blog-entry">
                <h3>{{ link_to($feat_sports[1]->url(), $feat_sports[1]->title) }}</h3>

                <div class="article-byline">
                    <time class="article-date">{{ $feat_sports[1]->formatted_date() }}</time>
                </div>
            </div>
        </div>

        <div class="blog-more">
            @for ($i=2; $i<4; $i++)
            <div class="blog-another">
                <div class="article-thumbnail">
                    {{ HTML::image(URL::asset('img/'.$feat_sports[$i]->img)) }}
                </div>

                <div class="blog-entry">
                    <h4>{{ link_to($feat_sports[$i]->url(), $feat_sports[$i]->title) }}</h4>

                    <div class="article-byline">
                        <time class="article-date">{{ $feat_sports[$i]->formatted_date() }}</time>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        
    </div>
</div>