<?php
/**
 * @package hello_teb
 * @version 0.0.1
 */
/*
Plugin Name: Hello Teb
Version: 0.0.1
*/

function hello_darkness_get_lyric() {
	/** These are the lyrics to Hello darkness */
	$lyrics = "Hello darkness, my old friend,
    I've come to talk with you again,
    Because a vision softly creeping,
    Left its seeds while I was sleeping,
    And the vision that was planted in my brain
    Still remains
    Within the sound of silence.  
    In restless dreams I walked alone 
    Narrow streets of cobblestone,
    Neath the halo of a street lamp,
    I turned my collar to the cold and damp
    When my eyes were stabbed by the flash of a neon light
    That split the night
    And touched the sound of silence.  
    And in the naked light I saw
    Ten thousand people, maybe more.
    People talking without speaking,
    People hearing without listening,
    People writing songs that voices never share 
    And no one dared 
    Disturb the sound of silence.";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hello_darkness() {
	$chosen = hello_darkness_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="darkness"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Hello darkness song, by Jerry Herman:', 'hello-darkness' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hello_darkness' );

// We need some CSS to position the paragraph.
function darkness_css() {
	echo "
	<style type='text/css'>
	#darkness {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #darkness {
		float: left;
	}
	.block-editor-page #darkness {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#darkness,
		.rtl #darkness {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'darkness_css' );


?>