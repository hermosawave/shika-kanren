<?php

//-- Nothing Type
define( 'nothing', "\x00" );

//-- Error Message Type
define( 'EMT_EMPTY', 1 );
define( 'EMT_INVALID_FORMAT', 2 );
define( 'EMT_TOO_SHORT', 3 );
define( 'EMT_TOO_LONG', 4 );
define( 'EMT_TOO_SMALL', 5 );
define( 'EMT_TOO_LARGE', 6 );
define( 'EMT_INCOMPLETE_INPUT', 7 );
define( 'EMT_CAN_NOT_CONFIRM', 8 );
define( 'EMT_NOT_ASCII', 9 );
define( 'EMT_NOT_DIGIT', 10 );
define( 'EMT_DATE_NOT_EXIST', 11 );

//-- Page Type
define( 'XPT_INPUT', 1 );
define( 'XPT_SEARCH', 2 );
define( 'XPT_EMAIL', 3 );
define( 'XPT_CSV', 4 );

//-- Encoding Type
define( 'XET_HTML', 'html' );
define( 'XET_RAW', 'raw' );

//-- Commands
define( 'XC_IS_RECORD', 1101 );
define( 'XC_IS_STATE', 1102 );
define( 'XC_IS_INPUT', 1103 );
define( 'XC_IS_INIT_VALUE', 1104 );

define( 'XC_OF_RAW', 1201 );
define( 'XC_OF_DEFAULT', 1202 );
define( 'XC_OF_INPUT', 1203 );
define( 'XC_OF_SEARCH', 1204 );
define( 'XC_OF_STATE', 1205 );

define( 'XC_AFTER_FROM_INPUT', 1251 );
define( 'XC_AFTER_FROM_STATE', 1252 );
define( 'XC_BEFORE_TO_STATE', 1253 );
define( 'XC_AFTER_TO_STATE', 1254 );
define( 'XC_AFTER_FROM_RECORDSET', 1255 );
define( 'XC_BEFORE_INSERT_RECORDSET', 1256 );
define( 'XC_AFTER_INSERT_RECORDSET', 1257 );
define( 'XC_BEFORE_UPDATE_RECORDSET', 1258 );
define( 'XC_AFTER_UPDATE_RECORDSET', 1259 );

define( 'XC_CLEAR_STATE', 1301 );
define( 'XC_VALIDATE', 1302 );
define( 'XC_SET_EMPTY', 1303 );

define( 'XC_SQL_NAME_RS', 1401 );
define( 'XC_SQL_COND', 1402 );
define( 'XC_SQL_FV', 1403 );

//-- Attributes
define( 'XA_NAME_RP', 2101 );
define( 'XA_NAME_RS', 2102 );
define( 'XA_LIST', 2110 );
define( 'XA_LIST_KEY', 2111 );
define( 'XA_PAGE_TYPE', 2112 );

define( 'XA_CLASS', 2201 );
define( 'XA_CAPTION', 2202 );
define( 'XA_EXAMPLE', 2203 );
define( 'XA_SIZE', 2204 );
define( 'XA_MIN_CHAR', 2206 );
define( 'XA_MAX_CHAR', 2207 );
define( 'XA_FORMAT', 2208 );
define( 'XA_SELECT_ON_TOP', 2209 );
define( 'XA_COLS', 2210 );
define( 'XA_ROWS', 2211 );
define( 'XA_SEARCH_OP', 2212 );
//define( 'XA_ENCODING', 2213 );
define( 'XA_SB_SIZE', 2214 );
define( 'XA_IB_PARAMS', 2215 );
define( 'XA_CAPTION_CHILD', 2216 );

define( 'XA_MIN_NUM', 2217 );
define( 'XA_MAX_NUM', 2218 );

define( 'XA_REQUIRED', 2231 );
define( 'XA_SKIP_VALIDATION', 2232 );

define( 'XA_SPEC_FILE', 2400);
define( 'XA_TABLE_NAME', 2401);
define( 'XA_TABLE_NAME_SEARCH', 2402);
define( 'XA_INIT_ORDER_BY', 2403);
define( 'XA_INIT_PAGE_SIZE', 2404);
define( 'XA_ID_NAME', 2405);

define( 'XA_AUTH', 2501);
define( 'XA_NS', 2502);
define( 'XA_HIDE_VALUE', 2504);
define( 'XA_BASE', 2505);
define( 'XA_SEL_TEXT', 2506);

//-- Specifies init values on XC_IS_INIT_VALUE
define( 'XA_INIT_VALUE', 2507);

//-- Connect Radio Button to Selection Box
define( 'XA_LINKED_TO', 2601);

//-- The Value of Radio Button connected to Selection Box
define( 'XA_RADIO_VALUE', 2602);

define( 'XA_HTML_ID', 2603 );

define( 'XA_DEFAULT_PAGESET', 2701 );
define( 'XA_DEFAULT_COMMAND', 2702 );

//-- specifies the fieldset used in frame object
define( 'XA_FRAME_FIELDSET', 2711 );

//-- specifies the fieldset id used in frame object
define( 'XA_FRAME_FIELDSET_ID', 2712 );

//-- specifies the start page after successful login
define( 'XA_START_PAGE', 2713 );

//-- base url of the web url class
define( 'XA_BASE_URL', 2714 );

//-- A value for XA_REQUIRED
define( 'REQ_ASK_PARENT', -1000 );

//-- Langauge Code
define( 'LC_ENG', 'eng' );
define( 'LC_JPN', 'jpn' );

//-- Message
define( 'XM_CMD', 3100 );
define( 'XM_NS', 3101 );
define( 'XM_RS', 3102 );
define( 'XM_PAGE_TYPE', 3103 );
define( 'XM_TABLE_NS', 3104 );

//-- A new id created after inserting a record
define( 'XM_NEW_ID', 3105 );

//-- Key for XC_IS_INIT_VALUE
define( 'XM_KEY', 3106 );

define( 'STR_DEF_SELECT_CAPTION', '*' );
define( 'SB_Size', 15 );

//-----------------------------------------------------------------------
// END OF FILE
//-----------------------------------------------------------------------
?>