<?php

function date_calendar($date,$output = 'mysql')
{       
       if($date AND $date>0)
       {
            if($output == 'calendar')
            {
                $return = date("m/d/Y",$date);
            }

            if($output == 'mysql')
            {
                $date = explode("/",$date);
                $return = $date[2].'/'.$date[0].'/'.$date[1];
            }

            return $return; 
       }	
}

?>
