# DoForm
Simple way to render html forms

## Some examples
### addText
```php
// Description:
DoForm addText ( string $name [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->addText('name');
// Result:
// <input type='text' id='name' name='name'  value='' >
```
### addTextarea
```php
// Description:
DoForm addText ( string $name [, string $value = null [, $cols = 50 [, $rows = 3 [, $extra = null ]]]] )

// Example:
echo DoForm::factory()->addTextarea('biography');
// Result:
// <textarea id='biography' name='biography' cols='50' rows='3'  ></textarea>

```
### addSelect
```php
// Description:
DoForm addSelect ( string $name, array $options [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->addSelect('gender', array('male','famale'));
// Result:
// <select name='gender' id='select_gender' size='1'  >
// <option  value='male'  >male</option>
// <option  value='famale'  >famale</option>
// </select>
```
### addSelectIndexed
```php
// Description:
DoForm addSelectIndexed ( string $name, array $options [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->addSelectIndexed('gender1', array('1'=>'famale','2'=>'male'), '2');
// Result:
// <select name='gender1' id='select_gender1' size='1'  >
// <option  value='1'  >famale</option>
// <option  value='2' selected >male</option>
// </select>
```
### addSelectIndexed
```php
// Description:
DoForm addSelectFormated ( string $name, array $options [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->addSelectFormated('gender2', array(array('1','famale'),array('2','male')), '2');
// Result:
// <select name='gender2' id='select_gender2' size='1'  >
// <option  value='1'  >famale</option>
// <option  value='2' selected >male</option>
// </select>
```
### addCheckbox
```php
// Description:
DoForm addCheckbox ( string $name [, string $value = null [, string $extra = null ]] )

// Example:
echo DoForm::factory()->addCheckbox('maried');
// Result:
// <input type='checkbox' id='maried' name='maried'   />
```
### addFile
```php
// Description:
DoForm addFile ( [ string $name = "file" [, $multiple = true [, $extra = null ]]] )

// Example:
echo DoForm::factory()->addFile('avatar');
// Result:
// <input type='file' name='avatar[]' multiple='true' >
```
### addFile
```php
// Description:
DoForm addFile ( [ string $name = "file" [, $multiple = true [, $extra = null ]]] )

// Example:
echo DoForm::factory()->addFile('avatar');
// Result:
// <input type='file' name='avatar[]' multiple='true' >
```
### addSubmit
```php
// Description:
DoForm addSubmit ( string $name [, $extra = null ] )

// Example:
echo DoForm::factory()->addSubmit('Send');
// Result:
// <input type='submit' name='Send'  >
```
### Creating form
```php
$form = DoForm::factory()
->addText('name')
->addTextarea('biography')
->addSelect('gender', array('male','famale'))
->addSelectIndexed('gender1', array('1'=>'famale','2'=>'male'), '2')
->addSelectFormated('gender2', array(array('1','famale'),array('2','male')), '2')
->addCheckbox('maried')
->addFile('avatar')
->addSubmit('Send');
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
