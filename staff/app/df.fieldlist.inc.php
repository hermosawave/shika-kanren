<?php

$spec = array(

'staff' => array(
XA_CLASS=>'cls_fl_staff',
XA_SPEC_FILE=>'df.fl.staff.inc.php',
XA_TABLE_NAME=>TBL_STAFF,
XA_ID_NAME=>'staff_id',
XA_INIT_ORDER_BY=>'staff_id ASC',
XA_INIT_PAGE_SIZE=>20
),

'member' => array(
XA_CLASS=>'cls_fl_member',
XA_SPEC_FILE=>'df.fl.member.inc.php',
XA_TABLE_NAME=>TBL_MEMBER,
XA_ID_NAME=>'member_id',
XA_INIT_ORDER_BY=>'member_id ASC',
XA_INIT_PAGE_SIZE=>50
),

'maker' => array(
XA_CLASS=>'cls_fl_maker',
XA_SPEC_FILE=>'df.fl.maker.inc.php',
XA_TABLE_NAME=>TBL_MAKER,
XA_ID_NAME=>'maker_id',
XA_INIT_ORDER_BY=>'maker_id ASC',
XA_INIT_PAGE_SIZE=>20
),

'category' => array(
XA_CLASS=>'cls_fl_category',
XA_SPEC_FILE=>'df.fl.category.inc.php',
XA_TABLE_NAME=>TBL_CATEGORY,
XA_ID_NAME=>'category_id',
XA_INIT_ORDER_BY=>'view_order ASC',
XA_INIT_PAGE_SIZE=>20
),

'product' => array(
XA_CLASS=>'cls_fl_product',
XA_SPEC_FILE=>'df.fl.product.inc.php',
XA_TABLE_NAME=>TBL_PRODUCT,
XA_ID_NAME=>'product_id',
XA_INIT_ORDER_BY=>'product_id ASC',
XA_INIT_PAGE_SIZE=>50
),

'trans' => array(
XA_CLASS=>'cls_fl_trans',
XA_SPEC_FILE=>'df.fl.trans.inc.php',
XA_TABLE_NAME=>TBL_TRANS,
XA_ID_NAME=>'trans_id',
XA_INIT_ORDER_BY=>'trans_id DESC',
XA_INIT_PAGE_SIZE=>50
),

'items' => array(
XA_CLASS=>'cls_fl_items',
XA_SPEC_FILE=>'df.fl.items.inc.php',
XA_TABLE_NAME=>TBL_ITEMS,
XA_ID_NAME=>'items_id',
XA_INIT_ORDER_BY=>'items_id ASC',
XA_INIT_PAGE_SIZE=>20
),

'const' => array(
XA_CLASS=>'cls_fl_const',
XA_SPEC_FILE=>'df.fl.const.inc.php',
XA_TABLE_NAME=>TBL_CONST,
XA_ID_NAME=>'const_id',
XA_INIT_ORDER_BY=>'const_id ASC',
XA_INIT_PAGE_SIZE=>20
),

);

?>
