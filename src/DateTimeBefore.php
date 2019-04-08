<?php

// Namespace
namespace Alphametric\Validation\Rules;

// Using directives
use Carbon\Carbon;

// Date time before rule
class DateTimeBefore extends Rule
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
		$this->maximum     = func_get_args()[0];
		$this->date_format = func_get_args()[1] ?? 'Y-m-d H:i:s';
		$this->time_zone   = func_get_args()[2] ?? 'UTC';
    }



    /**
     * Determine if the validation rule passes.
     *
     * The rule has three parameters:
     * 1. The maximum date / time permitted.
     * 2. The PHP date format, defaults to 'Y-m-d H:i:s'.
     * 3. The PHP time zone, defaults to 'UTC'.
     *
     * @param string $attribute.
     * @param mixed $value.
     * @return bool.
     *
     **/
    public function passes($attribute, $value)
    {
        $boundary = Carbon::createFromFormat($this->date_format, $this->maximum, $this->time_zone);

        return Carbon::createFromFormat($this->date_format, $value, $this->time_zone)->lessThan($boundary);
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
            'datetime_before',
            'The :attribute must be a date / time before ' .
            Carbon::createFromFormat($this->date_format, $this->maximum, $this->time_zone)
                  ->format('jS F Y @ g:i:s A')
        );
    }

}