<?php include( 'tpl.html_tag.inc.php'); ?>
<head>
<?php include( 'tpl.html_head.inc.php'); ?>
<title>歯科材の輸入代行　|　歯科関連ドットコム</title>
</head>

<body>

<?php include( 'tpl.page_header.inc.php'); ?>

<!-- [BEGIN] Content -->

<?php include(INC_FORM_BEGIN); ?>

        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="540" valign="top">
            <img src="../pic/titlebar/regist.gif" alt="新規会員登録" width="540" height="25"></td>
        </tr>
        <tr>
          <td height="5" valign="top"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
        </tr>
        <tr>
          <td valign="top"><table width="540" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" class="body1_blk"><div align="left"><strong>歯科関連ドットコム</strong>ではアメリカから歯科材料などを日本へ個人輸入頂くお手伝いを致します。<br>
        その為にも全ての歯科医師さまに会員登録(無料)をお願いしております。<br>
        お手数ですが、まずこちらのフォームへ登録して下さい。<br>
        また輸入される歯科材が輸入通関の歳、お客様の歯科医師免許のコピーが必要となります。<br>
        お手数ですが、当フォーム登録後にメールで歯科医師免許のコピーの送付方法をお知らせ致しますので、宜しくお願い致します。<br>
        会員登録の前に、本ページの下(<a href="#toroku">こちら</a>)を必ずご覧下さい。
              </div>
              </td>
            </tr>
            <tr>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td>
              <span class="body1_blk">
<?php include( 'tpl.page.info.inc.php' ); ?>
              </span>
              </td>
            </tr>
            <tr>
              <td>
                <table width="539" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000" class="test">
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="2" align="center" class="tbl_left"><div align="right">名前(漢字)：</div></td>
                    <td width="413" height="2" align="left" valign="top" class="tbl_right">                      <div align="left">
                        <?php echo $hm->Zb('rs:def:name_jpn'); ?>
                        <span class="body3_red">※必修</span>    <br>
                        (例：志賀太郎)</div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="3" align="center" class="tbl_left"><div align="right">名前(半角ローマ字)：</div></td>
                    <td height="3" align="left" valign="top" class="tbl_right">
                    <?php echo $hm->Zb('rs:def:name_alpha'); ?>
                      <span class="body3_red">※必修</span><br>
                      (例：Taro Shika)</td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="5" align="center" class="tbl_left"><div align="right">クリニック名：</div></td>
                    <td width="413" height="5" align="left" valign="top" class="tbl_right">
                      <div align="left">
                        <?php echo $hm->Zb('rs:def:clinic'); ?>
                        <span class="body3_red">※必修</span><br>
                        (例：しか歯科医院)<br>
                    </div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="5" align="center" class="tbl_left"><div align="right">郵便番号：</div></td>
                    <td height="5" align="left" valign="top" class="tbl_right">
                      <?php echo $hm->Zb('rs:def:zip'); ?>
                      <span class="body3_red">※必修</span><br>
                      (例：123-0001)</td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="5" align="center" class="tbl_left"><div align="right">ご住所：</div></td>
                    <td height="5" align="left" valign="top" class="tbl_right">
                    <?php echo $hm->Zb('rs:def:street1'); ?>
                      <span class="body3_red">※必修</span><br>
(例：東京都港区赤坂1丁目1-1) <br>
                    <?php echo $hm->Zb('rs:def:street2'); ?>
                      <br>
(例：赤坂ビル1F) </td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="2" align="center" class="tbl_left"><div align="right">電話番号：</div></td>
                    <td height="2" align="left" valign="top" class="tbl_right">
                      <?php echo $hm->Zb('rs:def:tel'); ?>
                      <span class="body3_red">※必修</span><br>
                      (例：03-1234-1000)</td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="2" align="center" class="tbl_left"><div align="right">携帯番号：</div></td>
                    <td height="2" align="left" valign="top" class="tbl_right">
                    <?php echo $hm->Zb('rs:def:cell'); ?><br>
                      (例：090-1234-1000)</td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="3" align="center" class="tbl_left"><div align="right">Ｆａｘ番号：</div></td>
                    <td height="3" align="left" valign="top" class="tbl_right">
                    <?php echo $hm->Zb('rs:def:fax'); ?>
                      <br>
(例：03-1234-1001)</td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="10" align="center" class="tbl_left"><div align="right">E-mailアドレス：</div></td>
                    <td width="413" height="10" align="left" valign="top" class="tbl_right">                      <div align="left">
                        <?php echo $hm->Zb('rs:def:email'); ?>
                        <span class="body3_red">※必修</span><br>
