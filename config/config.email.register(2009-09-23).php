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
// To
//---------------------------------------------------------------
//
// The receiver of the form mail
//
// (e.g.) receiver@mydomain.com
//

To=info@shika-kanren.com

//---------------------------------------------------------------
// Email Subject
//---------------------------------------------------------------
//
// (e.g.) "Cotact Us"
//

Subject=[Shika-Kanren.com] 新規会員登録

//---------------------------------------------------------------
// Email Body Template ( Text Format )
//---------------------------------------------------------------

Body=<<<_EOM_
名前(漢字) : ##name_jpn##
名前(ローマ字) : ##name_alpha##
クリニック名 : ##clinic##
郵便番号 : ##zip##
ご住所1 : ##street1##
ご住所2 : ##street2##
電話番号 : ##tel##
携帯番号 : ##cell##
Fax番号 : ##fax##
E-mailアドレス : ##email##
パスワード : ##password##
通信欄 : ##comment##
_EOM_

//---------------------------------------------------------------
// Email Body Template ( HTML Format )
//---------------------------------------------------------------

Html=<<<_EOM_
<html>
<head>
	<title>[Shika-Kanren.com] 新規会員登録</title>
</head>
<body>
	<table>
	<tr>
		<td align='right'>名前(漢字) : </td>
		<td align='left'>##name_jpn##</td>
	</tr>
	<tr>
		<td align='right'>名前(ローマ字) : </td>
		<td align='left'>##name_alpha##</td>
	</tr>
	<tr>
		<td align='right'>クリニック名 : </td>
		<td align='left'>##clinic##</td>
	</tr>
	<tr>
		<td align='right'>郵便番号 : </td>
		<td align='left'>##zip##</td>
	</tr>
	<tr>
		<td align='right'>ご住所1 : </td>
		<td align='left'>##street1##</td>
	</tr>
	<tr>
		<td align='right'>ご住所2 : </td>
		<td align='left'>##street2##</td>
	</tr>
	<tr>
		<td align='right'>電話番号 : </td>
		<td align='left'>##tel##</td>
	</tr>
	<tr>
		<td align='right'>携帯番号 : </td>
		<td align='left'>##cell##</td>
	</tr>
	<tr>
		<td align='right'>Fax番号 : </td>
		<td align='left'>##fax##</td>
	</tr>
	<tr>
		<td align='right'>E-mailアドレス : </td>
		<td align='left'>##email##</td>
	</tr>
	<tr>
		<td align='right'>パスワード : </td>
		<td align='left'>##password##</td>
	</tr>
	<tr>
		<td align='right'>通信欄 : </td>
		<td align='left'>##comment##</td>
	</tr>
	</table>
</body>
</html>
_EOM_

//---------------------------------------------------------------
// END OF FILE
//---------------------------------------------------------------
