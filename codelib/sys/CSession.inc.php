<?php

//----------------------------------------------------------------
// CSession
//----------------------------------------------------------------
class CSession extends CObject
{
	function Setup()
	{
		//-------------------------------------
		//-- session_cache_limiter('none') 
		//-- prevents "page expired" error from
		//-- IE when pressing back-button
		//-------------------------------------
		@session_cache_limiter('none');
		//-----------------------------------

		@session_start();
		//header('Cache-control: private'); 
		//header('Cache-Control: max-age=3600, must-revalidate'); 
		//header('Cache-Control: max-age=1, must-revalidate'); 
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>