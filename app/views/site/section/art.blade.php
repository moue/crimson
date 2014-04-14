<div class="section-box" id="section-arts">
    <div class="section-box-first">
        <h2 class="section-header"><a href=
        "/section/arts/">Arts</a></h2>

        <div class="section-article section-feature">
            <div class="article-image">
                {{ HTML::image(URL::asset('img/'.$feat_arts[0]->img), 'alt', array('width'=>'100%')) }}
            </div>

            <div class="section-feature-text">
                <div class="article-section">
                    <a href="/tag/men's-basketball">Men's
                    Basketball</a>
                </div>

                <h2>{{ link_to($feat_arts[0]->url(), $feat_arts[0]->title) }}</h2>

                <div class="article-byline">
                    By {{ $feat_arts[0]->author->name }}
                    <time class="article-date">{{ $feat_arts[0]->formatted_date() }}</time>
                </div>

                <p>{{ String::tidy(Str::limit($feat_arts[0]->content, 200)) }}</p>
            </div>
        </div>
    </div>
    <div class="section-box-second">
        @for($i=0; $i<3; $i++)
        <div class="section-article">
            <div class="article-section">
                <a href="/tag/softball">Softball</a>
            </div>

            <h3>{{ link_to($arts[$i]->url(), $arts[$i]->title) }}</h3>

            <div class="article-byline">
                By {{ $arts[$i]->author->name }} 
                <time class="article-date">{{ $arts[$i]->formatted_date() }}</time>
            </div>
        </div>
        @endfor
    </div>
</div>