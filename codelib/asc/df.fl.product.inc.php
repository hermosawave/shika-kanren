<?php

$spec = array(

'product_id'=>array(
XA_CLASS=>'CVPrimaryKey',
XA_CAPTION=>'Product ID',
XA_SIZE=>9,
XA_REQUIRED=>false,
XA_MAX_CHAR=>9,
XA_SB_SIZE=>9,
XA_LIST=>'(sp)(sr)(key)(list_sr)(product_detail)'
),

'active'=>array(
XA_CLASS=>'cls_active',
XA_CAPTION=>'Active',
XA_INIT_VALUE=>array( 'reg'=>'Y', 'search'=>'Y' ),
XA_REQUIRED=>true,
XA_SELECT_ON_TOP=>STR_SELECT_CAPTION,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(sp)(sr)(fd)(reg_save)(list_sp)'
),

'active_Y' => array(
XA_CLASS=>'CVRadio',
XA_NAME_RS=>nothing,
XA_REQUIRED=>false,
XA_LINKED_TO=>'active',
XA_RADIO_VALUE=>'Y',
XA_LIST=>'(fd)'
),

'active_N' => array(
XA_CLASS=>'CVRadio',
XA_NAME_RS=>nothing,
XA_REQUIRED=>false,
XA_LINKED_TO=>'active',
XA_RADIO_VALUE=>'N',
XA_LIST=>'(fd)'
),

'view_order'=>array(
XA_CLASS=>'CVInteger',
XA_INIT_VALUE=>array( 'reg'=>'100' ),
XA_CAPTION=>array( LC_JPN=>'表示順序' ),
XA_SIZE=>6,
XA_REQUIRED=>true,
XA_MAX_CHAR=>9,
XA_LIST=>'(sr)(fd)'
),

'product_code'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'商品番号' ),
XA_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>24,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)(list_sr)(product_detail)'
),

'product_name'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'商品名' ),
XA_SIZE=>36,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)(list_sr)(product_detail)'
),

'category_id'=>array(
XA_CLASS=>'cls_category_sel',
XA_CAPTION=>array( LC_JPN=>'カテゴリ' ),
XA_REQUIRED=>true,
XA_SELECT_ON_TOP=>STR_SELECT_CAPTION,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(sp)(sr)(fd)(list_sp)(list_sr)(product_detail)'
),

'maker_id'=>array(
XA_CLASS=>'cls_maker_sel',
XA_CAPTION=>array( LC_JPN=>'メーカー' ),
XA_REQUIRED=>true,
XA_SELECT_ON_TOP=>STR_SELECT_CAPTION,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(sp)(sr)(fd)'
),

'maker_id_raw'=>array(
XA_CLASS=>'CVInteger',
XA_NAME_RS=>'maker_id',
XA_LIST=>'(list_sr)(product_detail)'
),

'price'=>array(
XA_CLASS=>'CVDouble',
XA_CAPTION=>array( LC_JPN=>'単価' ),
XA_SIZE=>11,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>11,
XA_FORMAT=>'%01.2f',
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sr)(fd)(list_sr)(product_detail)'
),

'yen'=>array(
XA_CLASS=>'cls_yen',
XA_LINKED_TO=>'price',
XA_NAME_RS=>nothing,
XA_LIST=>'(list_sr)(product_detail)'
),

'size'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'サイズ' ),
XA_SIZE=>60,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(list_sr)(product_detail)'
),

'description'=>array(
XA_CLASS=>'CVTextArea',
XA_CAPTION=>array( LC_JPN=>'説明' ),
XA_COLS=>35,
XA_ROWS=>10,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>3000,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(product_detail)'
),

'description_raw'=>array(
XA_CLASS=>'CVText',
XA_NAME_RS=>nothing,
XA_LINKED_TO=>'description',
XA_LIST=>'(fd)(product_detail)'
),

'pic_m'=>array(
XA_CLASS=>'cls_pic_up',
XA_CAPTION=>array( LC_JPN=>'画像' ),
XA_SIZE=>48,
XA_REQUIRED=>false,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>255,
XA_SEARCH_OP=>'s%',
'MAX_PIC_WIDTH'=>180,
'MAX_PIC_HEIGHT'=>180,
'EMPTY_FILENAME'=>'no_pic_m.png',
XA_LIST=>'(fd)(product_detail)'
),

'pic_m_state'=>array(
XA_CLASS=>'CVFileUpload_State',
XA_NAME_RS=>nothing,
XA_CAPTION=>array( LC_JPN=>'Pic_State' ),
XA_LINKED_TO=>'pic_m',
XA_LIST=>'(fd)'
),

'pic_s'=>array(
XA_CLASS=>'cls_pic_up',
XA_CAPTION=>array( LC_JPN=>'画像(サムネイル)' ),
XA_SIZE=>48,
XA_REQUIRED=>false,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>255,
XA_SEARCH_OP=>'s%',
'MAX_PIC_WIDTH'=>50,
'MAX_PIC_HEIGHT'=>50,
'EMPTY_FILENAME'=>'no_pic_s.png',
XA_LIST=>'(fd)(list_sr)'
),

'pic_s_state'=>array(
XA_CLASS=>'CVFileUpload_State',
XA_NAME_RS=>nothing,
XA_CAPTION=>array( LC_JPN=>'Pic_State' ),
XA_LINKED_TO=>'pic_s',
XA_LIST=>'(fd)'
),

'rlog_create_date_time'=>array(
XA_CLASS=>'cls_rlog_date_time',
XA_CAPTION=>RSTR_CREATE_DATE_TIME,
XA_FORMAT=>'Y-m-d H:i:s',
XA_LIST=>'(rlog)(reg_save)'
),

'rlog_create_user_type'=>array(
XA_CLASS=>'cls_rlog_user_type',
XA_CAPTION=>RSTR_CREATE_USER_TYPE,
XA_LIST=>'(rlog)(reg_save)'
),

'rlog_create_user_id'=>array(
XA_CLASS=>'cls_rlog_user_id',
XA_CAPTION=>RSTR_CREATE_USER_NAME,
XA_LIST=>'(rlog)(reg_save)'
),

'rlog_edit_date_time'=>array(
XA_CLASS=>'cls_rlog_date_time',
XA_CAPTION=>RSTR_EDIT_DATE_TIME,
XA_FORMAT=>'Y-m-d H:i:s',
XA_LIST=>'(rlog)(edit_save)'
),

'rlog_edit_user_type'=>array(
XA_CLASS=>'cls_rlog_user_type',
XA_CAPTION=>RSTR_EDIT_USER_TYPE,
XA_LIST=>'(rlog)(edit_save)'
),

'rlog_edit_user_id'=>array(
XA_CLASS=>'cls_rlog_user_id',
XA_CAPTION=>RSTR_EDIT_USER_NAME,
XA_LIST=>'(rlog)(edit_save)'
),

'row_idx'=>array(
XA_CLASS=>'CVRowIndex',
XA_NAME_RS=>nothing,
XA_LIST=>'(sr)'
),

);

?>
