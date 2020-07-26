<aside id="menu"<?php if(is_user_logged_in()) echo 'class="is-login"'; ?>>
  <div id="menu-inner">
    <div id="close">
      <span></span>
    </div>
    <div id="menu-story">
      <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
      <?php dynamic_sidebar( 'sidebar' ); ?>
      <?php endif; ?>
    </div>
  </div>
</aside>