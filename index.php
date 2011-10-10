<?php

/**
 * Widget Dropdowns.
 *
 * @todo Move all "positioning" and "sizing" styles into js.
 */

?><!doctype html>
<html lang="en">
	<head>
		<title>Widget Dropdowns</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php print get_stylesheet_uri(); ?>" media="all">
		<?php wp_head(); ?>
	</head>
	<body>

		<div id="container">

		<?php

			get_template_part( 'dropdowns' );
			#get_template_part( 'dropdowns', 'debug' );
		?>

		</div>

		<?php wp_footer(); ?>

	</body>
</html>