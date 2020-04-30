<?php

global $rearrange;

if ( isset( $rearrange['god_mode']['enable'] ) && true === $rearrange['god_mode']['enable'] ) {
    
    $body_class = implode( ' ', get_body_class() );
    echo '<script type="text/body-class">' . $body_class . '</script>';

}

