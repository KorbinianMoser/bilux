<?php



$slug = $wp_query->queried_object->post_name;


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Birgit Luxenburger<?php wp_title(' - ') ?></title>
<?php wp_head() ?>
<meta name="viewport" content="width=1000" />
<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' data:" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>" />
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/mootools-yui-compressed.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/scripts.js"></script>
</head>

<body>




<div id="center">
    <div id="left">
    	<h1><a href="<?php bloginfo('wpurl') ?>" title="Zur Startseite"><span class="hidden"><?php wp_title('') ?> | </span>Birgit Luxenburger</a></h1>
        <ul id="nav">
        	<li><a <?php if($slug=='kompetenzen') echo 'class="active" ' ?> href="<?php bloginfo('wpurl') ?>/kompetenzen/">Kompetenzen</a></li>
        	<li><a <?php if($slug=='referenzen') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/referenzen/">Referenzen</a></li>
        	<li><a <?php if($slug=='links') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/links/">Links</a></li>
        	<li><a <?php if($slug=='kontakt') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/kontakt/">Kontakt</a></li>
        </ul>
    </div>
    <div id="right">
        <ul id="nav">
        	<li><a <?php if($slug=='fotografie') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/fotografie/">Fotografie</a></li>
        	<li><a <?php if($slug=='kunstkataloge') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/kunstkataloge/">Kunstkataloge</a></li>
        	<li><a <?php if($slug=='plakate') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/plakate/">Plakate</a></li>
        	<li><a <?php if($slug=='broschueren') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/broschueren/">Broschüren</a></li>
        	<li><a <?php if($slug=='einladungskarten') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/einladungskarten/">Einladungskarten</a></li>
        </ul>
        <ul id="items"></ul>
        <div id="content">

<?php

	if( have_posts()) while( have_posts()):the_post();
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
            <ul id="nav">
                <li><a <?php if($slug=='impressum') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/impressum/">Impressum</a></li>
                <li><a <?php if($slug=='datenschutz') echo 'class="active" ' ?>  href="<?php bloginfo('wpurl') ?>/datenschutz/">Datenschutz</a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>



</body>
</html>



