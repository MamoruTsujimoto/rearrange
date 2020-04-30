<?php
global $rearrange;

get_header();
?>

<?php get_template_part('./template/entry-new-story'); ?>

<?php if (is_active_sidebar( 'top-contents')): ?>
<?php dynamic_sidebar( 'top-contents' ); ?>
<?php else: ?>
<?php get_template_part('./template/entry-story'); ?>
<?php get_template_part('./template/entry-wordpress'); ?>
<?php endif; ?>

<!-- footer -->
<?php get_footer(); ?>
