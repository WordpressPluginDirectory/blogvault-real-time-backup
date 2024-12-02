<?php
if (!defined('ABSPATH') && !defined('MCDATAPATH')) exit;

if (!class_exists('BVProtectLoggerDB_V585')) :
class BVProtectLoggerDB_V585 {
	private $tablename;
	private $bv_tablename;

	const MAXROWCOUNT = 100000;

	function __construct($tablename) {
		$this->tablename = $tablename;
		$this->bv_tablename = BVProtect_V585::$db->getBVTable($tablename);
	}

	public function log($data) {
		if (is_array($data)) {
			if (BVProtect_V585::$db->rowsCount($this->bv_tablename) > BVProtectLoggerDB_V585::MAXROWCOUNT) {
				BVProtect_V585::$db->deleteRowsFromtable($this->tablename, 1);
			}

			BVProtect_V585::$db->replaceIntoBVTable($this->tablename, $data);
		}
	}
}
endif;