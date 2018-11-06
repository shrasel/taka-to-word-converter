## Taka To Words Conversion

### Usage

#### Install Through Composer
```
composer require shrasel/taka-to-word-converter dev-master
```
or add this to `composer.json`
```
"shrasel/taka-to-word-converter": "dev-master"
```
then run `composer update`

### Examples
#### Taka To Words

```
require_once __DIR__.'/vendor/autoload.php';

$obj = new \TakaToWordConverter\WordConverter();
```
```
$obj->convert(3104007200); 
// Three Hundred Ten Crore Forty Lac Seven Thousand Two Hundred Taka
```
```
$obj->convert(103.32);
// One Hundred Three Taka And Thirty Two Poisa
```
```
// If you want to remove the word taka 
$obj->convert(409, null);
// Four Hundred Nine
```
```
// Do you want to add suffix?

$obj->setSuffix('only');
$obj->convert(409);
// Four Hundred Nine Taka Only
```