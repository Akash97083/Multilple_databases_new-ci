<?php

class Global_settings_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }
	
	function getGlobalData()
	{
		$sql="SELECT * FROM global_config ";
		$recordSet = $this->db->query($sql);

		$rs = false;
		if ($recordSet->num_rows() > 0)
        {
           	$rs = array();
			$isEscapeArr = array();
			foreach ($recordSet->result_array() as $row)
				{
					foreach($row as $key=>$val){
						if(!in_array($key,$isEscapeArr)){
							$recordSet->fields[$key] = outputEscapeString($val);
						}
					}
					$rs[$recordSet->fields['field_key']] = $recordSet->fields;
				}
        }
		return $rs;
	}
	
	//=========================================//
	#	Update Global Settings for the Website	#
	//=========================================//
	function updateGlobalSetting($data)

	{
		/*---------------------------- Site Information -------------------------*/
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_site_name_en'])."' WHERE field_key='global_site_name_en' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_meta_title_en'])."' WHERE field_key='global_meta_title_en' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_meta_keywords_en'])."' WHERE field_key='global_meta_keywords_en' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_meta_description_en'])."' WHERE field_key='global_meta_description_en' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_phone_number'])."' WHERE field_key='global_phone_number' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_site_email_address'])."' WHERE field_key='global_site_email_address' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_site_address'])."' WHERE field_key='global_site_address' ";
		$recordSet = $this->db->query($sql);
		/*---------------------------- Email Information -------------------------*/
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_web_admin_name'])."' WHERE field_key='global_web_admin_name' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_webadmin_email'])."' WHERE field_key='global_webadmin_email' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_email_signature'])."' WHERE field_key='global_email_signature' ";
		$recordSet = $this->db->query($sql);

		/*--------------------- Delivery Area Information--------*/
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_web_with_in'])."' WHERE field_key='global_web_with_in' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_web_longitude'])."' WHERE field_key='global_web_longitude' ";
		$recordSet = $this->db->query($sql);
		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_web_latitude'])."' WHERE field_key='global_web_latitude' ";
		$recordSet = $this->db->query($sql);

		$sql = "UPDATE global_config SET field_value = '".addslashes($data['global_web_with_in_pin'])."' WHERE field_key='global_web_with_in_pin' ";
		$recordSet = $this->db->query($sql);

		return true;
	}
	
}

?>