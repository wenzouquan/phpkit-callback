<?php
namespace phpkit\callback;
class Callback {
	public $Stauts = 0; //状态
	public $List = array(); //回调函数
	public $Type; //执行方式
	public $params;
	public $Closure = array();
	function __construct($type = array('once', 'memory')) {
		$this->Type = $type;
	}

	function add($fun = "") {
		if (empty($fun)) {
			return false;
		}
		if (in_array($fun, $this->Closure)) {
			return false;
		}
		$this->Closure[] = $fun;
		$status = 0;
		if ($this->Stauts == 1 && in_array('memory', $this->Type)) {
			$fun($this->params);
			$status = 1;
		}
		$this->List[] = array(
			'fun' => $fun,
			'status' => $status,
		);
	}

	function fire($params = array()) {
		$this->params = $params;
		$data = array();
		foreach ($this->List as $key => $value) {
			if ($value['status'] == 0 || !in_array('once', $this->Type)) {
				$ret = $value['fun']($params);
				if (!empty($ret)) {
					$data[] = $ret;
				}
				$this->List[$key]['status'] = 1;
			}
		}
		$this->Stauts = 1;
		return $data;
	}

}
