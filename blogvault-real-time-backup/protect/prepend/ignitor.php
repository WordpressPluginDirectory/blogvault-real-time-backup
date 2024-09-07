<?php
if (!defined('MCDATAPATH')) exit;

if (defined('MCCONFKEY')) {
	require_once dirname( __FILE__ ) . '/../protect.php';

	BVProtect_V573::init(BVProtect_V573::MODE_PREPEND);
}