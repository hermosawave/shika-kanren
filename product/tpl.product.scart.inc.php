<?php include( 'tpl.html_tag.inc.php'); ?>
<head>
<?php include( 'tpl.html_head.inc.php'); ?>
<title>歯科材の輸入代行　|　歯科関連ドットコム</title>
<style type="text/css">
<!--
.style2 {font-size: 11pt; line-height: 12pt; font-weight: bold; font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";}
.style3 {color: #FF0000}
.style5 {color: #666666}
-->
</style>
</head>

<body>

<?php include( 'tpl.page_header.inc.php'); ?>

<!-- [BEGIN] Content -->

<?php include(INC_FORM_BEGIN); ?>

        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="540" height="25" valign="top">
             <img src="../pic/titlebar/checkout1.gif" alt="登録商品" width="540" height="25"></td>
        </tr>
        <tr>
          <td valign="top" class="body1_blk"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span> </td>
        </tr>
        <tr>
          <td align="left" valign="top" class="body1_blk"><div align="left">
              <table width="540" border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td colspan="2" align="center" valign="top" bgcolor="#99CCFF"><div align="center"><strong class="style2"><font size="3">ショッピングカート</font></strong></div></td>
                </tr>
<?php
	global $scart;
	foreach( $scart->items as $item )
	{
		$obj =& GetItemObj( $item );
?>
<!-- [BEGIN] Item -->
                <tr>
                  <td colspan="2"><span class="style6"><img src="../pic/space.gif" width="5" height="2"> </span></td>
                </tr>
                <tr>
                  <td width="58" rowspan="7" align="right" valign="top">
                    <div align="left">
                      <a href="index.php?_sc=detail&key:def:product_id=<?php echo $obj->Pid(); ?>&">
                      <img src='<?php echo $obj->PicS(); ?>' border='0'>
                      </a>
                    </div>
                  </td>
                  <td width="470" align="left" valign="top"><div align="left"> 商品番号：
                  <span class="body3_red"><?php echo $obj->ProductCode(); ?></span><br>
                  </div></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="body1_blk">メーカー： 
                  <?php echo $obj->Maker(); ?>
                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="body1_blk"><strong>商品名：
                  <?php echo $obj->ProductName(); ?></strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="body1_blk">
                  (<?php echo $obj->Size(); ?>)</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="body1_blk">単価：
                  $<?php echo $obj->Price(); ?>
                  <span class="style3">(￥<?php echo $obj->PriceYen(); ?>) </span></td>
                </tr>
                <tr>
                  <td align="right" valign="top" class="body1_blk">
                  <span class="style6"><img src="../pic/dot_red.gif" width="465" height="1">
                  </span> </td>
                </tr>
                <tr>
                  <td align="right" valign="top" bgcolor="#FFFFCC" class="body1_blk"><strong>数量：
                      <input name="qty_<?php echo $obj->Pid(); ?>" type="text" value="<?php echo $obj->Qty(); ?>" size="2" maxlength="3">
<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/scart_update_qty&pid=" . $obj->Pid() . "&", 'value'=>"更新", 'class'=>'def_button' ) ); ?>
                      合計：$<?php echo $obj->Total(); ?>
                      <span class="style3">(￥<?php echo $obj->TotalYen(); ?>) 
<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/scart_remove&pid=" . $obj->Pid() . "&", 'value'=>"削除", 'class'=>'def_button' ) ); ?>
                  </span></strong></td>
                </tr>
                <tr align="right" valign="middle">
                  <td colspan="2"><div><span class="style6">
                  <img src="../pic/dot_blue.gif" width="530" height="1"> </span>
                  </div></td>
                </tr>
<!-- [END] Item -->
<?php
	}
?>
                <tr align="right" valign="middle">
                  <td colspan="2"><div class="body1_blk2">合計：
                  $<?php echo $scart->ItemsTotal(); ?></div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td colspan="2"><div><span class="style6"><img src="../pic/dot_red.gif" width="530" height="1"> </span>
                  </div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td colspan="2"><div class="body1_blk2">手数料
                  <?php echo $scart->HandlingRate(); ?>：
                  $<?php echo $scart->HandlingFee(); ?></div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td colspan="2"><div ><span class="style6"><img src="../pic/dot_red.gif" width="530" height="1"> </span>
                  </div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td colspan="2">
                  <div>
                    <span class="bodytop1_blk">総合計：
                    $<?php echo $scart->GrandTotal(); ?>
                    </span><br>
                    <strong>
                    <span class="style3">
                    (￥<?php echo $scart->GrandTotalYen(); ?>)
                    </span>
                    </strong>
                  </div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td colspan="2"><div ><span class="style6"><img src="../pic/dot_red.gif" width="530" height="1"> </span>
                  </div></td>
                </tr>
                <tr align="center" valign="middle">
                  <td colspan="2"><div align="center">

<!-- [BEGIN] Buttons -->
<div align="center" style="margin-top:0px">
<table width='100%'>
<tr>
	<td align='left'>
		<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/search_ret&", 'value'=>"リストに戻る", 'class'=>'def_button' ) ); ?>
	</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td align='right'>
		<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/scart_checkout&", 'value'=>"チェックアウトする", 'class'=>'def_button' ) ); ?>
	</td>
</tr>
</table>
</div>
<!-- [END] Buttons -->

                  </div>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        <tr>
          <td valign="top" align='left'>
            <br/>
            <span class="body1_blk"><span class="style5">■歯科関連ドットコムでは登録頂いておりますクレジットカードでの決済をお勧めしております。<br>
■発送方法は第一種国際郵便小包が最も安価ですが、急ぎの場合や御希望などお聞かせ頂ければ、最も効率の良い方法をご提案させて頂きます。<br>
■海外送金をご利用の場合は、銀行振り込み手数料として$45を加算致します。<br>
■着払い(代引き)の場合は着払い手数料として、総額の5%(もしくは500円)が加算されて配達時に運送会社より請求されます。<br> 
            ■日本での税金として、送料と商品代の合計に消費税(5%)が課される場合があります。<br> 
            ■送料はこの合計に含まれません。発送時に合計金額の最終請求書をお送りします。<br> 
            ■国際宅配便は送料と消費税を配達時にご請求しますので、運送会社にお支払い下さい。<br> 
            ■</span><span class="style3">カッコ内は1ドル=<?php echo $GLOBALS['yen_per_dollar']; ?>円で算出した円換算の参考価格です。</span></span><br> </td>
        </tr>
      </table>


<?php include(INC_FORM_END); ?>

<!-- [END] Content -->

<?php include("tpl.page_footer.inc.php"); ?>

</body>
</html>