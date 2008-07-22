<?php
	require_once dirname(__FILE__) . "/../extlib/simpletest/autorun.php";
	include_once dirname(__FILE__) . "/../extlib/praized-mt-core/inc.init.php";
	
	class PraizedRouterTest extends UnitTestCase {
		var $_router;
		
		function setUp() {
			$this->_router = new PraizedRouter();
			$this->_router->add(new PraizedRoute("/^merchants\/search\/?/", new PraizedSearchAction()));
			$this->_router->add(new PraizedRoute("/^merchants\/search\/.+/", new PraizedSearchAction()));
			$this->_router->add(new PraizedRoute("/^merchants\/.+/", new PraizedMerchantAction()));
			$this->_router->add(new PraizedRoute("/^merchants\/?/", new PraizedMerchantsAction()));
			$this->_router->add(new PraizedRoute("/^places\/.+/", new PraizedMerchantAction()));
			$this->_router->add(new PraizedRoute("/^results\/.+/", new PraizedMerchantAction()));
			$this->_router->add(new PraizedRoute("/^users\/.+/", new PraizedUserAction()));
		}
		
		function testPositiveRouting () {
				$r = new PraizedRequest("merchants/", array());
				$this->assertTrue($this->_router->compile($r));
				
				$r = new PraizedRequest("places/ca/quebec/louiseville/fleuriste-la-serre-de-louiseville-enr");
				$this->assertTrue($this->_router->compile($r));
				
				$r = new PraizedRequest("users/php", array());
				$this->assertTrue($this->_router->compile($r));
				
				$r = new PraizedRequest("merchants/92834192828222", array());
				$this->assertTrue($this->_router->compile($r));
				
				$r = new PraizedRequest("results/ca/quebec/louiseville/fleuriste-la-serre-de-louiseville-enr");
				$this->assertTrue($this->_router->compile($r));
				
				$r = new PraizedRequest("merchants/search/?page=2", array());
				$this->assertTrue($this->_router->compile($r));
					
		}
		
		function testNegativeRouting() {
			$r = new PraizedRequest("users/", array());
			$this->assertFalse($this->_router->compile($r));
			
			$r = new PraizedRequest("2008/03/31/identity-management-architect-montreal.html");
			$this->assertFalse($this->_router->compile($r));
		}
		
		function testMatchAMerchantRequest(){
			$r = new PraizedRequest("places/ca/quebec/louiseville/fleuriste-la-serre-de-louiseville-enr");
			$this->assertIsA($this->_router->compile($r), "PraizedMerchantAction");

			$r = new PraizedRequest("merchants/92834192828222", array());
			$this->assertIsA($this->_router->compile($r), "PraizedMerchantAction");

			$r = new PraizedRequest("results/ca/quebec/louiseville/fleuriste-la-serre-de-louiseville-enr");
			$this->assertIsA($this->_router->compile($r), "PraizedMerchantAction");
		}
		
		function testMatchAMerchantsRequest() {
			$r = new PraizedRequest("merchants/");
			$this->assertIsA($this->_router->compile($r), "PraizedMerchantsAction");
			
		    $r = new PraizedRequest("merchants");
		    $this->assertIsA($this->_router->compile($r), "PraizedMerchantsAction");
		}
		
		function testMatchASearchRequest() {
			$r = new PraizedRequest("merchants/search/?page=3&q=sushi&l=montreal");
			$this->assertIsA($this->_router->compile($r), "PraizedSearchAction");
			
			$r = new PraizedRequest("merchants/search");
			$this->assertIsA($this->_router->compile($r), "PraizedSearchAction");
		}
	}
?>