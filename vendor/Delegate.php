<?php

namespace Vendor;

final class Delegate {
	private $_Closure;

	public function __construct($closure)
	{
		$this->_Closure = \Closure::fromCallable($closure);
	}

	public function __invoke(...$args)
	{
		return call_user_func_array($this->_Closure, $args);
	}
}