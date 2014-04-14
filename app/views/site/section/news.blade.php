<section id="primary">
    <div id="primary-first">
        <div class="article feature vertical">
            <div class="article-image">
                {{ HTML::image(URL::asset('img/'.$feat_post->img)) }}
            </div>
            
            <div class="article-content">
                <h2>{{ link_to($feat_post->url(), $feat_post->title) }}</h2>
                <div class="article-byline">
                    By {{ $feat_post->author->name }} 
                    <time class="article-date">{{ $feat_post->formatted_date() }}</time>
                </div>

                <p>{{ String::tidy(Str::limit($feat_post->content, 200)) }}</p>

                <div class="article-comments">
                    <a href=
                    "/article/2014/4/5/divinity-school-campaign-launch/#article-comments">
                    <span class="comment-count">1</span> comment</a>
                </div>
            </div>
        </div>
        
        @for($i=0; $i<2; $i++) 
        <div class="article">
            <div class="article-content">
                <h3>{{ link_to($posts[$i]->url(), $posts[$i]->title) }}</h3>

                <div class="article-byline">
                    By {{ $posts[$i]->author->writer }} 
                    <time class="article-date">{{ $posts[$i]->formatted_date() }}</time>
                </div>

                <p>{{ String::tidy(Str::limit($posts[$i]->content, 200)) }}</p>

                <div class="article-comments">
                    <a href=
                    "/article/2014/4/3/faust-sexual-misconduct-task-force/#article-comments">
                    <span class="comment-count">22</span> comments</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
    
    <div id="primary-second">
        @for($i=2; $i<4; $i++) 
        @if($i==2)
        <div class="article bigger">
            <div class="article-content">
                <h2>{{ link_to($posts[$i]->url(), $posts[$i]->title) }}</h2>

                <div class="article-byline">
                    By {{ $posts[$i]->author->name }} <time class="article-date">{{ $posts[$i]->formatted_date() }}</time>
                </div>

                <p>{{ String::tidy(Str::limit($posts[$i]->content, 200)) }}</p>

                <div class="article-comments">
                    <a href=
                    "/article/2014/4/6/pfoho-sophomore-fall/#article-comments">
                    <span class="comment-count">1</span> comment</a>
                </div>
            </div>
        </div>
        @endif

        <div class="article">
            <div class="article-content">
                <h3>{{ link_to($posts[$i]->url(), $posts[$i]->title) }}</h3>

                <div class="article-byline">
                    By {{ $posts[$i]->author->name }} <time class="article-date">{{ $posts[$i]->formatted_date() }}</time>
                </div>

                <p>{{ String::tidy(Str::limit($posts[$i]->content, 200)) }}</p>

                <div class="article-comments">
                    <a href=
                    "/article/2014/4/3/faust-sexual-misconduct-task-force/#article-comments">
                    <span class="comment-count">22</span> comments</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</section>
