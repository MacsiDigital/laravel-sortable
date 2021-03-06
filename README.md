# Package to sort results by a field in a table

[![Latest Version on Packagist](https://img.shields.io/packagist/v/macsidigital/laravel-sortable.svg?style=flat-square)](https://packagist.org/packages/macsidigital/laravel-sortable)
[![Build Status](https://img.shields.io/travis/macsidigital/laravel-sortable/master.svg?style=flat-square)](https://travis-ci.org/MacsiDigital/laravel-sortable)
[![StyleCI](https://github.styleci.io/repos/193589045/shield?branch=master)](https://github.styleci.io/repos/193589045)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MacsiDigital/laravel-sortable/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/MacsiDigital/laravel-sortable/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/macsidigital/laravel-sortable.svg?style=flat-square)](https://packagist.org/packages/macsidigital/laravel-sortable)

A simple package to sort results by any field on an eloquent model, including by joins.  Uses the Laravel default query builder order and join functions.

## Installation

You can install the package via composer:

```bash
composer require macsidigital/laravel-sortable
```

The service provider should automatically register for For Laravel > 5.4.

For Laravel < 5.5, open config/app.php and, within the providers array, append:

``` php
MacsiDigital\Sortable\Providers\SortableServiceProvider::class
```

## Usage

Create 2 arrays in your elequent model, the first with the fields that can be sorted, the second showing any table joins.

``` php
protected $sortable = [
    'name', 'email', 'addresses.country'
];

protected $extended_joins = [
    'addresses.country' => [
        'table_field' => 'users.id',
        'foreign_table_field' => 'addresses.addressable_id',
        'restrict_table_field' => 'addresses.addressable_type',
        'restrict_value' => 'App\User'
    ]
];
```

If no table joins are required then you will only need the sortable array.

For any joins include the table and field seperated by a period (.).

Then to sort the fields simply add a sortable() and pass in any fields as an array to sort the results. This has to be in the query builder prior to any get/first requests.

``` php
Users::sortable(explode(',', request()->query('sort')))->get();
```

Use the table blade helper to output sortable links, the first argument is the column name and the 2nd is an array of any key value pairs to include in the anchor tag, if a label is given it will override the column name.

``` php
<tr>
    <th>@sortablecolumnlink('name')</th>
    <th>@sortablecolumnlink('email')</th>
    <th>@sortablecolumnlink('addresses.country', ['label' => 'Country', 'class' => 'country])</th>
</tr>
```

Finally you can set icons in the config file, by default fontawesome icons are used, but this can easily be changed to whatever library you want to use.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email colin@macsi.co.uk instead of using the issue tracker.

## Credits

- [Macsi Digital](https://github.com/mancsidigital)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
