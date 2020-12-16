<?php

$spec = array(

'member_id'=>array(
XA_CLASS=>'CVPrimaryKey',
XA_CAPTION=>'Form ID',
XA_SIZE=>9,
XA_REQUIRED=>false,
XA_MAX_CHAR=>9,
XA_SB_SIZE=>9,
XA_LIST=>'(ses)(sp)(sr)(key)'
),

'active'=>array(
XA_CLASS=>'cls_active',
XA_CAPTION=>'Active',
XA_INIT_VALUE=>array( 'reg'=>'Y', 'search'=>'Y' ),
XA_REQUIRED=>true,
XA_SELECT_ON_TOP=>STR_SELECT_CAPTION,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(auth)(sp)(sr)(fd)(reg_save)'
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

'name_jpn'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'名前(漢字)' ),
XA_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(ses)(sp)(sr)(fd)(reg_page1)(edit_page1)'
),

'name_alpha'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>array( LC_JPN=>'名前(半角ローマ字)' ),
XA_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)(reg_page1)(edit_page1)'
),

'clinic'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'クリニック名' ),
XA_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(sp)(sr)(fd)(reg_page1)(edit_page1)'
),

'zip'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>array( LC_JPN=>'郵便番号' ),
XA_SIZE=>20,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>20,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(edit_page1)'
),

'street1'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'ご住所' ),
XA_SIZE=>40,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(edit_page1)'
),

'street2'=>array(
XA_CLASS=>'CVText',
XA_CAPTION=>array( LC_JPN=>'ご住所2' ),
XA_SIZE=>40,
XA_REQUIRED=>false,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(edit_page1)'
),

'tel'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>array( LC_JPN=>'電話番号' ),
XA_SIZE=>24,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(edit_page1)'
),

'cell'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>array( LC_JPN=>'携帯番号' ),
XA_SIZE=>24,
XA_REQUIRED=>false,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(edit_page1)'
),

'fax'=>array(
XA_CLASS=>'CVAsciiText',
XA_CAPTION=>array( LC_JPN=>'Fax番号' ),
XA_SIZE=>24,
XA_REQUIRED=>false,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>36,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(edit_page1)'
),

'email'=>array(
XA_CLASS=>'CVEmail',
XA_CAPTION=>array( LC_JPN=>'E-mailアドレス' ),
XA_SIZE=>36,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(ses)(sp)(sr)(fd)(reg_page1)(edit_page1)(sendpass_page1)'
),

'email_conf'=>array(
XA_CLASS=>'cls_EmailConf',
XA_CAPTION=>array( LC_JPN=>'E-mailアドレス (確認)' ),
XA_NAME_RS=>nothing,
XA_SIZE=>36,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(reg_page1)'
),

'password'=>array(
XA_CLASS=>'CVPassword',
XA_CAPTION=>array( LC_JPN=>'パスワード' ),
XA_SIZE=>20,
XA_REQUIRED=>true,
XA_MIN_CHAR=>8,
XA_MAX_CHAR=>16,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(ses)(sp)(sr)(fd)(reg_page1)'
),

'password_conf'=>array(
XA_CLASS=>'cls_PasswordConf',
XA_CAPTION=>array( LC_JPN=>'パスワード (確認)' ),
XA_NAME_RS=>nothing,
XA_SIZE=>20,
XA_REQUIRED=>true,
XA_MIN_CHAR=>8,
XA_MAX_CHAR=>16,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(reg_page1)'
),

'password_old'=>array(
XA_CLASS=>'cls_member_password_old',
XA_CAPTION=>array( LC_JPN=>'旧パスワード' ),
XA_NAME_RS=>nothing,
XA_SIZE=>20,
XA_REQUIRED=>false,
XA_MIN_CHAR=>8,
XA_MAX_CHAR=>16,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(edit_page1)'
),

'password_new'=>array(
XA_CLASS=>'CVPassword',
XA_CAPTION=>array( LC_JPN=>'新パスワード' ),
XA_NAME_RS=>nothing,
XA_SIZE=>20,
XA_REQUIRED=>false,
XA_MIN_CHAR=>8,
XA_MAX_CHAR=>16,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(edit_page1)'
),

'password_new_conf'=>array(
XA_CLASS=>'cls_member_password_new_conf',
XA_CAPTION=>array( LC_JPN=>'新パスワード (確認)' ),
XA_NAME_RS=>nothing,
XA_SIZE=>20,
XA_REQUIRED=>false,
XA_MIN_CHAR=>8,
XA_MAX_CHAR=>16,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(edit_page1)'
),

'comment'=>array(
XA_CLASS=>'CVTextArea',
XA_CAPTION=>array( LC_JPN=>'通信欄' ),
XA_COLS=>35,
XA_ROWS=>10,
XA_REQUIRED=>false,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>3000,
XA_SEARCH_OP=>'s%',
XA_LIST=>'(fd)(reg_page1)(edit_page1)'
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
XA_LIST=>'(fd)'
),

'rlog_create_date_time'=>array(
XA_CLASS=>'cls_rlog_date_time',
XA_CAPTION=>RSTR_CREATE_DATE_TIME,
XA_FORMAT=>'Y-m-d H:i:s',
XA_LIST=>'(rlog)(reg_save)(sr)'
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
XA_LIST=>'(rlog)(edit_save)(sr)'
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

'rlog_last_login_date_time'=>array(
XA_CLASS=>'cls_rlog_date_time',
XA_CAPTION=>RSTR_LAST_LOGIN_DATE_TIME,
XA_FORMAT=>'Y-m-d H:i:s',
XA_LIST=>'(rlog)(last_login)'
),

'row_idx'=>array(
XA_CLASS=>'CVRowIndex',
XA_NAME_RS=>nothing,
XA_LIST=>'(sr)'
),

'email_login'=>array(
XA_CLASS=>'cls_email_login',
XA_NAME_RS=>'email',
XA_CAPTION=>array( LC_JPN=>'E-mailアドレス' ),
XA_SIZE=>20,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>100,
XA_HIDE_VALUE=>true,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(login)(auth)'
),

'password_login'=>array(
XA_CLASS=>'cls_password_login',
XA_NAME_RS=>nothing,
XA_CAPTION=>array( LC_JPN=>'パスワード' ),
XA_SIZE=>20,
XA_REQUIRED=>true,
XA_MIN_CHAR=>0,
XA_MAX_CHAR=>16,
XA_HIDE_VALUE=>true,
XA_SEARCH_OP=>'s=',
XA_LIST=>'(login)'
),

'active_login' =>array(
XA_CLASS=>'cls_active_login',
XA_NAME_RS=>'active',
XA_SEARCH_OP=>'s=',
XA_LIST=>''
),

);

?>
