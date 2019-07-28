<?php
namespace DoForm;

/**
 * DO INPUT CLASS
 * ==============
 * Simple way to render html form inputs
 * 
 * @author leonovich.pavel@gmail.com
 * @version 1.1.0 
 *
 * Some examples:
 *
 * $input = DoInput::text('name');
 * $input = DoInput::textarea('biography');
 * $input = DoInput::select('gender', array('male','famale'), 'famale');
 * $input = DoInput::selectIndexed('gender', array('1'=>'famale','2'=>'male'), '2');
 * $input = DoInput::selectFormated('gender', array(array('1','famale'),array('2','male')), '2');
 * $input = DoInput::checkbox('maried');
 * $input = DoInput::_file('avatar');
 * $input = DoInput::submit('Send');
 *
 */

class DoInput
{
    
    public static $charset = 'UTF-8';
    private static $params = array(
        'id', 'name', 'value', 'type', 'cols', 'rows', 'size', 'checked', 'selected', 'multiple'
    );
    private static $types = array(
        'text', 'hidden', 'password', 'checkbox', 'file', 'submit',
        'color', 'date', 'datetime', 'datetime-local', 'email',
        'number', 'range', 'search', 'tel', 'time', 'url', 'month', 'week'
    );

    /**
     * Convert special characters to HYML entities
     *
     * @param string $value - value to convert
     * @param boolean $double_encode - double encode
     * @return converted characters
     */
    private static function chars($value, $double_encode = true)
    {
        return htmlspecialchars( (string) $value, ENT_QUOTES, self::$charset, $double_encode);
    }

    private static function renderParams($params=array())
    {   
        $html = "";
        foreach($params as $k=>$v){
            if(in_array($k, self::$params)) {
                if($k==='value') {
                    $params['value'] = self::chars($params['value']);
                }
                if(strlen($v)>0) $html.= "{$k}='{$v}' ";
            }
        }
        return $html;
    }

    public static function renderDatalist($name, $datalist=array())
    {   
        $html = "";
        $params['id'] = "{$name}_list";
        $html_params = self::renderParams($params);
        if(count($datalist)>0) {
			$html.= "<datalist {$html_params}>\n";
			foreach($datalist as $v) {
                $html.= "\t<option>".$v."</option>\n";
            }
			$html.= "</datalist>\n";
		}
        return $html;
    }
    /**
     * Input
     *
     * @param string $type - input type
     * @param string $value - default value
     * @param string $params - input params
     * @return html input type text
     */
    protected static function input($type, $name, $value, $params=array())
    {
        $params['type'] = $type;
        $params['name'] = $name;
        $params['value'] = self::chars($value);
        return "<input ".self::renderParams($params)." >\n";
    }

    /**
     * Input type text
     *
     * @param string $name - input title
     * @param string $value - default value
     * @param string $extra - anything you need to put into input tag
     * @param array $datalist - input datalist
     * @return html input type text
     */
    public static function text($name, $value = null, $params=array(), $datalist=array())
    {
        $input = self::input('text', $name, $value, ['id'=>'textid']);
        $input.= self::renderDatalist($name, $datalist);
		return $input;
    }

    /**
     * Input
     *
     * @param string $name
     * @param string $arguments
     * @return html input
     */
    public static function __callStatic ( $type, $arguments ) {
        if(in_array($type, self::$types)) {
            $name = array_shift($arguments);
            $value = self::chars(array_shift($arguments));
            $params = (count($arguments)>0) ? array_shift($arguments) : array();
            return self::input($type, $name, $value, $params);
        }
    }

    /**
     * Input type checkbox
     *
     * @param string $name - input title
     * @param string $value - checked value
     * @param array $params - params
     * @return html input type chekbox
     */
    public static function checkbox($name, $value = null, $params = array())
    {
        if(in_array($value, array('1','true','on'))) {
            $params['checked'] = 'checked';
        }
        return self::input('checkbox', $name, $value, $params);
    }
    
