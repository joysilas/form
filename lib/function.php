<?php 

    function getUser($sn, $col='') {
		
		global $db;
        $users = $db->query("SELECT * FROM users WHERE sn='$sn' ") or die('Cannot Select');
		$row = mysqli_fetch_array($users);
		$val = ($col == '') ? $row['surname'].' '.$row['othernames'] : $row[$col];
		return $val;

	}
	

    function checkEmail($email) {
        global $db;

        $users = $db->query("SELECT * FROM users WHERE email='$email' ") or die('Cannot Select');
        $num = mysqli_num_rows($users);

    

        if(!$num > 0) {
            $val = 1;
        }else{
            $val = 0;
        }
        return $val;

    }



    function valEmpty($field, $fname, $ct) {
        global $report, $count;
        $field = trim($field);
        if($field==''){$report .= "<br>".$fname." field is required! "; $count=1; return;}elseif 
            (strlen($field)<$ct) {
            $report .= "<br>".$fname." must be at least ".$ct." characters! "; $count=1; return;
        }
        else{
            return $field;
        }
    }




    function Alert(){
		global $report,$count;
		if($count>0){

				 $alat = '<div class="alert alert-warning alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:10000">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <i class="icon fa fa-ban"></i>   &nbsp;&nbsp;'. $report .' &nbsp;&nbsp;&nbsp;
	              </div>';	


		}
		else{
		 $alat = '<div class="alert alert-success alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:10000">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <i class="icon fa fa-check"></i>  &nbsp;&nbsp;'. $report .'&nbsp;&nbsp;&nbsp;&nbsp;
	              </div>';	
		}
		return $alat;
	}

    function Alert2(){
		global $report,$count;
		if($count>0){

				 $alat = '<div class="alert alert-danger alert-dismissible" style="position:relative;">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <i class="icon fa fa-ban"></i>   &nbsp;&nbsp;'. $report .' &nbsp;&nbsp;&nbsp;
	              </div>';	


		}
		else{
		 $alat = '<div class="alert alert-success alert-dismissible" style="position:relative;">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <i class="icon fa fa-check"></i>  &nbsp;&nbsp;'. $report .'&nbsp;&nbsp;&nbsp;&nbsp;
	              </div>';	
		}
		return $alat;
	}



	