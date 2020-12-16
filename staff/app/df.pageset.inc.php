<?php

$spec = array(

'frame' => array(
XA_CLASS=>'cls_ps_frame',
XA_AUTH=>false,
XA_DEFAULT_COMMAND=>'login'
),

'staff' => array(
XA_CLASS=>'cls_ps_staff',
XA_DEFAULT_COMMAND=>'search'
),

'member' => array(
XA_CLASS=>'cls_ps_member',
XA_DEFAULT_COMMAND=>'search'
),

'maker' => array(
XA_CLASS=>'cls_ps_maker',
XA_DEFAULT_COMMAND=>'search'
),

'category' => array(
XA_CLASS=>'cls_ps_category',
XA_DEFAULT_COMMAND=>'search'
),

'product' => array(
XA_CLASS=>'cls_ps_product',
XA_DEFAULT_COMMAND=>'search'
),

'trans' => array(
XA_CLASS=>'cls_ps_trans',
XA_DEFAULT_COMMAND=>'search'
),

'items' => array(
XA_CLASS=>'cls_ps_items',
XA_DEFAULT_COMMAND=>'search'
),

'const' => array(
XA_CLASS=>'cls_ps_const',
XA_DEFAULT_COMMAND=>'edit_inp'
),

);

?>
