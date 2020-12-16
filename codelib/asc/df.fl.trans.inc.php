<?php

$spec = array(

'trans_id'=>array(
XA_CLASS=>'CVPrimaryKey',
XA_CAPTION=>'Trans ID',
XA_SIZE=>9,
XA_REQUIRED=>false,
XA_MAX_CHAR=>9,
XA_SB_SIZE=>9,
XA_LIST=>'(sp)(sr)(key)'
),

'active'=>array(
XA_CLASS=>'cls_active',
XA_CAPTION=>'Active',
XA_INIT_VALUE=>array( 'reg'=>'Y', 'search'=>'Y' ),
XA_REQUIRED=>true,
XA_SELECT_ON_TOP=>STR_SELECT_CAPTION,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(sp)(sr)(fd)(reg_save)(edit_staff)'
),

'active_Y' => array(
XA_CLASS=>'CVRadio',
XA_NAME_RS=>nothing,
XA_REQUIRED=>false,
XA_LINKED_TO=>'active',
XA_RADIO_VALUE=>'Y',
XA_LIST=>'(fd)(edit_staff)'
),

'active_N' => array(
XA_CLASS=>'CVRadio',
XA_NAME_RS=>nothing,
XA_REQUIRED=>false,
XA_LINKED_TO=>'active',
XA_RADIO_VALUE=>'N',
XA_LIST=>'(fd)(edit_staff)'
),

'order_status'=>array(
XA_CLASS=>'CVSelection',
XA_CAPTION=>array( LC_JPN=>'受注状況レベル' ),
XA_REQUIRED=>true,
XA_SEL_TEXT=>SEL_ORDER_STATUS,
XA_SELECT_ON_TOP=>STR_SELECT_CAPTION,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>3,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(sp)(sr)(fd)(reg_save)(edit_staff)'
),

'member_id'=>array(
XA_CLASS=>'CVInteger',
XA_CAPTION=>array( LC_JPN=>'Member ID' ),
XA_REQUIRED=>true,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(fd)(reg_save)(detail_staff)'
),

'name_jpn'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'名前(漢字)' ),
XA_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)(reg_page1)(detail_staff)'
),

'name_alpha'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>array( LC_JPN=>'名前(半角ローマ字)' ),
XA_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)(reg_page1)(detail_staff)'
),

'clinic'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'クリニック名' ),
XA_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)(reg_page1)(detail_staff)'
),

'zip'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>array( LC_JPN=>'郵便番号' ),
XA_SIZE=>20,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>20,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(detail_staff)'
),

'street1'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'ご住所' ),
XA_SIZE=>40,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(detail_staff)'
),

'street2'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'ご住所2' ),
XA_SIZE=>40,
XA_REQUIRED=>false,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(detail_staff)'
),

'tel'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>array( LC_JPN=>'電話番号' ),
XA_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(detail_staff)'
),

'email'=>array(
XA_CLASS=>'CVEmail',
XA_CAPTION=>array( LC_JPN=>'E-mailアドレス' ),
XA_SIZE=>36,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)(reg_page1)(detail_staff)'
),

'delivery_method'=>array(
XA_CLASS=>'CVSelection',
XA_CAPTION=>array( LC_JPN=>'発送方法' ),
XA_REQUIRED=>true,
XA_SEL_TEXT=>SEL_DELIVERY_METHOD,
XA_SELECT_ON_TOP=>'発送方法を選択下さい。',
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>6,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(fd)(reg_page1)(detail_staff)'
),

'note'=>array(
XA_CLASS=>'CVTextArea',
XA_CAPTION=>array( LC_JPN=>'メモ' ),
XA_COLS=>35,
XA_ROWS=>10,
XA_REQUIRED=>false,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>3000,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(edit_staff)'
),

'rlog_create_date_time'=>array(
XA_CLASS=>'cls_rlog_date_time',
XA_CAPTION=>RSTR_CREATE_DATE_TIME,
XA_FORMAT=>'Y-m-d H:i:s',
XA_LIST=>'(sr)(rlog)(reg_save)'
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
