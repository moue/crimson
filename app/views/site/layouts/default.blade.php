<!DOCTYPE html>

<html lang="en">
<head>
  <title>
    @section('title')
    The Harvard Crimson
    @show
  </title>

  <meta charset="utf-8">
  <meta content="IE=Edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta property="og:image" content="http://static.thecrimson.com/images/seal.jpg">

  {{ Basset::show('public.css') }}

  <style>
  [touch-action="none"]{ -ms-touch-action: none; touch-action: none; }[touch-action="pan-x"]{ -ms-touch-action: pan-x; touch-action: pan-x; }[touch-action="pan-y"]{ -ms-touch-action: pan-y; touch-action: pan-y; }[touch-action="scroll"],[touch-action="pan-x pan-y"],[touch-action="pan-y pan-x"]{ -ms-touch-action: pan-x pan-y; touch-action: pan-x pan-y; }
  </style>
</head>

<body style="zoom: 1;">
  <header>
    <div id="masthead">
      <div id="masthead-first-wrapper">
        <div id="toolbar">
          <div id="toolbar-container">
            <nav id="toolbar-colophon">
              <ul>

                <li><a href="http://www.thecrimsonadvertising.com/" target=
                "_blank">Advertising</a></li>

                <li><a href="http://conferences.thecrimson.com/">Journalism
                Conference</a></li>

                @if (Auth::check())
                @if (Auth::user()->hasRole('admin'))
                <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
                @endif
                <li><a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a></li>
                <li><a href="{{{ URL::to('user/logout') }}}">Logout</a></li>
                @else
                <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                <li {{ (Request::is('user/register') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                @endif
              </ul>
            </nav>

            <nav id="toolbar-social"></nav>

            <div id="toolbar-weather">
              <a href="http://www.accuweather.com/en/us/cambridge-ma/02138/weather-forecast/756_pc">
                <span class="weather-locale">Cambridge, MA</span> Weather: 54°F
              </a>
            </div>

            <div id="masthead-search-mobile">
              <form action="/search/" id="cse-search-box" name=
              "cse-search-box">
                <input name="cx" type="hidden" value=
                "013815813102981840311:aw6l9tjs1a0"> <input name="cof" type=
                "hidden" value="FORID:10"> <input name="ie" type="hidden"
                value="UTF-8"> <input class="query" name="q" type="text">
                <button class="search-submit" name="sa" type=
                "submit">Search</button>
              </form>
            </div>
          </div>
        </div>

        <div id="masthead-first">
          <div id="masthead-first-container">
            <h1><a href="/">The Harvard Crimson</a></h1>

            <div id="masthead-search">
              <form action="/search/" id="cse-search-box" name=
              "cse-search-box">
                <input name="cx" type="hidden" value=
                "013815813102981840311:aw6l9tjs1a0"> <input name="cof" type=
                "hidden" value="FORID:10"> <input name="ie" type="hidden"
                value="UTF-8"> <input class="query" name="q" type="text">
                <button class="search-submit" name="sa" type=
                "submit">Search</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div id="masthead-second">
        <nav id="masthead-nav-mobile">
          <ul>
            <li><a href="#">Sections</a></li>
          </ul>
        </nav>

        <nav class="mobile-hidden" id="masthead-nav">
          <ul>
            <li><a href="/section/news/">News</a></li>

            <li><a href="/section/opinion/">Opinion</a></li>

            <li><a href="/section/fm/">Magazine</a></li>

            <li><a href="/section/sports/">Sports</a></li>

            <li><a href="/section/arts/">Arts</a></li>

            <li><a href="/section/media/">Media</a></li>

            <li><a href="/section/flyby/">Flyby</a></li>

            <li><a href="/admissions/">Admissions</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <div id="content">
    <div class="leaderboard">
      <a href="#"><img src="http://thefitchen.com/wp-content/uploads/2013/08/Garden-of-Life-footer-Ad.jpg" width=728 height=90></a>
    </div>

    <section id="main">
      <div id="body">
        <div id="article-content">
          @yield('content')
        </div>
      </div>

      <div id="sidebar">

        @include('site.layouts.partials.flyby')
        @include ('site.layouts.partials.popular_posts')

      </div>
    </section>
  </div>

  <footer>
    <div id="footer-first">
      <h1><a href="/">The Harvard Crimson</a></h1>
    </div>

    <div id="footer-second">
      <p>Copyright © 2014 The Harvard Crimson, Inc.</p>

      <nav id="footer-nav">
        <ul>
          <li><a href="/about/privacy/">Privacy Policy</a></li>

          <li><a href="/about/permissions/">Rights &amp; Permissions</a></li>

          <li><a href="/contact/">Contact Us</a></li>

          <li><a href="/contact/">Corrections</a></li>

          <li><a href="/subscribe/">Subscriptions</a></li>

          <li><a href="/sitemap/">Archives</a></li>

          <li><a href="/sitemap/contributors/">Writers</a></li>
        </ul>
      </nav>
    </div>
  </footer>

  
</body>
</html>