<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


// ------------------------------------------------------------------------

/**
  *
  * Производит вычисление угла обзора объектива в зависимости от фокусного расстояния
  *
  * @access		public
  * @focal		int фокусное расстояние
  * @matrix		string формат матрицы
  *
*/

function calculate_angle($focal, $matrix)
{
    $horizontal_coff = array(
        '1/4'       => array(154.0195274067, -0.9452426351),
        '1/3'       => array(200.9025939065, -0.90318986),
        '1/127'     => array(225.7694377298, -0.8711578259),
        '1/2'       => array(232.964719839,  -0.8620986055)
    );
    $vertical_coff = array(
        '1/4'       => array(107.3353659916, -0.969374549),
        '1/3'       => array(148.8549668699, -0.9466308635),
        '1/127'     => array(157.0007044741, -0.9403353173),
        '1/2'       => array(207.7062240906, -0.8935035234)
    );
    $result = array();

    switch ($matrix)
    {
        case '1'  :   $result['vertical_angle']                = $vertical_coff['1/4'][0] * pow($focal, $vertical_coff['1/4'][1]);
                      $result['horizontal_angle']              = $horizontal_coff['1/4'][0] * pow($focal, $horizontal_coff['1/4'][1]);
                      break;
        case '2'  :   $result['vertical_angle']                = $vertical_coff['1/3'][0] * pow($focal, $vertical_coff['1/3'][1]);
                      $result['horizontal_angle']              = $horizontal_coff['1/3'][0] * pow($focal, $horizontal_coff['1/3'][1]);
                      break;
        case '4':     $result['vertical_angle']                = $vertical_coff['1/127'][0] * pow($focal, $vertical_coff['1/127'][1]);
                      $result['horizontal_angle']              = $horizontal_coff['1/127'][0] * pow($focal, $horizontal_coff['1/127'][1]);
                      break;
        case '3'  :   $result['vertical_angle']                = $vertical_coff['1/2'][0] * pow($focal, $vertical_coff['1/2'][1]);
                      $result['horizontal_angle']              = $horizontal_coff['1/2'][0] * pow($focal, $horizontal_coff['1/2'][1]);
                      break;
    }
    return $result;
}
?>
