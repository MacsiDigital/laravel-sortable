# Package to sort results by a field in a table

A simple package to sort results by any field on an eloquent model, including by joins.  Uses the Laravel default query builder order and join functions.

## Installation

You can install the package via composer:

```bash
composer require mancsidigital/sortable
```

## Usage

Create 2 arrays in your elequent model, the first with the fields that can be sorted, the second showing any table joins.

``` php
	protected $sortable = [
        'name', 'email', 'addresses.country'
    ];

    protected $sortable_joins = [
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

Finally you can set icons in the config file, by default fontawesome icons are used, but htis can easily be changed to whatever library you want to use.

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