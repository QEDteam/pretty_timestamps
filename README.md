# QED Pretty Timestamps

## Install

```bash
composer require qedteam/pretty_timestamps
```

## Usage

Use trait in model and set up format and timezone

```php
    use PrettyTimestamps\PrettyTimestamps;

    class ModelName extends Model {
        
        use PrettyTimestamps;

        // Pretty timestamp format
        protected $prettyFormat = 'd.m.Y';

        // Pretty timestamp timezone
        protected $prettyNewTimezone = 'CET';

        // Add timestamp + '_pretty' to model appended attributes
        protected $appends = ['created_at_pretty', 'updated_at_pretty'];
    }
```
Display pretty timestamp

```php
    $model = ModelName::first();
    return $model->created_at_pretty; 
```

## License

[MIT](http://vjpr.mit-license.org)
