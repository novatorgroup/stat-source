Novator Statistics Source
=================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).
Either run
```
php composer.phar require --prefer-dist novatorgroup/stat-source "*"
```
or add
```
"novatorgroup/stat-source": "*"
```
to the require section of your `composer.json` file.

Usage
-----
Configuration:
```php
'modules' => [
    ...
    'statistics' => [
        'class' => 'novatorgroup\statsource\Module',
        'sources' => [
            'orders' => TestNovatorStatSource::class,
            ...
        ],
        'username' => 'username',
        'password' => 'password',
   ]
   ...
]
```
Source data class example:
```php
class TestNovatorStatSource implements DataSourceInterface
{
    public function load(?string $start = null, ?string $end = null): array
    {
        //test data
        return [
            [
                'sid' => 123,
                'date' => '2018-01-01',
                'value' => 10
            ],
            [
                'sid' => 123,
                'date' => '2018-01-03',
                'value' => 8
            ]
        ];
    }
}
```

Request example:
```php
/statistics/load/index?type=orders&start=2018-01-01&end=2018-01-31
```