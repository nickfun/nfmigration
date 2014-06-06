<?php

class MigrationUtils {

	public $systemDir = "./systems/";

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
}
