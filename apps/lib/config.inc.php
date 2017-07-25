<?php
define('DB_SERVER','DB_SERVER');
define('DB_USER','DB_USER');
define('DB_PASS','DB_PASS');
define('DB_DATABASE','DB_DATABASE');
define('RESPONSE_FORMAT','json');
define('LANGUAGE_CODE','TH');
// Fix "monthly" for payment type
define('PAYMENT_TYPE','monthly');
// development env
// define('URL_ONAMAE_API','https://test-des.onamae.com/des/Execute.do');
// define('HOST_HEADER','Host: test-des.onamae.com');
// define('ONAMAE_USERNAME','ONAMAE_USERNAME');
// define('ONAMAE_PASSWORD','ONAMAE_PASSWORD');
// production env
define('URL_ONAMAE_API','https://des.onamae.com/des/Execute.do');
define('HOST_HEADER','Host: des.onamae.com');
define('ONAMAE_USERNAME','ONAMAE_USERNAME');
define('ONAMAE_PASSWORD','ONAMAE_PASSWORD');
?>