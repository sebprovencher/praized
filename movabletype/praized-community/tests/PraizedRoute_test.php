<?php
	require_once dirname(__FILE__) . "/../extlib/simpletest/autorun.php";
	include_once dirname(__FILE__) . "/../extlib/praized-mt-core/inc.init.php";

	class PraizedRouteTest extends UnitTestCase {
		function testForRightMatch() {
			$r = new PraizedRoute("/^\/merchant?(\/.+)/", new AbstractPraizedAction());
			$req  = new PraizedRequest("/merchant/chez-ty-coq", array());
			$this->assertTrue($r->match($req));
		}
		
		function testForFalseMatch() {
			$r = new PraizedRoute("/^\/merchant?(\/.+)/", new AbstractPraizedAction());
			$req  = new PraizedRequest("search-false-match", array());
			$this->assertFalse($r->match($req));
		}
	}
?>