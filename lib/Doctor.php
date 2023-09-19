<?php

/**
 * @author Rudy GAULT
 * @company H2V Solutions
 * @created_at 2023-09-18 22:06:09
 * @updated_by Rudy GAULT
 * @updated_at 2023-09-18 22:06:09
 */

namespace Ecole\GsbVisitsManager;

class Doctor
{
	private $_name;
	private $_specialty;

	public function __construct($_name, $_specialty)
	{
		$this->_name = $_name;
		$this->_specialty = $_specialty;
	}

	/**
	 * Get the name of the doctor.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->_name;
	}

	/**
	 * Get the specialty of the doctor.
	 *
	 * @return string
	 */
	public function getSpecialty()
	{
		return $this->_specialty;
	}
}