(例：shika_taro@shika-kanren.com)</div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="10" align="center" class="tbl_left"><div align="right">E-mail確認：</div></td>
                    <td width="413" height="10" align="left" valign="top" class="tbl_right">                      <div align="left">
                        <?php echo $hm->Zb('rs:def:email_conf'); ?>
                        <span class="body3_red">※必修</span><br>
(e-mailアドレスを再入力下さい。)</div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="10" align="center" class="tbl_left"><div align="right">パスワード：</div></td>
                    <td width="413" height="10" align="left" valign="top" class="tbl_right">                      <div align="left">
                        <?php echo $hm->Zb('rs:def:password'); ?>
                        <span class="body3_red">※必修</span><br>
(半角英数8～16文字)</div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="10" align="center" class="tbl_left"><div align="right">パスワード確認：</div></td>
                    <td width="413" height="10" align="left" valign="top" class="tbl_right">                      <div align="left">
                        <?php echo $hm->Zb('rs:def:password_conf'); ?>
                        <span class="body3_red">※必修</span><br>
(半角英数8～16文字)</div></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="4" align="center" valign="top" class="tbl_left"><div align="right">通信欄： </div></td>
                    <td width="413" height="4" align="left" valign="top" class="tbl_right">
                      <div align="left">
                        質問事項や問合せがございましたら、こちらにご記入下さい。
                        <?php echo $hm->Zb('rs:def:comment'); ?>
                        <br>
                        <br>
                    </div></td>
                  </tr>
                  <tr bgcolor="#FFFFCC">
                    <td height="5" colspan="2" align="center" valign="top" class="tbl_right">

<!-- [BEGIN] Buttons -->
<div align="center" style="margin-top:0px">
<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/reg_page1_next&" ) ); ?>
<table width='100%'>
<tr>
	<td align='center'>
		<input type="reset" value="リセット" class="def_button">
	</td>
	<td align='center'>
		<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/reg_page1_next&", 'src'=>'next', 'value'=>"次へ進む", 'class'=>'def_button' ) ); ?>
	</td>
</tr>
</table>
</div>
<!-- [END] Buttons -->

                    </td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
            </tr>
            <tr>
              <td align='left' bgcolor="#E8E8E8" class="bodytop1_blk"><a name="toroku" id="toroku"></a>■登録について</td>
            </tr>
            <tr>
              <td align='left' class="body1_blk">
