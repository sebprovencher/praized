<?php
	include_once dirname(__FILE__) . "/../extlib/praized-mt-core/inc.init.php";
	require_once dirname(__FILE__) . "/../extlib/simpletest/autorun.php";
	include_once dirname(__FILE__) . "/../../../php/mt.php";
	var_dump(dirname(__FILE__));

	$mt = new PraizedViewer(2, '/Users/ph/praized/_installation/mt3/cgi/mt-config.cgi');
	
	class AllTests extends TestSuite {
	    function AllTests() {
	        $this->TestSuite('All tests');
			
			$dir = dirname(__FILE__);
	
			if (is_dir($dir)) {
			    if ($dh = opendir($dir)) {
			        while (($file = readdir($dh)) !== false) {
						if(preg_match("/_test.php$/", $file)) {
							        $this->addFile($file);
						}
			        }
			        closedir($dh);
			    }
			}
    	}
	}
?>