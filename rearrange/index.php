<?php
global $rearrange;

get_header();

get_template_part('slider'); 

?>

<!-- wrapper -->
<div id="wrapper" class="<?php echo $rearrange['column']['position']; ?>">

    <!-- side -->
    <?php if ( 'l-column' === $rearrange['column']['position'] ) get_sidebar(); ?>
    
    <!-- gadios wrapper -->
    <div id="rearrange-wrapper" class="<?php echo $rearrange['wrap']; ?>">
        <div class="rearrange-container">
            <!-- main -->
            <main>

                <?php get_template_part( 'entry', 'list' ); ?>
                
                <?php get_template_part( 'list', 'pagination' ); ?>
                
            </main> <!-- main -->
            <?php get_template_part( 'inc/body', 'class' ); ?>
        </div> <!-- /rearrange-container -->
    </div> <!-- /rearrange-wrapper -->
    
    <!-- side -->
    <?php if ( 'r-column' === $rearrange['column']['position'] ) get_sidebar(); ?>

</div> <!-- /wrapper -->


<!-- footer -->
<?php get_footer(); ?>