こちらで登録頂きましたら、追って歯科関連ドットコムより登録依頼の確認メールと、本登録へのご案内メールを随時送信させて頂きます。
また医薬品等の輸入通関に際して、商品によっては薬事法に基づく輸入許可証明が必要となり、医師免許の提示などの手続きが必要になります。
<br/>
<strong>歯科関連ドットコム</strong>を通じて購入頂く際、通関業務を少しでもスムーズに行う為、会員情報と歯科医師免許のコピーを事前にお預かりさせて頂いております。
詳しくは仮登録後、追ってe-mailにてご案内させて頂きます。<br/>
不明な点がございましたら、FAXまたはe-mailへ添付して弊社までお送り下さい。<br/>
FAX：020-4666-5069(日本国内)<br/>
e-mail：<a href="mailto:toroku@shika-kanren.com">toroku@shika-kanren.com</a>
              </td>
            </tr>
            <tr>
              <td><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
            </tr>
            <tr>
              <td align='left' bgcolor="#E8E8E8" class="bodytop1_blk">■商品注文について</td>
            </tr>
            <tr>
              <td align='left' class="body1_blk"><strong>歯科関連ドットコム</strong>で紹介している商品は、すべてアメリカでの一般的な定価で表示しております。弊社のサイトでご紹介している商品は、15％(但し100ドル以下は一律15ドル)の手数料でお請け致します。<br>                  
                当サイトにない商品でも、出来る限り御希望に添えるよう、お見積り致しますので是非お問い合せ下さい。　御希望の商品が手配出来ましたら、定価に20％(但し100ドル以下は一律20ドル)の手数料でお請け致します。<br>
                  オーダーの方法につきまして、当サイトのショッピングカート、e-mail、電話などでお請け致しますが、弊社よりオーダー内容の確認メールをお送りしますので、不備がある場合は24時間以内にお知らせ下さい。</td>
            </tr>
            <tr>
              <td><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
            </tr>
            <tr>
              <td align='left' bgcolor="#E8E8E8"><span class="bodytop1_blk">■購入について</span></td>
            </tr>
            <tr>
              <td align='left' class="body1_blk">御注文頂きました商品は、支払いや発送方法について確認の上、必要な手続きが完了した後、アメリカから日本へ発送致します。<br>
                支払い方法に関しては、クレジットカード(VISA、MASTER)での決済、送金、もしくは料金着払い(代引き)にてお請け致します。<br>
                  余分な手数料や時間がかからないことなどから、クレジットカードでの決済をお勧め致します。</td>
            </tr>
            <tr>
              <td><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
            </tr>
            <tr>
              <td align='left' bgcolor="#E8E8E8" class="bodytop1_blk">■発送について</td>
            </tr>
            <tr>
              <td align='left' class="body1_blk">御注文頂きました商品は、支払いや発送方法について確認の上、必要な手続きが完了した後、アメリカから日本へ発送致します。<br>
    支払い方法に関しては、クレジットカード(VISA、MASTER)での決済、送金、もしくは料金着払い(代引き)にてお請け致します。<br>
    余分な手数料や時間がかからないことなどから、クレジットカードでの決済をお勧め致します。</td>
            </tr>
            <tr>
              <td><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
            </tr>
            <tr>
              <td align='left' bgcolor="#E8E8E8" class="bodytop1_blk">■税金(関税等)について</td>
            </tr>
            <tr>
              <td align='left' class="body1_blk">国際発送しました商品を個人輸入にて日本国内に入る時、税関監視人によって関税が課せられる場合があります。<br>                  
                関税がかかった場合は商品が配達される際に請求されます。　<br>
                  商品と引き換えにお支払い下さい。　この関税は商品価格(送料、手数料、保険料を含む)の合計金額にかけられます。<br>
                  加えて消費税(5％)は課税対象金額と税額に対して課税されます。<br>
                  詳しい情報は税関のホームページ(http://www.customs.go.jp/)を参照下さい。</td>
            </tr>
            <tr>
              <td><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
            </tr>
            <tr>
              <td align='left' bgcolor="#E8E8E8" class="bodytop1_blk"><a name='henpin'></a>■不良品、返品について</td>
            </tr>
            <tr>
              <td align='left' class="body1_blk">未開封でもお客様のご都合で不要になった場合や、開封もしくは使用後の返品は、基本的に返品は出来ません。<br>
                受け取られた商品に不良(破損、変質、傷みなど)があった場合、メーカーが保証する範囲において返品をうけさせて頂きます。<br>
                  弊社の手違いでオーダーと違った商品が届いた場合、届いた商品をデジカメで撮影しe-mailでお送り下さい。　<br>
                  また領収書も必要となりますので、必ず保管しておいて下さい。<br>
                  弊社では出来る限り安全にかつ効率的にお届け出来るように丁寧な梱包を致しますが、輸送中に起因する問題の場合は、その輸送手段に掛けられた保険によって保障と致します。<br>
                  返品が発生した場合は、受領後1週間以内にお電話、もしくはe-mailにてお知らせ下さい。<br>                  <br>
                  以下の場合は如何なる事情でも返品や交換は出来ませんのでご了承下さい。<br>
                  1.領収書がない場合<br>
                  2.少しでも使用済みの場合<br>
                  3.商品を受け取ってから1週間を過ぎて報告があった場合<br>
                  4.オーダー間違いやお客様のご都合による場合<br>                  <br>                  
                  返品方法については弊社よりお知らせ致します。その際には必ずレシートのコピーを付けてお送り下さい。</td>
            </tr>
            <tr>
              <td><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
            </tr>
            <tr>
              <td align='left' bgcolor="#E8E8E8" class="bodytop1_blk">■個人情報の取り扱いについて</td>
            </tr>
            <tr>
              <td align='left' class="body1_blk">弊社のサービスを提供するに際し、会員登録でお客様の個人情報が必要となり、その情報に基づいて商品をご購入頂きます。<br>
                  ご提供頂きましたお客様の個人情報は、如何なる事情であれ第三者へ提供や譲渡は致しません。もし開示が必要な場合は、お客様の同意に基づいて慎重に対処致します。<br>
                    情報管理には細心の注意を払い、もし不正アクセスや紛失などが発生した場合は、可能な限り迅速な対処を致します。<br>
                    情報を入力頂くサイトにはSSLでデータ転送時の漏洩防止措置を致します。<br>                    <br>
                    個人情報の利用目的は下記の場合に限定します。<br>
                    1.お客様の本人確認の場合<br>
                    2.オーダー確認の場合<br>
                    3.支払い関連での確認の場合<br>
                    4.金融機関への認証確認の場合<br>
                    5.御見積り、ご請求、領収に関する確認の場合<br>
                    6.ご依頼による商品購入に必要な場合<br>
                    7.弊社よりお知らせの場合<br>
                    8.適切な礼状等により警察や裁判所から法律的に開示が求められた場合<br>
                    9.お客様からのお支払い等に問題が生じた場合</td>
            </tr>
            <tr>
              <td><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
            </tr>
          </table></td>
        </tr>
      </table>

<?php include(INC_FORM_END); ?>

<!-- [END] Content -->

<?php include("tpl.page_footer.inc.php"); ?>

</body>
</html>