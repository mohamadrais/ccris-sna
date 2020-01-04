<?php
	/**
	 * Checks if the value of a specific unique field already exists 
	 * @param d department / table group name (0:"All departments", 1:"PROJECT", 2:"CLIENT", 3:"ADMIN", 4:"RESOURCES", 5:"ASSET", 6:"QHSE", 7:"STATUS", 8:"Misc.")
	 * @returns json result: { "result": "output" } or { "result": "error" }
	 */
	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	$memberInfo = getMemberInfo();
	$departments = get_table_groups();
	$tables = getTableList2();

	/*
	<select name="departmentID" id="departmentID">
		<option value="0" class="">All departments</option> // return all tables
		<option value="1" class="">PROJECT</option>
		<option value="2" class="">CLIENT</option>
		<option value="3" class="">ADMIN</option>
		<option value="4" class="">RESOURCES</option>
		<option value="5" class="">ASSET</option>
		<option value="6" class="">QHSE</option>
		<option value="7" class="">STATUS</option>
		<option value="8" class="">Misc.</option>
	</select>

	<select name="tableName" id="tableName">
		<option value="" selected="" class="">All tables</option>
		<option value="OrgContentContext" class="">Organization Content &amp; Context</option>
	</select>

	departments:
		PROJECT:array(11)	
			0:"projects"
			1:"WorkLocation"
			2:"ProjectTeam"
			3:"resources"
			4:"PROInitiation"
			5:"PROPlanning"
			6:"PROExecution"
			7:"PROControlMonitoring"
			8:"PROVariation"
			9:"PROCompletion"
			10:"Receivables"
		CLIENT:array(4)
		ADMIN:array(3)
		RESOURCES:array(5)
		ASSET:array(6)
		QHSE:array(18)
		STATUS:array(5)
		Misc.:array(35)
	*/

	/* maintenance mode */
	handle_maintenance();

	/* return json */
	header('Content-type: application/json');

	$error_return = '{ "result": "error" }';
	$ok_return = '{ "result": "ok" }';
	
	/* capture inputs */
	$departmentID = new Request('d');
	

	/* prevent conventional error output via a shutdown handler */
	function cancel_all_buffers(){
		while(ob_get_level()) ob_end_clean();
		echo $GLOBALS['result'];
	}
	$GLOBALS['result'] = $error_return; // error message to return if any error occurs
	ob_start();
	register_shutdown_function('cancel_all_buffers');

	/* user has access to table? */
	// $table_perms = getTablePermissions($table->raw);
	// if(!$table_perms[0]) exit();


	// if($operation->sql == 'select'){
		$dID = intval(makeSafe($departmentID->sql));
		if($dID == '0'){

		}
		switch ($dID){
			case '0':
				;
				break;
			case '1':
				$returnTables = array_values($departments["PROJECT"]);
				break;
			case '2':
				$returnTables = array_values($departments["CLIENT"]);
				break;
			case '3':
				$returnTables = array_values($departments["ADMIN"]);
				break;
			case '4':
				$returnTables = array_values($departments["RESOURCES"]);
				break;
			case '5':
				$returnTables = array_values($departments["ASSET"]);
				break;
			case '6':
				$returnTables = array_values($departments["QHSE"]);
				break;
			case '7':
				$returnTables = array_values($departments["STATUS"]);
				break;
			case '8':
				$returnTables = array_values($departments["Misc."]);
				break;
		}

		$output =  '<select name="tableName" id="tableName"><option value="" selected="" class="">All tables</option>';
		// $count = 0;
		foreach($tables as $tn => $tc){
			if ($dID != '0'){
				if(in_array($tn, $returnTables)){
					$output .= '<option value="' . $tn . '" class="">' . $tc . '</option>';
					// $count++;
				}
			}
			else {
				$output .= '<option value="' . $tn . '" class="">' . $tc . '</option>';
				// $count++;
			}
		}
		$output .= '</select>';
		// echo $count;
		$GLOBALS['result'] = json_encode($output);
	// }

	
