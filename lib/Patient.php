<?php

/**
 * @author Rudy GAULT
 * @company H2V Solutions
 * @created_at 2023-09-18 22:05:23
 * @updated_by Rudy GAULT
 * @updated_at 2023-09-18 22:05:24
 */
namespace Ecole\GsbVisitsManager;

class Patient
{
	private $_name;
	private $_age;

	public function __construct($_name, $age)
	{
	$this->_name = $_name;
	$this->_age = $age;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function getAge()
	{
	return $this->_age;
	}
}
