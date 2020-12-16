<?php require_once( dirname(__FILE__) . "/common.inc.php" ); ?>
<?php

	//-- [BEGIN] Member Info Indicator (ようこそXXXさん)
	if ( CMemberInfo::IsLoggedIn() )
	{
		$member_id = CMemberInfo::GetMemberID();
		$member_name = CMemberInfo::GetMemberName();
		$link = "<a href='" . $_https_ . "member/index.php?_sc=frame/logoff&'>Logout</a>";
	}
	else
	{
		unset( $member_id );
		$member_name = "ゲスト";
		$link = "<a href='" . $_https_ . "member/index.php'>Login</a>";
	}

	$member_status = "ようこそ" . $member_name . "さん&nbsp;&nbsp;" . $link;
	//-- [END] Member Info Indicator (ようこそXXXさん)

	//-- [BEGIN] Category
	$db =& $sys->DB;
	$table_name = TBL_CATEGORY;
	$flist = array( "category_id", "category_name" );
	$qc = array( "active = 'Y'" );
	$sql = $db->GetSQLSelect( $table_name, $flist, $qc ) . " ORDER BY view_order ASC";
	$result = $db->Query( $sql );
	$category = array();
	while ( $rs = $db->GetRowA( $result ) )
	{
		$category[] = array(
			'id'=>$rs['category_id'],
			'name'=>$rs['category_name']
		);
	}
	$db->FreeResult( $result );

	//-- [END] Category

?>
<div align="center">
  <table width="726" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="197" align="left" valign="bottom" background="<?php echo $_bp_; ?>pic/top_logoBG.jpg" bgcolor="#FFFFFF">
      <a href="<?php echo $_http_; ?>index.php">
      <img src="<?php echo $_bp_; ?>pic/top_logo.jpg" alt="歯科関連ドットコム" width="197" height="72" border="0"></a></td>
      <td width="539" align="right" valign="bottom" background="<?php echo $_bp_; ?>pic/top_logoBG.jpg" bgcolor="#FFFFFF">
      <span class="body1_blk">
      <a href='<?php echo $_http_; ?>product/index.php?_sc=scart&'>&lt; ショッピングカートを見る &gt;</a>
      &nbsp;&nbsp;&nbsp;&nbsp;
      <?php echo $member_status; ?>
      </span>
      </td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF"><TABLE width="726" border="0" cellpadding="1" cellspacing="1" style="BACKGROUND-COLOR: white">
        <tr>
          <td 
style="FONT-SIZE: 12px; WIDTH: 102px; BACKGROUND-COLOR: #b1bdc9; TEXT-ALIGN: center"><A href="<?php echo $_http_; ?>index.php" class="topmenu_txt">HOME</A></td>
          <td 
style="FONT-SIZE: 12px; WIDTH: 102px; BACKGROUND-COLOR: #b1bdc9; TEXT-ALIGN: center"><A href="<?php echo $_http_; ?>info.php" class="topmenu_txt">お知らせ</A></td>
          <td 
style="FONT-SIZE: 12px; WIDTH: 102px; BACKGROUND-COLOR: #b1bdc9; TEXT-ALIGN: center"><A href="<?php echo $_http_; ?>product/index.php" class="topmenu_txt">登録商品</A></td>
          <td 
style="FONT-SIZE: 12px; WIDTH: 102px; BACKGROUND-COLOR: #b1bdc9; TEXT-ALIGN: center"><A href="<?php echo $_https_; ?>register/index.php" class="topmenu_txt">会員登録</A></td>
          <td 
style="FONT-SIZE: 12px; WIDTH: 102px; BACKGROUND-COLOR: #b1bdc9; TEXT-ALIGN: center"><a href="<?php echo $_https_; ?>member/index.php?dest=home" class="topmenu_txt">ログイン</a></td>
          <td class="topmenu_txt" 
style="FONT-SIZE: 12px; WIDTH: 102px; BACKGROUND-COLOR: #b1bdc9; TEXT-ALIGN: center"><A href="<?php echo $_http_; ?>estimate.php" class="topmenu_txt">個人輸入依頼</A></td>
          <td class="topmenu_txt" 
