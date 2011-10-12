<?php require_once('functions.php'); ?>
<html>
<head>
<title><?php bloginfo('name'); ?></title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.4.1/build/cssreset/cssreset-min.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.4.1/build/cssbase/cssbase-min.css">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('style.css' , __FILE__); ?>" />
<?php if (file_exists(get_stylesheet_directory().'/fbprofile.css')): ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/fbprofile.css" />	
<?php endif; ?>
<base target="_top" />
</head>
<body style="overflow:hidden;max-width:<?php echo fbprofile_is_page() ? '520px' : '760px'; ?>">
<div id="container">
<div id="content">
<div class="hfeed" style="margin-top: 10px;">
	<?php while ( have_posts() ) : the_post() ?>
    <div id="post-<?php the_ID() ?>" class="<?php fbprofile_post_class() ?>">
    <div style="float:right"><fb:share-button class="url" href="<?php the_permalink() ?>" /></div>
        <h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'fbprofile'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
        <div class="entry-content">
		<?php fbprofile_content('<span class="more-link">'.__('Continue Reading &raquo;', 'fbprofile').'</span>'); ?>
        </div>
        <div class="entry-meta">
            <span class="entry-date"><?php _e('Written on', 'fbprofile') ?> <abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php unset($previousday); printf(__('%1$s', 'fbprofile'), the_date('d F Y', false)) ?></abbr></span>
            <span class="meta-sep"> <?php _e('by', 'fbprofile') ?> </span> <span class="entry-author author vcard"><?php the_author_posts_link(); ?></span>
            <span class="meta-sep"> <?php _e('under', 'fbprofile'); ?> </span>
            <span class="entry-category"><?php the_category(', ') ?></span>
            <span class="meta-sep"> <?php _e('with', 'fbprofile'); ?> </span>
            <span class="entry-comments"><?php comments_popup_link(__('No Comments ', 'fbprofile'), __('1 Comment', 'fbprofile'), __('% Comments ', 'fbprofile')) ?></span>
            <?php the_tags('<br /><span class="entry-tags">'.__('Tagged with ', 'fbprofile'), ", ", "</span>") ?>
        </div>
    </div><!-- .post -->
	<?php endwhile ?>

	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link(__('&laquo; Earlier posts', 'fbprofile')) ?></div>
		<div class="nav-next"><?php previous_posts_link(__('Later posts &raquo;', 'fbprofile')) ?></div>
	</div>
</div><!-- .hfeed -->
</div><!-- #content -->
</div><!-- #container -->

<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function () {
	    FB.init({
	    	appId: '<?php echo get_option('FACEBOOK_APP_ID') ?>'
	    });

	    FB.Canvas.setSize();
	};
	
	(function () {
	    var e = document.createElement('script');
	    e.type = 'text/javascript';
	    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
	    e.async = true;
	    document.getElementById('fb-root').appendChild(e);
	} ());
<?php
# Google Analytics support 
$options = get_option('GoogleAnalyticsPP');
if (!empty($options) && !empty($options['uastring'])): ?>
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '<?php echo $options['uastring']; ?>']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
<?php endif; ?>
</script>
</body>
</html>