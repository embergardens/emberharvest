<?php
/**
 * The main template file for the front-end.
 *
 * Since this is a headless cms, there is no front-end so this file redirects to the admin.
 *
 * @package emberharvest
 *
 */
?>

<?php if ( ! is_customize_preview() ) : ?>
	<script type="text/javascript">
		window.location.replace(window.location.protocol + "//" + window.location.hostname + "/wp-admin");
	</script>
<?php else : ?>
	No frontend loaded.
<?php endif; ?>