    /**
     * Input type file
     *
     * @param string $name - input title
     * @param boolean $multiple - multiple input or not
     * @param array $params - params
     * @return html input type file
     */
    public static function _file($name="file", $multiple=true, $params=array())
    {
        if($multiple) {
            $params['multiple'] = true;
            $name = $name."[]";
        }
        return self::input('file', $name, null, $params);
    }
    
    /**
     * Input type submit
     *
     * @param string $title - submit title
     * @param array $params - params
     * @return html input type submit
     */
    public static function submit($title, $params=array())
    {
        return self::input('submit', null, $title, $params);
    }

    /**
     * Textarea
     *
     * @param string $name - input title
     * @param string $value - default value
     * @param int $cols - cols value
     * @param int $rows - rows value
     * @param array $params - params
     * @return html input type select
     */
    public static function textarea($name, $value=null, $cols=50, $rows=3, $params=array())
    {
        return "<textarea name='{$name}' cols='{$cols}' rows='{$rows}' ".self::renderParams($params)." >".self::chars($value)."</textarea>\n";
    }

    /**
     * Select with simple arrays
     *
     * @param string $name - input title
     * @param array $options - select options array, like - array('famale','male')
     * @param string $value - checked value
     * @param array $params - params
     * @param string $default - value of default option
     * @return string - html input type select
     */
    public static function renderSelect ($name, array $options, $selected=null, $params=array(), $default=null, $func)
    {   
        $params = array_merge(['name'=>$name, 'size'=>1], $params);
        $select = "<select ".self::renderParams($params).">\n";
        if ($default!=null) {
            $select .= "\t<option ".self::renderParams(['value'=>$default]).">{$default}</option>\n";
        }
        $params = array();
        foreach ($options as $k=>$one) {
            $params = $func($k, $one, $selected);
            $select .= "\t<option ".self::renderParams($params).">".$params['title']."</option>\n";
        }
        $select .= "</select>\n";
        return $select;
    }

    /**
     * Select with simple arrays
     *
     * @param string $name - input title
     * @param array $options - select options array, like - array('famale','male')
     * @param string $selected - selected value
     * @param array $params - params
     * @param string $default - value of default option
     * @return string - html input type select
     */
    public static function select ($name, array $options, $selected=null, $params=array(), $default=null)
    {   
        return self::renderSelect($name, $options, $selected, $params, $default, function($k, $v, $selected) {
            $params = array('value'=>$v, 'title'=>$v);
            if($selected==$v) $params['selected'] = 'selected';
            return $params;
        });
    }

    /**
     * Select with formated arrays
     *
     * @param string $name - input title
     * @param array $options - select options formated array, like - array(array('1','famale'),array('2','male'))
     * @param boolean $value - checked value
     * @param array $params - params
     * @param string $default - value of default option
     * @return html input type select
     */
    public static function selectFormated($name, array $options, $selected=null, $params=array(), $default=null)
    {
        return self::renderSelect($name, $options, $selected, $params, $default, function($k, $v, $selected) {
            $keys = array_keys($v);
            $params = array('value'=>$v[$keys[0]], 'title'=>$v[$keys[1]]);
            if(in_array($selected, $v)) $params['selected'] = 'selected';
            return $params;
        });
    }
    
    /**
     * Select with indexed arrays
     *
     * @param string $name - input title
     * @param array $options - select options indexed array, like - array('1'=>'famale','2'=>'male')
     * @param string $value - selected value
     * @param array $params - params
     * @param string $default - value of default option
     * @return html input type select
     */
    public static function selectIndexed($name, $options, $selected=null, $params=array(), $default=null)
    {
        return self::renderSelect($name, $options, $selected, $params, $default, function($k, $v, $selected) {            
            $params = array('value'=>$k, 'title'=>$v);
            if($k==$selected) $params['selected'] = 'selected';
            return $params;
        });
    }

}