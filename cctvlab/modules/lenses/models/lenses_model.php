<?php defined('BASEPATH') OR exit('No direct script access allowed');

class lenses_model extends CI_Model {

        function __construct()
        {
            parent::__construct();
        }

        function add_element($data)
        {
            $this->db->select_max('lenses_node');
            $query = $this->db->get('lenses');
            $result = $query->row_array();
            $this->db->set('lenses_node',$result['lenses_node'] + 1);
            $this->db->insert('lenses',$data);
        }

        function get_lens($name, $value)
        {
            $this->db->where($name, $value);
            $query = $this->db->get('lenses');
            $result = $query->row_array();
            if (!empty ($result))
                return $result;
            else
                return FALSE;
        }

        function delete_new_flag()
        {
            $this->db->where('lenses_new', 1);
            $this->db->set('lenses_new', 0);
            $this->db->update('lenses');
        }

        function get_test_group($group_id)
        {
            $this->db->where('group_id', $group_id);
            $query = $this->db->get('tests_group');
            $result = $query->row_array();
            return $result;
        }

        function delete_group_test($group_id)
        {
            $this->db->delete('lenses_testing', array('lenses_group_id' => $group_id));
            //$this->db->delete('tests_group', array('group_id' => $group_id));
        }
        function add_test_group($data)
        {
            $this->db->insert('tests_group', $data);
        }
        function get_test($lenses_code, $group_id)
        {
            $this->db->where('lenses_code', $lenses_code);
            $this->db->where('lenses_group_id', $group_id);
            $query = $this->db->get('lenses_testing');
            $result = $query->row_array();
            if (!empty ($result))
                return TRUE;
            else
                return FALSE;
        }

        function delete_test($lenses_code)
        {
            $this->db->delete('lenses_testing', array('lenses_code' => $lenses_code));
        }

        function get_elements($sort = '')
        {
            $this->db->order_by('lenses_node');
            $query = $this->db->get('lenses');
            return $query->result_array();
        }
        function set_order_by($sort)
        {
            if (!empty($sort))
                $this->db->order_by($sort['field_name'], $sort['direction']);
            return $this;
        }
        function get_elements_search($data)
        {
            $this->db->select('lenses.*,lenses_parameters.*,lenses.lenses_code');
            $this->db->order_by('lenses_node');
            $this->db->join('lenses_parameters','lenses_parameters.lenses_code = lenses.lenses_code','LEFT');
            if($data)
            {
                foreach($data as $name=>$value)
                {
                    switch ($name)
                    {

                        case "focal_min_val":
                            if($value == '0')
                                continue;
                            $this->db->where('lenses_parameters.lenses_parameters_focal_min >=',$value);
                            break;
                        case "focal_max_val":
                            if($value == '200')
                                continue;
                            $this->db->where('lenses_parameters.lenses_parameters_focal_max <=',$value);
                            break;
                        case "lenses_brands":
                            if ($value == '0')
                                continue;
                            $this->db->where('lenses.lenses_brand', $value);
                            break;
                        case "lenses_parameters_focal":
                            if ($value == '0')
                                continue;
                            $this->db->where('lenses_parameters.lenses_parameters_focal', $value);
                            break;
                    }

                }

            }
            $query = $this->db->get('lenses');
            return $query->result_array();
        }

        function get_element($id)
	{
            $this->db->select('lenses.*,lenses_parameters.*,lenses.lenses_code');
            $this->db->join('lenses_parameters','lenses_parameters.lenses_code = lenses.lenses_code','LEFT');
            $this->db->where('lenses_id',$id);
            $query = $this->db->get('lenses');
            return $query->row_array();
	}
        function get_element_by_code($lenses_code)
	{
            $this->db->select('lenses.*,lenses_parameters.*,lenses.lenses_code');
            $this->db->join('lenses_parameters','lenses_parameters.lenses_code = lenses.lenses_code','LEFT');
            $this->db->where('lenses.lenses_code',$lenses_code);
            $query = $this->db->get('lenses');
            return $query->row_array();
	}

