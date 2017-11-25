# DoForm
Simple way to render html forms

## Some examples
### text
```php
// Description:
DoForm text ( string $name [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->text('name');
// Result:
// <input type='text' id='name' name='name'  value='' >
```
### textarea
```php
// Description:
DoForm text ( string $name [, string $value = null [, $cols = 50 [, $rows = 3 [, $extra = null ]]]] )

// Example:
echo DoForm::factory()->textarea('biography');
// Result:
// <textarea id='biography' name='biography' cols='50' rows='3'  ></textarea>

```
### select
```php
// Description:
DoForm select ( string $name, array $options [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->select('gender', array('male','famale'));
// Result:
// <select name='gender' id='select_gender' size='1'  >
// <option  value='male'  >male</option>
// <option  value='famale'  >famale</option>
// </select>
```
### selectIndexed
```php
// Description:
DoForm selectIndexed ( string $name, array $options [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->selectIndexed('gender1', array('1'=>'famale','2'=>'male'), '2');
// Result:
// <select name='gender1' id='select_gender1' size='1'  >
// <option  value='1'  >famale</option>
// <option  value='2' selected >male</option>
// </select>
```
### selectIndexed
```php
// Description:
DoForm selectFormated ( string $name, array $options [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->selectFormated('gender2', array(array('1','famale'),array('2','male')), '2');
// Result:
// <select name='gender2' id='select_gender2' size='1'  >
// <option  value='1'  >famale</option>
// <option  value='2' selected >male</option>
// </select>
```
### checkbox
```php
// Description:
DoForm checkbox ( string $name [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->checkbox('maried');
// Result:
// <input type='checkbox' id='maried' name='maried'   />
```
### _file
```php
// Description:
DoForm _file ( [ string $name = "file" [, $multiple = true [, $extra = null ]]] )

// Example:
echo DoForm::factory()->_file('avatar');
// Result:
// <input type='file' name='avatar[]' multiple='true' >
```
### submit
```php
// Description:
DoForm submit ( string $name [, $extra = null ] )

// Example:
echo DoForm::factory()->submit('Send');
// Result:
// <input type='submit' name='Send'  >
```
### Creating form
```php
$form = DoForm::factory()
->text('name')
->textarea('biography')
->select('gender', array('male','famale'))
->selectIndexed('gender1', array('1'=>'famale','2'=>'male'), '2')
->selectFormated('gender2', array(array('1','famale'),array('2','male')), '2')
->checkbox('maried')
->_file('avatar')
->submit('Send');
```

# DoInput
Simple way to render html form inputs

## Example:
```php
$input = DoInput::text('name');
$input.= DoInput::textarea('biography');
$input.= DoInput::select('gender', array('male','famale'), 'famale');
$input.= DoInput::selectIndexed('gender', array('1'=>'famale','2'=>'male'), '2');
$input.= DoInput::selectFormated('gender', array(array('1','famale'),array('2','male')), '2');
$input.= DoInput::checkbox('maried');
$input.= DoInput::_file('avatar');
$input.= DoInput::submit('Send');
```
