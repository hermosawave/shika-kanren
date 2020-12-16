<?php

$spec = array(

'maker_id'=>array(
XA_CLASS=>'CVPrimaryKey',
XA_CAPTION=>'Maker ID',
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
XA_LIST=>'(sp)(sr)(fd)(reg_save)'
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

'maker_name'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'メーカー名' ),
XA_SIZE=>40,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)'
),

'url'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>array( LC_JPN=>'URL' ),
XA_SIZE=>60,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>255,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)'
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
