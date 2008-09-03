<?php
/*******************************************************************************
BUTTONSNAP CLASS LIBRARY By Owen Winkler
http://asymptomatic.net
WordPress Downloads are at http://redalt.com/downloads
Was Version: 1.3.1
Modified by Andrew Scott on 9th September 2007 to remove all references
to TinyMCE, and allow it to do the job of manipulating the HTML code editor
buttons on WordPress 2.1+
Version: 2.0
*******************************************************************************/

if (!class_exists('buttonsnap2')) :
class buttonsnap2
{
	var $script_output = false;
	var $buttons = array('post'=>array(),'page'=>array(),'any'=>array());
	var $markers = array();
	
	function sink_hooks()
	{
		add_action('edit_form_advanced', array(&$this, 'edit_form_advanced'));
		add_action('edit_page_form', array(&$this, 'edit_page_form'));
		add_filter('mce_plugins', array(&$this, 'mce_plugins'));
	}
	
	function go_solo()
	{
		$dispatch = isset($_POST['buttonsnap2dispatch']) ? $_POST['buttonsnap2dispatch'] : @$_GET['buttonsnap2dispatch'];
		if($dispatch != '') {
			auth_redirect();
			$selection = isset($_POST['selection']) ? $_POST['selection'] : @$_GET['selection'];
			$selection = apply_filters($dispatch, $selection);
			die($selection);
		}
		if(isset($_GET['docss'])) {
			auth_redirect();
			do_action('marker_css');
			die();
		}
	}
	
	function edit_form_advanced()
	{
		if (!$this->script_output) {
			$this->output_script('post');
			$this->script_output = true;
		}
	}
	
	function edit_page_form()
	{
		if (!$this->script_output) {
			$this->output_script('page');
			$this->script_output = true;
		}
	}
	
	function mce_plugins($plugins)
	{
		if (count($this->markers) > 0) {
		
			echo "var buttonsnap2_markers = new Array(\n";
			$comma = '';
			foreach ($this->markers as $k => $v) {
				echo "{$comma}\"{$k}\"";
				$comma = "\n,";
			}
			echo "\n);\n";
			echo "var buttonsnap2_classes = new Array(\n";
			$comma = '';
			foreach ($this->markers as $k => $v) {
				echo "{$comma}\"{$v}\"";
				$comma = "\n,";
			}
			echo "\n);\n";
			
			$plugins[] = 'buttonsnap2';
		}
		return $plugins;
	}
	
	function output_script($type = 'any')
	{
		echo '<script type="text/javascript">
		var buttonsnap2_request_uri = "' . $this->plugin_uri() . '";
		var buttonsnap2_wproot = "' . get_settings('siteurl') . '";
		</script>' . "\n";
echo <<< ENDSCRIPT

<script type="text/javascript">//<![CDATA[
addLoadEvent(function () { window.setTimeout('buttonsnap2_addbuttons()',1000); });
var buttonsnap2_mozilla = document.getElementById&&!document.all;
function buttonsnap2_safeclick(e)
{
	if(!buttonsnap2_mozilla) {
		e.returnValue = false;
		e.cancelBubble = true;
	}
}
function buttonsnap2_addEvent( obj, type, fn )
{
	if (obj.addEventListener)
		obj.addEventListener( type, fn, false );
	else if (obj.attachEvent)
	{
		obj["e"+type+fn] = fn;
		obj[type+fn] = function() { obj["e"+type+fn]( window.event ); }
		obj.attachEvent( "on"+type, obj[type+fn] );
	}
}
function buttonsnap2_newbutton(src, alt) {
	if(window.qttoolbar)
	{
		var anchor = document.createElement('input');
		anchor.type = 'button';
		anchor.value = alt;
		anchor.className = 'ed_button';
		anchor.title = alt;
		anchor.id = 'ed_' + alt;
		qttoolbar.appendChild(anchor);
	}	
	return anchor;
}
function buttonsnap2_settext(text) {
	edInsertContent(edCanvas, text);
}
function buttonsnap2_ajax(dispatch) {
		if (document.selection) {
			document.getElementById('content').focus();
		  sel = document.selection.createRange();
			if (sel.text.length > 0) {
				selection = sel.text;
			}
			else {
				selection = '';
			}
		}
		else {
			selection = '';
		}

	var ajax = new sack(buttonsnap2_request_uri);
	ajax.setVar('buttonsnap2dispatch', dispatch);
	ajax.setVar('selection', selection);
	ajax.onCompletion = function () {buttonsnap2_settext(this.response);};
	ajax.runAJAX();
}
var qttoolbar = document.getElementById("ed_toolbar");
function buttonsnap2_addbuttons () {
	try {
ENDSCRIPT;
		
		switch($type) {
		case 'any':
			$this->buttons['any'] = array_merge($this->buttons['post'], $this->buttons['page'], $this->buttons['any']);
			break;
		default:
			$this->buttons[$type] = array_merge($this->buttons[$type], $this->buttons['any']);
		}
		$usebuttons = $this->buttons[$type];
		
		foreach ($usebuttons as $button) {
			if($button['type'] == 'separator') {
				// do nothing
			}
			else {
				echo "newbtn = buttonsnap2_newbutton('{$button['src']}', '{$button['alt']}');\n";
				switch($button['type']) {
				case 'text':
					echo "buttonsnap2_addEvent(newbtn, 'click', function(e) {buttonsnap2_settext(\"{$button['text']}\");buttonsnap2_safeclick(e);});\n";
					break;
				case 'js':
					echo "buttonsnap2_addEvent(newbtn, 'click', function(e) {" . $button['js'] . "buttonsnap2_safeclick(e);});\n";
					break;
				case 'ajax':
					echo "buttonsnap2_addEvent(newbtn, 'click', function(e) {buttonsnap2_ajax(\"{$button['hook']}\");buttonsnap2_safeclick(e);});\n";
					break;
				default:
					echo "buttonsnap2_addEvent(newbtn, 'click', function(e) {alert(\"The :{$button->type}: button is an invalid type\");buttonsnap2_safeclick(e);});\n";
				}
			}
		}
echo <<< MORESCRIPT
	}
	catch(e) {
		setTimeout('buttonsnap2_addbuttons()', 5000);
	}
}
//]]></script>

MORESCRIPT;
	}
	
