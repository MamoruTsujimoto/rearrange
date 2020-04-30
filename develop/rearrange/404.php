<?php
global $rearrange;

get_header();
?>

<!-- wrapper -->
<div id="wrapper">

  <!-- gadios wrapper -->
  <div id="rearrange-wrapper">
    <div class="rearrange-container">
      <!-- main -->
      <main>
        <article id="entry">
          <div id="not-found">
            <p>404</p>
            <p>Page not found</p>
            <h1>お探しのページは見つかりませんでした。</h1>
            <a href="<?php echo $rearrange['home_url']; ?>">ホーム</a>
          </div>
        </article>
      </main> <!-- /main -->
      <?php get_template_part( 'inc/body', 'class' ); ?>

      <script>
        const is_god = document.querySelector('script[src*="god.min.js"]');
        if (is_god) {
          document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href]');
            for(var i = 0, l = links.length; i < l; i++) {
              links[i].classList.add('no-god');
            }
          });
        }
      </script>
    </div> <!-- /rearrange-container -->
  </div> <!-- /rearrange-wrapper -->

</div> <!-- /wrapper -->

<!-- footer -->
<?php get_footer(); ?>