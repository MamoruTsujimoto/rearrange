<?php
global $rearrange;

if( ! isset( $content_width ) ) $content_width = 1400;

$facebook_ogp_prefix = '';
if ( isset( $rearrange['head_tag']['facebook_ogp'] ) || isset( $rearrange['head_tag']['twitter_card'] ) ) {
  $facebook_ogp_prefix = ' prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article# fb: http://ogp.me/ns/fb#"';
}

$description = get_bloginfo( 'description' );
if ( isset( $rearrange['head_tag']['description'] ) && ! empty( $rearrange['head_tag']['description'] ) ) {
  $rearrange['site_description'] = $rearrange['head_tag']['description'];
} else {
  $rearrange['site_description'] = $description;
}

$rearrange['header_img'] = get_header_image();

/* カラム設定 */
if ( 'l-column' === $rearrange['column']['position'] ) {
  $rearrange['wrap'] = 'r-wrap';
} else {
  $rearrange['wrap'] = 'l-wrap';
}

$rearrange['site_name'] = get_bloginfo( 'name' );
$rearrange['home_url'] = esc_url( get_home_url( null, '/' ) );

/* Class設定 */
$class = '';
if (is_page('post-status')) {
  $class = 'status';
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head<?php echo $facebook_ogp_prefix; ?>>
<?php get_template_part( 'analytics' ); ?>
<?php wp_head(); ?>
<?php get_template_part( 'add', 'header' ); ?>
</head>
<body <?php body_class($class); ?>>
  <?php get_template_part( 'analytics-noscript' ); ?>

  <div id="global-wrapper">
  <!-- header -->
  <?php get_template_part('./components/global-header'); ?>
  <?php get_template_part('./components/navigation'); ?>
  <main>