	function textbutton($imgsrc, $alttext, $inserted, $type="any")
	{
		$this->buttons[$type][] = array('type'=>'text', 'src'=>$imgsrc, 'alt'=>$alttext, 'text'=>$inserted);
		return $this->buttons;
	}
	
	function jsbutton($imgsrc, $alttext, $js, $type="any")
	{
		$this->buttons[$type][] = array('type'=>'js', 'src'=>$imgsrc, 'alt'=>$alttext, 'js'=>$js);
		return $this->buttons;
	}

	function ajaxbutton($imgsrc, $alttext, $hook, $type="any")
	{
		$this->buttons[$type][] = array('type'=>'ajax', 'src'=>$imgsrc, 'alt'=>$alttext, 'hook'=>$hook);
		return $this->buttons;
	}
	
	function separator($type="any")
	{
		$this->buttons[$type][] = array('type'=>'separator');
		return $this->buttons;
	}
	
	function register_marker($marker, $cssclass)
	{
		$this->markers[$marker] = $cssclass;
	}
	
	function basename($src='') 
	{
		if($src == '') $src = __FILE__;
		$name = preg_replace('/^.*wp-content[\\\\\/]plugins[\\\\\/]/', '', $src);
		return str_replace('\\', '/', $name);
	}
	
	function plugin_uri($src = '')
	{
		return get_settings('siteurl') . '/wp-content/plugins/' . $this->basename($src); 
	}
	
	function include_up($filename) {
		$c=0;
		while(!is_file($filename)) {
			$filename = '../' . $filename;
			$c++;
			if($c==30) {
				echo 'Could not find ' . basename($filename) . '.'; return '';
			}
		}
		return $filename;
	}

	function debug($foo)
	{
		$args = func_get_args();
		echo "<pre style=\"background-color:#ffeeee;border:1px solid red;\">";
		foreach($args as $arg1)
		{
			echo htmlentities(print_r($arg1, 1)) . "<br/>";
		}
		echo "</pre>";
	}
}
$buttonsnap2 = new buttonsnap2();
function buttonsnap2_textbutton($imgsrc, $alttext, $inserted, $type="any") { global $buttonsnap2; return $buttonsnap2->textbutton($imgsrc, $alttext, $inserted, $type);}
function buttonsnap2_jsbutton($imgsrc, $alttext, $js, $type="any") { global $buttonsnap2; return $buttonsnap2->jsbutton($imgsrc, $alttext, $js, $type);}
function buttonsnap2_ajaxbutton($imgsrc, $alttext, $hook, $type="any") { global $buttonsnap2; return $buttonsnap2->ajaxbutton($imgsrc, $alttext, $hook, $type);}
function buttonsnap2_separator($type="any") { global $buttonsnap2; return $buttonsnap2->separator($type);}

function buttonsnap2_textbutton_post($imgsrc, $alttext, $inserted) { global $buttonsnap2; return $buttonsnap2->textbutton($imgsrc, $alttext, $inserted, 'post');}
function buttonsnap2_jsbutton_post($imgsrc, $alttext, $js) { global $buttonsnap2; return $buttonsnap2->jsbutton($imgsrc, $alttext, $js, 'post');}
function buttonsnap2_ajaxbutton_post($imgsrc, $alttext, $hook) { global $buttonsnap2; return $buttonsnap2->ajaxbutton($imgsrc, $alttext, $hook, 'post');}
function buttonsnap2_separator_post() { global $buttonsnap2; return $buttonsnap2->separator('post');}

function buttonsnap2_textbutton_page($imgsrc, $alttext, $inserted) { global $buttonsnap2; return $buttonsnap2->textbutton($imgsrc, $alttext, $inserted, 'page');}
function buttonsnap2_jsbutton_page($imgsrc, $alttext, $js) { global $buttonsnap2; return $buttonsnap2->jsbutton($imgsrc, $alttext, $js, 'page');}
function buttonsnap2_ajaxbutton_page($imgsrc, $alttext, $hook) { global $buttonsnap2; return $buttonsnap2->ajaxbutton($imgsrc, $alttext, $hook, 'page');}
function buttonsnap2_separator_page() { global $buttonsnap2; return $buttonsnap2->separator('page');}

function buttonsnap2_dirname($src = '') {global $buttonsnap2; return dirname($buttonsnap2->plugin_uri($src));}
function buttonsnap2_register_marker($marker, $cssclass) {global $buttonsnap2; return $buttonsnap2->register_marker($marker, $cssclass);}
endif;
if (!defined('ABSPATH')) {
  require_once($buttonsnap2->include_up('wp-config.php'));
  $buttonsnap2->go_solo();
}
else {
	$buttonsnap2->sink_hooks();
}

?>
