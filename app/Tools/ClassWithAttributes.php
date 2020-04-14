<?php


namespace App\Tools;


class ClassWithAttributes
{
	protected $_attributes = [];

	public function __set($key, $value)
	{
		$this->_attributes[$key] = $value;
	}

	public function __get($key)
	{
		if (isset($this->_attributes[$key])) {
			return $this->_attributes[$key];
		}
		return null;
	}
}
