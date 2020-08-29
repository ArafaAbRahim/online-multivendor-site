<?php
/**
 * Created by ra.
 * Date: 3/7/2016
 */




class tdc_util {
	private static $unique_id_counter = 0;


	static function generate_unique_id() {
		self::$unique_id_counter ++;
		return 'td_uid_' . self::$unique_id_counter . '_' . uniqid();
	}


	static function enqueue_js_files_array($js_files_array, $dependency_array = array(), $url = TDC_URL ) {

		$last_js_file_id = '';
		foreach ($js_files_array as $js_file_id => $js_file) {
			if ($last_js_file_id == '') {
				wp_enqueue_script($js_file_id, $url . $js_file, $dependency_array, TDC_VERSION, true); //first, load it with jQuery dependency
			} else {
				wp_enqueue_script($js_file_id, $url . $js_file, array($last_js_file_id), TDC_VERSION, true);  //not first - load with the last file dependency
			}
			$last_js_file_id = $js_file_id;
		}
	}





	/**
	 * Shows a soft error. The site will run as usual if possible. If the user is logged in and has 'switch_themes'
	 * privileges this will also output the caller file path
	 * @param $file - The file should be __FILE__
	 * @param $function - __FUNCTION__
	 * @param $message - the error message
	 * @param $more_data - it will be print_r if available
	 */
	static function error($file, $function, $message, $more_data = '') {
		echo '<br><br>wp booster error:<br>';
		echo $message;
		if (is_user_logged_in() and current_user_can('switch_themes')){
			echo '<br>' . $file . ' > ' . $function;
			if (!empty($more_data)) {
				echo '<br><br><pre>';
				echo 'more data:' . PHP_EOL;
				print_r($more_data);
				echo '</pre>';
			}
		};
	}




	static function get_get_val($_get_name) {
		if (isset($_GET[$_get_name])) {
			return $_GET[$_get_name];
		}

		return false;
	}
}