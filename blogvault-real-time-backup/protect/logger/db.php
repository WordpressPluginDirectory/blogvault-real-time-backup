<?php
if (!defined('ABSPATH') && !defined('MCDATAPATH')) exit;

if (!class_exists('BVProtectLoggerDB_V577')) :
class BVProtectLoggerDB_V577 {
	private $tablename;
	private $bv_tablename;

	const MAXROWCOUNT = 100000;

	function __construct($tablename) {
		$this->tablename = $tablename;
		$this->bv_tablename = BVProtect_V577::$db->getBVTable($tablename);
	}

	public function log($data) {
		if (is_array($data)) {
			if (BVProtect_V577::$db->rowsCount($this->bv_tablename) > BVProtectLoggerDB_V577::MAXROWCOUNT) {
				BVProtect_V577::$db->deleteRowsFromtable($this->tablename, 1);
			}

			BVProtect_V577::$db->replaceIntoBVTable($this->tablename, $data);
		}
	}
}
endif;