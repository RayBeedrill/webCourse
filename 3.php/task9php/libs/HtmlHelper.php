<?php

class HtmlHelper
{
	public static function radioButtonsCreate($arr)
    {
        $name = $arr['name'];
        $value = $arr['value'];
        $id = $arr['id'];
        $inline = $arr['inline'] ;
        $text = $arr['text'];
        $checked = $arr['checked'];

        if(is_bool($inline) && true === $inline)
        {
            $inline = 'class="radio-inline"'; 
        }
        else
        {
            $inline = '';
        }
       
        if(is_bool($checked) && true === $checked)
        {
            $checked = 'checked'; 
        }
        else
        {
            $checked = '';
        }    

        if(is_string($name))
        {
            $name = 'name="' . $name . '"'; 
        }
        else
        {
            $name = '';
        }
        
        if(is_string($id))
        {
            $id = 'id="' . $id . '"'; 
        }
        else
        {
            $id = '';
        }
        
        if(is_string($value))
        {
            $value = 'value="' . $value . '"'; 
        }
        else
        {
            $value = '';
        }
        
        if(!is_string($text))
        {
            $text = '';
        }

        $input .= '<label ' . $inline  . '>' ;
        $input .=   '<input type="radio" ' . $name . $id . $value . $checked  . '>' . $text;
        $input .= '</label>';
        return $input;
    }
	
	public static function checkBoxCreate($arr)
    {
        $name = $arr['name'];
        $value = $arr['value'];
        $id = $arr['id'];
        $inline = $arr['inline'] ;
        $text = $arr['text'];
        $checked = $arr['checked'];

        if(is_bool($inline) && true === $inline)
        {
            $inline = 'class="checkbox-inline"'; 
        }
        else
        {
            $inline = 'class="checkbox"';
        }
       
        if(is_bool($checked) && true === $checked)
        {
            $checked = 'checked'; 
        }
        else
        {
            $checked = '';
        }    

        if(is_string($name))
        {
            $name = 'name="' . $name . '"'; 
        }
        else
        {
            $name = '';
        }
        
        if(is_string($id))
        {
            $id = 'id="' . $id . '"'; 
        }
        else
        {
            $id = '';
        }
        
        if(is_string($value))
        {
            $value = 'value="' . $value . '"'; 
        }
        else
        {
            $value = '';
        }
        
        if(!is_string($text))
        {
            $text = '';
        }

        $input .= '<div ' . $inline  . '>' ;
        $input .= '<label>' ;
        $input .=   '<input type="checkbox" ' . $name . $id . $value . $checked  . '>' . $text;
        $input .= '</label>';
        $input .= '</div>';
        return $input;
    }
    
    public static function listCreate($arrSettings,$arrValues)
    {
        $ordered = $arrSettings['ordered'];
        $inline = $arrSettings['inline'];
        $class = $arrSettings['class'];

        $classes = '';

        if(is_bool($inline) && true === $inline)
        {
            $classes .= " list-inline ";
        }
        else
        {
            $classes .= '';
        }

        if(is_string($class))
        {
            $classes .= $class;
        }
        else
        {
            $classes .= '';
        }

        if(is_bool($ordered) && true === $ordered)
        {
            $list .= '<ol class="' . $classes  .'">';
                foreach($arrValues as $value)
                {
                    $list .= '<li>' . $value . '</li>';
                }
            
            $list .= '</ol>';
            return $list;
        }
        else
        {
            $list .= '<ul class="' . $classes  .'">';
                foreach($arrValues as $value)
                {
                    $list .= '<li>' . $value . '</li>';
                }
            
            $list .= '</ul>';
            return $list;
        }
    }
    
    public static function descriptionCreate($arrSettings,$arrValues)
    {
        $horizontal = $arrSettings['horizontal'];
        $class = $arrSettings['class'];

        $classes = '';

        if(is_string($class))
        {
            $classes .= $class;
        }

        if(is_bool($horizontal) && true === $horizontal)
        {
           $classes .= " dl-horizontal  ";
        }
        
             $list .= '<dl class="' . $classes  .'">';
                foreach($arrValues as $key => $value)
                {
                    $list .= '<dt>' . $key . '</dt>';
                    $list .= '<dd>' . $value . '</dd>';
                }
            
            $list .= '</dl>';
            return $list;
    }
    
    public static function selectCreate($arrSettings,$arrValues)
    {
        $multiple = $arrSettings['multiple'];
        $class = $arrSettings['class'];

        $classes = 'form-control ';

        if(is_string($class))
        {
            $classes .= $class;
        }

        if(is_bool($multiple) && true === $multiple)
        {
           $multiple = ' multiple ';
        }
        else
        {
           $multiple = ''; 
        } 
             $list .= '<select' . $multiple . ' class="' . $classes  .'">';
                foreach($arrValues as  $value)
                {
                    $list .= '<option>' . $value . '</option>';
                }
            
            $list .= '</select>';
            return $list;
    }	
	
	public static function tableCreate($arrSettings,$arrValues)
    {
        $bordered = $arrSettings['bordered'];
        $class = $arrSettings['class'];
		$align = $arrSettings['align'];
		
        $classes = ' ';

        if(is_string($class))
        {
            $classes .= $class;
        }
		
		if(is_string($align))
        {
            $align = ' align="' . $align . '" ';
        }
		else
		{
			$align = '';
		}

        if(is_bool($bordered) && true === $bordered)
        {
           $classes .= " table ";
        }
			$rows = count($arrValues);
			$cols = count($arrValues[0]);
			
            $table .= '<table' . $align .  ' class="' . $classes  .'">';
                for($i = 0; $i < $rows; $i++)
				{
					$table .= '<tr>';
					for($j =0; $j < $cols; $j++)
					{
						$table .= '<td>' . $arrValues[$i][$j] . '</td>';
					}
					$table .= "</tr>";
				}
            $table .= '</table>';
            return $table;
    }
}
