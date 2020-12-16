<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $GLOBALS['PAGE_TITLE']; ?></title>

<?php 

	//-----------------------------------------------------------
	//
	// Fx2 ==> Mozilla/5.0 (Windows; U; Windows NT 6.0; ) Gecko/20080702 Firefox/2.0.0.16
	// IE6 ==> Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1) 
	// IE7 ==> Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)
	//
	//-----------------------------------------------------------

	$agent = '';
	if ( isset( $_SERVER["HTTP_USER_AGENT"] ) )
		$agent = $_SERVER["HTTP_USER_AGENT"];
	//echo $agent;

	if ( strpos( $agent, "Firefox/1" ) !== false )
	{
		$css_body = "body.fx1.css";
	}
	else
	if ( strpos( $agent, "Windows NT 5" ) !== false )
	{
		$css_body = "body.nt5.css";
	}
	else
	{
		$css_body = "body.default.css";
	}

?>

<link href="css/<?php echo $css_body; ?>" rel="stylesheet" type="text/css"/>
<link href="css/struct.css" rel="stylesheet" type="text/css"/>
<link href="css/link.css" rel="stylesheet" type="text/css"/>
<link href="css/info_box.css" rel="stylesheet" type="text/css"/>
<link href="css/sect.css" rel="stylesheet" type="text/css"/>
<link href="css/data_table.css" rel="stylesheet" type="text/css"/>
<link href="css/page_no.css" rel="stylesheet" type="text/css"/>
<link href="css/menu.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="js/default.js"></script>

