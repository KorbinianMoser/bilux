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
        <!--
        <ul id="nav">
        	<li><a <?php if($slug=='vita') echo 'class="active" ' ?> href="<?php bloginfo('wpurl') ?>/vita/">Vita</a></li>
        	<li><a <?php if($slug=='bibliographie') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/bibliographie/">Texte</a></li>
        	<li><a <?php if($slug=='seminare') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/seminare/">Seminare</a></li>
        	<li><a <?php if($slug=='links') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/links/">Links</a></li>
        	<li><a <?php if($slug=='kontakt') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/kontakt/">Kontakt</a></li>
        </ul>
        -->
    </div>
    <div id="right">
        <?php wp_nav_menu(['theme_location'=>'works']); ?>
        <!--
        <ul id="nav">
        	<li><a <?php if($slug=='malerei') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/malerei/">Malerei</a></li>
        	<li><a <?php if($slug=='auf-papier') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/auf-papier/">Auf Papier</a></li>
        	<li><a <?php if($slug=='fotografische-arbeiten') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/fotografische-arbeiten/">Fotografie</a></li>
        	<li><a <?php if($slug=='installation') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/installation/">Installation</a></li>
        	<li><a <?php if($slug=='kunst-am-bau') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/kunst-am-bau/">Kunst am Bau</a></li>
        </ul>
        -->
        <ul id="items"></ul>
        <div id="content">

<?php

    // echo '- '.have_posts().' -';

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
		// echo '<div class="postDate">'.get_the_date('d.m.Y').'</div>';
		echo '</div>';
	}
	endwhile;

?>

        </div>
        <div id="footer">
            <?php wp_nav_menu(['theme_location'=>'footer']); ?>
            <!--
            <ul id="nav">
                <li><a <?php if($slug=='impressum') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/impressum/">Impressum</a></li>
                <li><a <?php if($slug=='datenschutz') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/datenschutz/">Datenschutz</a></li>
            </ul>
            -->
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>


<?php wp_footer() ?>

</body>
</html>



