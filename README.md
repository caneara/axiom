# Laravel Validation Rules

This package provides a set of reusable validation rules for your Laravel projects. Use them to augment the existing set provided by Laravel itself.

## Installation

Pull in the package using composer

```bash
composer require alphametric/laravel-validation-rules
```

## Usage

As per the Laravel [documentation](https://laravel.com/docs/5.8/validation#using-rule-objects), simply import the relevant validation class wherever you require it, and then include it within the rules for a particular field:

```php
use Alphametric\Validation\Rules\StrongPassword;

// ...

$request->validate([
    'password' => ['bail', 'required', StrongPassword],
]);
```

If the validation fails, the package will attempt to respond with a localized error message (see message keys below). If the key does not exist, it will fall back to a hard-coded English language version.

## Available rules

The following validation rules are currently available:

| Rule           | Message Key | Description |
| -------------  | ----------- | ----------- |
| StrongPassword | validation.strong_password | Requires the presence of a "strong" password - see class for details |
| TelephoneNumber | validation.telephone_number | Requires the presence of a valid telephone number - see class for details |
| RecordOwner | validation.record_owner | Requires the authenticated user's id to match the user_id column on a given database record e.g. owner:posts,id |
| MonetaryFigure | validation.monetary_figure | Requires the presence of a monetary figure e.g $72.33 - see class for details |

The package will receive new rules over time, however since these updates will not be breaking changes, they will not receive major version numbers unless Laravel changes in such a way that the package requires a re-write.

## Contributions

You are welcome to submit pull requests containing your own validation rules, however to be accepted, they must explain what they do, be useful to others, and include a suitable test to confirm they work correctly.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.