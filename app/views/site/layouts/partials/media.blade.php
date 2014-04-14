<div id="media-shell">
    <div id="media-box">
        <h2 class="media-title"><a href="/section/media/">Media</a></h2>
        @foreach ($sections['5']->posts->slice(0,3) as $index=>$post)
        @if($index===0)
        <div class="media-feature">
            <div class="media-entry">
                <div>
        
        @else
            <div class="media-another">
                <div class="media-thumbnail">
        @endif
                    {{ HTML::image(URL::asset('img/'.$post->img), 'alt', ['width'=>'100%']) }}
                    <h3>{{ link_to($post->url(), $post->title) }}</h3>
                    <div class="media-byline"><time class="article-date">{{ $post->formatted_date() }}</time></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
