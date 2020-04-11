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
    'password' => ['bail', 'required', new StrongPassword],
]);
```

If the validation fails, the package will attempt to respond with a localized error message (see message keys below). If the key does not exist, it will fall back to a hard-coded English language version.

**IMPORTANT**: As with all custom rules, you cannot use a pipe-delimited string. You must instead use an array e.g.

```php
'password' => ['bail', 'required', new StrongPassword] // correct
'password' => 'bail|required|new StrongPassword' // wrong
```

## Available rules

The following validation rules are currently available:

| Rule                  | Message Key                       | Description |
| --------------------- | --------------------------------- | ----------- |
| StrongPassword        | validation.strong_password        | Requires the presence of a "strong" password - see class for details |
| TelephoneNumber       | validation.telephone_number       | Requires the presence of a valid telephone number - see class for details |
| RecordOwner           | validation.record_owner           | Requires the authenticated user's id to match the user_id column on a given database record e.g. owner:posts,id |
| MonetaryFigure        | validation.monetary_figure        | Requires the presence of a monetary figure e.g $72.33 - see class for details |
| DisposableEmail       | validation.disposable_email       | Requires the presence of an email address which is not disposable |
| DoesNotExist          | validation.does_not_exist         | Requires that the given value is not present in a given database table / column - see class for details |
| Decimal               | validation.decimal                | Requires that the given value is a decimal with an appropriate format - see class for details |
| EncodedImage          | validation.encoded_image          | Requires that the given value is a base64-encoded image of a given mime type - see class for details |
| LocationCoordinates   | validation.location_coordinates   | Requires that the given value is a comma-separated set of latitude and longitude coordinates |
| FileExists            | validation.file_exists            | Requires that the given value is a path to an existing file - see class for details |
| Equals                | validation.equals                 | Requires that the given value is equal to another given value |
| MacAddress            | validation.mac_address            | Requires that the given value is a valid MAC address |
| ISBN                  | validation.isbn                   | Requires that the given value is a valid ISBN-10 or ISBN-13 number |
| EndsWith              | validation.ends_with              | Requires that the given value ends with a given string - see class for details |
| EvenNumber            | validation.even_number            | Requires that the given value is an even number (decimals are first converted using intval) |
| OddNumber             | validation.odd_number             | Requires that the given value is an odd number (decimals are first converted using intval) |
| Lowercase             | validation.lowercase              | Requires that the given value is a lowercase string |
| Uppercase             | validation.uppercase              | Requires that the given value is a uppercase string |
| Titlecase             | validation.titlecase              | Requires that the given value is a titlecase string |
| Domain                | validation.domain                 | Requires that the given value be a domain e.g. google.com, www.google.com |
| CitizenIdentification | validation.citizen_identification | Requires that the given value be a citizen identification number of usa, uk or france (see class for details) |
| WithoutWhitespace     | validation.without_whitespace	    | Requires that the given value not include any whitespace characters |

The package will receive new rules over time, however since these updates will not be breaking changes, they will not receive major version numbers unless Laravel changes in such a way that the package requires a re-write.

## Contributions

You are welcome to submit pull requests containing your own validation rules, however to be accepted, they must explain what they do, be useful to others, and include a suitable test to confirm they work correctly.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.