<?php
namespace DoForm;

use DoForm\DoInput as DoInput;

/**
 * DO FORM CLASS
 * =============
 * Simple way to render html forms
 * 
 * @author leonovich.pavel@gmail.com
 * @version 1.0.0
 *
 * Example:
 *
 * $form = DoForm::factory()
 * ->text('name')
 * ->textarea('biography')
 * ->select('gender', array('male','famale'))
 * ->selectIndexed('gender1', array('1'=>'famale','2'=>'male'), '2')
 * ->selectFormated('gender2', array(array('1','famale'),array('2','male')), '2')
 * ->checkbox('maried')
 * ->_file('avatar')
 * ->submit('Send')
 * ->toArray();
 *
 */

class DoForm
{
    
    private $Form = array();
    
    function __construct()
    {
    }
    
    /**
     * Input type text
     *
     * @param string $name - input title
     * @param string $value - default value
     * @param string $params - params
     * @return SimpleForm - this object
     */
    public function text($name, $value = null, $params=array())
    {
        $this->Form[$name] = DoInput::text($name, $value, $params);
        return $this;
    }

    /**
     * Input
     *
     * @param string $name
     * @param string $arguments
     * @return html input
     */
    public function __call ( $name, $arguments ) {        
        $this->Form[$name] = DoInput::__callStatic($name, $arguments);
        return $this;
    }
    
    /**
     * Textarea
     *
     * @param string $name - input title
     * @param string $value - default value
     * @param int $cols - cols value
     * @param int $rows - rows value
     * @param string $params - params
     * @return SimpleForm - this object
     */
    public function textarea($name, $value = null, $cols = 50, $rows = 3, $params=array())
    {
        $this->Form[$name] = DoInput::textarea($name, $value, $cols, $rows, $params);
        return $this;
    }
    
    /**
     * Select with simple arrays
     *
     * @param string $name - input title
     * @param array $options - select options array, like - array('male','famale')
     * @param string $value - checked value
     * @param string $params - anything you need to put into input tag
     * @return SimpleForm - this object
     */
    public function select($name, array $options, $value = null, $params=array())
    {
        $this->Form[$name] = DoInput::select($name, $options, $value, $params);
        return $this;
    }
    
    /**
     * Select with formated arrays
     *
     * @param string $name - input title
     * @param array $options - select options formated array, like - array(array('1','famale'),array('2','male'))
     * @param boolean $value - checked value
     * @param string $params - params
     * @return SimpleForm - this object
     */
    public function selectFormated($name, array $options, $value = null, $params=array())
    {
        $this->Form[$name] = DoInput::selectFormated($name, $options, $value, $params);
        return $this;
    }
    
    /**
     * Select with indexed arrays
     *
     * @param string $name - input title
     * @param array $options - select options indexed array, like - array('1'=>'famale','2'=>'male')
     * @param string $selected - selected value
     * @param string $params - params
     * @return SimpleForm - this object
     */
    public function selectIndexed($name, array $options, $value = null, $params=array())
    {
        $this->Form[$name] = DoInput::selectIndexed($name, $options, $value, $params);
        return $this;
    }
    
    /**
     * Input type checkbox
     *
     * @param string $name - input title
     * @param string $value - checked value
     * @param string $params - params
     * @return SimpleForm - this object
     */
    public function checkbox($name, $value = null, $params=array())
    {
        $this->Form[$name] = DoInput::checkbox($name, $value, $params);
        return $this;
    }
    
    /**
     * Input type file
     *
     * @param string $name - input title
     * @param boolean $multiple - multiple input or not
     * @param string $params - params
     * @return SimpleForm - this object
     */
    public function _file($name = "file", $multiple = true, $params=array())
    {
        $this->Form[$name] = DoInput::_file($name, $multiple, $params);
        return $this;
    }
    
    /**
     * Input type submit
     *
     * @param string $name - input title
     * @param string $params - params
     * @return SimpleForm - this object
     */
    public function submit($name, $params=array())
    {
        $this->Form['submit'] = DoInput::submit($name, $params);
        return $this;
    }

    /**
     * Get form element by name
     */
    public function __get ($name) {
        if(isset($this->Form[$name])) return $this->Form[$name];
        else return null;
    }

    /**
     * Render form to string
     */
    public function __toString()
    {
        return implode("\n", $this->Form);
    }
    
    /**
     * Render form to array
     */
    public function toArray()
    {
        return $this->Form;
    }
    
    public static function factory()
    {
        return new DoForm ();
    }
}