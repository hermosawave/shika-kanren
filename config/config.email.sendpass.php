//<?php exit; ?>
//---------------------------------------------------------------
//---------------------------------------------------------------
//---------------------------------------------------------------
//---------------------------------------------------------------
//
// Email Configuration File
//
//---------------------------------------------------------------
//---------------------------------------------------------------
//---------------------------------------------------------------
//---------------------------------------------------------------

//---------------------------------------------------------------
// Hostname 
//---------------------------------------------------------------
//
// The address of SMTP server
//
// (e.g.) localhost
// (e.g.) mail.mydomain.com
// (e.g.) 111.222.333.444
//
//

Hostname=localhost

//---------------------------------------------------------------
// From
//---------------------------------------------------------------
//
// The sender of the form mail
//
// (e.g.) sender@mydomain.com
//

From=info@shika-kanren.com

//---------------------------------------------------------------
// Email Subject
//---------------------------------------------------------------
//
// (e.g.) "Cotact Us"
//

Subject=[Shika-Kanren.com] パスワード送信

//---------------------------------------------------------------
// Email Body Template ( Text Format )
//---------------------------------------------------------------

Body=<<<_EOM_
Shika-Kanren.comのパスワードを送信いたしました。
パスワード : ##password##
_EOM_

//---------------------------------------------------------------
// Email Body Template ( HTML Format )
//---------------------------------------------------------------

Html=<<<_EOM_
<html>
<head>
	<title>[Shika-Kanren.com] パスワード</title>
</head>
<body>
Shika-Kanren.comのパスワードを送信いたしました。
	<table>
	<tr>
		<td align='right'>パスワード : </td>
		<td align='left'>##password##</td>
	</tr>
	</table>
</body>
</html>
_EOM_

//---------------------------------------------------------------
// END OF FILE
//---------------------------------------------------------------