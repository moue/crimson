@extends('site.layouts.default')

{{-- Content --}}
@section('content')

@include('site.section.news')

@include('site.layouts.partials.row')

@include('site.layouts.partials.secondary')

<section id="tertiary">
    <div id="tertiary-first">
        @include('site.section.sports')

        @include('site.section.art')

    </div>

    <div id="tertiary-second">
        @include('site.section.sports_blog')

        <div class="sidekick">
           <a href="#"><img src="http://adspecs.aol.com/sites/adspecs.aol.com/files/examples/Mobile300x250.jpg"></a>
        </div>

        <div class="sidekick">
            <a href="#"><img src="http://i.marketingprofs.com/assets/images/articles/lg/140307-socialskim-lg.jpg"></a>
        </div>
    </div>
</section>

@stop
