<!DOCTYPE html>

<html lang="en">

<head id="Starter-Site">

	<meta charset="UTF-8">

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>
		@section('title')
			{{{ $title }}} :: Administration
		@show
	</title>
	<link rel="icon" type="image/jpg" href="http://static.thecrimson.com/images/seal.jpg">

	<meta name="keywords" content="@yield('keywords')" />
	<meta name="author" content="@yield('author')" />
	<!-- Google will often use this as its description of your page/site. Make it good. -->
	<meta name="description" content="@yield('description')" />

	<!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
	<meta name="google-site-verification" content="">

	<!-- Dublin Core Metadata : http://dublincore.org/ -->
	<meta name="DC.title" content="Project Name">
	<meta name="DC.subject" content="@yield('description')">
	<meta name="DC.creator" content="@yield('author')">

	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- CSS -->
    {{ Basset::show('admin.css') }}

	<style>
	.tab-pane {
		padding-top: 20px;
	}
	</style>

	@yield('styles')

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
	<script type="text/javascript">
		var _gaq = _gaq || [];
	  	_gaq.push(['_setAccount', 'UA-31122385-3']);
	  	_gaq.push(['_trackPageview']);

	  	(function() {
	   		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  	})();

	</script> -->

</head>

<body>
	<!-- Container -->
	<div class="container">

		<!-- Notifications -->
		@include('notifications')
		<!-- ./ notifications -->

		<div class="page-header">
			<h3>
				{{ $title }}
				<div class="pull-right">
					<button class="btn btn-default btn-small btn-inverse close_popup"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</button>
				</div>
			</h3>
		</div>

		<!-- Content -->
		@yield('content')
		<!-- ./ content -->

		<!-- Footer -->
		<footer class="clearfix">
			@yield('footer')
		</footer>
		<!-- ./ Footer -->

	</div>
	<!-- ./ container -->

	<!-- Javascripts -->
    {{ Basset::show('admin.js') }}

 <script type="text/javascript">
$(document).ready(function(){
$('.close_popup').click(function(){
parent.oTable.fnReloadAjax();
parent.jQuery.fn.colorbox.close();
return false;
});
$('#deleteForm').submit(function(event) {
var form = $(this);
$.ajax({
type: form.attr('method'),
url: form.attr('action'),
data: form.serialize()
}).done(function() {
parent.jQuery.colorbox.close();
parent.oTable.fnReloadAjax();
}).fail(function() {
});
event.preventDefault();
});
});

$('.wysihtml5').wysihtml5({
    "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
    "emphasis": true, //Italics, bold, etc. Default true
    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
    "html": true, //Button which allows you to edit the generated HTML. Default false
    "link": false, //Button to insert a link. Default true
    "image": false, //Button to insert an image. Default true,
    "color": false, //Button to change color of font
    "size": 'sm' //Button size like sm, xs etc.
});

$(prettyPrint)
</script>

    @yield('scripts')

</body>

</html>