<?php

$spec = array(

'trans' => array(
XA_CLASS=>'cls_fl_trans',
XA_SPEC_FILE=>'df.fl.trans.inc.php',
XA_TABLE_NAME=>TBL_TRANS,
XA_ID_NAME=>'trans_id',
XA_INIT_ORDER_BY=>'trans_id ASC',
XA_INIT_PAGE_SIZE=>20
),

'member' => array(
XA_CLASS=>'cls_fl_member',
XA_SPEC_FILE=>'df.fl.member.inc.php',
XA_TABLE_NAME=>TBL_MEMBER,
XA_ID_NAME=>'member_id',
XA_INIT_ORDER_BY=>'member_id ASC',
XA_INIT_PAGE_SIZE=>20
),

);

?>
