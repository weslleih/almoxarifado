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
    public function is_unique_edit($form_value,$args){

        list($pk_value, $table, $column, $pk_ident)=explode(',', $args);
        //Is there any record where table.column equals form_value that isn't the one we're editing?
        $query = $this->CI->db->limit(1)->get_where($table, array($column => $form_value, "$pk_ident <>" => $pk_value));

		return $query->num_rows() === 0;
	}
}
?>
