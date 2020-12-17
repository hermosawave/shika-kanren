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

From=shika-kanren@hermosawaveinternet.com

//---------------------------------------------------------------
// Bcc
//---------------------------------------------------------------
//
// The receiver of the form mail
//
// (e.g.) receiver@mydomain.com
//

Bcc=order@shika-kanren.com

//---------------------------------------------------------------
// Email Subject
//---------------------------------------------------------------
//
// (e.g.) "Cotact Us"
//

Subject=[Shika-Kanren.com] 購入依頼発注確認メール

//---------------------------------------------------------------
// Email Body Template ( HTML Format )
//---------------------------------------------------------------

Html=<<<_EOM_
<html>
<head>
	<title>[Shika-Kanren.com] 購入依頼発注確認メール</title>
</head>
<body>
<b>歯科関連ドットコム - 購入依頼発注確認メール</b><br/>
<br/>
ご注文ありがとうございます。<br/>
<br/>
<div style='border:1px solid #808080;padding:10px;width:640px'>
	<table>
	<tr>
		<td align='right'>ご注文ID : </td>
		<td align='left'>##trans_id##</td>
	</tr>
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
		<td align='right'>E-mailアドレス : </td>
		<td align='left'>##email##</td>
	</tr>
	<tr>
		<td align='right'>発送方法 : </td>
		<td align='left'>##delivery_method##</td>
	</tr>
	</table>
<br/>
##scart##
</div>
</body>
</html>
_EOM_

//---------------------------------------------------------------
// Email Body Template ( Text Format )
//---------------------------------------------------------------

Body=<<<_EOM_
歯科関連ドットコム - 購入依頼発注確認メール

ご注文ありがとうございます。

---------------------------------------------

ご注文ID : ##trans_id##
名前(漢字) : ##name_jpn##
名前(ローマ字) : ##name_alpha##
クリニック名 : ##clinic##
郵便番号 : ##zip##
ご住所1 : ##street1##
ご住所2 : ##street2##
電話番号 : ##tel##
E-mailアドレス : ##email##
発送方法 : ##delivery_method##

##scart##

_EOM_

//---------------------------------------------------------------
// END OF FILE
//---------------------------------------------------------------