style="FONT-SIZE: 12px; WIDTH: 102px; BACKGROUND-COLOR: #b1bdc9; TEXT-ALIGN: center"><A href="<?php echo $_http_; ?>company.php" class="topmenu_txt">会社案内</A></td>
        </tr>
      </TABLE></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><table width="720" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="10"><img src="<?php echo $_bp_; ?>pic/space.gif" width="10" height="5"></td>
          <td width="147" valign="top"><table width="147" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="147" bgcolor="#CCFFFF"></td>
            </tr>
            <tr>
              <td><table width="146" border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td align="center" bgcolor="#99CCFF"><a href="<?php echo $_https_; ?>member/index.php?dest=home"><img src="<?php echo $_bp_; ?>pic/leftmenu/1login.gif" alt="会員ログイン" width="140" height="25" border="0"></a></td>
                </tr>
                <tr>
                  <td align="left" valign="top" bgcolor="#D7EBFF" class="body1_blk">
                  <span class="mbody1_blk">■登録頂いている会員情報でログインをお願いします。</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" bgcolor="#D7EBFF" class="body1_blk">
                  <span class="mbody1_blk">■登録頂いている会員情報の修正は<a href="<?php echo $_https_; ?>member/index.php?_sc=member/edit_inp&dest=edit_inp">会員情報管理画面</a>でお願いします。</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" bgcolor="#D7EBFF" class="body1_blk">
                  <span class="mbody1_blk">■パスワードを忘れた方は<a href="<?php echo $_https_; ?>register/index.php?_sc=member/sendpass_init&">こちら</a>へ</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" bgcolor="#D7EBFF">
                  <span class="style6"><img src="<?php echo $_bp_; ?>pic/space.gif" width="5" height="5"> </span></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td><span class="style6">
                <img src="<?php echo $_bp_; ?>pic/space.gif" width="5" height="5"> </span>
              </td>
            </tr>

<!-- [BEGIN] 新規会員登録 -->
<?php if ( !isset( $_NO_NEW_REG_BOX_ ) ) { ?>
            <tr>
              <td><table width="146" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td align="center" bgcolor="#99CCFF"><span class="style6">
                      <a href="<?php echo $_https_; ?>register/index.php">
                      <a href="<?php echo $_https_; ?>register/index.php"><img src="<?php echo $_bp_; ?>pic/leftmenu/2toroku.gif" alt="新規会員登録" width="140" height="25" border="0"></a> </a></span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" bgcolor="#D7EBFF"><span class="mbody1_blk">■初めての方は会員登録をお願いします。<br>
(登録には歯科医師免許が必要です。) <br>
■規約など詳しいことは<a href="<?php echo $_https_; ?>register/index.php#toroku">こちら</a>をご覧下さい。</span></td>
                  </tr>
                  <tr>
                    <td bgcolor="#D7EBFF"><span class="style6"><img src="<?php echo $_bp_; ?>pic/space.gif" width="5" height="5"> </span></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td><span class="style6"><img src="<?php echo $_bp_; ?>pic/space.gif" width="5" height="5"> </span></td>
            </tr>

<?php } ?>
<!-- [END] 新規会員登録 -->

<!-- [BEGIN] カテゴリ -->
            <tr>
              <td><table width="146" border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td align="center" bgcolor="#99CCFF"><span class="style6"><a href="<?php echo $_http_; ?>product/index.php?_sc=search_ret"><img src="<?php echo $_bp_; ?>pic/leftmenu/3category.gif" alt="カテゴリ" width="140" height="25" border="0"></a></span></td>
                </tr>
<?php foreach( $category as $ax ) { ?>
                <tr>
                  <td align="left" valign="top" bgcolor="#D7EBFF">
                  <span class="mbody1_blk">
                  ■ <a href='<?php echo $_http_; ?>product/index.php?cid=<?php echo $ax['id']; ?>'><?php echo $ax['name']; ?></a>
                  </span>
                  </td>
                </tr>
<?php } ?>
                <tr>
                  <td bgcolor="#D7EBFF"><span class="style6"><img src="<?php echo $_bp_; ?>pic/space.gif" width="5" height="5"> </span></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td><span class="style6"><img src="<?php echo $_bp_; ?>pic/space.gif" width="5" height="5"> </span></td>
            </tr>
<!-- [END] カテゴリ -->

            <tr>
              <td><table width="146" border="0" cellspacing="0" cellpadding="3">
                  <tr>
                    <td align="center" bgcolor="#99CCFF"><a href="<?php echo $_http_; ?>estimate.php"><img src="<?php echo $_bp_; ?>pic/leftmenu/4sporder.gif" alt="個人輸入依頼" width="140" height="25" border="0"></a></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" bgcolor="#D7EBFF"><p class="mbody1_blk">■当サイトにリストされていない歯科材料や医療機器についても、アメリカから個人輸入をお手伝いします。</p></td>
                  </tr>
                  <tr>
                    <td bgcolor="#D7EBFF"><span class="style6"><img src="<?php echo $_bp_; ?>pic/space.gif" width="5" height="5"> </span></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td><span class="style6"><img src="<?php echo $_bp_; ?>pic/space.gif" width="5" height="5"> </span></td>
            </tr>
          </table></td>
          <td width="13"><img src="<?php echo $_bp_; ?>pic/space.gif" width="10" height="5"></td>
          <td width="540" valign="top">

