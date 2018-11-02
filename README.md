## Taka To Words Conversion

### Usage

#### Step 1: Install Through Composer
```
composer require shrasel/taka-to-word-converter
```
or add this to `composer.json`
```
"shrasel/taka-to-word-converter": "dev"
```
then run `composer update`

### Examples
#### Taka To Words

```
require_once __DIR__.'/vendor/autoload.php'

$obj = new \TakaToWordConverter\WordConverter();
```
```
$obj->convert(3104007200); 
// Three Hundred Ten Crore Forty Lac Seven Thousand Two Hundred Taka Only
```
```
$obj->convert(103.32);
// One Hundred Three Taka And Thirty Two Poisa Only
```