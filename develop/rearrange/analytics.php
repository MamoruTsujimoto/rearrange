<?php

/*---------------------------------------------------------------------------
 * Google Analytics
 *---------------------------------------------------------------------------*/
global $rearrange;

if ( isset( $rearrange['analytics']['do_not_load'] ) && is_user_logged_in() ) {
    return;
}

if ( '' !== $rearrange['analytics']['tag'] ) {
    echo $rearrange['analytics']['tag'];
}