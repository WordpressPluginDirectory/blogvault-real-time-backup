<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVWPAction')) :
	class BVWPAction {
		public $settings;
		public $siteinfo;
		public $bvinfo;
		public $bvapi;

		public function __construct($settings, $siteinfo, $bvapi) {
			$this->settings = $settings;
			$this->siteinfo = $siteinfo;
			$this->bvapi = $bvapi;
			$this->bvinfo = new BVInfo($settings);
		}
	
		public function activate() {
			if (!isset($_REQUEST['blogvaultkey'])) {
				##BVKEYSLOCATE##
			}
			if (BVAccount::isConfigured($this->settings)) {
				/* This informs the server about the activation */
				$info = array();
				$this->siteinfo->basic($info);
				$this->bvapi->pingbv('/bvapi/activate', $info);
			} else {
				BVAccount::setup($this->settings);
			}
		}

		public function deactivate() {
			$info = array();
			$this->siteinfo->basic($info);
			##DISABLECACHE##
			$this->bvapi->pingbv('/bvapi/deactivate', $info);
		}

		public static function uninstall() {
			do_action('bv_clear_pt_config');
			do_action('bv_clear_dynsync_config');
			##CLEARCACHECONFIG##
			do_action('bv_clear_bv_services_config');
			do_action('bv_remove_bv_preload_include');
			do_action('bv_clear_php_error_config');
		}

		public function clear_bv_services_config() {
			$this->settings->deleteOption($this->bvinfo->services_option_name);
		}

		##SOUNINSTALLFUNCTION##

		public function footerHandler() {
			$bvfooter = $this->settings->getOption($this->bvinfo->badgeinfo);
			if ($bvfooter) {
				echo '<div style="max-width:150px;min-height:70px;margin:0 auto;text-align:center;position:relative;">
					<a href='.esc_url($bvfooter['badgeurl']).' target="_blank" ><img src="'.esc_url(plugins_url($bvfooter['badgeimg'], __FILE__)).'" alt="'.esc_attr($bvfooter['badgealt']).'" /></a></div>';
			}
		}

		public function removeBVPreload() {
			$pattern = "@include '" . rtrim(ABSPATH, DIRECTORY_SEPARATOR) . "/bv-preload.php" . "';";
			BVHelper::removePatternFromWpConfig($pattern);
		}

	}
endif;