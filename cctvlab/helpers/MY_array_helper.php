<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


// ------------------------------------------------------------------------

/**
  *
  * Преобразует одномерный масив в масив для dropdown
  *
  * @access		public
  * @array		array     массив 2 уровня
  * @value		значеиние option
  * @name		имя option
  *
*/
function dropdown_elements($array,$value,$name)
{
     $return = array('');

     if($array)
     {
          foreach($array as $row)
          {
             $return[$row[$value]] = $row[$name];
          }
     }
     return $return;
}

function group_dropdown_elements($array, $value, $name)
{
    $return = array('');
    if ($array)
    {
        foreach($array as $key => $item)
            {
                $return[$key][$item[$value]] = $item[$name];
            }
    }
    unset($return[0]);
    return $return;
}


/**
  *
  * Выводит массив значений указанных ключей
  * из массива 2 уровня.
  *
  * @access		public
  * @array		array     массив 2 уровня
  * @key		string    ключ
  *
*/

function key_elements($array,$key)
{

     $ret = array();

     if($array)

          foreach ($array as $row)
                {

                    $ret[] .= isset($row[$key]) ? $row[$key] : FALSE;
                }


     return $ret;
}

/**
  *
  * Преобразует массива 2 уровня
  * в ассоциативный массив 2 уровня где ключ каждого элемента (массива)
  * принимает значение указанного ключа из этого елемента.
  *
  * @access		public
  * @array		array     массив 2 уровня
  * @key		string    ключ
  *
*/

function associative($array,$key,$key2 = FALSE)
{

     $ret[0] = '-';

     if($array)

          foreach ($array as $row)
          {

             $ret[$row[$key]] = $key2 ? $row[$key2] : $row;

          }

     return $ret;
}

/* End of file MY_array_helper.php */
/* Location: ./application/helper/MY_array_helper.php */