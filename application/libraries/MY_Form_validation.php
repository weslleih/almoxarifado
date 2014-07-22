<?php
class MY_Form_validation extends CI_Form_validation
{
     function __construct($config = array())
     {
        parent::__construct($config);
        $this->set_message("is_unique_edit", "%s já está cadastrado no sistema");
     }

    /**
     * Error Array
     *
     * Returns the error messages as an array
     *
     * @return  array
     */
    function error_array()
    {
        if (count($this->_error_array) === 0)
        {
                return FALSE;
        }
        else
            return $this->_error_array;

    }

    /**
	 * Match two fields to anothers
	 *
	 * @access	public
	 * @param	string
	 * @param	fields
	 * @return	bool
	 */
    public function is_unique_edit($f_value,$fields){

        list($f_field, $s_field)=explode(',', $fields);
        list($table, $f_field)=explode('.', $f_field);
        list($s_field, $s_value)=explode('.', $s_field);
        $query = $this->CI->db->limit(1)->get_where($table, array($f_field => $f_value, "$s_field <>" => $s_value));

		return $query->num_rows() === 0;
	}
}
?>
