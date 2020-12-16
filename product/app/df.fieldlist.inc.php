<?php

$spec = array(

'product' => array(
XA_CLASS=>'cls_fl_product',
XA_SPEC_FILE=>'df.fl.product.inc.php',
XA_TABLE_NAME=>TBL_PRODUCT,
XA_ID_NAME=>'product_id',
XA_INIT_ORDER_BY=>'view_order ASC, product_code ASC',
XA_INIT_PAGE_SIZE=>20
),

);

?>
