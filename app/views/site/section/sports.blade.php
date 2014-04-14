<div class="section-box" id="section-sports">
    <div class="section-box-first">
        <h2 class="section-header"><a href=
        "/section/sports/">Sports</a></h2>

        <div class="section-article section-feature">
            <div class="article-image">
                {{ HTML::image(URL::asset('img/'.$feat_sports[0]->img), 'alt', array('width'=>'100%')) }}
            </div>

            <div class="section-feature-text">
                <div class="article-section">
                    <a href="/tag/men's-basketball">Men's
                    Basketball</a>
                </div>

                <h2>{{ link_to($feat_sports[0]->url(), $feat_sports[0]->title) }}</h2>

                <div class="article-byline">
                    By {{ $feat_sports[0]->author->name }}
                    <time>{{ $feat_sports[0]->formatted_date() }}</time>
                </div>

                <p>{{ String::tidy(Str::limit($feat_sports[0]->content, 200)) }}/p>
            </div>
        </div>
    </div>
    <div class="section-box-second">
        @for($i=0; $i<3; $i++)
        <div class="section-article">
            <div class="article-section">
                <a href="/tag/softball">Softball</a>
            </div>

            <h3>{{ link_to($sports[$i]->url(), $sports[$i]->title) }}</h3>

            <div class="article-byline">
                By {{ $sports[$i]->author->name }} 
                <time class="article-date">{{ $sports[$i]->formatted_date() }}</time>
            </div>
        </div>
        @endfor
    </div>
</div>