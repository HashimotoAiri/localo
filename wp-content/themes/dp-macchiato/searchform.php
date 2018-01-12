<?php global $IS_MOBILE_DP; ?>
<form method="get" id="searchform"<?php if ($IS_MOBILE_DP) echo ' class="mb"'; ?> action="<?php echo esc_url( home_url( '/' ) ); ?>">
<div class="searchtext_div"><label for="searchtext" class="assistive-text"><?php _e( 'Search', 'DigiPress' ); ?></label>
<input type="text" class="field searchtext" name="s" id="searchtext" placeholder="<?php esc_attr_e( 'Search', 'DigiPress' ); ?>" /></div>
<input type="submit" class="searchsubmit" name="submit" value="" />
</form>
