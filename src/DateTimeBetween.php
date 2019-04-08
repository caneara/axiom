<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Carbon\Carbon;

// Date time between rule
class DateTimeBetween extends Rule
{

    /**
     * The date format for the rule.
     *
     **/
    protected $date_format;



    /**
     * The maximum acceptable date.
     *
     **/
    protected $maximum;



    /**
     * The minimum acceptable date.
     *
     **/
    protected $minimum;



    /**
     * The time zone for the rule.
     *
     **/
    protected $time_zone;



    /**
     * Constructor.
     *
     * @param none.
     * @return instance.
     *
     **/
    public function __construct()
    {
		$this->minimum     = func_get_args()[0];
		$this->maximum     = func_get_args()[1];
		$this->date_format = func_get_args()[2] ?? 'Y-m-d H:i:s';
		$this->time_zone   = func_get_args()[3] ?? 'UTC';
    }



    /**
     * Determine if the validation rule passes.
     *
     * The rule has four parameters:
     * 1. The minimum date / time permitted.
     * 2. The maximum date / time permitted.
     * 3. The PHP date format, defaults to 'Y-m-d H:i:s'.
     * 4. The PHP time zone, defaults to 'UTC'.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        $boundary_start = Carbon::createFromFormat($this->date_format, $this->minimum, $this->time_zone);
        $boundary_finish = Carbon::createFromFormat($this->date_format, $this->maximum, $this->time_zone);

		$date_time = Carbon::createFromFormat($this->date_format, $value, $this->time_zone);

        return $date_time->greaterThan($boundary_start) && $date_time->lessThan($boundary_finish);
    }



    /**
     * Get the validation error message.
     *
     * @param none.
     * @return string.
     *
     **/
    public function message()
    {
        return Helper::getLocalizedErrorMessage(
            'datetime_between',
            'The :attribute must be a date / time after ' .
            Carbon::createFromFormat($this->date_format, $this->minimum, $this->time_zone)
                  ->format('jS F Y @ g:i:s A') .
			' and before ' .
			Carbon::createFromFormat($this->date_format, $this->maximum, $this->time_zone)
                  ->format('jS F Y @ g:i:s A')
        );
    }

}