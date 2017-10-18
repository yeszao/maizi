<?php
/**
 * The template for displaying search forms in Underscores.me
 *
 */

?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<div class="input-group">
		<input class="field form-control" id="s" name="s" type="text"
			placeholder="<?php esc_attr_e( 'Search &hellip;', 'maizi' ); ?>">
		<span class="input-group-btn">
			<input class="submit btn btn-primary" id="searchsubmit" name="submit" type="submit"
			value="<?php esc_attr_e( 'Search', 'maizi' ); ?>">
	</span>
	</div>
</form>
