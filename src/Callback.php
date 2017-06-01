<?php
namespace phpkit\callback;
class Callback {
	function __construct($param = array()) {
		if (empty($param)) {
			throw new \Exception("Error WeiXinApi params missing", 1);
		}
	}

}
