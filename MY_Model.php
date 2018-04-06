<?php
/*
Name:		Core > MY_Model (CI TV)
Author:		Rebecca Follman
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
	
	public $table_name = '';
	public $primary_key = '';
	public $primaryFilter = 'intval';
	public $order_by = '';
	public $menufile = '';
  
	function __construct() {
		parent::__construct(); /*When running MY_Model, CI_Model also included*/
	}
	
	public function changeunit($uc) {
		$_SESSION['uc'] = $uc;
	}

	public function ynckcheck($d, $val) {
		if ($d[0]['V_YES'] == 1 && $val == 1) {
			return "checked='checked'";
		}
		if ($d[0]['V_DISCUSS'] == 1 && $val == 4) {
			return "checked='checked'";
		}
		if ($d[0]['V_NO'] == 1 && $val == 2) {
			return "checked='checked'";
		}
		if ($d[0]['V_ABSTAIN'] == 1 && $val == 3) {
			return "checked='checked'";
		}
		return null;
	}

	public function checkcheck($fld, $val) {
		if ($fld == $val) {
			return 'checked="checked"';
		} else {
			return null;
		}
	}

	public function datecheck($dv) {
		if (strlen($dv)) {
			return date('d-M-y', strtotime($dv));
		} else {
			return null;
		}
	}
	
	public function isauthentic ($logout = false)
	{
	    require_once(APPPATH.'libraries/CAS.php');   //  Change the path of the CAS.php to reflect where exactly it is located.
	
	    if(isset($_SESSION)) {
	        phpCAS::client(CAS_VERSION_2_0, 'login.umd.edu', 443, 'cas',false); //use existing session
	    } else {
	        phpCAS::client(CAS_VERSION_2_0, 'login.umd.edu', 443, 'cas'); //let phpCAS manage the session
	    }
	    phpCAS::setNoCasServerValidation();
	    if (!isset($_SESSION['phpCAS']['user']))
	    {
		   phpCAS::forceAuthentication();
	    }
	    if (isset($_REQUEST['logout']) || $logout) {
		   phpCAS::logout();
	    }
	    
	    return $_SESSION['phpCAS']['user'];
	}

	public function headings($t, $h = false, $s = false) {
		if (!$s) {$s = $this->subheading;}
		if (!$h) {$h = $this->heading;}
		if ($this->menufile == '') {
			redirect('startup');
		}
		$data = array('title' => 'Dev: ' . $t, 'heading' => $h, 'subheading' => $s);
		$this->load->view('templates/' . $this->menufile, $data);
		if (!isset($_SESSION['phpCAS']['user'])) {
			redirect('startup/index/badu'); 
		}
		return true;
	}

	public function getldap($user) {
		$ldaprdn  = 'uid=oit-faculty-sabbatical-form,cn=auth,ou=ldap,dc=umd,dc=edu';     // ldap rdn or dn
		$ldappass = '57N4AoCwUk627rbr97x79gFj';  // associated password
		$attributes=array('mail','uid','sn','umFaculty','employeeNumber','umDisplayNameLF','givenName','umPermanentCountry','umUnitCode', 'umOfficialTitle', 'postalAddress', 'telephoneNumber');
		$ldapconn = ldap_connect("directory.umd.edu") or die("Could not connect to LDAP server.");
		if ($ldapconn) {
			$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
			if ($ldapbind) {
				if (is_numeric($user)) {
					$srchon = 'employeeNumber=';
				} else {
					$srchon = 'uid=';
				}
				$result = ldap_search($ldapconn, 'dc=umd,dc=edu', $srchon . $user, $attributes) or die ('Was not successful');
				if ($result) {
					$info = ldap_get_entries($ldapconn, $result);
				} else {
					$_SESSION['errtxt'] = 'There was a problem with the LDAP search. Please check the information you entered and try again.';
				}
			} else {
				$_SESSION['errtxt'] = 'There was a problem with the LDAP search. Please check your information and try again.';
			}
		}
		ldap_close($ldapconn);
		return $info;
	}

	function logind($tn, $ids) {
		$this->save($tn, array('LAST_LOGIN' => date('d-M-y')), array('DIRID' => $ids));
		return true;
	}

	public function makedd($vals, $trans = false) {
		if (count($vals[0]) > 1) { /*Turn into associative list*/
			$data = $this->to_assoc($vals);
		} else {
			array_unshift($vals, 'Please make a choice'); /*do it like this for simple array*/
			$data = $vals;
		}
		if ($trans) {
			return $data[$trans];
		} else {
			return $data;
		}
	}

	public function mrgArray($one, $two, $three = false, $four = false) {
		if (is_array($one)) {
			if (is_array($two)) {
				$one = array_merge($one,$two);
			} 
			if (is_array($three)) {
				$one = array_merge($one,$three);
			}
			if (is_array($four)) {
				$one = array_merge($one,$four);
			}
		} else { // no return from $cu
			if (is_array($two)) {
				if (is_array($three)) {
					$one = array_merge($two,$three);
				}
				if (is_array($four)) {
					$one = array_merge($one,$four);
				}
			} else {
				if (is_array($three)) {
					if (is_array($four)) {
						$one = array_merge($three,$four);
					}
				} else {
					$one = $four;
				}
			}
		}
		return $one;
	}

	public function showArray($a) {
		echo '<table class="table table-condensed table-hover">';
		foreach ($a as $k => $r) {
			echo '<tr><td>[' . $k . ']</td><td>' . $r . '</td></tr>';
		}
		echo '</table>';
	}

	public function sendmail($info)
	{
		$details = array('from', 'fromname', 'to', 'cc', 'subj', 'msg');
		foreach ($details as $tst) {
			if (!isset($info[$tst])) {
				$_SESSION['errtxt'] = 'Missing [' . $tst . ']: There was a problem sending an email. Please contact the system administrator.';
				return false;
			}
		}
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($info['from'], $info['fromname']);
		$this->email->to('rfollman@umd.edu','praju@umd.edu');
		/*$this->email->to($info['to']); */
		/*$this->email->cc($info['cc']); */
		$this->email->subject($info['subj']);
		$this->email->message($info['msg'] . implode(", ", $info['to']) . ' ' . $info['cc']);
		$this->email->send();
		return true;
	}

	public function sendmailesj($info) 
	{
		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		mail($info['to'], $info['sub'], $info['msg'], implode("\r\n", $headers));
		return true;
	} 

	public function showerr() {
		if (isset($_SESSION['errtxt'])/*strlen($_SESSION['errtxt']) > 0*/) {
			echo '<blockquote class="bg-danger"><h5>' . $_SESSION['errtxt'] . '</h5></blockquote>';
			unset($_SESSION['errtxt']);
		}
	}

	function raceEthGender($labelw = 3, $fieldw = 9, $raceval = false, $genderval = false, $hispval = false) {
		$checkmeMale = null;
		$checkmeFemale = null;
		$checkmehYes = null;
		$checkmehNo = null;
		if ($genderval == 'M') {
			$checkmeMale = ' checked="checked"';
			$checkmeFemale = null;
		} else if ($genderval =='F') {
			$checkmeFemale = ' checked="checked"';
			$checkmeMale = null;
		}
		if ($hispval == "Y") {
			$checkmehYes = ' checked="checked"';
			$checkmehNo = null;
		} else if ($hispval == "N") {
			$checkmehNo = ' checked="checked"';
			$checkmehYes = null;
		}
		
		echo '<div class="form-group">';
		echo '<label for="gender" class="col-sm-' . $labelw . ' control-label">Race / Ethnicity</label>';
		echo '<div class="col-sm-' . $fieldw . '">';
		echo form_dropdown('race', racelst(), $raceval, 'class="form-control" id="race"');
		echo '</div>';
		echo '<label class="radio-inline col-sm-1">';
		echo '<input type="radio" name="gender" id="male" value="M"' . $checkmeMale . '> Male';
		echo '</label>';
		echo '<label class="radio-inline col-sm-1">';
		echo '<input type="radio" name="gender" id="female" value="F"' . $checkmeFemale . '> Female';
		echo '</label>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="hispanic" class="col-sm-4 control-label">Hispanic or Latino Origin</label>';
		echo '<div class="col-sm-6">';
		echo '<label class="radio-inline">';
		echo '<input type="radio" name="hispanic" value="Y" id="yes"' . $checkmehYes . '> Yes';
		echo '</label>';
		echo '<label class="radio-inline">';
		echo '<input type="radio" name="hispanic" value="N" id="no"' . $checkmehNo . '> No';
		echo '</label>';
		echo '</div>';
		echo '</div>';
	}

	/* Data actions */

	public function buildData($type) {
		switch ($type) {
			case '1': /*APT default*/
				$data['STATUS_F'] = $this->input->post('status_f');
				$data['STATUS_V'] = $this->input->post('status_v');
				$data['CMNT_GEN'] = $this->input->post('cmnt_gen');
				$data['REVIEWER'] = $this->input->post('reviewer');
				$data['V_YES'] = $this->input->post('v_yes');
				$data['V_NO'] = $this->input->post('v_no');
				$data['V_ABSTAIN'] = $this->input->post('v_abstain');
				$data['AGENDA_DATE'] = $this->datecheck($this->input->post('agenda_date'));
				break;
			case '8': /*AEP default*/
				$data['CMNT_COL'] = $this->input->post('cmnt_col');
				$data['STATUS_F'] = $this->input->post('status_f');
				$data['STATUS'] = $this->input->post('status');
				if ($this->input->post('status_f')) {
					$data['CMNT_COL'] .= '<p>' . $this->statuslist('aepstatus_ca', $this->input->post('status_f')) . ' on ' . date('F d, Y') . ": " . $_SESSION['fname'] . " " . $_SESSION['lname'] . '</p>';
					if ($this->input->post('status_f') <= 2) {
						$data['STATUS_F'] = 2;
						$data['STATUS'] = 9;
					} elseif ($this->input->post('status_f') == 4) {
						$data['STATUS_F'] = 5;
						$data['STATUS'] = 9;						
					}
				}
				break;
			case '11': /*SRTH*/
				$data['HIRE_TYPE'] = 11;
				$data['UNIT_CODE'] = $this->input->post('unit_code');
				$data['CONTACT'] = $this->input->post('contact');
				$data['F_NAME'] = $this->input->post('f_name');
				$data['L_NAME'] = $this->input->post('l_name');
				$data['TITLE'] = $this->input->post('title');
				$data['INSTITUTION'] = $this->input->post('institution');
				$data['DEPARTMENT'] = $this->input->post('department');
				$data['RACE'] = $this->input->post('race');
				$data['GENDER'] = $this->input->post('gender');
				$data['HISPANIC'] = $this->input->post('hispanic');
				$data['AWARDS'] = $this->input->post('awards');
				$data['METRICS'] = $this->input->post('metrics');
				$data['ESTCOST'] = $this->input->post('estcost');
				$data['CITIZENSHIP'] = $this->input->post('citizenship');
				$data['REQPROV'] = $this->input->post('reqprov');
				$data['CONTDEPT'] = $this->input->post('contdept');
				$data['DIVERSE'] = $this->input->post('diverse');
				$data['STRATPRIOR'] = $this->input->post('stratprior');
				$data['CULTURE'] = $this->input->post('culture');
				$data['CONTRIB'] = $this->input->post('contrib');
				$data['BASESAL'] = $this->input->post('basesal');
				$data['STARTUP'] = $this->input->post('startup');
				$data['SPOUSEDET'] = $this->input->post('spousedet');
				break;
			case '12': /*URM-TTK*/
				$data['HIRE_TYPE'] = 12;
				break;
			default:
				$data = null;
				break;
		}
		return $data;
	}

	public function get($ids = false) {
		
		// Set flag -- if single ID was passed, return single record
		$single = $ids == false || is_array($ids) ? false : true;
		// Limit results to one or more ids
		if ($ids !== false) {
			// $ids should always be an array
			is_array($ids) || $ids = array($ids);
			// Sanitize ids
			$filter = $this->primaryFilter;
			$ids = array_map($filter, $ids);
			$this->db->where_in($this->primary_key, $ids);
		}
		// set order by if it was not already set
		$this->db->order_by($this->order_by);
		
		// Return results
		$single == false || $this->db->limit(1);
		$method = $single ? 'row_array' : 'result_array';
		return $this->db->get($this->table_name)->$method();
	}
	
	public function get_by($key, $val = false, $orwhere = false, $single = false) {
		// Limit Results
		if (! is_array($key)) {
			$this->db->where(htmlentities($key), htmlentities($val));
		} else {
			$key = array_map('htmlentities', $key);
			$where_method = $orwhere == true ? 'or_where' : 'where';
			$this->db->$where_method($key);
		}
		// Return Results
		$single == false || $this->db->limit(1);
		$method = $single ? 'row_array' : 'result_array';
		return $this->db->get($this->table_name)->$method();
	}
	
	public function get_key_value ($key_field, $value_field, $ids = false) {
		
		// Get records
		$this->db->select($key_field . ', ' . $value_field);
		$result = $this->get($ids);
		
		// Turn results into key=>value pair array. Use this if you want to make a dropdown list or something
		$data = array();
		if (count($result) > 0) {
			if ($ids != false && !is_array($ids)) {
				$result = array($result);
			}
			
			foreach ($result as $row) {
				$data[$row[$key_field]] = $row[$value_field];
			}
		}
		
		return $data;
	}
	
	public function get_assoc ($ids = false) {
		$result = $this->get($ids);
		// Turn results into associative array
		if ($ids != false && !is_array($ids)) {
			$result = array($result);
		}
		
		$data = $this->to_assoc($result);
		return $data;
	}
	
	function arrayOffset($d) {
		$a = array();
		foreach ($d[0] as $v => $k) {
			$a[$v] = $k;
		}
		return $a;
	}

	function to_array($data, $fld) {
		$a = false;
		foreach ($data as $v) {
			$a[] = $v[$fld];
		}
		return $a;
	}

	public function to_assoc($result = array()) {
		$data = array();
		$data[""] = 'Please make a choice'; /*Do it like this for associative array*/
		if (count($result) > 0) {
			foreach ($result as $row) {
				if (!is_array($row)) {
					$data[$row] = $row;
				} else {
					if (count($row) < 3) {
						$tmp = array_values(array_slice($row, 0 , 1));
						$flds = array_values(array_slice($row, 1));
						$data[$tmp[0]] = $flds[0];
					} else {
						$tmp = array_values(array_slice($row, 0, 1));
						$flds = array_values(array_slice($row, 1, 2));
						$data[$tmp[0]] = $flds[0] . ", " . $flds[1];
					}
				}
			}
		}
		return $data;
	}
	
    /**
     * Save or update a record.
     * 
     * @param array $data
     * @param mixed $id Optional
     * @return mixed The ID of the saved record
     * @author Joost van Veen
     */
    public function saive($data, $id = FALSE) {
        
        if ($id == FALSE) {
            
            // This is an insert
            $this->db->set($data)->insert($this->table_name);
		  /*$temp = $this->db->insert('DUP_DOCS', $data);
		  return $temp;*/
        }
        else {
            
            // This is an update
            $filter = $this->primaryFilter;
            $this->db->set($data)->where($this->primary_key, $filter($id))->update($this->table_name);
        }
        
        // Return the ID
        return $id == FALSE ? $this->db->insert_id() : $id;
    }

	public function newid($tblname, $fldname) {
		$this->db->select_max($fldname);
		$answer = $this->db->get($tblname);
		if ($answer->num_rows() > 0) {
			$row = $answer->row_array();
			$answer = $row[$fldname] + 1;
		} else {
			$answer = 1;
		}
		return $answer;
	}

	/* Insert or update, depending on data passed
	/* id is an array of fieldname and value
	/* data is also an array, with 0 default value for key field */
	public function save($tblname, $data, $id = FALSE) {
		if ($id == false) {
			//insert the record
			$this->db->set($data)->insert($tblname);
		} else {
			//update the record
			$this->db->set($data)->update($tblname, $data, $id);
		}
	}
	
     /**
     * Delete one or more records by ID
     * @param mixed $ids
     * @return void
     * @author Joost van Veen
     */
    public function deleet($ids){
        
        $filter = $this->primaryFilter; 
        $ids = ! is_array($ids) ? array($ids) : $ids;
        
        foreach ($ids as $id) {
            $id = $filter($id);
            if ($id) {
                $this->db->where($this->primary_key, $id)->limit(1)->delete($this->table_name);
            }
        }
    }
	/* Delete records, giving table name, field name, and value */
	public function delete($tblname, $fldname, $value) {
		$this->db->delete($tblname, array($fldname => $value));
	}
    /**
     * Delete one or more records by another key than the ID
     * @param string $key
     * @param mixed $value
     * @return void
     * @author Joost van Veen
     */
    public function delete_by($key, $value){
        
        if (empty($key)) {
            return FALSE;
        }
        $this->db->delete('mytable', array('id' => $id));
        $this->db->where(htmlentities($key), htmlentities($value))->delete($this->table_name);
    }
	
}
?>
