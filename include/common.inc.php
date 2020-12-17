<?php
	$path_parts = pathinfo( $_SELF_PATH_ );
    $dirname = $path_parts['dirname'];
	if ( $dirname != '/' ) $dirname .= '/';
	$_bp_ = $dirname . $_REL_PATH_;
	$_host_ =  $_SERVER["HTTP_HOST"];
	$_http_ = "http://" . $_host_ . $_bp_;
	$_https_ = "https://" . $_host_ . $_bp_;

	//-- For local versions
	$_http_ = str_replace( "/httpsdocs/", "/httpdocs/", $_http_ );
	$_https_ = str_replace( "/httpdocs/", "/httpsdocs/", $_https_ );
?>
