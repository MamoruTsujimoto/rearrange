<?php
global $rearrange;
$placeholder = '検索したいキーワード';
$rearrange['search_query'] = get_search_query();
?>
<?php
$microtime = explode( ' ', microtime() );
$mt = floor( $microtime[0] * 1000 );
?>
<form role="search" method="get" class="search-form" action="<?php echo $rearrange['home_url']; ?>">
	<label for="search-field<?php echo $mt; ?>">
		<input type="search" class="search-field" id="search-field<?php echo $mt; ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo $rearrange['search_query']; ?>" name="s" title="サイト内検索" />
	</label>
	<button type="submit" class="search-submit" name="search-submit" value="検索" title="検索">
		<svg class="search-icon" height="20" width="20" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <path d="M18.869 19.162l-5.943-6.484c1.339-1.401 2.075-3.233 2.075-5.178 0-2.003-0.78-3.887-2.197-5.303s-3.3-2.197-5.303-2.197-3.887 0.78-5.303 2.197-2.197 3.3-2.197 5.303 0.78 3.887 2.197 5.303 3.3 2.197 5.303 2.197c1.726 0 3.362-0.579 4.688-1.645l5.943 6.483c0.099 0.108 0.233 0.162 0.369 0.162 0.121 0 0.242-0.043 0.338-0.131 0.204-0.187 0.217-0.503 0.031-0.706zM1 7.5c0-3.584 2.916-6.5 6.5-6.5s6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5-6.5-2.916-6.5-6.5z"></path>
    </svg>
  </button>
</form>