	function update_element($data,$id, $lenses_code='', $type='lens')
	{
            switch ($type)
            {
                case "lens":
                    $this->db->where('lenses_id',$id);
                    $this->db->update('lenses',$data);
                    break;
                case "testing":
                    $this->db->where('testing_id',$id);
                    $this->db->where('lenses_code', $lenses_code );
                    $this->db->update('lenses_testing',$data);
            }
	}
        function update_parameters($data, $lenses_code)
        {
            $this->db->where('lenses_code', $lenses_code );
            $this->db->update('lenses_parameters',$data);
        }
        function insert_parameters($data, $lenses_code)
        {
            $this->db->insert('lenses_parameters',$data);
        }
        function update_element_parameters($data,$id)
	{

            $result = $this->get_element($id);

            $sql = 'INSERT INTO '.$this->db->dbprefix('lenses_parameters').' (
                                            lenses_code,
                                            lenses_parameters_focal,
                                            lenses_parameters_focal_min,
                                            lenses_parameters_focal_max,
                                            lenses_parameters_aperture,
                                            lenses_parameters_aperture_min,
                                            lenses_parameters_aperture_max,
                                            lenses_parameters_mount,
                                            lenses_parameters_angle_vertical_min,
                                            lenses_parameters_angle_vertical_max,
                                            lenses_parameters_angle_horizontal_min,
                                            lenses_parameters_angle_horizontal_max,
                                            lenses_parameters_matrix,
                                            lenses_parameters_weight,
                                            lenses_parameters_dimension,
                                            lenses_parameters_correction)

                                   VALUES (
                                            "'.$result['lenses_code'].'",
                                            "'.$data['lenses_parameters_focal'].'",
                                            "'.$data['lenses_parameters_focal_min'].'",
                                            "'.$data['lenses_parameters_focal_max'].'",
                                            "'.$data['lenses_parameters_aperture'].'",
                                            "'.$data['lenses_parameters_aperture_min'].'",
                                            "'.$data['lenses_parameters_aperture_max'].'",
                                            "'.$data['lenses_parameters_mount'].'",
                                            "'.$data['lenses_parameters_angle_vertical_min'].'",
                                            "'.$data['lenses_parameters_angle_vertical_max'].'",
                                            "'.$data['lenses_parameters_angle_horizontal_min'].'",
                                            "'.$data['lenses_parameters_angle_horizontal_max'].'",
                                            "'.$data['lenses_parameters_matrix'].'",
                                            "'.$data['lenses_parameters_weight'].'",
                                            "'.$data['lenses_parameters_dimension'].'",
                                            "'.$data['lenses_parameters_correction'].'")

                                   ON DUPLICATE KEY UPDATE
                                            lenses_parameters_focal = "'.$data['lenses_parameters_focal'].'",
                                            lenses_parameters_focal_min = "'.$data['lenses_parameters_focal_min'].'",
                                            lenses_parameters_focal_max = "'.$data['lenses_parameters_focal_max'].'",
                                            lenses_parameters_aperture = "'.$data['lenses_parameters_aperture'].'",
                                            lenses_parameters_aperture_min = "'.$data['lenses_parameters_aperture_min'].'",
                                            lenses_parameters_aperture_max = "'.$data['lenses_parameters_aperture_max'].'",
                                            lenses_parameters_mount = "'.$data['lenses_parameters_mount'].'",
                                            lenses_parameters_angle_vertical_min = "'.$data['lenses_parameters_angle_vertical_min'].'",
                                            lenses_parameters_angle_vertical_max = "'.$data['lenses_parameters_angle_vertical_max'].'",
                                            lenses_parameters_angle_horizontal_min = "'.$data['lenses_parameters_angle_horizontal_min'].'",
                                            lenses_parameters_angle_horizontal_max = "'.$data['lenses_parameters_angle_horizontal_max'].'",
                                            lenses_parameters_matrix = "'.$data['lenses_parameters_matrix'].'",
                                            lenses_parameters_weight = "'.$data['lenses_parameters_weight'].'",
                                            lenses_parameters_dimension = "'.$data['lenses_parameters_dimension'].'",
                                            lenses_parameters_correction = "'.$data['lenses_parameters_correction'].'"';

