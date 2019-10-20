<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Helper
class Helper
{

	/**
	 * Retrieve the appropriate, localized validation message
	 * or fall back to the given default.
	 *
	 * @param string $key.
	 * @param string $default.
	 * @return string.
	 *
	 **/
	public static function getLocalizedErrorMessage($key, $default)
	{
		return trans("validation.$key") === "validation.$key" ? $default : trans("validation.$key");
	}
}
