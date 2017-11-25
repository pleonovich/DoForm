<?php
require_once('DoInput.class.php');
require_once('DoForm.class.php');

/*
 * DoInput
 */

echo DoInput::date('test', '777', ['id'=>'12']);
echo DoInput::text('name');
echo DoInput::textarea('biography');
echo DoInput::select('gender', array('male','famale'), 'famale');
echo DoInput::selectIndexed('gender', array('1'=>'male','2'=>'famale'), '2');
echo DoInput::selectFormated('gender', array(array('1','male'),array('2','famale')), '2');
echo DoInput::checkbox('maried');
echo DoInput::_file('avatar');
echo DoInput::submit('Send');

/*
 * DoForm
 */

echo DoForm::factory()
->password('name')
->textarea('biography')
->select('gender', array('male','famale'))
->selectIndexed('gender1', array('1'=>'famale','2'=>'male'), '2')
->selectFormated('gender2', array(array('1','famale'),array('2','male')), '2')
->checkbox('maried')
->_file('avatar')
->submit('Send');