             $this->db->query($sql);
	}

        function delete_element($id)
	{
		$this->db->where('lenses_id',$id);
		$query = $this->db->get('lenses');
		if(!$query) { return FALSE; }
		$result = $query->row_array();
		$this->db->delete('lenses',array('lenses_id' => $id));
                $this->delete_test($result['lenses_code']);
                $this->db->delete('lenses_parameters', array('lenses_code' => $result['lenses_code']));
		$this->db->where('lenses_node >',$result['lenses_node']);
               	$this->db->set('lenses_node', 'lenses_node-1',FALSE);
		$this->db->update('lenses');
		return TRUE;
	}

	function up_element($id)
	{
		$this->db->where('lenses_id',$id);
		$query = $this->db->get('lenses');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();

		$this->db->select_max('lenses_node');
		$query = $this->db->get('lenses');
		$maxord = $query->row_array();

		if ($ford['lenses_node'] == 1)
		{
			$this->db->set('lenses_node', 'lenses_node-1',FALSE);
			$this->db->update('lenses');
			$this->db->where('lenses_id',$id);
			$this->db->set('lenses_node',$maxord['lenses_node']);
			$this->db->update('lenses');
		}
		else
		{
			$this->db->where('lenses_node',$ford['lenses_node']-1);
			$this->db->set('lenses_node',$ford['lenses_node']);
			$this->db->update('lenses');
			$this->db->where('lenses_id',$id);
			$this->db->set('lenses_node',$ford['lenses_node']-1);
			$this->db->update('lenses');
		}
	  }
	}

	function down_element($id)
	{
		$this->db->where('lenses_id', $id);
		$query = $this->db->get('lenses');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();

		$this->db->select_max('lenses_node');
		$query = $this->db->get('lenses');
		$maxord = $query->row_array();

		if ($ford['lenses_node'] == $maxord['lenses_node'])
		{
                        $this->db->set('lenses_node', 'lenses_node+1',FALSE);
			$this->db->update('lenses');
			$this->db->where('lenses_id',$id);
			$this->db->set('lenses_node', 1);
			$this->db->update('lenses');
		}
		else
		{
                        $this->db->where('lenses_node', $ford['lenses_node']+1);
			$this->db->set('lenses_node', $ford['lenses_node']);
			$this->db->update('lenses');
			$this->db->where('lenses_id', $id);
			$this->db->set('lenses_node', $ford['lenses_node']+1);
			$this->db->update('lenses');
		}
            }
        }

        function set_where($name,$value)
        {
            $this->db->where($name,$value == FALSE ? '' : $value);
            return $this;
        }

        function set_like($name,$value)
        {
            $this->db->like($name,$value);
            return $this;
        }

        function set_search($data)
        {

            if($data)
            {
                foreach($data as $name=>$value)
                $this->db->like($name,$value);
            }


            return $this;
        }

        function set_search_public($data)
        {

        }

        function set_limit($limit,$offset = FALSE)
        {
            $this->db->limit($limit,$offset);
            return $this;
        }

        function export($lenses_code,$testing_id = '0', $group_id)
        {
            if(!$lenses_code) return FALSE;

            $return = array();

            $this->db->distinct();
            $this->db->select('lenses_testing_value_focal as focal');
            $this->db->from('lenses_testing');
            $this->db->where('lenses_code',$lenses_code);
            $this->db->where('lenses_group_id', $group_id);
            $this->db->where('testing_id',$testing_id);
            $this->db->order_by('lenses_testing_value_focal');
            $focal = $this->db->get()->result_array();
            //print_r($focal);
            if($focal)
            {
                $f=0;
                $max_points_item = 0;
                $min_points_item = 100000000;
                $max_curvature_item = 0;
                $min_curvature_item = 100000000000;
                foreach ($focal as $row1)
                {
                    $this->db->where('lenses_code',$lenses_code);
                    $this->db->where('lenses_testing_value_focal',$row1['focal']);
                    $this->db->where('testing_id',$testing_id);
                    $this->db->order_by('lenses_testing_value_aperture');
                    $aperture = $this->db->get('lenses_testing')->result_array();
                    if($aperture)
                    {
                        $a=0;
                        foreach ($aperture as $row2)
                        {
                            $return[$a][$f]['points'] = $this->_chart_format($row2['lenses_testing_value_chart']);
                            $return[$a][$f]['curvature_points'] = $this->_chart_format_2($row2['lenses_testing_value_chart_2']);
                            $buff = array();
                            for ($i = 0; $i< count($return[$a][$f]['curvature_points']); $i++)
                            {
                                for($j = 0; $j < count($return[$a][$f]['curvature_points'][$i]); $j++)
                                {
                                    if ($j == 1)
                                        if ($return[$a][$f]['curvature_points'][$i][$j] != 0)
                                            $buff[$i][$j] = $return[$a][$f]['curvature_points'][$i][$j];
                                        else
                                            $buff[$i][$j] = $return[$a][$f]['curvature_points'][$i][$j];
                                    else
                                        $buff[$i][$j] = -$return[$a][$f]['curvature_points'][$i][$j];
                                }
                            }
                            $return[$a][$f]['curvature_points'] = array_merge_recursive($return[$a][$f]['curvature_points'], $buff);
                            $return[$a][$f]['aperture'] = $row2['lenses_testing_value_aperture'];
                            $return[$a][$f]['focal'] = $row2['lenses_testing_value_focal'];

                            foreach($return[$a][$f]['points'] as $point)
                            {
                                if ($max_points_item < $point[1])
                                    $max_points_item = $point[1];
                                if ($min_points_item > $point[1])
                                    $min_points_item = $point[1];
                            }
                            unset($point);
                            foreach($return[$a][$f]['curvature_points'] as $point)
                            {
                                if ($point[1] == '998973.846')                  //TODO: КОСТЫЛЬ, ИСПРАВИТЬ!!!
                                    break;
//                                    echo $point[1]."\n";
                                if ($max_curvature_item < $point[1])
                                    $max_curvature_item = $point[1];
                                if ($min_curvature_item > $point[1])
                                    $min_curvature_item = $point[1];
                                //echo $max_curvature_item."\n";
                            }
                            $a++;
                        }
                    }
                    $f++;
                }
                //echo $max_curvature_item;
                $scale['points_max'] = $max_points_item;
                $scale['points_min'] = $min_points_item;
                $scale['curvature_max'] = $max_curvature_item;
                $scale['curvature_min'] = $min_curvature_item;
            }
            return array($return, $scale);

        }
        function number_of_test($lenses_code)
        {
            $this->db->distinct();
            $this->db->select('testing_id');
            $this->db->from('lenses_testing');
            $this->db->where('lenses_code', $lenses_code);
            $query = $this->db->get();
            return $query->result_array();
        }
        function get_groups($lenses_code)
        {
            $this->db->distinct();
            $this->db->select('lenses_group_id');
            $this->db->from('lenses_testing');
            $this->db->where('lenses_code', $lenses_code);
            $query = $this->db->get();
            return $query->result_array();
        }

        function get_tests($lenses_code, $group)
        {
            $this->db->select('testing_id');
            $this->db->from('lenses_testing');
            $this->db->where('lenses_group_id', $group);
            $this->db->where('lenses_code', $lenses_code);
            $query = $this->db->get();
            return $query->row_array();

        }
        function import($insert_data, $type = 'lens')
        {
            switch($type)
            {
                case "lens":
                    if (!empty($insert_data))
                    {
                        $this->db->select_max('lenses_node');
                        $query = $this->db->get('lenses');
                        $result = $query->row_array();
                        $this->db->set('lenses_node',$result['lenses_node'] + 1);
                        $this->db->insert('lenses',$insert_data);
                        return $this->db->insert_id();
                    }else
                        return FALSE;
                break;
                case "testing":
                    if (!empty($insert_data))
                    {
                        $this->db->insert('lenses_testing', $insert_data);
                        return TRUE;
                    }else
                        return FALSE;
            }
        }

        function _chart_format($data)
        {
            $scale = 1;

            $data = json_decode($data);
            $i=0;
            $multi = 100 / count($data);
            if($data)
            {
                foreach($data as $key=>$val)
                {
                    $return[$i] = array($key*$multi,$val*$scale);
                    $i++;
                }
            }

            return $return;
        }
        function _chart_format_2($data)
        {
            $scale = 1;


            $data = json_decode($data);
            $i=0;
            $multi = 100 / count($data);
            if($data)
            {
                $data = array_reverse($data);
                foreach($data as $key=>$val)
                {
                    $return[$i] = array($key*$multi,$val*$scale);
                    $i++;
                }
            }
            return $return;
        }
}

/* End of file lenses_model.php */
/* Location: ./application/modules/lenses/models/lenses_model.php */