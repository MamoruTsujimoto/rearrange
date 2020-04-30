<aside id="side">
    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar' ); ?>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'sidebar-fixed' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-fixed' ); ?>
    <?php endif; ?>
</aside>