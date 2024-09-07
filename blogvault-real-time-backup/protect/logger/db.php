<?php
if (!defined('ABSPATH') && !defined('MCDATAPATH')) exit;

if (!class_exists('BVProtectLoggerDB_V573')) :
class BVProtectLoggerDB_V573 {
	private $tablename;
	private $bv_tablename;

	const MAXROWCOUNT = 100000;

	function __construct($tablename) {
		$this->tablename = $tablename;
		$this->bv_tablename = BVProtect_V573::$db->getBVTable($tablename);
	}

	public function log($data) {
		if (is_array($data)) {
			if (BVProtect_V573::$db->rowsCount($this->bv_tablename) > BVProtectLoggerDB_V573::MAXROWCOUNT) {
				BVProtect_V573::$db->deleteRowsFromtable($this->tablename, 1);
			}

			BVProtect_V573::$db->replaceIntoBVTable($this->tablename, $data);
		}
	}
}
endif;