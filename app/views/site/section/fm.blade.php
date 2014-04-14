
<div id="fm-shell">
        <div id="fm-box">
            <div id="fm-container">
                <div id="fm-first">
                    <div id="fm-feature">
                        <div class="section-article section-feature">
                            <div class="article-image" style="max-height: 210px; overflow:hidden;">
                                {{ HTML::image(URL::asset('img/'.$features['2']->posts[0]->img)) }}
                            </div>

                            <div id="fm-logo">
                                <a href="/section/fm/"><img src=
                                "http://static.thecrimson.com/images/fm-logo.png"></a>
                            </div>

                            <div class="section-feature-text">
                                <div class="article-section">
                                    <a href="/tag/scrutiny">Scrutiny</a>
                                </div>

                                <h2>{{ link_to($features['2']->posts[0]->url(), $features['2']->posts[0]->title) }}</h2>

                                <div class="article-byline">
                                    By {{ $features['2']->posts[0]->name }} 
                                    <date class="article-date">{{ $features['2']->posts[0]->formatted_date() }}</date>
                                </div>

                                <p>{{ String::tidy(Str::limit($features['2']->posts[0]->content, 200)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="fm-second">
                @for($i=0; $i<4; $i++)
                    @if($sections['2']->posts[$i]->title != $repeats['2'])
                    <div class="section-article">
                        <div class="article-section">
                            <a href="/tag/house-life">House Life</a>
                        </div>

                        <h3>{{ link_to($sections['2']->posts[$i]->url(), $sections['2']->posts[$i]->title) }}</h3>

                        <div class="article-byline">
                            By {{ $sections['2']->posts[$i]->name }} 
                            <date class="article-date">{{ $sections['2']->posts[$i]->formatted_date() }}</date>
                        </div>
                    </div>
                    @endif
                @endfor               
                </div>
            </div>
        </div>
    </div>
