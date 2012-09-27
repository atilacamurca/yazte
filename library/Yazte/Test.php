<?php

class Yazte_Test {
	
	function getTemplate($file, $vars = array()) {
		ob_start();
		if (file_exists($file)) {
			include($file);
		}
		return ob_get_clean();
	}
}

$test = new Yazte_Test();
echo $test->getTemplate('file.php', array('var1' => 'atilacamurca'));
