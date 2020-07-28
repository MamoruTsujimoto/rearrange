<?php
/*---------------------------------------------------------------------------
 * Google Analytics
 *---------------------------------------------------------------------------*/
global $rearrange;

if ( isset( $rearrange['analytics']['do_not_load'] ) && is_user_logged_in() ) {
  return;
}

if ( isset( $rearrange['analytics']['tag-noscript'] ) && !is_user_logged_in() ) {
  echo $rearrange['analytics']['tag-noscript'];
}