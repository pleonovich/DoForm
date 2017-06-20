# DoForm
Simple way to render html forms

## Example:
```php
$form = DoForm::factory()
->addText('name')
->addTextarea('biography')
->addSelect('gender', array('male','famale'))
->addSelectIndexed('gender1', array('1'=>'famale','2'=>'male'), '2')
->addSelectFormated('gender2', array(array('1','famale'),array('2','male')), '2')
->addCheckbox('maried')
->addFile('avatar')
->addSubmit('Send')
->toArray();
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
