<?php
if (!defined('MCDATAPATH')) exit;

if (defined('MCCONFKEY')) {
	require_once dirname( __FILE__ ) . '/../protect.php';

	BVProtect_V585::init(BVProtect_V585::MODE_PREPEND);
}