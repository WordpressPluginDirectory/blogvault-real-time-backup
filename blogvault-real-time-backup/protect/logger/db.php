<?php
if (!defined('ABSPATH') && !defined('MCDATAPATH')) exit;

if (!class_exists('BVProtectLoggerDB_V556')) :
class BVProtectLoggerDB_V556 {
	private $tablename;
	private $bv_tablename;

	const MAXROWCOUNT = 100000;

	function __construct($tablename) {
		$this->tablename = $tablename;
		$this->bv_tablename = BVProtect_V556::$db->getBVTable($tablename);
	}

	public function log($data) {
		if (is_array($data)) {
			if (BVProtect_V556::$db->rowsCount($this->bv_tablename) > BVProtectLoggerDB_V556::MAXROWCOUNT) {
				BVProtect_V556::$db->deleteRowsFromtable($this->tablename, 1);
			}

			BVProtect_V556::$db->replaceIntoBVTable($this->tablename, $data);
		}
	}
}
endif;