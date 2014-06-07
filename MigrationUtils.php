<?php

class MigrationUtils {

	public $systemDir = "./systems/";
	private $systems;

	function __construct() {
		$systems = array();
	}

	function getSystemsList() {

	    $list = array();
		$d = dir("./systems");
		while ($file = $d->read()) {
			if (substr($file, -4) == ".php") {
				$list[] = substr($file, 0, -4);
			}
		}
		return $list;
	}

	/**
	 * @TODO test this
	 */
	function getSystem($name) {
		if (!isset($this->systems[$name])) {
			require_once $this->systemDir . $name . ".php";
			$s = new $name();
			$this->systems[$name] = $s;
		}
		return $this->systems[$name];
	}

}
