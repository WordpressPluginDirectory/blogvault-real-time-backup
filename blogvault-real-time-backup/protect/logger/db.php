<?php
if (!defined('ABSPATH') && !defined('MCDATAPATH')) exit;

if (!class_exists('BVProtectLoggerDB_V568')) :
class BVProtectLoggerDB_V568 {
	private $tablename;
	private $bv_tablename;

	const MAXROWCOUNT = 100000;

	function __construct($tablename) {
		$this->tablename = $tablename;
		$this->bv_tablename = BVProtect_V568::$db->getBVTable($tablename);
	}

	public function log($data) {
		if (is_array($data)) {
			if (BVProtect_V568::$db->rowsCount($this->bv_tablename) > BVProtectLoggerDB_V568::MAXROWCOUNT) {
				BVProtect_V568::$db->deleteRowsFromtable($this->tablename, 1);
			}

			BVProtect_V568::$db->replaceIntoBVTable($this->tablename, $data);
		}
	}
}
endif;