<section id="secondary">
    <div id="secondary-first">
        <div id="section-opinion" class="section-box">
            <h2 class="section-header"><a href="/section/opinion/">Opinion</a></h2>
            <div class="raise" style="position: relative; z-index: 5;">
                @foreach($opinions as $opinion)
                <div class="section-article">
                    
                    <div class="article-section">
                        <a href="/tag/columns">Columns</a>
                    </div>
                    <h3>{{ link_to($opinion->url(), $opinion->title) }}</h3>
                    <div class="article-byline">
                        By {{ $opinion->author->name }} 
                        <time class="article-date">{{ $opinion->formatted_date() }}</time>
                    </div>
                    <p>{{ String::tidy(Str::limit($opinion->content, 200)) }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="secondary-second">
        @for($i=4; $i<6; $i++) 
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

        <div class="more-news">
            <h3>More News</h3>
            <ul>
                @for($i=6; $i<10; $i++)
                <li>{{ link_to($posts[$i]->url(), $posts[$i]->title) }}</li>
                @endfor
            </ul>
        </div>
    </div>
        

    <div id="secondary-third">
        <div id="photo-box">
            <h2 class="media-title"><a href="/section/media/">Photo</a></h2>
            
            @foreach ($photos as $photo)
            <div class="media-entry">
                {{ HTML::image(URL::asset('img/'.$photo->img), 'alt', array('width'=>143, 'height'=>119)) }}
                <h4 style="padding:5px;">{{ link_to($photo->url(), 'Today in Photos ('. $photo->date().')') }}</h4>
            </div>
            @endforeach
        </div>

        
        @include('site.layouts.partials.media')

        @include('site.section.fm')
    </div>
</section>