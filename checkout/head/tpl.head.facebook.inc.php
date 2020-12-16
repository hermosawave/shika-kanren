<?php require_once( 'tpl.head.jquery.inc.php' ); ?>
<!-- [BEGIN] Facebook -->
<link href="js/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="js/facebox/facebox.js" type="text/javascript"></script> 

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('a[rel*=facebox]').facebox({
			loadingImage : 'js/facebox/loading.gif',
			closeImage   : 'js/facebox/closelabel.gif'
		}) 
	});
</script>
<!-- [END] Facebook -->

