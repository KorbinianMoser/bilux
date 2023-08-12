<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$slug = $wp_query->queried_object->post_name;



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Birgit Luxenburger<?php wp_title(' - ') ?></title>
<?php wp_head() ?>
<!-- <meta name="viewport" content="width=1000" /> -->
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' data:" />
<link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/favicon.png" type="image/x-icon" />
</head>

<body>




<div id="center">
    <div id="mobile-nav" class="open">
        <h1 class="site-title"><a href="#" title="Menü öffnen"><span class="burger-icon"><span></span><span></span><span></span></span>Birgit Luxenburger</a></h1>
        <?php wp_nav_menu(['theme_location'=>'mobile']); ?>
    </div>
    <div id="left">
    	<h1 class="site-title"><a href="<?php bloginfo('wpurl') ?>" title="Zur Startseite"><span class="hidden"><?php wp_title('') ?> | </span>Birgit Luxenburger</a></h1>
        <?php wp_nav_menu(['theme_location'=>'texts']); ?>
    </div>
    <div id="right">
        <?php wp_nav_menu(['theme_location'=>'works']); ?>
        <ul id="items"></ul>
        <div id="content">

<?php
	if( have_posts()) while( have_posts()):the_post();
    // echo '<pre>test: '.print_r($post,true).'</pre>';
	if( get_post_type()=='page')
	{
		the_content();
		echo '&nbsp;';
	}
	elseif( get_post_type()=='post')
	{
		$anchor = basename( get_permalink($post->ID));
		echo '<div id="'.$anchor.'" class="post">';
		if( count($posts)>1)
		{
			echo '<h2><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h2>';
			$ex = trim(get_the_excerpt());	
			$ex = preg_replace( '/\<\/p\>$/', '', $ex);
			$ex .= '... <a href="'.get_permalink($post->ID).'" title="Weiterlesen" class="details">&gt;</a></p>';
			echo $ex;
			echo '&nbsp;';
		}
		else
		{
			echo '<h2>'; the_title(); echo '</h2>';
			the_content();
			echo '<p><a href="'.get_bloginfo('wpurl').'/seminare/#'.$anchor.'" title="Zurück zur Übersicht" class="details">&lt;</a></p>';
			echo '&nbsp;';
		}
		echo '</div>';
	}
	endwhile;

?>

        </div>
        <div id="footer">
            <?php wp_nav_menu(['theme_location'=>'footer']); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>


<?php wp_footer() ?>

</body>
</html>



