<?php if ( has_nav_menu( 'header' ) ): ?>
<div id="site-menu">
  <ul>
    <?php
        $args = [
          'container'       => false,
          'fallback_cb'     => false,
          'depth'           => 1,
          'theme_location'  => 'header',
          'items_wrap'      => '%3$s',
        ];
        wp_nav_menu( $args );
    ?>
  </ul>
</div>
<?php endif; ?>
