<?php
// Start counting time for the page load
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

// Include SimplePie
// Located in the parent directory
include_once('./simplepie/autoloader.php');
include_once('./simplepie/idn/idna_convert.class.php');

// Set static urls here
$staticUrl = [
	'https://www.reddit.com/r/conspiracy/.rss?#',
	'https://www.reddit.com/r/conspiratard/.rss?#',
	'http://www.infowars.com/feed/custom_feed_rss',
	'http://www.thespoof.com/rss/feeds/frontpage/rss.xml'
	];

// Create a new instance of the SimplePie object
$feed = new SimplePie();

//$feed->force_fsockopen(true);

if (isset($_GET['js']))
{
	SimplePie_Misc::output_javascript();
	die();
}

// Make sure that page is getting passed a URL
if (isset($staticUrl) && $staticUrl !== '')
{
	// Strip slashes if magic quotes is enabled (which automatically escapes certain characters)
	if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
	{
		$staticUrl = stripslashes($staticUrl);
	}

	// Use the URL that was passed to the page in SimplePie
	$feed->set_feed_url($staticUrl);
}

// Allow us to change the input encoding from the URL string if we want to. (optional)
if (!empty($_GET['input']))
{
	$feed->set_input_encoding($_GET['input']);
}

// Allow us to choose to not re-order the items by date. (optional)
if (!empty($_GET['orderbydate']) && $_GET['orderbydate'] == 'false')
{
	$feed->enable_order_by_date(false);
}

// Trigger force-feed
if (!empty($_GET['force']) && $_GET['force'] == 'true')
{
	$feed->force_feed(true);
}

// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and
// all that other good stuff.  The feed's information will not be available to SimplePie before
// this is called.
$success = $feed->init();

// We'll make sure that the right content type and character encoding gets set automatically.
// This function will grab the proper character encoding, as well as set the content type to text/html.
$feed->handle_content_type();

// When we end our PHP block, we want to make sure our DOCTYPE is on the top line to make
// sure that the browser snaps into Standards Mode.
?>

<!DOCTYPE html>
<html lang="en">
	<head>

	
		<title>ConspiriTracker</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="stylesheet" href="css/bootstrap.css" media="screen">
		<link rel="stylesheet" href="css/custom.min.css">
		
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="/mstile-144x144.png">
		<meta name="theme-color" content="#ffffff">
	</head>
	<body>
	<div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.html" class="navbar-brand">ConspiriTracker</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
				<li><a href="about.html">About</a></li>
				<li><a href="sites.html">Sites</a></li>
				<li><a href="store.html">Store</a></li>
				<li><a href="contact.html">Contact</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
				<li><button type="button" class="btn btn-default" id="backButton" onclick="backbutton()">Back</button></li>
				<li><a href="checkout.html">Checkout
				  <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
				</a></li>
			</ul>
        </div>
      </div>
    </div>
	<div class="container">
		<main>
		<div class="col-lg-8 col-md-7 col-sm-6">
		<div class="page-header" id="banner">
        <div class="row">
			<div class="col-lg-8 col-md-7 col-sm-6">
				<h1>ConspiriTracker</h1>
				<p class="lead">What they don't want you to know</p>
			</div>
          
			</div>
		</div>
		
		<div id="sp_results" class="col-md-8">

			<?php if ($success): ?>
				<?php foreach($feed->get_items(0, 10) as $item): ?>
					<div class="chunk">
						<h4><?php if ($item->get_permalink())
										echo '<a href="' . $item->get_permalink() . '">';
									echo $item->get_title();
									if ($item->get_permalink())
										echo '</a>';
								?>
								&nbsp;<span class="footnote">
								</br>
									<?php echo $item->get_date('j M Y, g:i a'); ?>
								</span>
						</h4>
						<?php echo $item->get_content(); ?>

						<?php
						
						if ($enclosure = $item->get_enclosure(0))
						{
							// Use the embed() method to embed the enclosure into the page inline.
							echo '<div align="center">';
							echo '<p>' . $enclosure->embed(array(
								'audio' => './for_the_demo/place_audio.png',
								'video' => './for_the_demo/place_video.png',
								'mediaplayer' => './for_the_demo/mediaplayer.swf',
								'altclass' => 'download'
							)) . '</p>';

							if ($enclosure->get_link() && $enclosure->get_type())
							{
								echo '<p class="footnote" align="center">(' . $enclosure->get_type();
								if ($enclosure->get_size())
								{
									echo '; ' . $enclosure->get_size() . ' MB';
								}
								echo ')</p>';
							}
							echo '</div>';
							echo '<hr>';
						}
						
						?>

					</div>
				<?php endforeach; ?>
			<?php endif; ?>

		</div>
		</div>
		<!-- Right column stuff -->
		<div class = "col-lg-4 col-md-5 col-sm-6">
			<h4>Featured Video</h4>
			<iframe width="100%" height="auto" src="https://www.youtube.com/embed/Pt-agRLVGGU" frameborder="0" allowfullscreen></iframe>
			<h4>Featured Audio</h4>
			<iframe width="100%" height="auto" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/192565410&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
			<h4>Feed Your Mind</h4>
			<img src="img/imagemap.png" width="100%" height="auto" alt="conspiracies" usemap="#conmap">
			<map name="conmap">
				<area shape="rect" coords="0,0,350,350" href="https://en.wikipedia.org/wiki/Illuminati" alt="illuminati">
				<area shape="rect" coords="0,350,350,700" href="https://en.wikipedia.org/wiki/Chemtrail_conspiracy_theory" alt="illuminati">
				<area shape="rect" coords="0,700,350,1050" href="https://en.wikipedia.org/wiki/Flat_Earth" alt="illuminati">
			</map>
		</div>
		<!-- END RIGHT COLUMN STUFF-->
		</main>
		<footer>
			<p>
				<a href="#top">Back to top</a><br>
				Copyright &copy 2015 ConspiriTracker - <a href="mailto:rbrown5262@student.gwinnetttech.edu">Ryan Brown</a>
			</p>
			<hr>
			<p>Theme Bootswatch Cyborg by <a href="http://thomaspark.co/">Thomas Park<a> <br>
			<a href="sitemap.html">Sitemap</a>
			</p>
		</footer>
	</div>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
	<script src="js/back.js"></script>
	</body>
</html>