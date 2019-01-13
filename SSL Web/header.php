<?php
    if ( defined( 'RESTRICTED' ) ) {
        if ( !isset( $_SESSION['login_flag'] ) ) {
            header( 'Location: index.php' );
            exit();
        }
    }elseif ( defined( 'SEND_TO_HOME' ) && isset( $_SESSION['login_flag'] ) ) {
        header( 'Location: admin.php' );
        exit();
    }
    function page_header(){
        if ( defined( 'SEND_TO_HOME' ) && isset( $_SESSION['login_flag'] ) ) {
            header( 'Location: admin.php' );
            exit();
        }
    }
?>