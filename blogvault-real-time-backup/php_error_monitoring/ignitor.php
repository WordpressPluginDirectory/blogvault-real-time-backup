<?php
if (!defined("PHP_ERR_MONIT_PATH")) exit;

require_once dirname( __FILE__ ) . '/../helper.php';
require_once dirname( __FILE__ ) . '/monitoring.php';

BVHelper::preInitWPHook("muplugins_loaded", array("BVWPPHPErrorMonitoring", 'init'), PHP_INT_MAX, 0);