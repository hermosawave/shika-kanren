<?php
/*

「購入商品の合計」が MINIMUM_TOTAL_AMOUNT を超えた場合、
手数料は 「購入商品の合計」x HANDLING_RATE になります。

「購入商品の合計」が MINIMUM_TOTAL_AMOUNT と同じかそれ以下場合、
手数料は MINIMUM_HANDLING_FEE になります。

*/

define( 'MINIMUM_TOTAL_AMOUNT', 100 );
define( 'HANDLING_RATE', 15 );
define( 'MINIMUM_HANDLING_FEE', 15 );

?>