<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Illuminate\Contracts\Validation\Rule as BaseRule;

// Rule
abstract class Rule implements BaseRule
{

	/**
	 * Array of supporting parameters.
	 *
	 **/
	protected $parameters;



	/**
	 * Constructor.
	 *
	 * @param none.
	 * @return instance.
	 *
	 **/
	public function __construct()
	{
		// Set the class properties
		$this->parameters = func_get_args();
	}

}