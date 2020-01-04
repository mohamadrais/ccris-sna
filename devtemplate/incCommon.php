<?php

	#########################################################
	/*
	~~~~~~ LIST OF FUNCTIONS ~~~~~~
		getTableList() -- returns an associative array (tableName => tableData, tableData is array(tableCaption, tableDescription, tableIcon)) of tables accessible by current user
		get_table_groups() -- returns an associative array (table_group => tables_array)
		logInMember() -- checks POST login. If not valid, redirects to index.php, else returns TRUE
		getTablePermissions($tn) -- returns an array of permissions allowed for logged member to given table (allowAccess, allowInsert, allowView, allowEdit, allowDelete) -- allowAccess is set to true if any access level is allowed
		get_sql_fields($tn) -- returns the SELECT part of the table view query
		get_sql_from($tn[, true]) -- returns the FROM part of the table view query, with full joins, optionally skipping permissions if true passed as 2nd param.
		get_joined_record($table, $id[, true]) -- returns assoc array of record values for given PK value of given table, with full joins, optionally skipping permissions if true passed as 3rd param.
		get_defaults($table) -- returns assoc array of table fields as array keys and default values (or empty), excluding automatic values as array values
		htmlUserBar() -- returns html code for displaying user login status to be used on top of pages.
		showNotifications($msg, $class) -- returns html code for displaying a notification. If no parameters provided, processes the GET request for possible notifications.
		parseMySQLDate(a, b) -- returns a if valid mysql date, or b if valid mysql date, or today if b is true, or empty if b is false.
		parseCode(code) -- calculates and returns special values to be inserted in automatic fields.
		addFilter(i, filterAnd, filterField, filterOperator, filterValue) -- enforce a filter over data
		clearFilters() -- clear all filters
		loadView($view, $data) -- passes $data to templates/{$view}.php and returns the output
		loadTable($table, $data) -- loads table template, passing $data to it
		filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo) -- applies cascading drop-downs for a lookup field, returns js code to be inserted into the page
		br2nl($text) -- replaces all variations of HTML <br> tags with a new line character
		htmlspecialchars_decode($text) -- inverse of htmlspecialchars()
		entitiesToUTF8($text) -- convert unicode entities (e.g. &#1234;) to actual UTF8 characters, requires multibyte string PHP extension
		func_get_args_byref() -- returns an array of arguments passed to a function, by reference
		permissions_sql($table, $level) -- returns an array containing the FROM and WHERE additions for applying permissions to an SQL query
		error_message($msg[, $back_url]) -- returns html code for a styled error message .. pass explicit false in second param to suppress back button
		toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format)
		reIndex(&$arr) -- returns a copy of the given array, with keys replaced by 1-based numeric indices, and values replaced by original keys
		get_embed($provider, $url[, $width, $height, $retrieve]) -- returns embed code for a given url (supported providers: youtube, googlemap)
		check_record_permission($table, $id, $perm = 'view') -- returns true if current user has the specified permission $perm ('view', 'edit' or 'delete') for the given recors, false otherwise
		NavMenus($options) -- returns the HTML code for the top navigation menus. $options is not implemented currently.
		StyleSheet() -- returns the HTML code for included style sheet files to be placed in the <head> section.
		getUploadDir($dir) -- if dir is empty, returns upload dir configured in defaultLang.php, else returns $dir.
		PrepareUploadedFile($FieldName, $MaxSize, $FileTypes='jpg|jpeg|gif|png', $NoRename=false, $dir="") -- validates and moves uploaded file for given $FieldName into the given $dir (or the default one if empty)
		get_home_links($homeLinks, $default_classes, $tgroup) -- process $homeLinks array and return custom links for homepage. Applies $default_classes to links if links have classes defined, and filters links by $tgroup (using '*' matches all table_group values)
		quick_search_html($search_term, $label, $separate_dv = true) -- returns HTML code for the quick search box.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	*/

	#########################################################

	function getTableList($skip_authentication = false){
		$arrAccessTables = array();
		$arrTables = array(
			/* 'table_name' => ['table caption', 'homepage description', 'icon', 'table group name'] */   
			'OrgContentContext' => array('Organization Content & Context', 'Record and document related to organization content and context. This may include but not limited to the SWOT analysis, PESTEL analysis, Market Prospect, Business Plan, Business Broshure and other related document. Detail record of the organization content and context can be inserted onto shared drive for reference.', 'resources/table_icons/application_from_storage.png', 'CLIENT'),
			'Marketing' => array('Marketing & Lead Generation', 'Record and document related to organization marketing actvities and Effort. This may include but not limited to the marketing campaigns event, Leads Generation, leads qualification and other related document. Detail record of the marketing event can be inserted onto shared drive for reference.', 'resources/table_icons/bricks.png', 'CLIENT'),
			'Client' => array('Client & Main Contractor', 'List of related Client and Main Contractor that require organization expertise. The List may also contain client that potentially be the future prospect. Client Techncial manual and client company specific procedure can be shared onto the shared drive for future reference. ', 'resources/table_icons/chart_pie.png', 'CLIENT'),
			'Inquiry' => array('Inquiry & Tender', 'Any related inquiry, tender document, market survey and request for proposal shall be recorded accordingly onto the register. This is to ensure that the requirement and inquiry from the client is captured. Thus follow up can be done accordingly.', 'resources/table_icons/cash_register.png', 'CLIENT'),
			'DesignProposal' => array('Service Design & Proposal', 'Consideration and design record for the related proposal/tender document. This register enable proposal to be enclosed with the inquiry from the client.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'ContractDeployment' => array('Project & Contract Deployment', 'Project related detail should be communicated promptly to operation team. The contract deployment process assist in getting all the contractual detail explained to the operation team. ', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'employees' => array('Human Resources Matrix', 'Employee matrix should be established properly. The matrix contain personnel involve in the organization operation. ', 'resources/table_icons/client_account_template.png', 'ADMIN'),
			'Recruitment' => array('Recruitment', 'Recruitment record review. This is register to enable personnel to record the recruitment evidence session along the interview session.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'PersonnalFile' => array('Personal File', 'This section register and contain all record from personnel. ', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'Competency' => array('Competency', 'Competency record review. This is register to enable personnel to record the Competency review session along the employment session. ', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'Training' => array('Training', 'Training record review. This is register to enable personnel to record the Training session along the employment session. ', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'JD_JS' => array('Job Description & Specification Register', 'Job Description and Job Specification available in the organization. This is the register for the job available on the organization.', 'resources/table_icons/data_table.png', 'ADMIN'),
			'InOutRegister' => array('Incoming & Outgoing Record Register', 'Record and document register for incoming and outgoing document. ', 'resources/table_icons/arrow_refresh.png', 'ADMIN'),
			'vendor' => array('Vendor & Subcontractor Register', 'Vendor list for organization operation. Detail of vendor and the associated vendor performance evaluation also available for reference. ', 'resources/table_icons/group.png', 'RESOURCES'),
			'ManagingVendor' => array('Managing Vendor & Subcontractor', 'activity register for audit done to operation vendor', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'VenPerformance' => array('Vendor Performance and Evaluation', 'activities by organization to evaluate the performance of vendor and subcontractor', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'Logistics' => array('Logistics & Freight Agent', 'Logistic agent and freight forwarder agent list', 'resources/table_icons/lorry_add.png', 'ASSET'),
			'Inventory' => array('Asset Register', 'Inventory and asset register shall consist of organization asset. this list of equipment must have dedicated maintenacne and inspection procedure. Parts and consumables shall not be registered under this item. ', 'resources/table_icons/change_password.png', 'ASSET'),
			'CalibrationCtrl' => array('Calibration Control', 'Calibration of measuring equipment shall be available for reference. every calibrated equipment shall have dedicated calibration number for identification and reference ID. Under this list, the calibrated equipment record can be retrieved.', 'resources/table_icons/cog_add.png', 'ASSET'),
			'WorkOrder' => array('General Work Order', 'General work order register. List of work order related to the organization to be properly handled from the list. Assignment of task to respective personnel.', 'resources/table_icons/interface_preferences.png', 'ASSET'),
			'MWO' => array('Maintenance Work Order', 'This section is dedicated to keep track of breakdown maintenance and planned maintenance. The task is generated on monthly basis in order to ensure, asset and facilities properly maintained. ', 'resources/table_icons/calendar_view_day.png', 'ASSET'),
			'MWOPlanned' => array('Planned Schedule', 'Planned schedule maintenance for asset. The expected record shall be the generated checklist of equipment inspection and testing. ', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'MWOpreventive' => array('Preventive', 'Preventive maintenance call for preventive action to deal with potential broken system or parts. ', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'MWOproactive' => array('Proactive', 'Proactive maintenance call for proactive initiative to eliminate potential non conformance on system functionality and system compliance.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'MWConditionBased' => array('Condition Based', 'Condition based maintenance call for maintenance action that to be done based on asset dissatisfactory visual inspection. if the viaual inspection showing sign of abnormality, supr shall assigned the task accordingly.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'MWOReactive' => array('Reactive', 'Reactive maintenance call for reactive maintenace action due to immedeate system breakdown.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'MWOCorrective' => array('Corrective', 'Corrective maintenance call for maintenance action raised by Fault report generated. The action is critical but not important. system may still retain its function, but repair is required in times to come.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'LogisticRequest' => array('Logistic Request Order', 'Logistic movement inquiry shall be initiated by issuing the request for logistic. this enable manager to keep track of the logistic list of organization.', 'resources/table_icons/aol_mail.png', 'ASSET'),
			'orders' => array('Request & Service Order', 'Product and services request order for organization to aquire resources. Request order can be linked to the price quotation, Purchase order, Delivery Order and payment request. Sometime, the RO can also act as the market survey for the team to check the price quotation for the services.', 'resources/table_icons/cash_register.png', 'RESOURCES'),
			'Quotation' => array('Quotations', 'Price quotation from vendor. All quotation shall be kept on the register to ensure good record keeping practice.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'PurchaseOrder' => array('Purchase Order', 'Purchase order to be issued by department based on the quotation evaliation. ', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'DeliveryOrder' => array('Delivery Order', 'Delivery order serve as evidence of acceptance. Goods or services shall be accompanied by the DO and also Commercial Invoice/Packing List.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'AccountPayables' => array('Account Payables', 'Account payables process enable the payment request to be made prior any actual payment. this eliminates the potential double payment or insufficient payment', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'Item' => array('Resources Inventory', 'Item and equipment shall consist of all parts and items that are consumables. This indicates the inventory of the fast moving item in the organization.', 'resources/table_icons/barcode.png', 'RESOURCES'),
			'categories' => array('Item Categories', 'This table represent the list of categories for the inventories', 'resources/table_icons/award_star_bronze_1.png', 'RESOURCES'),
			'batches' => array('Batches', 'Batches represent the table of item that arrive in the organization. Each delivery or every packing list is checked and recorder properly.', 'resources/table_icons/box_closed.png', 'RESOURCES'),
			'transactions' => array('Transfer Item', 'This table indicates movement of the asset and inventory in the organization.', 'resources/table_icons/book_keeping.png', 'RESOURCES'),
			'CommConsParticipate' => array('Communication, Consultation & Participation', 'This is area in which the monthly commitment of organization towards the excellence of IMS is recorded. All the activities of communication, consultation and participation to be properly recorded and organized in the monthly activities.', 'resources/table_icons/participation_rate.png', 'QHSE'),
			'ToolBoxMeeting' => array('ToolBox Meeting', 'Toolbox meeting to be done prior daily activities promote the team alignment and coordination', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'Bi_WeeklyMeeting' => array('Bi-Weekly Meeting', 'Performance measurement meeting and progress meeting table', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'QuarterlyMeeting' => array('Quarterly Meeting', 'Quarterly Meeting to evaluate performance of leading and lagging indicators', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'Campaign' => array('Campaign', 'IMS campaign in the organization to maximize awareness and promote organizational effectiveness', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'DrillNInspection' => array('Drill & Inspection', 'Drill and inspecction activities record of desktop drill, safety drill and monthly safety and environment inspection.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'ManagementVisit' => array('Management Visit', 'Management visit record and evidence of top management communication and participation ', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'EventNotification' => array('Event Notification', 'Event notification tables include the activity highlight of the month. this can either be the incident event, operation event or accident event.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'ActCard' => array('Act Card', 'Act card register table promote all to highlight and take immediate action towards non conformance action.', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'KM' => array('Organizational Knowledge', 'Organizational knowledge table contain list of guideline and reference in order for the organization to have sustainable competency programm.', 'resources/table_icons/application_view_tile.png', 'QHSE'),
			'LegalRegister' => array('Legal Register', 'Legal register table consist of legal clause that involve in business activities', 'resources/table_icons/active_sessions.png', 'QHSE'),
			'RiskandOpportunity' => array('Risks Management', 'Risk Management table indicates the risk management evaluation consideration in the organization.', 'resources/table_icons/document_inspector.png', 'QHSE'),
			'DocControl' => array('Document & Record Control', 'Document control table enable the document to be displayed onto singular table for ease of reference. DCN also available to assist on changes reference.', 'resources/table_icons/application_error.png', 'QHSE'),
			'DCN' => array('Document Change Notice', 'Any document change require DCN. Register of changes in the document', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'ObsoleteRec' => array('Obsolete Record Register', 'Any document that is obsolete require official record. Register of obsolete record in the table', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'QA' => array('IMS Planning & Assurance', 'All IMS planning and assurance to be included in this table. Training matrix, competency matrix, Training and competency plan, Project QHSE plan, annual IMS plan and other asssurance plan', 'resources/table_icons/administrator.png', 'QHSE'),
			'ERP' => array('Emergency Preparedness & Response', 'List of ERP plan for organization', 'resources/table_icons/delete.png', 'QHSE'),
			'WorkEnvMonitoring' => array('Work Environment Monitoring and Control', 'Work environment monitoring record to be kept on this table', 'resources/table_icons/brick_edit.png', 'QHSE'),
			'ScheduleWaste' => array('Schedule Waste Disposal Register', 'Register of Schedule waste to be kept on this table for reference. this is to prepare for Environment management meeting content. ', 'resources/table_icons/direction.png', 'QHSE'),
			'IncidentReporting' => array('Incident & Accident Reporting', 'Detail incident and accident report shall be registered on this table', 'resources/table_icons/application_put.png', 'QHSE'),
			'MgtofChange' => array('Management Of Change', 'MOC form can be retrieved on this table.', 'resources/table_icons/alarm_bell.png', 'QHSE'),
			'IMStrackingNmonitoring' => array('IMS Data Tracking & Monitoring', 'IMS leading and lagging can be stored in this table for monthly data tracking and monitoring. other data tracking can be kept on this table.', 'resources/table_icons/chart_line_add.png', 'QHSE'),
			'IMSDataAnalysis' => array('Continual Improvement Plan', 'Collection of analysis of data to be kept on this table for reference. this is to prepare for quaterly meeting content. ', 'resources/table_icons/chart_stock.png', 'QHSE'),
			'Audit' => array('Management System Audit', 'Audit record shall be kept in the table', 'resources/table_icons/balance.png', 'QHSE'),
			'NonConformance' => array('IMS Non Conformance', 'Register of Non Conformance to be kept on this table for reference. Non conformance towards standards to be highlighted and acted upon.', 'resources/table_icons/cog_delete.png', 'QHSE'),
			'ContinualImprovement' => array('CAPAR', 'CIPL table consist of CAPAR register. ', 'resources/table_icons/finance.png', 'QHSE'),
			'StakeholderSatisfaction' => array('Stakeholder Satisfaction Survey', 'satisfaction survey can be stored in this table', 'resources/table_icons/document_signature.png', 'QHSE'),
			'MRM' => array('Management Review Meeting', 'Management review meeting organized at least once a year to evaluate the performance of the management system', 'resources/table_icons/attach.png', 'QHSE'),
			'projects' => array('Project Register', 'List of project in the organization', 'resources/table_icons/server_components.png', 'PROJECT'),
			'WorkLocation' => array('Work Site Location', 'This table contain information on the work site location', 'resources/table_icons/color_swatch.png', 'PROJECT'),
			'WorkPermit' => array('Work Permit', 'Related work permit in the respective worksite', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'ProjectTeam' => array('Project Team Matrix', 'Project Team matrix should be established properly. The matrix contain personnel involve in the Project and operation. ', 'resources/table_icons/images.png', 'PROJECT'),
			'resources' => array('Resources & Equipment', 'This table shall contain the list of all resources and equipment required to ensure success operation. One of the resources characteristic is that, it must be the cost for the operation.', 'resources/table_icons/setting_tools.png', 'PROJECT'),
			'PROInitiation' => array('Project Initiation', 'initiation process deliverables by project team', 'resources/table_icons/arrow_in.png', 'PROJECT'),
			'PROPlanning' => array('Project Planning', 'project planning process deliverables table', 'resources/table_icons/arrow_inout.png', 'PROJECT'),
			'PROExecution' => array('Project Execution', 'Project Execution deliverables table contain information on project execution', 'resources/table_icons/arrow_out.png', 'PROJECT'),
			'DailyProgressReport' => array('Daily Progress Report', 'Collecction of the daily progress report', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'MonthlyTimesheet' => array('Monthly Timesheet', 'Monthly timesheet for operation. critical deliverables for operation', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'Breakdown' => array('Breakdown & Fault Report', 'Breakdown and fault report', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'PROControlMonitoring' => array('Project Control And Monitoring', 'Control and monitoring activities for project.', 'resources/table_icons/arrow_refresh.png', 'PROJECT'),
			'PROVariation' => array('Project Variation Order', 'project variation order table. any instruction from site shall be validated via the variation order request', 'resources/table_icons/arrow_divide.png', 'PROJECT'),
			'PROCompletion' => array('Project Completion', 'Project completion deliverables table', 'resources/table_icons/arrow_join.png', 'PROJECT'),
			'Receivables' => array('Project Receivables', 'Project Receivables information table. ', 'resources/table_icons/ehow.png', 'PROJECT'),
			'ClaimRecord' => array('Claim Submission', 'Claim submission information table', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'TeamSoftBoard' => array('Organization Softboard', 'General posting from the group member to promote collaboration and group awareness.', 'resources/table_icons/group_link.png', 'STATUS'),
			'SoftboardComment' => array('Softboard Comment', '', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'IMSReport' => array('IMS Complaint Report', 'Report on the IMS system and also the channel to log in the complaint report for any conformance.', 'resources/table_icons/premium_support.png', 'STATUS'),
			'ReportComment' => array('Report Comment', '', 'resources/table_icons/application_form_magnify.png', 'Misc.'),
			'Leadership' => array('Review & Verification', 'Review and verification summary for the IMS', 'resources/table_icons/chart_organisation.png', 'STATUS'),
			'Approval' => array('Approval', 'Approval summary for the IMS ', 'resources/table_icons/chart_organisation.png', 'STATUS'),
			'IMSControl' => array('IMS Control', 'IMS DCC post check summary', 'resources/table_icons/chart_organisation.png', 'STATUS'),
			'membership_company' => array('Company', 'Setup company details', 'table.gif', 'STATUS'),
			'kpi' => array('KPI', 'Key performance indexes', 'table.gif', 'STATUS'),
			'summary_dashboard' => array('Summary Dashboard', 'Summary of all statistics from other tables', 'table.gif', 'STATUS')
		);
		if($skip_authentication || getLoggedAdmin()) return $arrTables;

		if(is_array($arrTables)){
			foreach($arrTables as $tn => $tc){
				$arrPerm = getTablePermissions($tn);
				if($arrPerm[0]){
					$arrAccessTables[$tn] = $tc;
				}
			}
		}

		return $arrAccessTables;
	}

	#########################################################

	function get_table_groups($skip_authentication = false){
		$tables = getTableList($skip_authentication);
		$all_groups = array('PROJECT', 'CLIENT', 'ADMIN', 'RESOURCES', 'ASSET', 'QHSE', 'STATUS', 'Misc.');

		$groups = array();
		foreach($all_groups as $grp){
			foreach($tables as $tn => $td){
				if($td[3] && $td[3] == $grp) $groups[$grp][] = $tn;
				if(!$td[3]) $groups[0][] = $tn;
			}
		}

		return $groups;
	}

	#########################################################

	function getTablePermissions($tn){
		static $table_permissions = array();
		if(isset($table_permissions[$tn])) return $table_permissions[$tn];

		$groupID = getLoggedGroupID();
		$memberID = makeSafe(getLoggedMemberID());
		$res_group = sql("select tableName, allowInsert, allowView, allowEdit, allowDelete from membership_grouppermissions where groupID='{$groupID}'", $eo);
		$res_user = sql("select tableName, allowInsert, allowView, allowEdit, allowDelete from membership_userpermissions where lcase(memberID)='{$memberID}'", $eo);

		while($row = db_fetch_assoc($res_group)){
			$table_permissions[$row['tableName']] = array(
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			);
		}

		// user-specific permissions, if specified, overwrite his group permissions
		while($row = db_fetch_assoc($res_user)){
			$table_permissions[$row['tableName']] = array(
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			);
		}

		// if user has any type of access, set 'access' flag
		foreach($table_permissions as $t => $p){
			$table_permissions[$t]['access'] = $table_permissions[$t][0] = false;

			if($p['insert'] || $p['view'] || $p['edit'] || $p['delete']){
				$table_permissions[$t]['access'] = $table_permissions[$t][0] = true;
			}
		}

		return $table_permissions[$tn];
	}

	#########################################################

	function get_sql_fields($table_name){
		$sql_fields = array(   
			'OrgContentContext' => "`OrgContentContext`.`id` as 'id', `OrgContentContext`.`RecordNumber` as 'RecordNumber', `OrgContentContext`.`DocItem` as 'DocItem', `OrgContentContext`.`fo_DocumentDescription` as 'fo_DocumentDescription', `OrgContentContext`.`fo_Type` as 'fo_Type', `OrgContentContext`.`fo_genrec` as 'fo_genrec', `OrgContentContext`.`fo_Update` as 'fo_Update', if(`OrgContentContext`.`fo_DateUpload`,date_format(`OrgContentContext`.`fo_DateUpload`,'%m/%d/%Y'),'') as 'fo_DateUpload', CONCAT_WS('-', LEFT(`OrgContentContext`.`ot_FileLoc`,3), MID(`OrgContentContext`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `OrgContentContext`.`ot_otherdetails` as 'ot_otherdetails', `OrgContentContext`.`ot_comments` as 'ot_comments', `OrgContentContext`.`ot_SharedLink1` as 'ot_SharedLink1', `OrgContentContext`.`ot_SharedLink2` as 'ot_SharedLink2', `OrgContentContext`.`ot_Ref01` as 'ot_Ref01', `OrgContentContext`.`ot_Ref02` as 'ot_Ref02', `OrgContentContext`.`ot_Ref03` as 'ot_Ref03', `OrgContentContext`.`ot_Ref04` as 'ot_Ref04', `OrgContentContext`.`ot_Ref05` as 'ot_Ref05', `OrgContentContext`.`ot_Ref06` as 'ot_Ref06', `OrgContentContext`.`ot_Photo01` as 'ot_Photo01', `OrgContentContext`.`ot_Photo02` as 'ot_Photo02', `OrgContentContext`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `OrgContentContext`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `OrgContentContext`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `OrgContentContext`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`OrgContentContext`.`ot_ap_filed`,date_format(`OrgContentContext`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`OrgContentContext`.`ot_ap_lastmodified`,date_format(`OrgContentContext`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Marketing' => "`Marketing`.`id` as 'id', `Marketing`.`RecordNumber` as 'RecordNumber', `Marketing`.`DocItem` as 'DocItem', `Marketing`.`fo_DocumentDescription` as 'fo_DocumentDescription', `Marketing`.`fo_Type` as 'fo_Type', `Marketing`.`fo_Source` as 'fo_Source', `Marketing`.`fo_Qualification` as 'fo_Qualification', if(`Marketing`.`fo_DateUpload`,date_format(`Marketing`.`fo_DateUpload`,'%m/%d/%Y'),'') as 'fo_DateUpload', CONCAT_WS('-', LEFT(`Marketing`.`ot_FileLoc`,3), MID(`Marketing`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Marketing`.`ot_otherdetails` as 'ot_otherdetails', `Marketing`.`ot_comments` as 'ot_comments', `Marketing`.`ot_SharedLink1` as 'ot_SharedLink1', `Marketing`.`ot_SharedLink2` as 'ot_SharedLink2', `Marketing`.`ot_Location` as 'ot_Location', `Marketing`.`ot_Ref01` as 'ot_Ref01', `Marketing`.`ot_Ref02` as 'ot_Ref02', `Marketing`.`ot_Ref03` as 'ot_Ref03', `Marketing`.`ot_Ref04` as 'ot_Ref04', `Marketing`.`ot_Ref05` as 'ot_Ref05', `Marketing`.`ot_Ref06` as 'ot_Ref06', `Marketing`.`ot_Photo01` as 'ot_Photo01', `Marketing`.`ot_Photo02` as 'ot_Photo02', `Marketing`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Marketing`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Marketing`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Marketing`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Marketing`.`ot_ap_filed`,date_format(`Marketing`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Marketing`.`ot_ap_lastmodified`,date_format(`Marketing`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Client' => "`Client`.`id` as 'id', `Client`.`ClientID` as 'ClientID', `Client`.`CompanyName` as 'CompanyName', `Client`.`fo_ContactName` as 'fo_ContactName', `Client`.`fo_ContactTitle` as 'fo_ContactTitle', `Client`.`fo_Address` as 'fo_Address', `Client`.`fo_City` as 'fo_City', `Client`.`fo_Region` as 'fo_Region', `Client`.`fo_PostalCode` as 'fo_PostalCode', `Client`.`fo_Country` as 'fo_Country', `Client`.`fo_Phone` as 'fo_Phone', `Client`.`fo_Fax` as 'fo_Fax', `Client`.`fo_Email` as 'fo_Email', CONCAT_WS('-', LEFT(`Client`.`ot_FileLoc`,3), MID(`Client`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Client`.`ot_otherDetails` as 'ot_otherDetails', `Client`.`ot_Comments` as 'ot_Comments', `Client`.`ot_SharedLink1` as 'ot_SharedLink1', `Client`.`ot_SharedLink2` as 'ot_SharedLink2', `Client`.`ot_Location` as 'ot_Location', `Client`.`ot_Ref01` as 'ot_Ref01', `Client`.`ot_Ref02` as 'ot_Ref02', `Client`.`ot_Ref03` as 'ot_Ref03', `Client`.`ot_Ref04` as 'ot_Ref04', `Client`.`ot_Ref05` as 'ot_Ref05', `Client`.`ot_Ref06` as 'ot_Ref06', `Client`.`ot_Photo01` as 'ot_Photo01', `Client`.`ot_Photo02` as 'ot_Photo02', `Client`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Client`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Client`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Client`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Client`.`ot_ap_filed`,date_format(`Client`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Client`.`ot_ap_lastmodified`,date_format(`Client`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Inquiry' => "`Inquiry`.`id` as 'id', `Inquiry`.`InqNumber` as 'InqNumber', IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') as 'ClientID', if(`Inquiry`.`fo_InquiryDate`,date_format(`Inquiry`.`fo_InquiryDate`,'%m/%d/%Y'),'') as 'fo_InquiryDate', if(`Inquiry`.`fo_DueDate`,date_format(`Inquiry`.`fo_DueDate`,'%m/%d/%Y'),'') as 'fo_DueDate', `Inquiry`.`fo_Classification` as 'fo_Classification', if(`Inquiry`.`fo_DeliveryDate`,date_format(`Inquiry`.`fo_DeliveryDate`,'%m/%d/%Y'),'') as 'fo_DeliveryDate', IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '; ', `Logistics1`.`CompanyName`), '') as 'fo_Logistic', `Inquiry`.`fo_Freight` as 'fo_Freight', IF(    CHAR_LENGTH(`Client1`.`fo_ContactName`), CONCAT_WS('',   `Client1`.`fo_ContactName`), '') as 'fo_ShipName', IF(    CHAR_LENGTH(`Client1`.`fo_Address`), CONCAT_WS('',   `Client1`.`fo_Address`), '') as 'fo_ShipAddress', IF(    CHAR_LENGTH(`Client1`.`fo_City`), CONCAT_WS('',   `Client1`.`fo_City`), '') as 'fo_ShipCity', IF(    CHAR_LENGTH(`Client1`.`fo_Region`), CONCAT_WS('',   `Client1`.`fo_Region`), '') as 'fo_ShipRegion', IF(    CHAR_LENGTH(`Client1`.`fo_PostalCode`), CONCAT_WS('',   `Client1`.`fo_PostalCode`), '') as 'fo_ShipPostalCode', IF(    CHAR_LENGTH(`Client1`.`fo_Country`), CONCAT_WS('',   `Client1`.`fo_Country`), '') as 'fo_ShipCountry', CONCAT_WS('-', LEFT(`Inquiry`.`ot_FileLoc`,3), MID(`Inquiry`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Inquiry`.`ot_otherdetails` as 'ot_otherdetails', `Inquiry`.`ot_comments` as 'ot_comments', `Inquiry`.`ot_SharedLink1` as 'ot_SharedLink1', `Inquiry`.`ot_SharedLink2` as 'ot_SharedLink2', `Inquiry`.`ot_Ref01` as 'ot_Ref01', `Inquiry`.`ot_Ref02` as 'ot_Ref02', `Inquiry`.`ot_Ref03` as 'ot_Ref03', `Inquiry`.`ot_Ref04` as 'ot_Ref04', `Inquiry`.`ot_Ref05` as 'ot_Ref05', `Inquiry`.`ot_Ref06` as 'ot_Ref06', `Inquiry`.`ot_Photo01` as 'ot_Photo01', `Inquiry`.`ot_Photo02` as 'ot_Photo02', `Inquiry`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Inquiry`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Inquiry`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Inquiry`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Inquiry`.`ot_ap_filed`,date_format(`Inquiry`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Inquiry`.`ot_ap_lastmodified`,date_format(`Inquiry`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'DesignProposal' => "`DesignProposal`.`id` as 'id', `DesignProposal`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`Inquiry1`.`InqNumber`) || CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Inquiry1`.`InqNumber`, '; ', `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') as 'InquiryID', `DesignProposal`.`fo_Type` as 'fo_Type', `DesignProposal`.`fo_Intro` as 'fo_Intro', `DesignProposal`.`fo_DocumentDescription` as 'fo_DocumentDescription', `DesignProposal`.`fo_RecSub` as 'fo_RecSub', if(`DesignProposal`.`fo_Submissiondate`,date_format(`DesignProposal`.`fo_Submissiondate`,'%m/%d/%Y'),'') as 'fo_Submissiondate', `DesignProposal`.`fo_contact_person` as 'fo_contact_person', `DesignProposal`.`fo_Price` as 'fo_Price', CONCAT_WS('-', LEFT(`DesignProposal`.`ot_FileLoc`,3), MID(`DesignProposal`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `DesignProposal`.`ot_otherdetails` as 'ot_otherdetails', `DesignProposal`.`ot_comments` as 'ot_comments', `DesignProposal`.`ot_SharedLink1` as 'ot_SharedLink1', `DesignProposal`.`ot_SharedLink2` as 'ot_SharedLink2', `DesignProposal`.`ot_Ref01` as 'ot_Ref01', `DesignProposal`.`ot_Ref02` as 'ot_Ref02', `DesignProposal`.`ot_Ref03` as 'ot_Ref03', `DesignProposal`.`ot_Ref04` as 'ot_Ref04', `DesignProposal`.`ot_Ref05` as 'ot_Ref05', `DesignProposal`.`ot_Ref06` as 'ot_Ref06', `DesignProposal`.`ot_Photo01` as 'ot_Photo01', `DesignProposal`.`ot_Photo02` as 'ot_Photo02', `DesignProposal`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `DesignProposal`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `DesignProposal`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `DesignProposal`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`DesignProposal`.`ot_ap_filed`,date_format(`DesignProposal`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`DesignProposal`.`ot_ap_lastmodified`,date_format(`DesignProposal`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ContractDeployment' => "`ContractDeployment`.`id` as 'id', `ContractDeployment`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`Inquiry1`.`InqNumber`) || CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Inquiry1`.`InqNumber`, '; ', `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') as 'InquiryID', `ContractDeployment`.`fo_Type` as 'fo_Type', `ContractDeployment`.`fo_Intro` as 'fo_Intro', `ContractDeployment`.`fo_DocumentDescription` as 'fo_DocumentDescription', if(`ContractDeployment`.`fo_ExeDate`,date_format(`ContractDeployment`.`fo_ExeDate`,'%m/%d/%Y'),'') as 'fo_ExeDate', CONCAT_WS('-', LEFT(`ContractDeployment`.`ot_FileLoc`,3), MID(`ContractDeployment`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ContractDeployment`.`ot_otherdetails` as 'ot_otherdetails', `ContractDeployment`.`ot_comments` as 'ot_comments', `ContractDeployment`.`ot_SharedLink1` as 'ot_SharedLink1', `ContractDeployment`.`ot_SharedLink2` as 'ot_SharedLink2', `ContractDeployment`.`ot_Ref01` as 'ot_Ref01', `ContractDeployment`.`ot_Ref02` as 'ot_Ref02', `ContractDeployment`.`ot_Ref03` as 'ot_Ref03', `ContractDeployment`.`ot_Ref04` as 'ot_Ref04', `ContractDeployment`.`ot_Ref05` as 'ot_Ref05', `ContractDeployment`.`ot_Ref06` as 'ot_Ref06', `ContractDeployment`.`ot_Photo01` as 'ot_Photo01', `ContractDeployment`.`ot_Photo02` as 'ot_Photo02', `ContractDeployment`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ContractDeployment`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ContractDeployment`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ContractDeployment`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ContractDeployment`.`ot_ap_filed`,date_format(`ContractDeployment`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ContractDeployment`.`ot_ap_lastmodified`,date_format(`ContractDeployment`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'employees' => "`employees`.`EmployeeID` as 'EmployeeID', IF(    CHAR_LENGTH(`membership_users`.`memberID`) || CHAR_LENGTH(`membership_users`.`email`), CONCAT_WS('',   `membership_users`.`memberID`, ': ', `membership_users`.`email`), '') as 'memberID', `employees`.`EmpNo` as 'EmpNo', `employees`.`Name` as 'Name', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, ': ', `WorkLocation1`.`DocItem`), '') as 'BaseLocation', `employees`.`fo_TermEmployment` as 'fo_TermEmployment', `employees`.`fo_Photo01` as 'fo_Photo01', `employees`.`fo_Photo02` as 'fo_Photo02', `employees`.`fo_Photo03` as 'fo_Photo03', `employees`.`fo_Position` as 'fo_Position', if(`employees`.`fo_HireDate`,date_format(`employees`.`fo_HireDate`,'%m/%d/%Y'),'') as 'fo_HireDate', if(`employees`.`fo_OffHireDate`,date_format(`employees`.`fo_OffHireDate`,'%m/%d/%Y'),'') as 'fo_OffHireDate', `employees`.`fo_Address` as 'fo_Address', `employees`.`fo_City` as 'fo_City', `employees`.`fo_Region` as 'fo_Region', `employees`.`fo_PostalCode` as 'fo_PostalCode', `employees`.`fo_Country` as 'fo_Country', `employees`.`fo_HomePhone` as 'fo_HomePhone', `employees`.`fo_Extension` as 'fo_Extension', `employees`.`fo_Notes` as 'fo_Notes', IF(    CHAR_LENGTH(`employees1`.`Name`) || CHAR_LENGTH(`employees1`.`EmployeeID`), CONCAT_WS('',   `employees1`.`Name`, ', ', `employees1`.`EmployeeID`), '') as 'fo_ReportsTo', `employees`.`fo_Acknowledgement` as 'fo_Acknowledgement', `employees`.`fo_Induction` as 'fo_Induction', CONCAT_WS('-', LEFT(`employees`.`ot_FileLoc`,3), MID(`employees`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `employees`.`ot_otherdetails` as 'ot_otherdetails', `employees`.`ot_comments` as 'ot_comments', `employees`.`ot_SharedLink1` as 'ot_SharedLink1', `employees`.`ot_SharedLink2` as 'ot_SharedLink2', `employees`.`ot_Ref01` as 'ot_Ref01', `employees`.`ot_Ref02` as 'ot_Ref02', `employees`.`ot_Ref03` as 'ot_Ref03', `employees`.`ot_Ref04` as 'ot_Ref04', `employees`.`ot_Ref05` as 'ot_Ref05', `employees`.`ot_Ref06` as 'ot_Ref06', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `employees`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `employees`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `employees`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`employees`.`ot_ap_filed`,date_format(`employees`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`employees`.`ot_ap_lastmodified`,date_format(`employees`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Recruitment' => "`Recruitment`.`RecruitID` as 'RecruitID', `Recruitment`.`CompID` as 'CompID', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'EmployeeID', IF(    CHAR_LENGTH(`ProjectTeam1`.`EmpNo`) || CHAR_LENGTH(`ProjectTeam1`.`Name`), CONCAT_WS('',   `ProjectTeam1`.`EmpNo`, '; ', `ProjectTeam1`.`Name`), '') as 'ProjectTeamID', `Recruitment`.`fo_RecruitmentSession` as 'fo_RecruitmentSession', `Recruitment`.`fo_Description` as 'fo_Description', if(`Recruitment`.`fo_Date`,date_format(`Recruitment`.`fo_Date`,'%m/%d/%Y'),'') as 'fo_Date', CONCAT_WS('-', LEFT(`Recruitment`.`ot_FileLoc`,3), MID(`Recruitment`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Recruitment`.`ot_otherdetails` as 'ot_otherdetails', `Recruitment`.`ot_comments` as 'ot_comments', `Recruitment`.`ot_SharedLink1` as 'ot_SharedLink1', `Recruitment`.`ot_SharedLink2` as 'ot_SharedLink2', `Recruitment`.`ot_Ref01` as 'ot_Ref01', `Recruitment`.`ot_Ref02` as 'ot_Ref02', `Recruitment`.`ot_Ref03` as 'ot_Ref03', `Recruitment`.`ot_Ref04` as 'ot_Ref04', `Recruitment`.`ot_Ref05` as 'ot_Ref05', `Recruitment`.`ot_Ref06` as 'ot_Ref06', `Recruitment`.`ot_Photo01` as 'ot_Photo01', `Recruitment`.`ot_Photo02` as 'ot_Photo02', `Recruitment`.`ot_Photo03` as 'ot_Photo03', if(`Recruitment`.`ot_ap_filed`,date_format(`Recruitment`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Recruitment`.`ot_ap_lastmodified`,date_format(`Recruitment`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'PersonnalFile' => "`PersonnalFile`.`PersonalFileID` as 'PersonalFileID', `PersonnalFile`.`FileID` as 'FileID', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'EmployeeID', IF(    CHAR_LENGTH(`ProjectTeam1`.`EmpNo`) || CHAR_LENGTH(`ProjectTeam1`.`Name`), CONCAT_WS('',   `ProjectTeam1`.`EmpNo`, '; ', `ProjectTeam1`.`Name`), '') as 'ProjectTeamID', `PersonnalFile`.`fo_PersonalFileDesc` as 'fo_PersonalFileDesc', `PersonnalFile`.`fo_Description` as 'fo_Description', if(`PersonnalFile`.`fo_Date`,date_format(`PersonnalFile`.`fo_Date`,'%m/%d/%Y'),'') as 'fo_Date', CONCAT_WS('-', LEFT(`PersonnalFile`.`ot_FileLoc`,3), MID(`PersonnalFile`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `PersonnalFile`.`ot_otherdetails` as 'ot_otherdetails', `PersonnalFile`.`ot_comments` as 'ot_comments', `PersonnalFile`.`ot_SharedLink1` as 'ot_SharedLink1', `PersonnalFile`.`ot_SharedLink2` as 'ot_SharedLink2', `PersonnalFile`.`ot_Ref01` as 'ot_Ref01', `PersonnalFile`.`ot_Ref02` as 'ot_Ref02', `PersonnalFile`.`ot_Ref03` as 'ot_Ref03', `PersonnalFile`.`ot_Ref04` as 'ot_Ref04', `PersonnalFile`.`ot_Ref05` as 'ot_Ref05', `PersonnalFile`.`ot_Ref06` as 'ot_Ref06', `PersonnalFile`.`ot_Photo01` as 'ot_Photo01', `PersonnalFile`.`ot_Photo02` as 'ot_Photo02', `PersonnalFile`.`ot_Photo03` as 'ot_Photo03', if(`PersonnalFile`.`ot_ap_filed`,date_format(`PersonnalFile`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`PersonnalFile`.`ot_ap_lastmodified`,date_format(`PersonnalFile`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Competency' => "`Competency`.`CompetencyID` as 'CompetencyID', `Competency`.`CompID` as 'CompID', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'EmployeeID', IF(    CHAR_LENGTH(`ProjectTeam1`.`EmpNo`) || CHAR_LENGTH(`ProjectTeam1`.`Name`), CONCAT_WS('',   `ProjectTeam1`.`EmpNo`, '; ', `ProjectTeam1`.`Name`), '') as 'ProjectTeamID', `Competency`.`fo_CompetencySession` as 'fo_CompetencySession', `Competency`.`fo_Description` as 'fo_Description', if(`Competency`.`fo_Date`,date_format(`Competency`.`fo_Date`,'%m/%d/%Y'),'') as 'fo_Date', CONCAT_WS('-', LEFT(`Competency`.`ot_FileLoc`,3), MID(`Competency`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Competency`.`ot_otherdetails` as 'ot_otherdetails', `Competency`.`ot_comments` as 'ot_comments', `Competency`.`ot_SharedLink1` as 'ot_SharedLink1', `Competency`.`ot_SharedLink2` as 'ot_SharedLink2', `Competency`.`ot_Location` as 'ot_Location', `Competency`.`ot_Ref01` as 'ot_Ref01', `Competency`.`ot_Ref02` as 'ot_Ref02', `Competency`.`ot_Ref03` as 'ot_Ref03', `Competency`.`ot_Ref04` as 'ot_Ref04', `Competency`.`ot_Ref05` as 'ot_Ref05', `Competency`.`ot_Ref06` as 'ot_Ref06', `Competency`.`ot_Photo01` as 'ot_Photo01', `Competency`.`ot_Photo02` as 'ot_Photo02', `Competency`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Competency`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Competency`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Competency`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Competency`.`ot_ap_filed`,date_format(`Competency`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Competency`.`ot_ap_lastmodified`,date_format(`Competency`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Training' => "`Training`.`TrainingID` as 'TrainingID', `Training`.`TraningNo` as 'TraningNo', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'EmployeeID', IF(    CHAR_LENGTH(`ProjectTeam1`.`EmpNo`) || CHAR_LENGTH(`ProjectTeam1`.`Name`), CONCAT_WS('',   `ProjectTeam1`.`EmpNo`, '; ', `ProjectTeam1`.`Name`), '') as 'ProjectTeamID', `Training`.`fo_TrainingSession` as 'fo_TrainingSession', `Training`.`fo_Classification` as 'fo_Classification', `Training`.`fo_Description` as 'fo_Description', if(`Training`.`fo_Date`,date_format(`Training`.`fo_Date`,'%m/%d/%Y'),'') as 'fo_Date', CONCAT_WS('-', LEFT(`Training`.`ot_FileLoc`,3), MID(`Training`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Training`.`ot_otherdetails` as 'ot_otherdetails', `Training`.`ot_comments` as 'ot_comments', `Training`.`ot_SharedLink1` as 'ot_SharedLink1', `Training`.`ot_SharedLink2` as 'ot_SharedLink2', `Training`.`ot_Location` as 'ot_Location', `Training`.`ot_Ref01` as 'ot_Ref01', `Training`.`ot_Ref02` as 'ot_Ref02', `Training`.`ot_Ref03` as 'ot_Ref03', `Training`.`ot_Ref04` as 'ot_Ref04', `Training`.`ot_Ref05` as 'ot_Ref05', `Training`.`ot_Ref06` as 'ot_Ref06', `Training`.`ot_Photo01` as 'ot_Photo01', `Training`.`ot_Photo02` as 'ot_Photo02', `Training`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Training`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Training`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Training`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Training`.`ot_ap_filed`,date_format(`Training`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Training`.`ot_ap_lastmodified`,date_format(`Training`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'JD_JS' => "`JD_JS`.`id` as 'id', `JD_JS`.`RecordNumber` as 'RecordNumber', `JD_JS`.`DocItem` as 'DocItem', `JD_JS`.`fo_DocumentDescription` as 'fo_DocumentDescription', `JD_JS`.`fo_Classification` as 'fo_Classification', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'fo_EmployeeID', IF(    CHAR_LENGTH(`ProjectTeam1`.`EmpNo`) || CHAR_LENGTH(`ProjectTeam1`.`Name`), CONCAT_WS('',   `ProjectTeam1`.`EmpNo`, '; ', `ProjectTeam1`.`Name`), '') as 'fo_ProjectTeamID', `JD_JS`.`fo_JDDesc` as 'fo_JDDesc', CONCAT_WS('-', LEFT(`JD_JS`.`ot_FileLoc`,3), MID(`JD_JS`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `JD_JS`.`ot_otherdetails` as 'ot_otherdetails', `JD_JS`.`ot_comments` as 'ot_comments', `JD_JS`.`ot_SharedLink1` as 'ot_SharedLink1', `JD_JS`.`ot_SharedLink2` as 'ot_SharedLink2', `JD_JS`.`ot_Ref01` as 'ot_Ref01', `JD_JS`.`ot_Ref02` as 'ot_Ref02', `JD_JS`.`ot_Ref03` as 'ot_Ref03', `JD_JS`.`ot_Ref04` as 'ot_Ref04', `JD_JS`.`ot_Ref05` as 'ot_Ref05', `JD_JS`.`ot_Ref06` as 'ot_Ref06', `JD_JS`.`ot_Photo01` as 'ot_Photo01', `JD_JS`.`ot_Photo02` as 'ot_Photo02', `JD_JS`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `JD_JS`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `JD_JS`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `JD_JS`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`JD_JS`.`ot_ap_filed`,date_format(`JD_JS`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`JD_JS`.`ot_ap_lastmodified`,date_format(`JD_JS`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'InOutRegister' => "`InOutRegister`.`id` as 'id', `InOutRegister`.`RecordNumber` as 'RecordNumber', `InOutRegister`.`DocItem` as 'DocItem', `InOutRegister`.`fo_DocumentDescription` as 'fo_DocumentDescription', `InOutRegister`.`fo_Classification` as 'fo_Classification', if(`InOutRegister`.`fo_Delivdate`,date_format(`InOutRegister`.`fo_Delivdate`,'%m/%d/%Y'),'') as 'fo_Delivdate', CONCAT_WS('-', LEFT(`InOutRegister`.`ot_FileLoc`,3), MID(`InOutRegister`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `InOutRegister`.`ot_otherdetails` as 'ot_otherdetails', `InOutRegister`.`ot_comments` as 'ot_comments', `InOutRegister`.`ot_SharedLink1` as 'ot_SharedLink1', `InOutRegister`.`ot_SharedLink2` as 'ot_SharedLink2', `InOutRegister`.`ot_Ref01` as 'ot_Ref01', `InOutRegister`.`ot_Ref02` as 'ot_Ref02', `InOutRegister`.`ot_Ref03` as 'ot_Ref03', `InOutRegister`.`ot_Ref04` as 'ot_Ref04', `InOutRegister`.`ot_Ref05` as 'ot_Ref05', `InOutRegister`.`ot_Ref06` as 'ot_Ref06', `InOutRegister`.`ot_Photo01` as 'ot_Photo01', `InOutRegister`.`ot_Photo02` as 'ot_Photo02', `InOutRegister`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `InOutRegister`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `InOutRegister`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `InOutRegister`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`InOutRegister`.`ot_ap_filed`,date_format(`InOutRegister`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`InOutRegister`.`ot_ap_lastmodified`,date_format(`InOutRegister`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'vendor' => "`vendor`.`VendorID` as 'VendorID', `vendor`.`CompanyID` as 'CompanyID', `vendor`.`CopanyName` as 'CopanyName', `vendor`.`fo_AVList` as 'fo_AVList', `vendor`.`fo_ContactTitle` as 'fo_ContactTitle', `vendor`.`fo_Address` as 'fo_Address', `vendor`.`fo_City` as 'fo_City', `vendor`.`fo_Region` as 'fo_Region', `vendor`.`fo_PostalCode` as 'fo_PostalCode', `vendor`.`fo_Country` as 'fo_Country', `vendor`.`fo_Phone` as 'fo_Phone', `vendor`.`fo_Fax` as 'fo_Fax', `vendor`.`fo_HomePage` as 'fo_HomePage', CONCAT_WS('-', LEFT(`vendor`.`ot_FileLoc`,3), MID(`vendor`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `vendor`.`ot_otherdetails` as 'ot_otherdetails', `vendor`.`ot_comments` as 'ot_comments', `vendor`.`ot_SharedLink1` as 'ot_SharedLink1', `vendor`.`ot_SharedLink2` as 'ot_SharedLink2', `vendor`.`ot_Ref01` as 'ot_Ref01', `vendor`.`ot_Ref02` as 'ot_Ref02', `vendor`.`ot_Ref03` as 'ot_Ref03', `vendor`.`ot_Ref04` as 'ot_Ref04', `vendor`.`ot_Ref05` as 'ot_Ref05', `vendor`.`ot_Ref06` as 'ot_Ref06', `vendor`.`ot_Photo01` as 'ot_Photo01', `vendor`.`ot_Photo02` as 'ot_Photo02', `vendor`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `vendor`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `vendor`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `vendor`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`vendor`.`ot_ap_filed`,date_format(`vendor`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`vendor`.`ot_ap_lastmodified`,date_format(`vendor`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ManagingVendor' => "`ManagingVendor`.`id` as 'id', `ManagingVendor`.`ManagingVendNumber` as 'ManagingVendNumber', `ManagingVendor`.`DocItem` as 'DocItem', IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') as 'fo_VendorID', `ManagingVendor`.`fo_DocumentDescription` as 'fo_DocumentDescription', `ManagingVendor`.`fo_Classification` as 'fo_Classification', if(`ManagingVendor`.`fo_Auditdate`,date_format(`ManagingVendor`.`fo_Auditdate`,'%m/%d/%Y'),'') as 'fo_Auditdate', `ManagingVendor`.`fo_image` as 'fo_image', `ManagingVendor`.`fo_address` as 'fo_address', `ManagingVendor`.`fo_city` as 'fo_city', `ManagingVendor`.`fo_state` as 'fo_state', `ManagingVendor`.`fo_zip` as 'fo_zip', CONCAT_WS('-', LEFT(`ManagingVendor`.`fo_workphone`,3), MID(`ManagingVendor`.`fo_workphone`,4,3), RIGHT(`ManagingVendor`.`fo_workphone`,4)) as 'fo_workphone', CONCAT_WS('-', LEFT(`ManagingVendor`.`fo_mobile`,3), MID(`ManagingVendor`.`fo_mobile`,4,3)) as 'fo_mobile', `ManagingVendor`.`fo_contactperson` as 'fo_contactperson', CONCAT_WS('-', LEFT(`ManagingVendor`.`ot_FileLoc`,3), MID(`ManagingVendor`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ManagingVendor`.`ot_otherdetails` as 'ot_otherdetails', `ManagingVendor`.`ot_comments` as 'ot_comments', `ManagingVendor`.`ot_SharedLink1` as 'ot_SharedLink1', `ManagingVendor`.`ot_SharedLink2` as 'ot_SharedLink2', `ManagingVendor`.`ot_Ref01` as 'ot_Ref01', `ManagingVendor`.`ot_Ref02` as 'ot_Ref02', `ManagingVendor`.`ot_Ref03` as 'ot_Ref03', `ManagingVendor`.`ot_Ref04` as 'ot_Ref04', `ManagingVendor`.`ot_Ref05` as 'ot_Ref05', `ManagingVendor`.`ot_Ref06` as 'ot_Ref06', `ManagingVendor`.`ot_Photo01` as 'ot_Photo01', `ManagingVendor`.`ot_Photo02` as 'ot_Photo02', `ManagingVendor`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ManagingVendor`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ManagingVendor`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ManagingVendor`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ManagingVendor`.`ot_ap_filed`,date_format(`ManagingVendor`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ManagingVendor`.`ot_ap_lastmodified`,date_format(`ManagingVendor`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'VenPerformance' => "`VenPerformance`.`id` as 'id', `VenPerformance`.`VendPerfNumber` as 'VendPerfNumber', `VenPerformance`.`DocItem` as 'DocItem', IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') as 'fo_SupplierID', `VenPerformance`.`fo_NewList` as 'fo_NewList', `VenPerformance`.`fo_DocumentDescription` as 'fo_DocumentDescription', `VenPerformance`.`fo_Classification` as 'fo_Classification', if(`VenPerformance`.`fo_Perfdate`,date_format(`VenPerformance`.`fo_Perfdate`,'%m/%d/%Y'),'') as 'fo_Perfdate', `VenPerformance`.`fo_image` as 'fo_image', `VenPerformance`.`fo_address` as 'fo_address', `VenPerformance`.`fo_city` as 'fo_city', `VenPerformance`.`fo_state` as 'fo_state', `VenPerformance`.`fo_zip` as 'fo_zip', CONCAT_WS('-', LEFT(`VenPerformance`.`fo_workphone`,3), MID(`VenPerformance`.`fo_workphone`,4,3), RIGHT(`VenPerformance`.`fo_workphone`,4)) as 'fo_workphone', CONCAT_WS('-', LEFT(`VenPerformance`.`fo_mobile`,3), MID(`VenPerformance`.`fo_mobile`,4,3)) as 'fo_mobile', `VenPerformance`.`fo_contactperson` as 'fo_contactperson', CONCAT_WS('-', LEFT(`VenPerformance`.`ot_FileLoc`,3), MID(`VenPerformance`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `VenPerformance`.`ot_otherdetails` as 'ot_otherdetails', `VenPerformance`.`ot_comments` as 'ot_comments', `VenPerformance`.`ot_SharedLink1` as 'ot_SharedLink1', `VenPerformance`.`ot_SharedLink2` as 'ot_SharedLink2', `VenPerformance`.`ot_Ref01` as 'ot_Ref01', `VenPerformance`.`ot_Ref02` as 'ot_Ref02', `VenPerformance`.`ot_Ref03` as 'ot_Ref03', `VenPerformance`.`ot_Ref04` as 'ot_Ref04', `VenPerformance`.`ot_Ref05` as 'ot_Ref05', `VenPerformance`.`ot_Ref06` as 'ot_Ref06', `VenPerformance`.`ot_Photo01` as 'ot_Photo01', `VenPerformance`.`ot_Photo02` as 'ot_Photo02', `VenPerformance`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `VenPerformance`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `VenPerformance`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `VenPerformance`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`VenPerformance`.`ot_ap_filed`,date_format(`VenPerformance`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`VenPerformance`.`ot_ap_lastmodified`,date_format(`VenPerformance`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Logistics' => "`Logistics`.`ShipperID` as 'ShipperID', `Logistics`.`LogisticID` as 'LogisticID', `Logistics`.`CompanyName` as 'CompanyName', `Logistics`.`fo_AVList` as 'fo_AVList', `Logistics`.`fo_Phone` as 'fo_Phone', CONCAT_WS('-', LEFT(`Logistics`.`ot_FileLoc`,3), MID(`Logistics`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Logistics`.`ot_otherdetails` as 'ot_otherdetails', `Logistics`.`ot_comments` as 'ot_comments', `Logistics`.`ot_SharedLink1` as 'ot_SharedLink1', `Logistics`.`ot_SharedLink2` as 'ot_SharedLink2', `Logistics`.`ot_Ref01` as 'ot_Ref01', `Logistics`.`ot_Ref02` as 'ot_Ref02', `Logistics`.`ot_Ref03` as 'ot_Ref03', `Logistics`.`ot_Ref04` as 'ot_Ref04', `Logistics`.`ot_Ref05` as 'ot_Ref05', `Logistics`.`ot_Ref06` as 'ot_Ref06', `Logistics`.`ot_Photo01` as 'ot_Photo01', `Logistics`.`ot_Photo02` as 'ot_Photo02', `Logistics`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Logistics`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Logistics`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Logistics`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Logistics`.`ot_ap_filed`,date_format(`Logistics`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Logistics`.`ot_ap_last_modified`,date_format(`Logistics`.`ot_ap_last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_last_modified'",
			'Inventory' => "`Inventory`.`id` as 'id', `Inventory`.`InventoryID` as 'InventoryID', `Inventory`.`asset_title` as 'asset_title', `Inventory`.`Description` as 'Description', `Inventory`.`fo_Type` as 'fo_Type', `Inventory`.`fo_Manufacturer` as 'fo_Manufacturer', `Inventory`.`fo_ModelNumber` as 'fo_ModelNumber', `Inventory`.`fo_SerialNumber` as 'fo_SerialNumber', `Inventory`.`fo_Condition` as 'fo_Condition', `Inventory`.`fo_history` as 'fo_history', `Inventory`.`fo_Quantity` as 'fo_Quantity', CONCAT('$', FORMAT(`Inventory`.`fo_UnitPrice`, 2)) as 'fo_UnitPrice', `Inventory`.`fo_Remarks` as 'fo_Remarks', if(`Inventory`.`fo_date`,date_format(`Inventory`.`fo_date`,'%m/%d/%Y'),'') as 'fo_date', CONCAT_WS('-', LEFT(`Inventory`.`fo_ItemLocation`,3), MID(`Inventory`.`fo_ItemLocation`,4,3)) as 'fo_ItemLocation', `Inventory`.`fo_image` as 'fo_image', CONCAT_WS('-', LEFT(`Inventory`.`ot_FileLoc`,3), MID(`Inventory`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Inventory`.`ot_otherdetails` as 'ot_otherdetails', `Inventory`.`ot_comments` as 'ot_comments', `Inventory`.`ot_SharedLink1` as 'ot_SharedLink1', `Inventory`.`ot_SharedLink2` as 'ot_SharedLink2', `Inventory`.`ot_Location` as 'ot_Location', `Inventory`.`ot_Ref01` as 'ot_Ref01', `Inventory`.`ot_Ref02` as 'ot_Ref02', `Inventory`.`ot_Ref03` as 'ot_Ref03', `Inventory`.`ot_Ref04` as 'ot_Ref04', `Inventory`.`ot_Ref05` as 'ot_Ref05', `Inventory`.`ot_Ref06` as 'ot_Ref06', `Inventory`.`ot_Photo01` as 'ot_Photo01', `Inventory`.`ot_Photo02` as 'ot_Photo02', `Inventory`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Inventory`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Inventory`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Inventory`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Inventory`.`ot_ap_filed`,date_format(`Inventory`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Inventory`.`ot_ap_last_modified`,date_format(`Inventory`.`ot_ap_last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_last_modified'",
			'CalibrationCtrl' => "`CalibrationCtrl`.`id` as 'id', `CalibrationCtrl`.`CalibrationID` as 'CalibrationID', `CalibrationCtrl`.`Calibtitle` as 'Calibtitle', IF(    CHAR_LENGTH(`Inventory1`.`InventoryID`) || CHAR_LENGTH(`Inventory1`.`asset_title`), CONCAT_WS('',   `Inventory1`.`InventoryID`, '; ', `Inventory1`.`asset_title`), '') as 'fo_InventoryID', IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '; ', `vendor1`.`CopanyName`), '') as 'fo_CalCom', `CalibrationCtrl`.`fo_DurCal` as 'fo_DurCal', if(`CalibrationCtrl`.`fo_Delivdate`,date_format(`CalibrationCtrl`.`fo_Delivdate`,'%m/%d/%Y'),'') as 'fo_Delivdate', `CalibrationCtrl`.`fo_contact_person` as 'fo_contact_person', CONCAT_WS('-', LEFT(`CalibrationCtrl`.`ot_FileLoc`,3), MID(`CalibrationCtrl`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `CalibrationCtrl`.`ot_otherdetails` as 'ot_otherdetails', `CalibrationCtrl`.`ot_comments` as 'ot_comments', `CalibrationCtrl`.`ot_SharedLink1` as 'ot_SharedLink1', `CalibrationCtrl`.`ot_SharedLink2` as 'ot_SharedLink2', `CalibrationCtrl`.`ot_Ref01` as 'ot_Ref01', `CalibrationCtrl`.`ot_Ref02` as 'ot_Ref02', `CalibrationCtrl`.`ot_Ref03` as 'ot_Ref03', `CalibrationCtrl`.`ot_Ref04` as 'ot_Ref04', `CalibrationCtrl`.`ot_Ref05` as 'ot_Ref05', `CalibrationCtrl`.`ot_Ref06` as 'ot_Ref06', `CalibrationCtrl`.`ot_Photo01` as 'ot_Photo01', `CalibrationCtrl`.`ot_Photo02` as 'ot_Photo02', `CalibrationCtrl`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `CalibrationCtrl`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `CalibrationCtrl`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `CalibrationCtrl`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`CalibrationCtrl`.`ot_ap_filed`,date_format(`CalibrationCtrl`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`CalibrationCtrl`.`ot_ap_lastmodified`,date_format(`CalibrationCtrl`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'WorkOrder' => "`WorkOrder`.`id` as 'id', `WorkOrder`.`WONumber` as 'WONumber', `WorkOrder`.`Task` as 'Task', `WorkOrder`.`fo_Critical` as 'fo_Critical', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'fo_EmployeeID', IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`), '') as 'fo_Position', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '; ', `WorkLocation1`.`DocItem`), '') as 'fo_BaseLocation', `WorkOrder`.`fo_JobInstruction` as 'fo_JobInstruction', `WorkOrder`.`fo_DetailInstruction` as 'fo_DetailInstruction', `WorkOrder`.`fo_Resources` as 'fo_Resources', if(`WorkOrder`.`fo_Duedate`,date_format(`WorkOrder`.`fo_Duedate`,'%m/%d/%Y'),'') as 'fo_Duedate', CONCAT_WS('-', LEFT(`WorkOrder`.`ot_FileLoc`,3), MID(`WorkOrder`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `WorkOrder`.`ot_otherdetails` as 'ot_otherdetails', `WorkOrder`.`ot_comments` as 'ot_comments', `WorkOrder`.`ot_SharedLink1` as 'ot_SharedLink1', `WorkOrder`.`ot_SharedLink2` as 'ot_SharedLink2', `WorkOrder`.`ot_Location` as 'ot_Location', `WorkOrder`.`ot_Ref01` as 'ot_Ref01', `WorkOrder`.`ot_Ref02` as 'ot_Ref02', `WorkOrder`.`ot_Ref03` as 'ot_Ref03', `WorkOrder`.`ot_Ref04` as 'ot_Ref04', `WorkOrder`.`ot_Ref05` as 'ot_Ref05', `WorkOrder`.`ot_Ref06` as 'ot_Ref06', `WorkOrder`.`ot_Photo01` as 'ot_Photo01', `WorkOrder`.`ot_Photo02` as 'ot_Photo02', `WorkOrder`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `WorkOrder`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `WorkOrder`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `WorkOrder`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`WorkOrder`.`ot_ap_filed`,date_format(`WorkOrder`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`WorkOrder`.`ot_ap_lastmodified`,date_format(`WorkOrder`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MWO' => "`MWO`.`id` as 'id', `MWO`.`MWONumber` as 'MWONumber', `MWO`.`Critical` as 'Critical', IF(    CHAR_LENGTH(`Inventory1`.`InventoryID`) || CHAR_LENGTH(`Inventory1`.`asset_title`), CONCAT_WS('',   `Inventory1`.`InventoryID`, '::', `Inventory1`.`asset_title`), '') as 'fo_InventoryID', `MWO`.`fo_Task` as 'fo_Task', `MWO`.`fo_Category` as 'fo_Category', `MWO`.`fo_JobInstruction` as 'fo_JobInstruction', `MWO`.`fo_DetailInstruction` as 'fo_DetailInstruction', `MWO`.`fo_Resources` as 'fo_Resources', if(`MWO`.`fo_Duedate`,date_format(`MWO`.`fo_Duedate`,'%m/%d/%Y'),'') as 'fo_Duedate', CONCAT_WS('-', LEFT(`MWO`.`ot_FileLoc`,3), MID(`MWO`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MWO`.`ot_otherdetails` as 'ot_otherdetails', `MWO`.`ot_comments` as 'ot_comments', `MWO`.`ot_SharedLink1` as 'ot_SharedLink1', `MWO`.`ot_SharedLink2` as 'ot_SharedLink2', `MWO`.`ot_Location` as 'ot_Location', `MWO`.`ot_Ref01` as 'ot_Ref01', `MWO`.`ot_Ref02` as 'ot_Ref02', `MWO`.`ot_Ref03` as 'ot_Ref03', `MWO`.`ot_Ref04` as 'ot_Ref04', `MWO`.`ot_Ref05` as 'ot_Ref05', `MWO`.`ot_Ref06` as 'ot_Ref06', `MWO`.`ot_Photo01` as 'ot_Photo01', `MWO`.`ot_Photo02` as 'ot_Photo02', `MWO`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MWO`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MWO`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MWO`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MWO`.`ot_ap_filed`,date_format(`MWO`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MWO`.`ot_ap_lastmodified`,date_format(`MWO`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MWOPlanned' => "`MWOPlanned`.`WMOPlannedID` as 'WMOPlannedID', `MWOPlanned`.`PlannedID` as 'PlannedID', IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') as 'MwoID', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'fo_EmployeeID', IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`, ' '), '') as 'fo_Position', CONCAT_WS('-', LEFT(`MWOPlanned`.`ot_FileLoc`,3), MID(`MWOPlanned`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MWOPlanned`.`ot_otherdetails` as 'ot_otherdetails', `MWOPlanned`.`ot_comments` as 'ot_comments', `MWOPlanned`.`ot_SharedLink1` as 'ot_SharedLink1', `MWOPlanned`.`ot_SharedLink2` as 'ot_SharedLink2', `MWOPlanned`.`ot_Location` as 'ot_Location', `MWOPlanned`.`ot_Ref01` as 'ot_Ref01', `MWOPlanned`.`ot_Ref02` as 'ot_Ref02', `MWOPlanned`.`ot_Ref03` as 'ot_Ref03', `MWOPlanned`.`ot_Ref04` as 'ot_Ref04', `MWOPlanned`.`ot_Ref05` as 'ot_Ref05', `MWOPlanned`.`ot_Ref06` as 'ot_Ref06', `MWOPlanned`.`ot_Photo01` as 'ot_Photo01', `MWOPlanned`.`ot_Photo02` as 'ot_Photo02', `MWOPlanned`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MWOPlanned`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MWOPlanned`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MWOPlanned`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MWOPlanned`.`ot_ap_filed`,date_format(`MWOPlanned`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MWOPlanned`.`ot_ap_lastmodified`,date_format(`MWOPlanned`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MWOpreventive' => "`MWOpreventive`.`id` as 'id', `MWOpreventive`.`PreventiveID` as 'PreventiveID', IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') as 'MwoID', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'fo_EmployeeID', IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`), '') as 'fo_Position', CONCAT_WS('-', LEFT(`MWOpreventive`.`ot_FileLoc`,3), MID(`MWOpreventive`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MWOpreventive`.`ot_otherdetails` as 'ot_otherdetails', `MWOpreventive`.`ot_comments` as 'ot_comments', `MWOpreventive`.`ot_SharedLink1` as 'ot_SharedLink1', `MWOpreventive`.`ot_SharedLink2` as 'ot_SharedLink2', `MWOpreventive`.`ot_Location` as 'ot_Location', `MWOpreventive`.`ot_Ref01` as 'ot_Ref01', `MWOpreventive`.`ot_Ref02` as 'ot_Ref02', `MWOpreventive`.`ot_Ref03` as 'ot_Ref03', `MWOpreventive`.`ot_Ref04` as 'ot_Ref04', `MWOpreventive`.`ot_Ref05` as 'ot_Ref05', `MWOpreventive`.`ot_Ref06` as 'ot_Ref06', `MWOpreventive`.`ot_Photo01` as 'ot_Photo01', `MWOpreventive`.`ot_Photo02` as 'ot_Photo02', `MWOpreventive`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MWOpreventive`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MWOpreventive`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MWOpreventive`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MWOpreventive`.`ot_ap_filed`,date_format(`MWOpreventive`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MWOpreventive`.`ot_ap_lastmodified`,date_format(`MWOpreventive`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MWOproactive' => "`MWOproactive`.`id` as 'id', `MWOproactive`.`ProactiveID` as 'ProactiveID', IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') as 'MwoID', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'fo_EmployeeID', IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`), '') as 'fo_Position', CONCAT_WS('-', LEFT(`MWOproactive`.`ot_FileLoc`,3), MID(`MWOproactive`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MWOproactive`.`ot_otherdetails` as 'ot_otherdetails', `MWOproactive`.`ot_comments` as 'ot_comments', `MWOproactive`.`ot_SharedLink1` as 'ot_SharedLink1', `MWOproactive`.`ot_SharedLink2` as 'ot_SharedLink2', `MWOproactive`.`ot_Location` as 'ot_Location', `MWOproactive`.`ot_Ref01` as 'ot_Ref01', `MWOproactive`.`ot_Ref02` as 'ot_Ref02', `MWOproactive`.`ot_Ref03` as 'ot_Ref03', `MWOproactive`.`ot_Ref04` as 'ot_Ref04', `MWOproactive`.`ot_Ref05` as 'ot_Ref05', `MWOproactive`.`ot_Ref06` as 'ot_Ref06', `MWOproactive`.`ot_Photo01` as 'ot_Photo01', `MWOproactive`.`ot_Photo02` as 'ot_Photo02', `MWOproactive`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MWOproactive`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MWOproactive`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MWOproactive`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MWOproactive`.`ot_ap_filed`,date_format(`MWOproactive`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MWOproactive`.`ot_ap_lastmodified`,date_format(`MWOproactive`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MWConditionBased' => "`MWConditionBased`.`id` as 'id', `MWConditionBased`.`CondBaseID` as 'CondBaseID', IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') as 'MwoID', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'fo_EmployeeID', IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`), '') as 'fo_Position', CONCAT_WS('-', LEFT(`MWConditionBased`.`ot_FileLoc`,3), MID(`MWConditionBased`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MWConditionBased`.`ot_otherdetails` as 'ot_otherdetails', `MWConditionBased`.`ot_comments` as 'ot_comments', `MWConditionBased`.`ot_SharedLink1` as 'ot_SharedLink1', `MWConditionBased`.`ot_SharedLink2` as 'ot_SharedLink2', `MWConditionBased`.`ot_Location` as 'ot_Location', `MWConditionBased`.`ot_Ref01` as 'ot_Ref01', `MWConditionBased`.`ot_Ref02` as 'ot_Ref02', `MWConditionBased`.`ot_Ref03` as 'ot_Ref03', `MWConditionBased`.`ot_Ref04` as 'ot_Ref04', `MWConditionBased`.`ot_Ref05` as 'ot_Ref05', `MWConditionBased`.`ot_Ref06` as 'ot_Ref06', `MWConditionBased`.`ot_Photo01` as 'ot_Photo01', `MWConditionBased`.`ot_Photo02` as 'ot_Photo02', `MWConditionBased`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MWConditionBased`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MWConditionBased`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MWConditionBased`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MWConditionBased`.`ot_ap_filed`,date_format(`MWConditionBased`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MWConditionBased`.`ot_ap_lastmodified`,date_format(`MWConditionBased`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MWOReactive' => "`MWOReactive`.`id` as 'id', `MWOReactive`.`ReactiveID` as 'ReactiveID', IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') as 'MwoID', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'fo_EmployeeID', IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`), '') as 'fo_Position', CONCAT_WS('-', LEFT(`MWOReactive`.`ot_FileLoc`,3), MID(`MWOReactive`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MWOReactive`.`ot_otherdetails` as 'ot_otherdetails', `MWOReactive`.`ot_comments` as 'ot_comments', `MWOReactive`.`ot_SharedLink1` as 'ot_SharedLink1', `MWOReactive`.`ot_SharedLink2` as 'ot_SharedLink2', `MWOReactive`.`ot_Location` as 'ot_Location', `MWOReactive`.`ot_Ref01` as 'ot_Ref01', `MWOReactive`.`ot_Ref02` as 'ot_Ref02', `MWOReactive`.`ot_Ref03` as 'ot_Ref03', `MWOReactive`.`ot_Ref04` as 'ot_Ref04', `MWOReactive`.`ot_Ref05` as 'ot_Ref05', `MWOReactive`.`ot_Ref06` as 'ot_Ref06', `MWOReactive`.`ot_Photo01` as 'ot_Photo01', `MWOReactive`.`ot_Photo02` as 'ot_Photo02', `MWOReactive`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MWOReactive`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MWOReactive`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MWOReactive`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MWOReactive`.`ot_ap_filed`,date_format(`MWOReactive`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MWOReactive`.`ot_ap_lastmodified`,date_format(`MWOReactive`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MWOCorrective' => "`MWOCorrective`.`id` as 'id', `MWOCorrective`.`CorrectiveID` as 'CorrectiveID', IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') as 'MwoID', IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') as 'fo_EmployeeID', IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`), '') as 'fo_Position', CONCAT_WS('-', LEFT(`MWOCorrective`.`ot_FileLoc`,3), MID(`MWOCorrective`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MWOCorrective`.`ot_otherdetails` as 'ot_otherdetails', `MWOCorrective`.`ot_comments` as 'ot_comments', `MWOCorrective`.`ot_SharedLink1` as 'ot_SharedLink1', `MWOCorrective`.`ot_SharedLink2` as 'ot_SharedLink2', `MWOCorrective`.`ot_Location` as 'ot_Location', `MWOCorrective`.`ot_Ref01` as 'ot_Ref01', `MWOCorrective`.`ot_Ref02` as 'ot_Ref02', `MWOCorrective`.`ot_Ref03` as 'ot_Ref03', `MWOCorrective`.`ot_Ref04` as 'ot_Ref04', `MWOCorrective`.`ot_Ref05` as 'ot_Ref05', `MWOCorrective`.`ot_Ref06` as 'ot_Ref06', `MWOCorrective`.`ot_Photo01` as 'ot_Photo01', `MWOCorrective`.`ot_Photo02` as 'ot_Photo02', `MWOCorrective`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MWOCorrective`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MWOCorrective`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MWOCorrective`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MWOCorrective`.`ot_ap_filed`,date_format(`MWOCorrective`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MWOCorrective`.`ot_ap_lastmodified`,date_format(`MWOCorrective`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'LogisticRequest' => "`LogisticRequest`.`id` as 'id', `LogisticRequest`.`LogisticNumber` as 'LogisticNumber', `LogisticRequest`.`Market_Survey` as 'Market_Survey', IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '; ', `resources1`.`Name`), '') as 'fo_ResourcesID', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '; ', `projects1`.`Name`), '') as 'fo_ProjectID', IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') as 'fo_ShipVia', if(`LogisticRequest`.`fo_Deliverydate`,date_format(`LogisticRequest`.`fo_Deliverydate`,'%m/%d/%Y'),'') as 'fo_Deliverydate', `LogisticRequest`.`fo_address` as 'fo_address', `LogisticRequest`.`fo_city` as 'fo_city', `LogisticRequest`.`fo_zip` as 'fo_zip', `LogisticRequest`.`fo_Countrys` as 'fo_Countrys', CONCAT_WS('-', LEFT(`LogisticRequest`.`fo_homephone`,3), MID(`LogisticRequest`.`fo_homephone`,4,3), RIGHT(`LogisticRequest`.`fo_homephone`,4)) as 'fo_homephone', CONCAT_WS('-', LEFT(`LogisticRequest`.`fo_workphone`,3), MID(`LogisticRequest`.`fo_workphone`,4,3), RIGHT(`LogisticRequest`.`fo_workphone`,4)) as 'fo_workphone', `LogisticRequest`.`fo_contactperson` as 'fo_contactperson', CONCAT_WS('-', LEFT(`LogisticRequest`.`ot_FileLoc`,3), MID(`LogisticRequest`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `LogisticRequest`.`ot_otherdetails` as 'ot_otherdetails', `LogisticRequest`.`ot_comments` as 'ot_comments', `LogisticRequest`.`ot_SharedLink1` as 'ot_SharedLink1', `LogisticRequest`.`ot_SharedLink2` as 'ot_SharedLink2', `LogisticRequest`.`ot_Ref01` as 'ot_Ref01', `LogisticRequest`.`ot_Ref02` as 'ot_Ref02', `LogisticRequest`.`ot_Ref03` as 'ot_Ref03', `LogisticRequest`.`ot_Ref04` as 'ot_Ref04', `LogisticRequest`.`ot_Ref05` as 'ot_Ref05', `LogisticRequest`.`ot_Ref06` as 'ot_Ref06', `LogisticRequest`.`ot_Photo01` as 'ot_Photo01', `LogisticRequest`.`ot_Photo02` as 'ot_Photo02', `LogisticRequest`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `LogisticRequest`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `LogisticRequest`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `LogisticRequest`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`LogisticRequest`.`ot_ap_filed`,date_format(`LogisticRequest`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`LogisticRequest`.`ot_ap_lastmodified`,date_format(`LogisticRequest`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'orders' => "`orders`.`id` as 'id', `orders`.`OrderID` as 'OrderID', `orders`.`Market_Survey` as 'Market_Survey', `orders`.`fo_Classification` as 'fo_Classification', `orders`.`fo_Critical` as 'fo_Critical', `orders`.`fo_Justification` as 'fo_Justification', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') as 'fo_ProjectID', IF(    CHAR_LENGTH(`Inventory1`.`InventoryID`) || CHAR_LENGTH(`Inventory1`.`asset_title`), CONCAT_WS('',   `Inventory1`.`InventoryID`, '::', `Inventory1`.`asset_title`), '') as 'fo_InventoryID', IF(    CHAR_LENGTH(`Item1`.`ItemID`) || CHAR_LENGTH(`Item1`.`ProductName`), CONCAT_WS('',   `Item1`.`ItemID`, '::', `Item1`.`ProductName`), '') as 'fo_ItemID', IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') as 'fo_ProductID', `orders`.`fo_Description` as 'fo_Description', `orders`.`fo_Detail` as 'fo_Detail', if(`orders`.`fo_OrderDate`,date_format(`orders`.`fo_OrderDate`,'%m/%d/%Y'),'') as 'fo_OrderDate', if(`orders`.`fo_RequiredDate`,date_format(`orders`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', if(`orders`.`fo_ShippedDate`,date_format(`orders`.`fo_ShippedDate`,'%m/%d/%Y'),'') as 'fo_ShippedDate', IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '; ', `Logistics1`.`CompanyName`), '') as 'fo_ShipVia', CONCAT_WS('-', LEFT(`orders`.`ot_FileLoc`,3), MID(`orders`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `orders`.`ot_otherdetails` as 'ot_otherdetails', `orders`.`ot_comments` as 'ot_comments', `orders`.`ot_SharedLink1` as 'ot_SharedLink1', `orders`.`ot_SharedLink2` as 'ot_SharedLink2', `orders`.`ot_Ref01` as 'ot_Ref01', `orders`.`ot_Ref02` as 'ot_Ref02', `orders`.`ot_Ref03` as 'ot_Ref03', `orders`.`ot_Ref04` as 'ot_Ref04', `orders`.`ot_Ref05` as 'ot_Ref05', `orders`.`ot_Ref06` as 'ot_Ref06', `orders`.`ot_Photo01` as 'ot_Photo01', `orders`.`ot_Photo02` as 'ot_Photo02', `orders`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `orders`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `orders`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `orders`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`orders`.`ot_ap_filed`,date_format(`orders`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`orders`.`ot_ap_lastmodified`,date_format(`orders`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Quotation' => "`Quotation`.`id` as 'id', `Quotation`.`QuoID` as 'QuoID', IF(    CHAR_LENGTH(`orders1`.`OrderID`), CONCAT_WS('',   `orders1`.`OrderID`), '') as 'OrderID', IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') as 'fo_Vendor', IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') as 'fo_ShipVia', CONCAT('$', FORMAT(`Quotation`.`fo_Price`, 2)) as 'fo_Price', `Quotation`.`fo_Description` as 'fo_Description', CONCAT('$', FORMAT(`Quotation`.`fo_Discount`, 2)) as 'fo_Discount', CONCAT_WS('-', LEFT(`Quotation`.`ot_FileLoc`,3), MID(`Quotation`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Quotation`.`ot_otherdetails` as 'ot_otherdetails', `Quotation`.`ot_comments` as 'ot_comments', `Quotation`.`ot_SharedLink1` as 'ot_SharedLink1', `Quotation`.`ot_SharedLink2` as 'ot_SharedLink2', `Quotation`.`ot_Ref01` as 'ot_Ref01', `Quotation`.`ot_Ref02` as 'ot_Ref02', `Quotation`.`ot_Ref03` as 'ot_Ref03', `Quotation`.`ot_Ref04` as 'ot_Ref04', `Quotation`.`ot_Ref05` as 'ot_Ref05', `Quotation`.`ot_Ref06` as 'ot_Ref06', `Quotation`.`ot_Photo01` as 'ot_Photo01', `Quotation`.`ot_Photo02` as 'ot_Photo02', `Quotation`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Quotation`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Quotation`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Quotation`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Quotation`.`ot_ap_filed`,date_format(`Quotation`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Quotation`.`ot_ap_last_modified`,date_format(`Quotation`.`ot_ap_last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_last_modified'",
			'PurchaseOrder' => "`PurchaseOrder`.`id` as 'id', `PurchaseOrder`.`POID` as 'POID', IF(    CHAR_LENGTH(`orders1`.`OrderID`), CONCAT_WS('',   `orders1`.`OrderID`), '') as 'OrderID', IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') as 'fo_Vendor', IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') as 'fo_ShipVia', CONCAT('$', FORMAT(`PurchaseOrder`.`fo_Price`, 2)) as 'fo_Price', `PurchaseOrder`.`fo_Description` as 'fo_Description', CONCAT('$', FORMAT(`PurchaseOrder`.`fo_Discount`, 2)) as 'fo_Discount', CONCAT_WS('-', LEFT(`PurchaseOrder`.`ot_FileLoc`,3), MID(`PurchaseOrder`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `PurchaseOrder`.`ot_otherdetails` as 'ot_otherdetails', `PurchaseOrder`.`ot_comments` as 'ot_comments', `PurchaseOrder`.`ot_SharedLink1` as 'ot_SharedLink1', `PurchaseOrder`.`ot_SharedLink2` as 'ot_SharedLink2', `PurchaseOrder`.`ot_Ref01` as 'ot_Ref01', `PurchaseOrder`.`ot_Ref02` as 'ot_Ref02', `PurchaseOrder`.`ot_Ref03` as 'ot_Ref03', `PurchaseOrder`.`ot_Ref04` as 'ot_Ref04', `PurchaseOrder`.`ot_Ref05` as 'ot_Ref05', `PurchaseOrder`.`ot_Ref06` as 'ot_Ref06', `PurchaseOrder`.`ot_Photo01` as 'ot_Photo01', `PurchaseOrder`.`ot_Photo02` as 'ot_Photo02', `PurchaseOrder`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `PurchaseOrder`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `PurchaseOrder`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `PurchaseOrder`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`PurchaseOrder`.`ot_ap_filed`,date_format(`PurchaseOrder`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`PurchaseOrder`.`ot_ap_lastmodified`,date_format(`PurchaseOrder`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'DeliveryOrder' => "`DeliveryOrder`.`id` as 'id', `DeliveryOrder`.`DOID` as 'DOID', IF(    CHAR_LENGTH(`orders1`.`OrderID`), CONCAT_WS('',   `orders1`.`OrderID`), '') as 'OrderID', IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') as 'fo_Vendor', IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') as 'fo_ShipVia', `DeliveryOrder`.`fo_Description` as 'fo_Description', CONCAT_WS('-', LEFT(`DeliveryOrder`.`ot_FileLoc`,3), MID(`DeliveryOrder`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `DeliveryOrder`.`ot_otherdetails` as 'ot_otherdetails', `DeliveryOrder`.`ot_comments` as 'ot_comments', `DeliveryOrder`.`ot_SharedLink1` as 'ot_SharedLink1', `DeliveryOrder`.`ot_SharedLink2` as 'ot_SharedLink2', `DeliveryOrder`.`ot_Location` as 'ot_Location', `DeliveryOrder`.`ot_Ref01` as 'ot_Ref01', `DeliveryOrder`.`ot_Ref02` as 'ot_Ref02', `DeliveryOrder`.`ot_Ref03` as 'ot_Ref03', `DeliveryOrder`.`ot_Ref04` as 'ot_Ref04', `DeliveryOrder`.`ot_Ref05` as 'ot_Ref05', `DeliveryOrder`.`ot_Ref06` as 'ot_Ref06', `DeliveryOrder`.`ot_Photo01` as 'ot_Photo01', `DeliveryOrder`.`ot_Photo02` as 'ot_Photo02', `DeliveryOrder`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `DeliveryOrder`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `DeliveryOrder`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `DeliveryOrder`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`DeliveryOrder`.`ot_ap_filed`,date_format(`DeliveryOrder`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`DeliveryOrder`.`ot_ap_lastmodified`,date_format(`DeliveryOrder`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'AccountPayables' => "`AccountPayables`.`id` as 'id', `AccountPayables`.`APID` as 'APID', IF(    CHAR_LENGTH(`orders1`.`OrderID`), CONCAT_WS('',   `orders1`.`OrderID`), '') as 'OrderID', IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') as 'fo_Vendor', IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') as 'fo_ShipVia', CONCAT('$', FORMAT(`AccountPayables`.`fo_UnitPrice`, 2)) as 'fo_UnitPrice', `AccountPayables`.`fo_Description` as 'fo_Description', CONCAT('$', FORMAT(`AccountPayables`.`fo_Discount`, 2)) as 'fo_Discount', CONCAT_WS('-', LEFT(`AccountPayables`.`ot_FileLoc`,3), MID(`AccountPayables`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `AccountPayables`.`ot_otherdetails` as 'ot_otherdetails', `AccountPayables`.`ot_comments` as 'ot_comments', `AccountPayables`.`ot_SharedLink1` as 'ot_SharedLink1', `AccountPayables`.`ot_SharedLink2` as 'ot_SharedLink2', `AccountPayables`.`ot_Ref01` as 'ot_Ref01', `AccountPayables`.`ot_Ref02` as 'ot_Ref02', `AccountPayables`.`ot_Ref03` as 'ot_Ref03', `AccountPayables`.`ot_Ref04` as 'ot_Ref04', `AccountPayables`.`ot_Ref05` as 'ot_Ref05', `AccountPayables`.`ot_Ref06` as 'ot_Ref06', `AccountPayables`.`ot_Photo01` as 'ot_Photo01', `AccountPayables`.`ot_Photo02` as 'ot_Photo02', `AccountPayables`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `AccountPayables`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `AccountPayables`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `AccountPayables`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`AccountPayables`.`ot_ap_filed`,date_format(`AccountPayables`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`AccountPayables`.`ot_ap_lastmodified`,date_format(`AccountPayables`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Item' => "`Item`.`ProductID` as 'ProductID', `Item`.`ItemID` as 'ItemID', `Item`.`ProductName` as 'ProductName', IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') as 'fo_SupplierID', IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') as 'fo_CategoryID', `Item`.`fo_QuantityPerUnit` as 'fo_QuantityPerUnit', CONCAT('$', FORMAT(`Item`.`fo_UnitPrice`, 2)) as 'fo_UnitPrice', `Item`.`fo_UnitsInStock` as 'fo_UnitsInStock', `Item`.`fo_UnitsOnOrder` as 'fo_UnitsOnOrder', `Item`.`fo_ReorderLevel` as 'fo_ReorderLevel', `Item`.`fo_Description` as 'fo_Description', `Item`.`fo_Discontinued` as 'fo_Discontinued', CONCAT_WS('-', LEFT(`Item`.`ot_FileLoc`,3), MID(`Item`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Item`.`ot_otherdetails` as 'ot_otherdetails', `Item`.`ot_comments` as 'ot_comments', `Item`.`ot_SharedLink1` as 'ot_SharedLink1', `Item`.`ot_SharedLink2` as 'ot_SharedLink2', `Item`.`ot_Ref01` as 'ot_Ref01', `Item`.`ot_Ref02` as 'ot_Ref02', `Item`.`ot_Ref03` as 'ot_Ref03', `Item`.`ot_Ref04` as 'ot_Ref04', `Item`.`ot_Ref05` as 'ot_Ref05', `Item`.`ot_Ref06` as 'ot_Ref06', `Item`.`ot_Photo01` as 'ot_Photo01', `Item`.`ot_Photo02` as 'ot_Photo02', `Item`.`ot_Photo03` as 'ot_Photo03', if(`Item`.`ot_ap_filed`,date_format(`Item`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Item`.`ot_ap_lastmodified`,date_format(`Item`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'categories' => "`categories`.`CategoryID` as 'CategoryID', `categories`.`CategoryName` as 'CategoryName', `categories`.`fo_Description` as 'fo_Description', CONCAT_WS('-', LEFT(`categories`.`ot_FileLoc`,3), MID(`categories`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `categories`.`ot_otherdetails` as 'ot_otherdetails', `categories`.`ot_comments` as 'ot_comments', `categories`.`ot_SharedLink1` as 'ot_SharedLink1', `categories`.`ot_SharedLink2` as 'ot_SharedLink2', `categories`.`ot_Ref01` as 'ot_Ref01', `categories`.`ot_Ref02` as 'ot_Ref02', `categories`.`ot_Ref03` as 'ot_Ref03', `categories`.`ot_Ref04` as 'ot_Ref04', `categories`.`ot_Ref05` as 'ot_Ref05', `categories`.`ot_Ref06` as 'ot_Ref06', `categories`.`ot_Picture01` as 'ot_Picture01', `categories`.`ot_Picture02` as 'ot_Picture02', `categories`.`ot_Picture03` as 'ot_Picture03', if(`categories`.`ot_ap_filed`,date_format(`categories`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`categories`.`ot_ap_lastmodified`,date_format(`categories`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'batches' => "`batches`.`id` as 'id', `batches`.`batch_no` as 'batch_no', IF(    CHAR_LENGTH(`Item1`.`ItemID`) || CHAR_LENGTH(`Item1`.`ProductName`), CONCAT_WS('',   `Item1`.`ItemID`, '::', `Item1`.`ProductName`), '') as 'fo_item', IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') as 'fo_suppliers', if(`batches`.`fo_manudate`,date_format(`batches`.`fo_manudate`,'%m/%d/%Y'),'') as 'fo_manudate', if(`batches`.`fo_expdate`,date_format(`batches`.`fo_expdate`,'%m/%d/%Y'),'') as 'fo_expdate', `batches`.`fo_Quantity` as 'fo_Quantity', CONCAT_WS('-', LEFT(`batches`.`ot_FileLoc`,3), MID(`batches`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `batches`.`fo_otherdetails` as 'fo_otherdetails', `batches`.`fo_comments` as 'fo_comments', `batches`.`fo_SharedLink1` as 'fo_SharedLink1', `batches`.`fo_SharedLink2` as 'fo_SharedLink2', `batches`.`fo_Ref01` as 'fo_Ref01', `batches`.`ot_Ref02` as 'ot_Ref02', `batches`.`ot_Ref03` as 'ot_Ref03', `batches`.`ot_Ref04` as 'ot_Ref04', `batches`.`ot_Ref05` as 'ot_Ref05', `batches`.`ot_Ref06` as 'ot_Ref06', `batches`.`ot_Photo01` as 'ot_Photo01', `batches`.`ot_Photo02` as 'ot_Photo02', `batches`.`ot_Photo03` as 'ot_Photo03', if(`batches`.`fo_ap_filed`,date_format(`batches`.`fo_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'fo_ap_filed', if(`batches`.`fo_lastmodified`,date_format(`batches`.`fo_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'fo_lastmodified'",
			'transactions' => "`transactions`.`id` as 'id', `transactions`.`TransCode` as 'TransCode', if(`transactions`.`fo_transaction_date`,date_format(`transactions`.`fo_transaction_date`,'%m/%d/%Y'),'') as 'fo_transaction_date', IF(    CHAR_LENGTH(`Item1`.`ItemID`) || CHAR_LENGTH(`Item1`.`ProductName`), CONCAT_WS('',   `Item1`.`ItemID`, '::', `Item1`.`ProductName`), '') as 'fo_item', IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') as 'fo_ResourcesID', `transactions`.`fo_transactiontype` as 'fo_transactiontype', `transactions`.`fo_quantity` as 'fo_quantity', `transactions`.`ot_FileLoc` as 'ot_FileLoc', `transactions`.`ot_otherdetails` as 'ot_otherdetails', `transactions`.`ot_comments` as 'ot_comments', `transactions`.`ot_SharedLink1` as 'ot_SharedLink1', `transactions`.`ot_SharedLink2` as 'ot_SharedLink2', `transactions`.`ot_Ref01` as 'ot_Ref01', `transactions`.`ot_Ref02` as 'ot_Ref02', `transactions`.`ot_Ref03` as 'ot_Ref03', `transactions`.`ot_Ref04` as 'ot_Ref04', `transactions`.`ot_Ref05` as 'ot_Ref05', `transactions`.`ot_Ref06` as 'ot_Ref06', `transactions`.`ot_Photo01` as 'ot_Photo01', `transactions`.`ot_Photo02` as 'ot_Photo02', `transactions`.`ot_Photo03` as 'ot_Photo03', if(`transactions`.`ot_ap_filed`,date_format(`transactions`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`transactions`.`ot_ap_lastmodified`,date_format(`transactions`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'CommConsParticipate' => "`CommConsParticipate`.`id` as 'id', `CommConsParticipate`.`ccpID` as 'ccpID', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '; ', `WorkLocation1`.`DocItem`), '') as 'WorkLocationID', if(`CommConsParticipate`.`fo_WorkDate`,date_format(`CommConsParticipate`.`fo_WorkDate`,'%m/%d/%Y'),'') as 'fo_WorkDate', if(`CommConsParticipate`.`fo_RequiredDate`,date_format(`CommConsParticipate`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', CONCAT_WS('-', LEFT(`CommConsParticipate`.`ot_FileLoc`,3), MID(`CommConsParticipate`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `CommConsParticipate`.`ot_otherdetails` as 'ot_otherdetails', `CommConsParticipate`.`ot_comments` as 'ot_comments', `CommConsParticipate`.`ot_SharedLink1` as 'ot_SharedLink1', `CommConsParticipate`.`ot_SharedLink2` as 'ot_SharedLink2', `CommConsParticipate`.`ot_Ref01` as 'ot_Ref01', `CommConsParticipate`.`ot_Ref02` as 'ot_Ref02', `CommConsParticipate`.`ot_Ref03` as 'ot_Ref03', `CommConsParticipate`.`ot_Ref04` as 'ot_Ref04', `CommConsParticipate`.`ot_Ref05` as 'ot_Ref05', `CommConsParticipate`.`ot_Ref06` as 'ot_Ref06', `CommConsParticipate`.`ot_Photo01` as 'ot_Photo01', `CommConsParticipate`.`ot_Photo02` as 'ot_Photo02', `CommConsParticipate`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `CommConsParticipate`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `CommConsParticipate`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `CommConsParticipate`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`CommConsParticipate`.`ot_ap_filed`,date_format(`CommConsParticipate`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`CommConsParticipate`.`ot_ap_lastmodified`,date_format(`CommConsParticipate`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ToolBoxMeeting' => "`ToolBoxMeeting`.`id` as 'id', `ToolBoxMeeting`.`tbmID` as 'tbmID', IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') as 'ccpID', `ToolBoxMeeting`.`fo_Desc` as 'fo_Desc', if(`ToolBoxMeeting`.`fo_RequiredDate`,date_format(`ToolBoxMeeting`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', CONCAT_WS('-', LEFT(`ToolBoxMeeting`.`ot_FileLoc`,3), MID(`ToolBoxMeeting`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ToolBoxMeeting`.`ot_otherdetails` as 'ot_otherdetails', `ToolBoxMeeting`.`ot_comments` as 'ot_comments', `ToolBoxMeeting`.`ot_SharedLink1` as 'ot_SharedLink1', `ToolBoxMeeting`.`ot_SharedLink2` as 'ot_SharedLink2', `ToolBoxMeeting`.`ot_Ref01` as 'ot_Ref01', `ToolBoxMeeting`.`ot_Ref02` as 'ot_Ref02', `ToolBoxMeeting`.`ot_Ref03` as 'ot_Ref03', `ToolBoxMeeting`.`ot_Ref04` as 'ot_Ref04', `ToolBoxMeeting`.`ot_Ref05` as 'ot_Ref05', `ToolBoxMeeting`.`ot_Ref06` as 'ot_Ref06', `ToolBoxMeeting`.`ot_Photo01` as 'ot_Photo01', `ToolBoxMeeting`.`ot_Photo02` as 'ot_Photo02', `ToolBoxMeeting`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ToolBoxMeeting`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ToolBoxMeeting`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ToolBoxMeeting`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ToolBoxMeeting`.`ot_ap_filed`,date_format(`ToolBoxMeeting`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ToolBoxMeeting`.`ot_ap_lastmodified`,date_format(`ToolBoxMeeting`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Bi_WeeklyMeeting' => "`Bi_WeeklyMeeting`.`id` as 'id', `Bi_WeeklyMeeting`.`BwmID` as 'BwmID', IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') as 'ccpID', `Bi_WeeklyMeeting`.`fo_Desc` as 'fo_Desc', if(`Bi_WeeklyMeeting`.`fo_RequiredDate`,date_format(`Bi_WeeklyMeeting`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', CONCAT_WS('-', LEFT(`Bi_WeeklyMeeting`.`ot_FileLoc`,3), MID(`Bi_WeeklyMeeting`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Bi_WeeklyMeeting`.`ot_otherdetails` as 'ot_otherdetails', `Bi_WeeklyMeeting`.`ot_comments` as 'ot_comments', `Bi_WeeklyMeeting`.`ot_SharedLink1` as 'ot_SharedLink1', `Bi_WeeklyMeeting`.`ot_SharedLink2` as 'ot_SharedLink2', `Bi_WeeklyMeeting`.`ot_Ref01` as 'ot_Ref01', `Bi_WeeklyMeeting`.`ot_Ref02` as 'ot_Ref02', `Bi_WeeklyMeeting`.`ot_Ref03` as 'ot_Ref03', `Bi_WeeklyMeeting`.`ot_Ref04` as 'ot_Ref04', `Bi_WeeklyMeeting`.`ot_Ref05` as 'ot_Ref05', `Bi_WeeklyMeeting`.`ot_Ref06` as 'ot_Ref06', `Bi_WeeklyMeeting`.`ot_Photo01` as 'ot_Photo01', `Bi_WeeklyMeeting`.`ot_Photo02` as 'ot_Photo02', `Bi_WeeklyMeeting`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Bi_WeeklyMeeting`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Bi_WeeklyMeeting`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Bi_WeeklyMeeting`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Bi_WeeklyMeeting`.`ot_ap_filed`,date_format(`Bi_WeeklyMeeting`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Bi_WeeklyMeeting`.`ot_ap_lastmodified`,date_format(`Bi_WeeklyMeeting`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'QuarterlyMeeting' => "`QuarterlyMeeting`.`id` as 'id', `QuarterlyMeeting`.`QmID` as 'QmID', IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') as 'ccpID', `QuarterlyMeeting`.`fo_Desc` as 'fo_Desc', if(`QuarterlyMeeting`.`fo_RequiredDate`,date_format(`QuarterlyMeeting`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', CONCAT_WS('-', LEFT(`QuarterlyMeeting`.`ot_FileLoc`,3), MID(`QuarterlyMeeting`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `QuarterlyMeeting`.`ot_otherdetails` as 'ot_otherdetails', `QuarterlyMeeting`.`ot_comments` as 'ot_comments', `QuarterlyMeeting`.`ot_SharedLink1` as 'ot_SharedLink1', `QuarterlyMeeting`.`ot_SharedLink2` as 'ot_SharedLink2', `QuarterlyMeeting`.`ot_Ref01` as 'ot_Ref01', `QuarterlyMeeting`.`ot_Ref02` as 'ot_Ref02', `QuarterlyMeeting`.`ot_Ref03` as 'ot_Ref03', `QuarterlyMeeting`.`ot_Ref04` as 'ot_Ref04', `QuarterlyMeeting`.`ot_Ref05` as 'ot_Ref05', `QuarterlyMeeting`.`ot_Ref06` as 'ot_Ref06', `QuarterlyMeeting`.`ot_Photo01` as 'ot_Photo01', `QuarterlyMeeting`.`ot_Photo02` as 'ot_Photo02', `QuarterlyMeeting`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `QuarterlyMeeting`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `QuarterlyMeeting`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `QuarterlyMeeting`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`QuarterlyMeeting`.`ot_ap_filed`,date_format(`QuarterlyMeeting`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`QuarterlyMeeting`.`ot_ap_lastmodified`,date_format(`QuarterlyMeeting`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Campaign' => "`Campaign`.`id` as 'id', `Campaign`.`CampaignID` as 'CampaignID', IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') as 'ccpID', `Campaign`.`fo_Desc` as 'fo_Desc', if(`Campaign`.`fo_RequiredDate`,date_format(`Campaign`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', CONCAT_WS('-', LEFT(`Campaign`.`ot_FileLoc`,3), MID(`Campaign`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Campaign`.`ot_otherdetails` as 'ot_otherdetails', `Campaign`.`ot_comments` as 'ot_comments', `Campaign`.`ot_SharedLink1` as 'ot_SharedLink1', `Campaign`.`ot_SharedLink2` as 'ot_SharedLink2', `Campaign`.`ot_Ref01` as 'ot_Ref01', `Campaign`.`ot_Ref02` as 'ot_Ref02', `Campaign`.`ot_Ref03` as 'ot_Ref03', `Campaign`.`ot_Ref04` as 'ot_Ref04', `Campaign`.`ot_Ref05` as 'ot_Ref05', `Campaign`.`ot_Ref06` as 'ot_Ref06', `Campaign`.`ot_Photo01` as 'ot_Photo01', `Campaign`.`ot_Photo02` as 'ot_Photo02', `Campaign`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Campaign`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Campaign`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Campaign`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Campaign`.`ot_ap_filed`,date_format(`Campaign`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Campaign`.`ot_ap_last_modified`,date_format(`Campaign`.`ot_ap_last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_last_modified'",
			'DrillNInspection' => "`DrillNInspection`.`id` as 'id', `DrillNInspection`.`DillID` as 'DillID', IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') as 'ccpID', `DrillNInspection`.`fo_Desc` as 'fo_Desc', `DrillNInspection`.`fo_Classification` as 'fo_Classification', if(`DrillNInspection`.`fo_RequiredDate`,date_format(`DrillNInspection`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', CONCAT_WS('-', LEFT(`DrillNInspection`.`ot_FileLoc`,3), MID(`DrillNInspection`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `DrillNInspection`.`ot_otherdetails` as 'ot_otherdetails', `DrillNInspection`.`ot_comments` as 'ot_comments', `DrillNInspection`.`ot_SharedLink1` as 'ot_SharedLink1', `DrillNInspection`.`ot_SharedLink2` as 'ot_SharedLink2', `DrillNInspection`.`ot_Ref01` as 'ot_Ref01', `DrillNInspection`.`ot_Ref02` as 'ot_Ref02', `DrillNInspection`.`ot_Ref03` as 'ot_Ref03', `DrillNInspection`.`ot_Ref04` as 'ot_Ref04', `DrillNInspection`.`ot_Ref05` as 'ot_Ref05', `DrillNInspection`.`ot_Ref06` as 'ot_Ref06', `DrillNInspection`.`ot_Photo01` as 'ot_Photo01', `DrillNInspection`.`ot_Photo02` as 'ot_Photo02', `DrillNInspection`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `DrillNInspection`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `DrillNInspection`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `DrillNInspection`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`DrillNInspection`.`ot_ap_filed`,date_format(`DrillNInspection`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`DrillNInspection`.`ot_ap_lastmodified`,date_format(`DrillNInspection`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ManagementVisit' => "`ManagementVisit`.`id` as 'id', `ManagementVisit`.`MgtVstID` as 'MgtVstID', IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') as 'ccpID', `ManagementVisit`.`fo_Desc` as 'fo_Desc', `ManagementVisit`.`fo_Classification` as 'fo_Classification', if(`ManagementVisit`.`fo_RequiredDate`,date_format(`ManagementVisit`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', CONCAT_WS('-', LEFT(`ManagementVisit`.`ot_FileLoc`,3), MID(`ManagementVisit`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ManagementVisit`.`ot_otherdetails` as 'ot_otherdetails', `ManagementVisit`.`ot_comments` as 'ot_comments', `ManagementVisit`.`ot_SharedLink1` as 'ot_SharedLink1', `ManagementVisit`.`ot_SharedLink2` as 'ot_SharedLink2', `ManagementVisit`.`ot_Ref01` as 'ot_Ref01', `ManagementVisit`.`ot_Ref02` as 'ot_Ref02', `ManagementVisit`.`ot_Ref03` as 'ot_Ref03', `ManagementVisit`.`ot_Ref04` as 'ot_Ref04', `ManagementVisit`.`ot_Ref05` as 'ot_Ref05', `ManagementVisit`.`ot_Ref06` as 'ot_Ref06', `ManagementVisit`.`ot_Photo01` as 'ot_Photo01', `ManagementVisit`.`ot_Photo02` as 'ot_Photo02', `ManagementVisit`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ManagementVisit`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ManagementVisit`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ManagementVisit`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ManagementVisit`.`ot_ap_filed`,date_format(`ManagementVisit`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ManagementVisit`.`ot_ap_lastmodified`,date_format(`ManagementVisit`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'EventNotification' => "`EventNotification`.`id` as 'id', `EventNotification`.`ENID` as 'ENID', IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') as 'ccpID', `EventNotification`.`fo_Desc` as 'fo_Desc', if(`EventNotification`.`fo_RequiredDate`,date_format(`EventNotification`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', CONCAT_WS('-', LEFT(`EventNotification`.`ot_FileLoc`,3), MID(`EventNotification`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `EventNotification`.`ot_otherdetails` as 'ot_otherdetails', `EventNotification`.`ot_comments` as 'ot_comments', `EventNotification`.`ot_SharedLink1` as 'ot_SharedLink1', `EventNotification`.`ot_SharedLink2` as 'ot_SharedLink2', `EventNotification`.`ot_Ref01` as 'ot_Ref01', `EventNotification`.`ot_Ref02` as 'ot_Ref02', `EventNotification`.`ot_Ref03` as 'ot_Ref03', `EventNotification`.`ot_Ref04` as 'ot_Ref04', `EventNotification`.`ot_Ref05` as 'ot_Ref05', `EventNotification`.`ot_Ref06` as 'ot_Ref06', `EventNotification`.`ot_Photo01` as 'ot_Photo01', `EventNotification`.`ot_Photo02` as 'ot_Photo02', `EventNotification`.`ot_Photo03` as 'ot_Photo03', if(`EventNotification`.`ot_ap_filed`,date_format(`EventNotification`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`EventNotification`.`ot_ap_lastmodified`,date_format(`EventNotification`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ActCard' => "`ActCard`.`id` as 'id', `ActCard`.`ACID` as 'ACID', IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') as 'ccpID', `ActCard`.`fo_Desc` as 'fo_Desc', `ActCard`.`fo_Classification` as 'fo_Classification', if(`ActCard`.`fo_RequiredDate`,date_format(`ActCard`.`fo_RequiredDate`,'%m/%d/%Y'),'') as 'fo_RequiredDate', CONCAT_WS('-', LEFT(`ActCard`.`ot_FileLoc`,3), MID(`ActCard`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ActCard`.`ot_otherdetails` as 'ot_otherdetails', `ActCard`.`ot_comments` as 'ot_comments', `ActCard`.`ot_SharedLink1` as 'ot_SharedLink1', `ActCard`.`ot_SharedLink2` as 'ot_SharedLink2', `ActCard`.`ot_Ref01` as 'ot_Ref01', `ActCard`.`ot_Ref02` as 'ot_Ref02', `ActCard`.`ot_Ref03` as 'ot_Ref03', `ActCard`.`ot_Ref04` as 'ot_Ref04', `ActCard`.`ot_Ref05` as 'ot_Ref05', `ActCard`.`ot_Ref06` as 'ot_Ref06', `ActCard`.`ot_Photo01` as 'ot_Photo01', `ActCard`.`ot_Photo02` as 'ot_Photo02', `ActCard`.`ot_Photo03` as 'ot_Photo03', if(`ActCard`.`ot_ap_filed`,date_format(`ActCard`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ActCard`.`ot_ap_last_modified`,date_format(`ActCard`.`ot_ap_last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_last_modified'",
			'KM' => "`KM`.`id` as 'id', `KM`.`DocumentName` as 'DocumentName', `KM`.`fo_Description` as 'fo_Description', `KM`.`fo_Reference` as 'fo_Reference', `KM`.`fo_Volume` as 'fo_Volume', `KM`.`fo_Classification` as 'fo_Classification', `KM`.`fo_Class` as 'fo_Class', if(`KM`.`fo_Regdate`,date_format(`KM`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`KM`.`ot_FileLoc`,3), MID(`KM`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `KM`.`ot_otherdetails` as 'ot_otherdetails', `KM`.`ot_comments` as 'ot_comments', `KM`.`ot_SharedLink1` as 'ot_SharedLink1', `KM`.`ot_SharedLink2` as 'ot_SharedLink2', `KM`.`ot_Ref01` as 'ot_Ref01', `KM`.`ot_Ref02` as 'ot_Ref02', `KM`.`ot_Ref03` as 'ot_Ref03', `KM`.`ot_Ref04` as 'ot_Ref04', `KM`.`ot_Ref05` as 'ot_Ref05', `KM`.`ot_Ref06` as 'ot_Ref06', `KM`.`ot_Photo01` as 'ot_Photo01', `KM`.`ot_Photo02` as 'ot_Photo02', `KM`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `KM`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `KM`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `KM`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`KM`.`ot_ap_filed`,date_format(`KM`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`KM`.`ot_ap_lastmodified`,date_format(`KM`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'LegalRegister' => "`LegalRegister`.`id` as 'id', `LegalRegister`.`LRNumber` as 'LRNumber', `LegalRegister`.`LegalItem` as 'LegalItem', `LegalRegister`.`fo_LRDescription` as 'fo_LRDescription', `LegalRegister`.`fo_Classification` as 'fo_Classification', `LegalRegister`.`fo_Class` as 'fo_Class', if(`LegalRegister`.`fo_date`,date_format(`LegalRegister`.`fo_date`,'%m/%d/%Y'),'') as 'fo_date', CONCAT_WS('-', LEFT(`LegalRegister`.`ot_FileLoc`,3), MID(`LegalRegister`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `LegalRegister`.`ot_otherdetails` as 'ot_otherdetails', `LegalRegister`.`ot_comments` as 'ot_comments', `LegalRegister`.`ot_SharedLink1` as 'ot_SharedLink1', `LegalRegister`.`ot_SharedLink2` as 'ot_SharedLink2', `LegalRegister`.`ot_Ref01` as 'ot_Ref01', `LegalRegister`.`ot_Ref02` as 'ot_Ref02', `LegalRegister`.`ot_Ref03` as 'ot_Ref03', `LegalRegister`.`ot_Ref04` as 'ot_Ref04', `LegalRegister`.`ot_Ref05` as 'ot_Ref05', `LegalRegister`.`ot_Ref06` as 'ot_Ref06', `LegalRegister`.`ot_Photo01` as 'ot_Photo01', `LegalRegister`.`ot_Photo02` as 'ot_Photo02', `LegalRegister`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `LegalRegister`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `LegalRegister`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `LegalRegister`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`LegalRegister`.`ot_ap_filed`,date_format(`LegalRegister`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`LegalRegister`.`ot_ap_lastmodified`,date_format(`LegalRegister`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'RiskandOpportunity' => "`RiskandOpportunity`.`id` as 'id', `RiskandOpportunity`.`RISKid` as 'RISKid', `RiskandOpportunity`.`Item` as 'Item', `RiskandOpportunity`.`fo_Description` as 'fo_Description', `RiskandOpportunity`.`fo_Class` as 'fo_Class', if(`RiskandOpportunity`.`fo_Riskregister`,date_format(`RiskandOpportunity`.`fo_Riskregister`,'%m/%d/%Y'),'') as 'fo_Riskregister', CONCAT_WS('-', LEFT(`RiskandOpportunity`.`ot_FileLoc`,3), MID(`RiskandOpportunity`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `RiskandOpportunity`.`ot_otherdetails` as 'ot_otherdetails', `RiskandOpportunity`.`ot_comments` as 'ot_comments', `RiskandOpportunity`.`ot_SharedLink1` as 'ot_SharedLink1', `RiskandOpportunity`.`ot_SharedLink2` as 'ot_SharedLink2', `RiskandOpportunity`.`ot_Ref01` as 'ot_Ref01', `RiskandOpportunity`.`ot_Ref02` as 'ot_Ref02', `RiskandOpportunity`.`ot_Ref03` as 'ot_Ref03', `RiskandOpportunity`.`ot_Ref04` as 'ot_Ref04', `RiskandOpportunity`.`ot_Ref05` as 'ot_Ref05', `RiskandOpportunity`.`ot_Ref06` as 'ot_Ref06', `RiskandOpportunity`.`ot_Photo01` as 'ot_Photo01', `RiskandOpportunity`.`ot_Photo02` as 'ot_Photo02', `RiskandOpportunity`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `RiskandOpportunity`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `RiskandOpportunity`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `RiskandOpportunity`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`RiskandOpportunity`.`ot_ap_filed`,date_format(`RiskandOpportunity`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`RiskandOpportunity`.`ot_ap_lastmodified`,date_format(`RiskandOpportunity`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'DocControl' => "`DocControl`.`id` as 'id', `DocControl`.`DocconNumber` as 'DocconNumber', `DocControl`.`DocItem` as 'DocItem', `DocControl`.`fo_DocumentDescription` as 'fo_DocumentDescription', `DocControl`.`fo_Class` as 'fo_Class', `DocControl`.`fo_DocumentType` as 'fo_DocumentType', `DocControl`.`fo_Rev` as 'fo_Rev', if(`DocControl`.`fo_date`,date_format(`DocControl`.`fo_date`,'%m/%d/%Y'),'') as 'fo_date', CONCAT_WS('-', LEFT(`DocControl`.`ot_FileLoc`,3), MID(`DocControl`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `DocControl`.`ot_otherdetails` as 'ot_otherdetails', `DocControl`.`ot_comments` as 'ot_comments', `DocControl`.`ot_SharedLink1` as 'ot_SharedLink1', `DocControl`.`ot_SharedLink2` as 'ot_SharedLink2', `DocControl`.`ot_Ref01` as 'ot_Ref01', `DocControl`.`ot_Ref02` as 'ot_Ref02', `DocControl`.`ot_Ref03` as 'ot_Ref03', `DocControl`.`ot_Ref04` as 'ot_Ref04', `DocControl`.`ot_Ref05` as 'ot_Ref05', `DocControl`.`ot_Ref06` as 'ot_Ref06', `DocControl`.`ot_Photo01` as 'ot_Photo01', `DocControl`.`ot_Photo02` as 'ot_Photo02', `DocControl`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `DocControl`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `DocControl`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `DocControl`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`DocControl`.`ot_ap_filed`,date_format(`DocControl`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`DocControl`.`ot_ap_lastmodified`,date_format(`DocControl`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'DCN' => "`DCN`.`id` as 'id', `DCN`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`DocControl1`.`DocconNumber`), CONCAT_WS('',   `DocControl1`.`DocconNumber`), '') as 'DCCID', IF(    CHAR_LENGTH(`DocControl1`.`DocItem`) || CHAR_LENGTH(`DocControl1`.`fo_Class`), CONCAT_WS('',   `DocControl1`.`DocItem`, '::', `DocControl1`.`fo_Class`), '') as 'fo_DCCITEM', `DCN`.`fo_Description` as 'fo_Description', `DCN`.`ot_FileLoc` as 'ot_FileLoc', `DCN`.`ot_otherdetails` as 'ot_otherdetails', `DCN`.`ot_comments` as 'ot_comments', `DCN`.`ot_SharedLink1` as 'ot_SharedLink1', `DCN`.`ot_SharedLink2` as 'ot_SharedLink2', `DCN`.`ot_Ref01` as 'ot_Ref01', `DCN`.`ot_Ref02` as 'ot_Ref02', `DCN`.`ot_Ref03` as 'ot_Ref03', `DCN`.`ot_Ref04` as 'ot_Ref04', `DCN`.`ot_Ref05` as 'ot_Ref05', `DCN`.`ot_Ref06` as 'ot_Ref06', `DCN`.`ot_Photo01` as 'ot_Photo01', `DCN`.`ot_Photo02` as 'ot_Photo02', `DCN`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `DCN`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `DCN`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `DCN`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`DCN`.`ot_ap_filed`,date_format(`DCN`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`DCN`.`ot_ap_lastmodified`,date_format(`DCN`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ObsoleteRec' => "`ObsoleteRec`.`id` as 'id', `ObsoleteRec`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`DocControl1`.`DocconNumber`), CONCAT_WS('',   `DocControl1`.`DocconNumber`), '') as 'DCCID', IF(    CHAR_LENGTH(`DocControl1`.`DocItem`) || CHAR_LENGTH(`DocControl1`.`fo_Class`), CONCAT_WS('',   `DocControl1`.`DocItem`, '::', `DocControl1`.`fo_Class`), '') as 'fo_DCCITEM', `ObsoleteRec`.`fo_Description` as 'fo_Description', `ObsoleteRec`.`ot_FileLoc` as 'ot_FileLoc', `ObsoleteRec`.`ot_otherdetails` as 'ot_otherdetails', `ObsoleteRec`.`ot_comments` as 'ot_comments', `ObsoleteRec`.`ot_SharedLink1` as 'ot_SharedLink1', `ObsoleteRec`.`ot_SharedLink2` as 'ot_SharedLink2', `ObsoleteRec`.`ot_Ref01` as 'ot_Ref01', `ObsoleteRec`.`ot_Ref02` as 'ot_Ref02', `ObsoleteRec`.`ot_Ref03` as 'ot_Ref03', `ObsoleteRec`.`ot_Ref04` as 'ot_Ref04', `ObsoleteRec`.`ot_Ref05` as 'ot_Ref05', `ObsoleteRec`.`ot_Ref06` as 'ot_Ref06', `ObsoleteRec`.`ot_Photo01` as 'ot_Photo01', `ObsoleteRec`.`ot_Photo02` as 'ot_Photo02', `ObsoleteRec`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ObsoleteRec`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ObsoleteRec`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ObsoleteRec`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ObsoleteRec`.`ot_ap_filed`,date_format(`ObsoleteRec`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ObsoleteRec`.`ot_ap_lastmodified`,date_format(`ObsoleteRec`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'QA' => "`QA`.`id` as 'id', `QA`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') as 'BaseLocation', `QA`.`fo_DocItem` as 'fo_DocItem', `QA`.`fo_DocumentDescription` as 'fo_DocumentDescription', `QA`.`fo_Class` as 'fo_Class', `QA`.`fo_Classification` as 'fo_Classification', if(`QA`.`fo_Regdate`,date_format(`QA`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`QA`.`ot_FileLoc`,3), MID(`QA`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `QA`.`ot_otherdetails` as 'ot_otherdetails', `QA`.`ot_comments` as 'ot_comments', `QA`.`ot_SharedLink1` as 'ot_SharedLink1', `QA`.`ot_SharedLink2` as 'ot_SharedLink2', `QA`.`ot_Ref01` as 'ot_Ref01', `QA`.`ot_Ref02` as 'ot_Ref02', `QA`.`ot_Ref03` as 'ot_Ref03', `QA`.`ot_Ref04` as 'ot_Ref04', `QA`.`ot_Ref05` as 'ot_Ref05', `QA`.`ot_Ref06` as 'ot_Ref06', `QA`.`ot_Photo01` as 'ot_Photo01', `QA`.`ot_Photo02` as 'ot_Photo02', `QA`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `QA`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `QA`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `QA`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`QA`.`ot_ap_filed`,date_format(`QA`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`QA`.`ot_ap_last_modified`,date_format(`QA`.`ot_ap_last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_last_modified'",
			'ERP' => "`ERP`.`id` as 'id', `ERP`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') as 'BaseLocation', `ERP`.`fo_DocItem` as 'fo_DocItem', `ERP`.`fo_DocumentDescription` as 'fo_DocumentDescription', `ERP`.`fo_Classification` as 'fo_Classification', `ERP`.`fo_Impact` as 'fo_Impact', if(`ERP`.`fo_Registerdate`,date_format(`ERP`.`fo_Registerdate`,'%m/%d/%Y'),'') as 'fo_Registerdate', CONCAT_WS('-', LEFT(`ERP`.`ot_FileLoc`,3), MID(`ERP`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ERP`.`ot_otherdetails` as 'ot_otherdetails', `ERP`.`ot_comments` as 'ot_comments', `ERP`.`ot_SharedLink1` as 'ot_SharedLink1', `ERP`.`ot_SharedLink2` as 'ot_SharedLink2', `ERP`.`ot_Location` as 'ot_Location', `ERP`.`ot_Ref01` as 'ot_Ref01', `ERP`.`ot_Ref02` as 'ot_Ref02', `ERP`.`ot_Ref03` as 'ot_Ref03', `ERP`.`ot_Ref04` as 'ot_Ref04', `ERP`.`ot_Ref05` as 'ot_Ref05', `ERP`.`ot_Ref06` as 'ot_Ref06', `ERP`.`ot_Photo01` as 'ot_Photo01', `ERP`.`ot_Photo02` as 'ot_Photo02', `ERP`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ERP`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ERP`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ERP`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ERP`.`ot_ap_filed`,date_format(`ERP`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ERP`.`ot_ap_lastmodified`,date_format(`ERP`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'WorkEnvMonitoring' => "`WorkEnvMonitoring`.`id` as 'id', `WorkEnvMonitoring`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') as 'BaseLocation', `WorkEnvMonitoring`.`fo_DocItem` as 'fo_DocItem', `WorkEnvMonitoring`.`fo_DocumentDescription` as 'fo_DocumentDescription', `WorkEnvMonitoring`.`fo_Classification` as 'fo_Classification', `WorkEnvMonitoring`.`fo_Impact` as 'fo_Impact', if(`WorkEnvMonitoring`.`fo_Regdate`,date_format(`WorkEnvMonitoring`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`WorkEnvMonitoring`.`ot_FileLoc`,3), MID(`WorkEnvMonitoring`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `WorkEnvMonitoring`.`ot_otherDetails` as 'ot_otherDetails', `WorkEnvMonitoring`.`ot_comments` as 'ot_comments', `WorkEnvMonitoring`.`ot_SharedLink1` as 'ot_SharedLink1', `WorkEnvMonitoring`.`ot_SharedLink2` as 'ot_SharedLink2', `WorkEnvMonitoring`.`ot_Location` as 'ot_Location', `WorkEnvMonitoring`.`ot_Ref01` as 'ot_Ref01', `WorkEnvMonitoring`.`ot_Ref02` as 'ot_Ref02', `WorkEnvMonitoring`.`ot_Ref03` as 'ot_Ref03', `WorkEnvMonitoring`.`ot_Ref04` as 'ot_Ref04', `WorkEnvMonitoring`.`ot_Ref05` as 'ot_Ref05', `WorkEnvMonitoring`.`ot_Ref06` as 'ot_Ref06', `WorkEnvMonitoring`.`ot_Photo01` as 'ot_Photo01', `WorkEnvMonitoring`.`ot_Photo02` as 'ot_Photo02', `WorkEnvMonitoring`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `WorkEnvMonitoring`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `WorkEnvMonitoring`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `WorkEnvMonitoring`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`WorkEnvMonitoring`.`ot_ap_filed`,date_format(`WorkEnvMonitoring`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`WorkEnvMonitoring`.`ot_ap_lastmodified`,date_format(`WorkEnvMonitoring`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ScheduleWaste' => "`ScheduleWaste`.`id` as 'id', `ScheduleWaste`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') as 'worklocID', `ScheduleWaste`.`fo_DocItem` as 'fo_DocItem', `ScheduleWaste`.`fo_DocumentDescription` as 'fo_DocumentDescription', `ScheduleWaste`.`fo_Classification` as 'fo_Classification', `ScheduleWaste`.`fo_Impact` as 'fo_Impact', if(`ScheduleWaste`.`fo_Regdate`,date_format(`ScheduleWaste`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`ScheduleWaste`.`ot_FileLoc`,3), MID(`ScheduleWaste`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ScheduleWaste`.`ot_otherdetails` as 'ot_otherdetails', `ScheduleWaste`.`ot_comments` as 'ot_comments', `ScheduleWaste`.`ot_SharedLink1` as 'ot_SharedLink1', `ScheduleWaste`.`ot_SharedLink2` as 'ot_SharedLink2', `ScheduleWaste`.`ot_Ref01` as 'ot_Ref01', `ScheduleWaste`.`ot_Ref02` as 'ot_Ref02', `ScheduleWaste`.`ot_Ref03` as 'ot_Ref03', `ScheduleWaste`.`ot_Ref04` as 'ot_Ref04', `ScheduleWaste`.`ot_Ref05` as 'ot_Ref05', `ScheduleWaste`.`ot_Ref06` as 'ot_Ref06', `ScheduleWaste`.`ot_Photo01` as 'ot_Photo01', `ScheduleWaste`.`ot_Photo02` as 'ot_Photo02', `ScheduleWaste`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ScheduleWaste`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ScheduleWaste`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ScheduleWaste`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ScheduleWaste`.`ot_ap_filed`,date_format(`ScheduleWaste`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ScheduleWaste`.`ot_ap_lastmodified`,date_format(`ScheduleWaste`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'IncidentReporting' => "`IncidentReporting`.`id` as 'id', `IncidentReporting`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, ':: ', `WorkLocation1`.`DocItem`), '') as 'BaseLocation', `IncidentReporting`.`fo_DocItem` as 'fo_DocItem', `IncidentReporting`.`fo_DocumentDescription` as 'fo_DocumentDescription', `IncidentReporting`.`fo_Classification` as 'fo_Classification', `IncidentReporting`.`fo_Impact` as 'fo_Impact', if(`IncidentReporting`.`fo_regdate`,date_format(`IncidentReporting`.`fo_regdate`,'%m/%d/%Y'),'') as 'fo_regdate', CONCAT_WS('-', LEFT(`IncidentReporting`.`ot_FileLoc`,3), MID(`IncidentReporting`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `IncidentReporting`.`ot_otherdetails` as 'ot_otherdetails', `IncidentReporting`.`ot_comments` as 'ot_comments', `IncidentReporting`.`ot_SharedLink1` as 'ot_SharedLink1', `IncidentReporting`.`ot_SharedLink2` as 'ot_SharedLink2', `IncidentReporting`.`ot_Ref01` as 'ot_Ref01', `IncidentReporting`.`ot_Ref02` as 'ot_Ref02', `IncidentReporting`.`ot_Ref03` as 'ot_Ref03', `IncidentReporting`.`ot_Ref04` as 'ot_Ref04', `IncidentReporting`.`ot_Ref05` as 'ot_Ref05', `IncidentReporting`.`ot_Ref06` as 'ot_Ref06', `IncidentReporting`.`ot_Photo01` as 'ot_Photo01', `IncidentReporting`.`ot_Photo02` as 'ot_Photo02', `IncidentReporting`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `IncidentReporting`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `IncidentReporting`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `IncidentReporting`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`IncidentReporting`.`ot_ap_filed`,date_format(`IncidentReporting`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`IncidentReporting`.`ot_ap_lastmodified`,date_format(`IncidentReporting`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MgtofChange' => "`MgtofChange`.`id` as 'id', `MgtofChange`.`DocconNumber` as 'DocconNumber', `MgtofChange`.`title` as 'title', `MgtofChange`.`fo_Desc` as 'fo_Desc', `MgtofChange`.`fo_class` as 'fo_class', if(`MgtofChange`.`fo_regdate`,date_format(`MgtofChange`.`fo_regdate`,'%m/%d/%Y'),'') as 'fo_regdate', CONCAT_WS('-', LEFT(`MgtofChange`.`ot_FileLoc`,3), MID(`MgtofChange`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MgtofChange`.`ot_otherdetails` as 'ot_otherdetails', `MgtofChange`.`ot_comments` as 'ot_comments', `MgtofChange`.`ot_SharedLink1` as 'ot_SharedLink1', `MgtofChange`.`ot_SharedLink2` as 'ot_SharedLink2', `MgtofChange`.`ot_Ref01` as 'ot_Ref01', `MgtofChange`.`ot_Ref02` as 'ot_Ref02', `MgtofChange`.`ot_Ref03` as 'ot_Ref03', `MgtofChange`.`ot_Ref04` as 'ot_Ref04', `MgtofChange`.`ot_Ref05` as 'ot_Ref05', `MgtofChange`.`ot_Ref06` as 'ot_Ref06', `MgtofChange`.`ot_Photo01` as 'ot_Photo01', `MgtofChange`.`ot_Photo02` as 'ot_Photo02', `MgtofChange`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MgtofChange`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MgtofChange`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MgtofChange`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MgtofChange`.`ot_ap_filed`,date_format(`MgtofChange`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MgtofChange`.`ot_ap_lastmodified`,date_format(`MgtofChange`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'IMStrackingNmonitoring' => "`IMStrackingNmonitoring`.`id` as 'id', `IMStrackingNmonitoring`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') as 'WorklocID', `IMStrackingNmonitoring`.`fo_DocItem` as 'fo_DocItem', `IMStrackingNmonitoring`.`fo_DocumentDescription` as 'fo_DocumentDescription', `IMStrackingNmonitoring`.`fo_Classification` as 'fo_Classification', `IMStrackingNmonitoring`.`fo_Impact` as 'fo_Impact', if(`IMStrackingNmonitoring`.`fo_Regdate`,date_format(`IMStrackingNmonitoring`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`IMStrackingNmonitoring`.`ot_FileLoc`,3), MID(`IMStrackingNmonitoring`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `IMStrackingNmonitoring`.`ot_otherdetails` as 'ot_otherdetails', `IMStrackingNmonitoring`.`ot_comments` as 'ot_comments', `IMStrackingNmonitoring`.`ot_SharedLink1` as 'ot_SharedLink1', `IMStrackingNmonitoring`.`ot_SharedLink2` as 'ot_SharedLink2', `IMStrackingNmonitoring`.`ot_Ref01` as 'ot_Ref01', `IMStrackingNmonitoring`.`ot_Ref02` as 'ot_Ref02', `IMStrackingNmonitoring`.`ot_Ref03` as 'ot_Ref03', `IMStrackingNmonitoring`.`ot_Ref04` as 'ot_Ref04', `IMStrackingNmonitoring`.`ot_Ref05` as 'ot_Ref05', `IMStrackingNmonitoring`.`ot_Ref06` as 'ot_Ref06', `IMStrackingNmonitoring`.`ot_Photo01` as 'ot_Photo01', `IMStrackingNmonitoring`.`ot_Photo02` as 'ot_Photo02', `IMStrackingNmonitoring`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `IMStrackingNmonitoring`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `IMStrackingNmonitoring`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `IMStrackingNmonitoring`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`IMStrackingNmonitoring`.`ot_ap_filed`,date_format(`IMStrackingNmonitoring`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`IMStrackingNmonitoring`.`ot_ap_lastmodified`,date_format(`IMStrackingNmonitoring`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'IMSDataAnalysis' => "`IMSDataAnalysis`.`id` as 'id', `IMSDataAnalysis`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') as 'worklocID', `IMSDataAnalysis`.`fo_DocItem` as 'fo_DocItem', `IMSDataAnalysis`.`fo_DocumentDescription` as 'fo_DocumentDescription', `IMSDataAnalysis`.`fo_Classification` as 'fo_Classification', `IMSDataAnalysis`.`fo_Impact` as 'fo_Impact', if(`IMSDataAnalysis`.`fo_Regdate`,date_format(`IMSDataAnalysis`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`IMSDataAnalysis`.`ot_FileLoc`,3), MID(`IMSDataAnalysis`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `IMSDataAnalysis`.`ot_otherdetails` as 'ot_otherdetails', `IMSDataAnalysis`.`ot_comments` as 'ot_comments', `IMSDataAnalysis`.`ot_SharedLink1` as 'ot_SharedLink1', `IMSDataAnalysis`.`ot_SharedLink2` as 'ot_SharedLink2', `IMSDataAnalysis`.`ot_Ref01` as 'ot_Ref01', `IMSDataAnalysis`.`ot_Ref02` as 'ot_Ref02', `IMSDataAnalysis`.`ot_Ref03` as 'ot_Ref03', `IMSDataAnalysis`.`ot_Ref04` as 'ot_Ref04', `IMSDataAnalysis`.`ot_Ref05` as 'ot_Ref05', `IMSDataAnalysis`.`ot_Ref06` as 'ot_Ref06', `IMSDataAnalysis`.`ot_Photo01` as 'ot_Photo01', `IMSDataAnalysis`.`ot_Photo02` as 'ot_Photo02', `IMSDataAnalysis`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `IMSDataAnalysis`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `IMSDataAnalysis`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `IMSDataAnalysis`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`IMSDataAnalysis`.`ot_ap_filed`,date_format(`IMSDataAnalysis`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`IMSDataAnalysis`.`ot_ap_lastmodified`,date_format(`IMSDataAnalysis`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Audit' => "`Audit`.`id` as 'id', `Audit`.`AuditNo` as 'AuditNo', `Audit`.`Rectitle` as 'Rectitle', `Audit`.`fo_Desc` as 'fo_Desc', `Audit`.`fo_Auditor` as 'fo_Auditor', `Audit`.`fo_Classification` as 'fo_Classification', if(`Audit`.`fo_Regdate`,date_format(`Audit`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', `Audit`.`fo_AuditMemo` as 'fo_AuditMemo', `Audit`.`fo_AuditPlan` as 'fo_AuditPlan', `Audit`.`fo_AuditNote` as 'fo_AuditNote', `Audit`.`fo_AuditReport` as 'fo_AuditReport', `Audit`.`fo_NoObservation` as 'fo_NoObservation', `Audit`.`fo_NoMinorNC` as 'fo_NoMinorNC', `Audit`.`fo_NoMajorNC` as 'fo_NoMajorNC', CONCAT_WS('-', LEFT(`Audit`.`ot_FileLoc`,3), MID(`Audit`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Audit`.`ot_otherdetails` as 'ot_otherdetails', `Audit`.`ot_comments` as 'ot_comments', `Audit`.`ot_SharedLink1` as 'ot_SharedLink1', `Audit`.`ot_SharedLink2` as 'ot_SharedLink2', `Audit`.`ot_Ref01` as 'ot_Ref01', `Audit`.`ot_Ref02` as 'ot_Ref02', `Audit`.`ot_Ref03` as 'ot_Ref03', `Audit`.`ot_Ref04` as 'ot_Ref04', `Audit`.`ot_Ref05` as 'ot_Ref05', `Audit`.`ot_Ref06` as 'ot_Ref06', `Audit`.`ot_Photo01` as 'ot_Photo01', `Audit`.`ot_Photo02` as 'ot_Photo02', `Audit`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Audit`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Audit`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Audit`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Audit`.`ot_ap_filed`,date_format(`Audit`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Audit`.`ot_ap_lastmodified`,date_format(`Audit`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'NonConformance' => "`NonConformance`.`id` as 'id', `NonConformance`.`DocconNumber` as 'DocconNumber', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') as 'worklocID', `NonConformance`.`fo_DocItem` as 'fo_DocItem', `NonConformance`.`fo_DocumentDescription` as 'fo_DocumentDescription', `NonConformance`.`fo_Classification` as 'fo_Classification', `NonConformance`.`fo_Impact` as 'fo_Impact', if(`NonConformance`.`fo_Regdate`,date_format(`NonConformance`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', `NonConformance`.`fo_ClosedIssue` as 'fo_ClosedIssue', CONCAT_WS('-', LEFT(`NonConformance`.`ot_FileLoc`,3), MID(`NonConformance`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `NonConformance`.`ot_otherdetails` as 'ot_otherdetails', `NonConformance`.`ot_comments` as 'ot_comments', `NonConformance`.`ot_SharedLink1` as 'ot_SharedLink1', `NonConformance`.`ot_SharedLink2` as 'ot_SharedLink2', `NonConformance`.`ot_Ref01` as 'ot_Ref01', `NonConformance`.`ot_Ref02` as 'ot_Ref02', `NonConformance`.`ot_Ref03` as 'ot_Ref03', `NonConformance`.`ot_Ref04` as 'ot_Ref04', `NonConformance`.`ot_Ref05` as 'ot_Ref05', `NonConformance`.`ot_Ref06` as 'ot_Ref06', `NonConformance`.`ot_Photo01` as 'ot_Photo01', `NonConformance`.`ot_Photo02` as 'ot_Photo02', `NonConformance`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `NonConformance`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `NonConformance`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `NonConformance`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`NonConformance`.`ot_ap_filed`,date_format(`NonConformance`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`NonConformance`.`ot_ap_lastmodified`,date_format(`NonConformance`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ContinualImprovement' => "`ContinualImprovement`.`id` as 'id', `ContinualImprovement`.`CAPARno` as 'CAPARno', `ContinualImprovement`.`RecTitle` as 'RecTitle', `ContinualImprovement`.`fo_Class` as 'fo_Class', `ContinualImprovement`.`fo_CAPAR` as 'fo_CAPAR', `ContinualImprovement`.`fo_Desc` as 'fo_Desc', if(`ContinualImprovement`.`fo_Regdate`,date_format(`ContinualImprovement`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`ContinualImprovement`.`ot_FileLoc`,3), MID(`ContinualImprovement`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ContinualImprovement`.`ot_otherdetails` as 'ot_otherdetails', `ContinualImprovement`.`ot_comments` as 'ot_comments', `ContinualImprovement`.`ot_SharedLink1` as 'ot_SharedLink1', `ContinualImprovement`.`ot_SharedLink2` as 'ot_SharedLink2', `ContinualImprovement`.`ot_Ref01` as 'ot_Ref01', `ContinualImprovement`.`ot_Ref02` as 'ot_Ref02', `ContinualImprovement`.`ot_Ref03` as 'ot_Ref03', `ContinualImprovement`.`ot_Ref04` as 'ot_Ref04', `ContinualImprovement`.`ot_Ref05` as 'ot_Ref05', `ContinualImprovement`.`ot_Ref06` as 'ot_Ref06', `ContinualImprovement`.`ot_Photo01` as 'ot_Photo01', `ContinualImprovement`.`ot_Photo02` as 'ot_Photo02', `ContinualImprovement`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ContinualImprovement`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ContinualImprovement`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ContinualImprovement`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ContinualImprovement`.`ot_ap_filed`,date_format(`ContinualImprovement`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ContinualImprovement`.`ot_ap_lastmodified`,date_format(`ContinualImprovement`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'StakeholderSatisfaction' => "`StakeholderSatisfaction`.`id` as 'id', `StakeholderSatisfaction`.`RecordID` as 'RecordID', `StakeholderSatisfaction`.`RecTitle` as 'RecTitle', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') as 'fo_ProjectId', IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') as 'fo_Recources', IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '::', `Client1`.`CompanyName`), '') as 'fo_ClientID', `StakeholderSatisfaction`.`fo_gender` as 'fo_gender', `StakeholderSatisfaction`.`fo_SurveyType` as 'fo_SurveyType', `StakeholderSatisfaction`.`fo_Stakeholder` as 'fo_Stakeholder', `StakeholderSatisfaction`.`fo_Description` as 'fo_Description', if(`StakeholderSatisfaction`.`fo_Regdate`,date_format(`StakeholderSatisfaction`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', `StakeholderSatisfaction`.`fo_website` as 'fo_website', CONCAT_WS('-', LEFT(`StakeholderSatisfaction`.`ot_FileLoc`,3), MID(`StakeholderSatisfaction`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `StakeholderSatisfaction`.`ot_otherdetails` as 'ot_otherdetails', `StakeholderSatisfaction`.`ot_comments` as 'ot_comments', `StakeholderSatisfaction`.`ot_SharedLink1` as 'ot_SharedLink1', `StakeholderSatisfaction`.`ot_SharedLink2` as 'ot_SharedLink2', `StakeholderSatisfaction`.`ot_Ref01` as 'ot_Ref01', `StakeholderSatisfaction`.`ot_Ref02` as 'ot_Ref02', `StakeholderSatisfaction`.`ot_Ref03` as 'ot_Ref03', `StakeholderSatisfaction`.`ot_Ref04` as 'ot_Ref04', `StakeholderSatisfaction`.`ot_Ref05` as 'ot_Ref05', `StakeholderSatisfaction`.`ot_Ref06` as 'ot_Ref06', `StakeholderSatisfaction`.`ot_Photo01` as 'ot_Photo01', `StakeholderSatisfaction`.`ot_Photo02` as 'ot_Photo02', `StakeholderSatisfaction`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `StakeholderSatisfaction`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `StakeholderSatisfaction`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `StakeholderSatisfaction`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`StakeholderSatisfaction`.`ot_ap_filed`,date_format(`StakeholderSatisfaction`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`StakeholderSatisfaction`.`ot_ap_lastmodified`,date_format(`StakeholderSatisfaction`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MRM' => "`MRM`.`id` as 'id', `MRM`.`DocconNumber` as 'DocconNumber', `MRM`.`DocItem` as 'DocItem', `MRM`.`fo_DocumentDescription` as 'fo_DocumentDescription', `MRM`.`fo_Classification` as 'fo_Classification', `MRM`.`fo_Impact` as 'fo_Impact', if(`MRM`.`fo_Regdate`,date_format(`MRM`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`MRM`.`ot_FileLoc`,3), MID(`MRM`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MRM`.`ot_otherdetails` as 'ot_otherdetails', `MRM`.`ot_comments` as 'ot_comments', `MRM`.`ot_SharedLink1` as 'ot_SharedLink1', `MRM`.`ot_SharedLink2` as 'ot_SharedLink2', `MRM`.`ot_Ref01` as 'ot_Ref01', `MRM`.`ot_Ref02` as 'ot_Ref02', `MRM`.`ot_Ref03` as 'ot_Ref03', `MRM`.`ot_Ref04` as 'ot_Ref04', `MRM`.`ot_Ref05` as 'ot_Ref05', `MRM`.`ot_Ref06` as 'ot_Ref06', `MRM`.`ot_Photo01` as 'ot_Photo01', `MRM`.`ot_Photo02` as 'ot_Photo02', `MRM`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MRM`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MRM`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MRM`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MRM`.`ot_ap_filed`,date_format(`MRM`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MRM`.`ot_ap_lastmodified`,date_format(`MRM`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'projects' => "`projects`.`Id` as 'Id', `projects`.`projectID` as 'projectID', `projects`.`Name` as 'Name', `projects`.`fo_ProjectIndication` as 'fo_ProjectIndication', `projects`.`fo_DocumentDescription` as 'fo_DocumentDescription', if(`projects`.`fo_StartDate`,date_format(`projects`.`fo_StartDate`,'%m/%d/%Y'),'') as 'fo_StartDate', if(`projects`.`fo_EndDate`,date_format(`projects`.`fo_EndDate`,'%m/%d/%Y'),'') as 'fo_EndDate', CONCAT_WS('-', LEFT(`projects`.`ot_FileLoc`,3), MID(`projects`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `projects`.`ot_otherdetails` as 'ot_otherdetails', `projects`.`ot_comments` as 'ot_comments', `projects`.`ot_SharedLink1` as 'ot_SharedLink1', `projects`.`ot_SharedLink2` as 'ot_SharedLink2', `projects`.`ot_Ref01` as 'ot_Ref01', `projects`.`ot_Ref02` as 'ot_Ref02', `projects`.`ot_Ref03` as 'ot_Ref03', `projects`.`ot_Ref04` as 'ot_Ref04', `projects`.`ot_Ref05` as 'ot_Ref05', `projects`.`ot_Ref06` as 'ot_Ref06', `projects`.`ot_Photo01` as 'ot_Photo01', `projects`.`ot_Photo02` as 'ot_Photo02', `projects`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `projects`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `projects`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `projects`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`projects`.`ot_ap_filed`,date_format(`projects`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`projects`.`ot_ap_lastmodified`,date_format(`projects`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'WorkLocation' => "`WorkLocation`.`id` as 'id', `WorkLocation`.`BaseLocation` as 'BaseLocation', `WorkLocation`.`DocItem` as 'DocItem', `WorkLocation`.`fo_DocumentDescription` as 'fo_DocumentDescription', `WorkLocation`.`fo_Type` as 'fo_Type', `WorkLocation`.`fo_Sector` as 'fo_Sector', `WorkLocation`.`fo_Zone` as 'fo_Zone', `WorkLocation`.`fo_Country` as 'fo_Country', CONCAT_WS('-', LEFT(`WorkLocation`.`ot_FileLoc`,3), MID(`WorkLocation`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `WorkLocation`.`ot_otherdetails` as 'ot_otherdetails', `WorkLocation`.`ot_comments` as 'ot_comments', `WorkLocation`.`ot_SharedLink1` as 'ot_SharedLink1', `WorkLocation`.`ot_SharedLink2` as 'ot_SharedLink2', `WorkLocation`.`ot_Location` as 'ot_Location', `WorkLocation`.`ot_Ref01` as 'ot_Ref01', `WorkLocation`.`ot_Ref02` as 'ot_Ref02', `WorkLocation`.`ot_Ref03` as 'ot_Ref03', `WorkLocation`.`ot_Ref04` as 'ot_Ref04', `WorkLocation`.`ot_Ref05` as 'ot_Ref05', `WorkLocation`.`ot_Ref06` as 'ot_Ref06', `WorkLocation`.`ot_Photo01` as 'ot_Photo01', `WorkLocation`.`ot_Photo02` as 'ot_Photo02', `WorkLocation`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `WorkLocation`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `WorkLocation`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `WorkLocation`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`WorkLocation`.`ot_ap_filed`,date_format(`WorkLocation`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`WorkLocation`.`ot_ap_lastmodified`,date_format(`WorkLocation`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'WorkPermit' => "`WorkPermit`.`id` as 'id', `WorkPermit`.`RecNum` as 'RecNum', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') as 'WrLocID', `WorkPermit`.`fo_Type` as 'fo_Type', CONCAT_WS('-', LEFT(`WorkPermit`.`ot_FileLoc`,3), MID(`WorkPermit`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `WorkPermit`.`ot_otherdetails` as 'ot_otherdetails', `WorkPermit`.`ot_comments` as 'ot_comments', `WorkPermit`.`ot_SharedLink1` as 'ot_SharedLink1', `WorkPermit`.`ot_SharedLink2` as 'ot_SharedLink2', `WorkPermit`.`ot_Ref01` as 'ot_Ref01', `WorkPermit`.`ot_Ref02` as 'ot_Ref02', `WorkPermit`.`ot_Ref03` as 'ot_Ref03', `WorkPermit`.`ot_Ref04` as 'ot_Ref04', `WorkPermit`.`ot_Ref05` as 'ot_Ref05', `WorkPermit`.`ot_Ref06` as 'ot_Ref06', `WorkPermit`.`ot_Photo01` as 'ot_Photo01', `WorkPermit`.`ot_Photo02` as 'ot_Photo02', `WorkPermit`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `WorkPermit`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `WorkPermit`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `WorkPermit`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`WorkPermit`.`ot_ap_filed`,date_format(`WorkPermit`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`WorkPermit`.`ot_ap_lastmodified`,date_format(`WorkPermit`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ProjectTeam' => "`ProjectTeam`.`ProjectTeamID` as 'ProjectTeamID', `ProjectTeam`.`EmpNo` as 'EmpNo', `ProjectTeam`.`Name` as 'Name', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, ': ', `WorkLocation1`.`DocItem`), '') as 'BaseLocation', `ProjectTeam`.`fo_TermEmployment` as 'fo_TermEmployment', `ProjectTeam`.`fo_Photo01` as 'fo_Photo01', `ProjectTeam`.`fo_Photo02` as 'fo_Photo02', `ProjectTeam`.`fo_Photo03` as 'fo_Photo03', `ProjectTeam`.`fo_Position` as 'fo_Position', if(`ProjectTeam`.`fo_HireDate`,date_format(`ProjectTeam`.`fo_HireDate`,'%m/%d/%Y'),'') as 'fo_HireDate', if(`ProjectTeam`.`fo_OffHireDate`,date_format(`ProjectTeam`.`fo_OffHireDate`,'%m/%d/%Y'),'') as 'fo_OffHireDate', `ProjectTeam`.`fo_Address` as 'fo_Address', `ProjectTeam`.`fo_City` as 'fo_City', `ProjectTeam`.`fo_Region` as 'fo_Region', `ProjectTeam`.`fo_PostalCode` as 'fo_PostalCode', `ProjectTeam`.`fo_Country` as 'fo_Country', `ProjectTeam`.`fo_HomePhone` as 'fo_HomePhone', `ProjectTeam`.`fo_Extension` as 'fo_Extension', `ProjectTeam`.`fo_Notes` as 'fo_Notes', IF(    CHAR_LENGTH(`ProjectTeam1`.`Name`) || CHAR_LENGTH(`ProjectTeam1`.`ProjectTeamID`), CONCAT_WS('',   `ProjectTeam1`.`Name`, ', ', `ProjectTeam1`.`ProjectTeamID`), '') as 'fo_ReportsTo', `ProjectTeam`.`fo_Acknowledgement` as 'fo_Acknowledgement', `ProjectTeam`.`fo_Induction` as 'fo_Induction', CONCAT_WS('-', LEFT(`ProjectTeam`.`ot_FileLoc`,3), MID(`ProjectTeam`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ProjectTeam`.`ot_otherdetails` as 'ot_otherdetails', `ProjectTeam`.`ot_comments` as 'ot_comments', `ProjectTeam`.`ot_SharedLink1` as 'ot_SharedLink1', `ProjectTeam`.`ot_SharedLink2` as 'ot_SharedLink2', `ProjectTeam`.`ot_Ref01` as 'ot_Ref01', `ProjectTeam`.`ot_Ref02` as 'ot_Ref02', `ProjectTeam`.`ot_Ref03` as 'ot_Ref03', `ProjectTeam`.`ot_Ref04` as 'ot_Ref04', `ProjectTeam`.`ot_Ref05` as 'ot_Ref05', `ProjectTeam`.`ot_Ref06` as 'ot_Ref06', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ProjectTeam`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ProjectTeam`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ProjectTeam`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ProjectTeam`.`ot_ap_filed`,date_format(`ProjectTeam`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ProjectTeam`.`ot_ap_lastmodified`,date_format(`ProjectTeam`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'resources' => "`resources`.`Id` as 'Id', `resources`.`ResourcesID` as 'ResourcesID', `resources`.`Name` as 'Name', `resources`.`fo_Type` as 'fo_Type', `resources`.`fo_Description` as 'fo_Description', `resources`.`fo_Available` as 'fo_Available', CONCAT_WS('-', LEFT(`resources`.`ot_FileLoc`,3), MID(`resources`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `resources`.`ot_otherdetails` as 'ot_otherdetails', `resources`.`ot_comments` as 'ot_comments', `resources`.`ot_SharedLink1` as 'ot_SharedLink1', `resources`.`ot_SharedLink2` as 'ot_SharedLink2', `resources`.`ot_Ref01` as 'ot_Ref01', `resources`.`ot_Ref02` as 'ot_Ref02', `resources`.`ot_Ref03` as 'ot_Ref03', `resources`.`ot_Ref04` as 'ot_Ref04', `resources`.`ot_Ref05` as 'ot_Ref05', `resources`.`ot_Ref06` as 'ot_Ref06', `resources`.`ot_Photo01` as 'ot_Photo01', `resources`.`ot_Photo02` as 'ot_Photo02', `resources`.`ot_Photo03` as 'ot_Photo03', if(`resources`.`ot_ap_filed`,date_format(`resources`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`resources`.`ot_ap_lastmodified`,date_format(`resources`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'PROInitiation' => "`PROInitiation`.`id` as 'id', `PROInitiation`.`InitiationNo` as 'InitiationNo', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') as 'ProjectsID', `PROInitiation`.`fo_InitiationForm` as 'fo_InitiationForm', `PROInitiation`.`fo_DocItem` as 'fo_DocItem', `PROInitiation`.`fo_DocumentDescription` as 'fo_DocumentDescription', if(`PROInitiation`.`fo_Regdate`,date_format(`PROInitiation`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`PROInitiation`.`ot_FileLoc`,3), MID(`PROInitiation`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `PROInitiation`.`ot_otherdetails` as 'ot_otherdetails', `PROInitiation`.`ot_comments` as 'ot_comments', `PROInitiation`.`ot_SharedLink1` as 'ot_SharedLink1', `PROInitiation`.`ot_SharedLink2` as 'ot_SharedLink2', `PROInitiation`.`ot_Ref01` as 'ot_Ref01', `PROInitiation`.`ot_Ref02` as 'ot_Ref02', `PROInitiation`.`ot_Ref03` as 'ot_Ref03', `PROInitiation`.`ot_Ref04` as 'ot_Ref04', `PROInitiation`.`ot_Ref05` as 'ot_Ref05', `PROInitiation`.`ot_Ref06` as 'ot_Ref06', `PROInitiation`.`ot_Photo01` as 'ot_Photo01', `PROInitiation`.`ot_Photo02` as 'ot_Photo02', `PROInitiation`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `PROInitiation`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `PROInitiation`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `PROInitiation`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`PROInitiation`.`ot_ap_filed`,date_format(`PROInitiation`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`PROInitiation`.`ot_ap_lastmodified`,date_format(`PROInitiation`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'PROPlanning' => "`PROPlanning`.`id` as 'id', `PROPlanning`.`PlanningNo` as 'PlanningNo', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') as 'ProjectsID', `PROPlanning`.`fo_RelatedDocument` as 'fo_RelatedDocument', `PROPlanning`.`fo_DocItem` as 'fo_DocItem', `PROPlanning`.`fo_DocumentDescription` as 'fo_DocumentDescription', if(`PROPlanning`.`fo_Regdate`,date_format(`PROPlanning`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`PROPlanning`.`ot_FileLoc`,3), MID(`PROPlanning`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `PROPlanning`.`ot_otherdetails` as 'ot_otherdetails', `PROPlanning`.`ot_comments` as 'ot_comments', `PROPlanning`.`ot_SharedLink1` as 'ot_SharedLink1', `PROPlanning`.`ot_SharedLink2` as 'ot_SharedLink2', `PROPlanning`.`ot_Ref01` as 'ot_Ref01', `PROPlanning`.`ot_Ref02` as 'ot_Ref02', `PROPlanning`.`ot_Ref03` as 'ot_Ref03', `PROPlanning`.`ot_Ref04` as 'ot_Ref04', `PROPlanning`.`ot_Ref05` as 'ot_Ref05', `PROPlanning`.`ot_Ref06` as 'ot_Ref06', `PROPlanning`.`ot_Photo01` as 'ot_Photo01', `PROPlanning`.`ot_Photo02` as 'ot_Photo02', `PROPlanning`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `PROPlanning`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `PROPlanning`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `PROPlanning`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`PROPlanning`.`ot_ap_filed`,date_format(`PROPlanning`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`PROPlanning`.`ot_ap_lastmodified`,date_format(`PROPlanning`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'PROExecution' => "`PROExecution`.`id` as 'id', `PROExecution`.`ExecutionNo` as 'ExecutionNo', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') as 'ProjectsID', `PROExecution`.`fo_Classification` as 'fo_Classification', `PROExecution`.`fo_DocItem` as 'fo_DocItem', `PROExecution`.`fo_DocumentDescription` as 'fo_DocumentDescription', if(`PROExecution`.`fo_Regdate`,date_format(`PROExecution`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`PROExecution`.`ot_FileLoc`,3), MID(`PROExecution`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `PROExecution`.`ot_otherdetails` as 'ot_otherdetails', `PROExecution`.`ot_comments` as 'ot_comments', `PROExecution`.`ot_SharedLink1` as 'ot_SharedLink1', `PROExecution`.`ot_SharedLink2` as 'ot_SharedLink2', `PROExecution`.`ot_Location` as 'ot_Location', `PROExecution`.`ot_Ref01` as 'ot_Ref01', `PROExecution`.`ot_Ref02` as 'ot_Ref02', `PROExecution`.`ot_Ref03` as 'ot_Ref03', `PROExecution`.`ot_Ref04` as 'ot_Ref04', `PROExecution`.`ot_Ref05` as 'ot_Ref05', `PROExecution`.`ot_Ref06` as 'ot_Ref06', `PROExecution`.`ot_Photo01` as 'ot_Photo01', `PROExecution`.`ot_Photo02` as 'ot_Photo02', `PROExecution`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `PROExecution`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `PROExecution`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `PROExecution`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`PROExecution`.`ot_ap_filed`,date_format(`PROExecution`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`PROExecution`.`ot_ap_lastmodified`,date_format(`PROExecution`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'DailyProgressReport' => "`DailyProgressReport`.`id` as 'id', `DailyProgressReport`.`ProgressReportId` as 'ProgressReportId', IF(    CHAR_LENGTH(`PROExecution1`.`ExecutionNo`) || CHAR_LENGTH(`PROExecution1`.`fo_DocItem`), CONCAT_WS('',   `PROExecution1`.`ExecutionNo`, '::', `PROExecution1`.`fo_DocItem`), '') as 'DPRID', `DailyProgressReport`.`fo_Class` as 'fo_Class', `DailyProgressReport`.`fo_DocItem` as 'fo_DocItem', `DailyProgressReport`.`fo_DocumentDescription` as 'fo_DocumentDescription', CONCAT_WS('-', LEFT(`DailyProgressReport`.`ot_FileLoc`,3), MID(`DailyProgressReport`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `DailyProgressReport`.`ot_otherdetails` as 'ot_otherdetails', `DailyProgressReport`.`ot_comments` as 'ot_comments', `DailyProgressReport`.`ot_SharedLink1` as 'ot_SharedLink1', `DailyProgressReport`.`ot_SharedLink2` as 'ot_SharedLink2', `DailyProgressReport`.`ot_Location` as 'ot_Location', `DailyProgressReport`.`ot_Ref01` as 'ot_Ref01', `DailyProgressReport`.`ot_Ref02` as 'ot_Ref02', `DailyProgressReport`.`ot_Ref03` as 'ot_Ref03', `DailyProgressReport`.`ot_Ref04` as 'ot_Ref04', `DailyProgressReport`.`ot_Ref05` as 'ot_Ref05', `DailyProgressReport`.`ot_Ref06` as 'ot_Ref06', `DailyProgressReport`.`ot_Photo01` as 'ot_Photo01', `DailyProgressReport`.`ot_Photo02` as 'ot_Photo02', `DailyProgressReport`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `DailyProgressReport`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `DailyProgressReport`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `DailyProgressReport`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`DailyProgressReport`.`ot_ap_filed`,date_format(`DailyProgressReport`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`DailyProgressReport`.`ot_ap_lastmodified`,date_format(`DailyProgressReport`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'MonthlyTimesheet' => "`MonthlyTimesheet`.`id` as 'id', `MonthlyTimesheet`.`TimesheetID` as 'TimesheetID', IF(    CHAR_LENGTH(`PROExecution1`.`ExecutionNo`) || CHAR_LENGTH(`PROExecution1`.`fo_DocItem`), CONCAT_WS('',   `PROExecution1`.`ExecutionNo`, '::', `PROExecution1`.`fo_DocItem`), '') as 'MTSID', `MonthlyTimesheet`.`fo_Class` as 'fo_Class', `MonthlyTimesheet`.`fo_DocItem` as 'fo_DocItem', `MonthlyTimesheet`.`fo_DocumentDescription` as 'fo_DocumentDescription', CONCAT_WS('-', LEFT(`MonthlyTimesheet`.`ot_FileLoc`,3), MID(`MonthlyTimesheet`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `MonthlyTimesheet`.`ot_otherdetails` as 'ot_otherdetails', `MonthlyTimesheet`.`ot_comments` as 'ot_comments', `MonthlyTimesheet`.`ot_SharedLink1` as 'ot_SharedLink1', `MonthlyTimesheet`.`ot_SharedLink2` as 'ot_SharedLink2', `MonthlyTimesheet`.`ot_Ref01` as 'ot_Ref01', `MonthlyTimesheet`.`ot_Ref02` as 'ot_Ref02', `MonthlyTimesheet`.`ot_Ref03` as 'ot_Ref03', `MonthlyTimesheet`.`ot_Ref04` as 'ot_Ref04', `MonthlyTimesheet`.`ot_Ref05` as 'ot_Ref05', `MonthlyTimesheet`.`ot_Ref06` as 'ot_Ref06', `MonthlyTimesheet`.`ot_Photo01` as 'ot_Photo01', `MonthlyTimesheet`.`ot_Photo02` as 'ot_Photo02', `MonthlyTimesheet`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `MonthlyTimesheet`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `MonthlyTimesheet`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `MonthlyTimesheet`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`MonthlyTimesheet`.`ot_ap_filed`,date_format(`MonthlyTimesheet`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`MonthlyTimesheet`.`ot_ap_lastmodified`,date_format(`MonthlyTimesheet`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Breakdown' => "`Breakdown`.`Id` as 'Id', `Breakdown`.`recID` as 'recID', IF(    CHAR_LENGTH(`PROExecution1`.`ExecutionNo`) || CHAR_LENGTH(`PROExecution1`.`fo_DocItem`), CONCAT_WS('',   `PROExecution1`.`ExecutionNo`, '::', `PROExecution1`.`fo_DocItem`), '') as 'MTSID', IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') as 'ResourceId', `Breakdown`.`Title` as 'Title', `Breakdown`.`fo_Description` as 'fo_Description', CONCAT_WS('-', LEFT(`Breakdown`.`ot_FileLoc`,3), MID(`Breakdown`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Breakdown`.`ot_otherDetails` as 'ot_otherDetails', `Breakdown`.`ot_comments` as 'ot_comments', `Breakdown`.`ot_SharedLink1` as 'ot_SharedLink1', `Breakdown`.`ot_SharedLink2` as 'ot_SharedLink2', `Breakdown`.`ot_Ref01` as 'ot_Ref01', `Breakdown`.`ot_Ref02` as 'ot_Ref02', `Breakdown`.`ot_Ref03` as 'ot_Ref03', `Breakdown`.`ot_Ref04` as 'ot_Ref04', `Breakdown`.`ot_Ref05` as 'ot_Ref05', `Breakdown`.`ot_Ref06` as 'ot_Ref06', `Breakdown`.`ot_Photo01` as 'ot_Photo01', `Breakdown`.`ot_Photo02` as 'ot_Photo02', `Breakdown`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Breakdown`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Breakdown`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Breakdown`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Breakdown`.`ot_ap_filed`,date_format(`Breakdown`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Breakdown`.`ot_ap_lastmodified`,date_format(`Breakdown`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'PROControlMonitoring' => "`PROControlMonitoring`.`id` as 'id', `PROControlMonitoring`.`ContMonitNo` as 'ContMonitNo', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') as 'ProjectsID', `PROControlMonitoring`.`fo_AuditInspection` as 'fo_AuditInspection', `PROControlMonitoring`.`fo_Classification` as 'fo_Classification', `PROControlMonitoring`.`fo_DocItem` as 'fo_DocItem', `PROControlMonitoring`.`fo_DocumentDescription` as 'fo_DocumentDescription', if(`PROControlMonitoring`.`fo_Regdate`,date_format(`PROControlMonitoring`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`PROControlMonitoring`.`ot_FileLoc`,3), MID(`PROControlMonitoring`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `PROControlMonitoring`.`ot_otherdetails` as 'ot_otherdetails', `PROControlMonitoring`.`ot_comments` as 'ot_comments', `PROControlMonitoring`.`ot_SharedLink1` as 'ot_SharedLink1', `PROControlMonitoring`.`ot_SharedLink2` as 'ot_SharedLink2', `PROControlMonitoring`.`ot_Ref01` as 'ot_Ref01', `PROControlMonitoring`.`ot_Ref02` as 'ot_Ref02', `PROControlMonitoring`.`ot_Ref03` as 'ot_Ref03', `PROControlMonitoring`.`ot_Ref04` as 'ot_Ref04', `PROControlMonitoring`.`ot_Ref05` as 'ot_Ref05', `PROControlMonitoring`.`ot_Ref06` as 'ot_Ref06', `PROControlMonitoring`.`ot_Photo01` as 'ot_Photo01', `PROControlMonitoring`.`ot_Photo02` as 'ot_Photo02', `PROControlMonitoring`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `PROControlMonitoring`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `PROControlMonitoring`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `PROControlMonitoring`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`PROControlMonitoring`.`ot_ap_filed`,date_format(`PROControlMonitoring`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`PROControlMonitoring`.`ot_ap_lastmodified`,date_format(`PROControlMonitoring`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'PROVariation' => "`PROVariation`.`id` as 'id', `PROVariation`.`VariationNo` as 'VariationNo', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') as 'ProjectsID', `PROVariation`.`fo_Classification` as 'fo_Classification', `PROVariation`.`fo_DocItem` as 'fo_DocItem', `PROVariation`.`fo_DocumentDescription` as 'fo_DocumentDescription', if(`PROVariation`.`fo_Regdate`,date_format(`PROVariation`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`PROVariation`.`ot_FileLoc`,3), MID(`PROVariation`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `PROVariation`.`ot_otherdetails` as 'ot_otherdetails', `PROVariation`.`ot_comments` as 'ot_comments', `PROVariation`.`ot_SharedLink1` as 'ot_SharedLink1', `PROVariation`.`ot_SharedLink2` as 'ot_SharedLink2', `PROVariation`.`ot_Ref01` as 'ot_Ref01', `PROVariation`.`ot_Ref02` as 'ot_Ref02', `PROVariation`.`ot_Ref03` as 'ot_Ref03', `PROVariation`.`ot_Ref04` as 'ot_Ref04', `PROVariation`.`ot_Ref05` as 'ot_Ref05', `PROVariation`.`ot_Ref06` as 'ot_Ref06', `PROVariation`.`ot_Photo01` as 'ot_Photo01', `PROVariation`.`ot_Photo02` as 'ot_Photo02', `PROVariation`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `PROVariation`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `PROVariation`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `PROVariation`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`PROVariation`.`ot_ap_filed`,date_format(`PROVariation`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`PROVariation`.`ot_ap_lastmodified`,date_format(`PROVariation`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'PROCompletion' => "`PROCompletion`.`id` as 'id', `PROCompletion`.`CompletionNo` as 'CompletionNo', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') as 'ProjectsID', `PROCompletion`.`fo_Classification` as 'fo_Classification', `PROCompletion`.`fo_DocItem` as 'fo_DocItem', `PROCompletion`.`fo_DocumentDescription` as 'fo_DocumentDescription', if(`PROCompletion`.`fo_Regdate`,date_format(`PROCompletion`.`fo_Regdate`,'%m/%d/%Y'),'') as 'fo_Regdate', CONCAT_WS('-', LEFT(`PROCompletion`.`ot_FileLoc`,3), MID(`PROCompletion`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `PROCompletion`.`ot_otherdetails` as 'ot_otherdetails', `PROCompletion`.`ot_comments` as 'ot_comments', `PROCompletion`.`ot_SharedLink1` as 'ot_SharedLink1', `PROCompletion`.`ot_SharedLink2` as 'ot_SharedLink2', `PROCompletion`.`ot_Ref01` as 'ot_Ref01', `PROCompletion`.`ot_Ref02` as 'ot_Ref02', `PROCompletion`.`ot_Ref03` as 'ot_Ref03', `PROCompletion`.`ot_Ref04` as 'ot_Ref04', `PROCompletion`.`ot_Ref05` as 'ot_Ref05', `PROCompletion`.`ot_Ref06` as 'ot_Ref06', `PROCompletion`.`ot_Photo01` as 'ot_Photo01', `PROCompletion`.`ot_Photo02` as 'ot_Photo02', `PROCompletion`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `PROCompletion`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `PROCompletion`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `PROCompletion`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`PROCompletion`.`ot_ap_filed`,date_format(`PROCompletion`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`PROCompletion`.`ot_ap_lastmodified`,date_format(`PROCompletion`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'Receivables' => "`Receivables`.`id` as 'id', `Receivables`.`ClaimNo` as 'ClaimNo', IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') as 'ProjectsID', IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') as 'ResourcesID', `Receivables`.`fo_Classification` as 'fo_Classification', `Receivables`.`fo_DocItem` as 'fo_DocItem', CONCAT('$', FORMAT(`Receivables`.`fo_UnitPrice`, 2)) as 'fo_UnitPrice', `Receivables`.`fo_DocumentDescription` as 'fo_DocumentDescription', if(`Receivables`.`fo_Registerdate`,date_format(`Receivables`.`fo_Registerdate`,'%m/%d/%Y'),'') as 'fo_Registerdate', CONCAT_WS('-', LEFT(`Receivables`.`ot_FileLoc`,3), MID(`Receivables`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `Receivables`.`ot_otherdetails` as 'ot_otherdetails', `Receivables`.`ot_comments` as 'ot_comments', `Receivables`.`ot_SharedLink1` as 'ot_SharedLink1', `Receivables`.`ot_SharedLink2` as 'ot_SharedLink2', `Receivables`.`ot_Ref01` as 'ot_Ref01', `Receivables`.`ot_Ref02` as 'ot_Ref02', `Receivables`.`ot_Ref03` as 'ot_Ref03', `Receivables`.`ot_Ref04` as 'ot_Ref04', `Receivables`.`ot_Ref05` as 'ot_Ref05', `Receivables`.`ot_Ref06` as 'ot_Ref06', `Receivables`.`ot_Photo01` as 'ot_Photo01', `Receivables`.`ot_Photo02` as 'ot_Photo02', `Receivables`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `Receivables`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `Receivables`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `Receivables`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`Receivables`.`ot_ap_filed`,date_format(`Receivables`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`Receivables`.`ot_ap_lastmodified`,date_format(`Receivables`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'ClaimRecord' => "`ClaimRecord`.`id` as 'id', `ClaimRecord`.`CRID` as 'CRID', IF(    CHAR_LENGTH(`Receivables1`.`ClaimNo`), CONCAT_WS('',   `Receivables1`.`ClaimNo`), '') as 'ReceivablesID', `ClaimRecord`.`fo_DocItem` as 'fo_DocItem', `ClaimRecord`.`fo_DocumentDescription` as 'fo_DocumentDescription', CONCAT('$', FORMAT(`ClaimRecord`.`fo_UnitPrice`, 2)) as 'fo_UnitPrice', CONCAT_WS('-', LEFT(`ClaimRecord`.`ot_FileLoc`,3), MID(`ClaimRecord`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `ClaimRecord`.`ot_otherdetails` as 'ot_otherdetails', `ClaimRecord`.`ot_comments` as 'ot_comments', `ClaimRecord`.`ot_SharedLink1` as 'ot_SharedLink1', `ClaimRecord`.`ot_SharedLink2` as 'ot_SharedLink2', `ClaimRecord`.`ot_Ref01` as 'ot_Ref01', `ClaimRecord`.`ot_Ref02` as 'ot_Ref02', `ClaimRecord`.`ot_Ref03` as 'ot_Ref03', `ClaimRecord`.`ot_Ref04` as 'ot_Ref04', `ClaimRecord`.`ot_Ref05` as 'ot_Ref05', `ClaimRecord`.`ot_Ref06` as 'ot_Ref06', `ClaimRecord`.`ot_Photo01` as 'ot_Photo01', `ClaimRecord`.`ot_Photo02` as 'ot_Photo02', `ClaimRecord`.`ot_Photo03` as 'ot_Photo03', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `ClaimRecord`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `ClaimRecord`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `ClaimRecord`.`ot_ap_QCComment` as 'ot_ap_QCComment', if(`ClaimRecord`.`ot_ap_filed`,date_format(`ClaimRecord`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`ClaimRecord`.`ot_ap_lastmodified`,date_format(`ClaimRecord`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'TeamSoftBoard' => "`TeamSoftBoard`.`Postid` as 'Postid', `TeamSoftBoard`.`Title` as 'Title', `TeamSoftBoard`.`image01` as 'image01', `TeamSoftBoard`.`image02` as 'image02', `TeamSoftBoard`.`image03` as 'image03', `TeamSoftBoard`.`TextPost` as 'TextPost', `TeamSoftBoard`.`website` as 'website', `TeamSoftBoard`.`Ref01` as 'Ref01', `TeamSoftBoard`.`Ref02` as 'Ref02', `TeamSoftBoard`.`Ref03` as 'Ref03', `TeamSoftBoard`.`Ref04` as 'Ref04', `TeamSoftBoard`.`Ref05` as 'Ref05', `TeamSoftBoard`.`Ref06` as 'Ref06', if(`TeamSoftBoard`.`filed`,date_format(`TeamSoftBoard`.`filed`,'%m/%d/%Y %h:%i %p'),'') as 'filed', if(`TeamSoftBoard`.`last_modified`,date_format(`TeamSoftBoard`.`last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'last_modified'",
			'SoftboardComment' => "`SoftboardComment`.`RunningID` as 'RunningID', IF(    CHAR_LENGTH(`TeamSoftBoard1`.`Title`) || CHAR_LENGTH(if(`TeamSoftBoard1`.`filed`,date_format(`TeamSoftBoard1`.`filed`,'%m/%d/%Y %h:%i %p'),'')), CONCAT_WS('',   `TeamSoftBoard1`.`Title`, ' @', if(`TeamSoftBoard1`.`filed`,date_format(`TeamSoftBoard1`.`filed`,'%m/%d/%Y %h:%i %p'),'')), '') as 'PostID', `SoftboardComment`.`TextPost` as 'TextPost', if(`SoftboardComment`.`filed`,date_format(`SoftboardComment`.`filed`,'%m/%d/%Y %h:%i %p'),'') as 'filed', if(`SoftboardComment`.`last_modified`,date_format(`SoftboardComment`.`last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'last_modified'",
			'IMSReport' => "`IMSReport`.`Postid` as 'Postid', `IMSReport`.`Title` as 'Title', `IMSReport`.`image` as 'image', `IMSReport`.`TextPost` as 'TextPost', `IMSReport`.`website` as 'website', `IMSReport`.`Ref01` as 'Ref01', `IMSReport`.`Ref02` as 'Ref02', `IMSReport`.`Ref03` as 'Ref03', `IMSReport`.`Ref04` as 'Ref04', `IMSReport`.`Ref05` as 'Ref05', `IMSReport`.`Ref06` as 'Ref06', `IMSReport`.`ClosedIssue` as 'ClosedIssue', if(`IMSReport`.`filed`,date_format(`IMSReport`.`filed`,'%m/%d/%Y %h:%i %p'),'') as 'filed', if(`IMSReport`.`last_modified`,date_format(`IMSReport`.`last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'last_modified'",
			'ReportComment' => "`ReportComment`.`RunningID` as 'RunningID', IF(    CHAR_LENGTH(`IMSReport1`.`Title`) || CHAR_LENGTH(if(`IMSReport1`.`filed`,date_format(`IMSReport1`.`filed`,'%m/%d/%Y %h:%i %p'),'')), CONCAT_WS('',   `IMSReport1`.`Title`, ' @', if(`IMSReport1`.`filed`,date_format(`IMSReport1`.`filed`,'%m/%d/%Y %h:%i %p'),'')), '') as 'PostID', `ReportComment`.`TextPost` as 'TextPost', if(`ReportComment`.`filed`,date_format(`ReportComment`.`filed`,'%m/%d/%Y %h:%i %p'),'') as 'filed', if(`ReportComment`.`last_modified`,date_format(`ReportComment`.`last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'last_modified'",
			'Leadership' => "`Leadership`.`id` as 'id', `Leadership`.`Status` as 'Status', `Leadership`.`Description` as 'Description', `Leadership`.`other_details` as 'other_details', if(`Leadership`.`filed`,date_format(`Leadership`.`filed`,'%m/%d/%Y %h:%i %p'),'') as 'filed', if(`Leadership`.`last_modified`,date_format(`Leadership`.`last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'last_modified'",
			'Approval' => "`Approval`.`id` as 'id', `Approval`.`Status` as 'Status', `Approval`.`Description` as 'Description', `Approval`.`other_details` as 'other_details', if(`Approval`.`filed`,date_format(`Approval`.`filed`,'%m/%d/%Y %h:%i %p'),'') as 'filed', if(`Approval`.`last_modified`,date_format(`Approval`.`last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'last_modified'",
			'IMSControl' => "`IMSControl`.`id` as 'id', `IMSControl`.`Status` as 'Status', `IMSControl`.`Description` as 'Description', `IMSControl`.`other_details` as 'other_details', if(`IMSControl`.`filed`,date_format(`IMSControl`.`filed`,'%m/%d/%Y %h:%i %p'),'') as 'filed', if(`IMSControl`.`last_modified`,date_format(`IMSControl`.`last_modified`,'%m/%d/%Y %h:%i %p'),'') as 'last_modified'",
			'membership_company' => "`membership_company`.`compID` as 'compID', `membership_company`.`fo_Name` as 'fo_Name', `membership_company`.`fo_RegistrationID` as 'fo_RegistrationID', `membership_company`.`fo_Logo` as 'fo_Logo', `membership_company`.`fo_Banner` as 'fo_Banner', `membership_company`.`fo_Photo01` as 'fo_Photo01', `membership_company`.`fo_Photo02` as 'fo_Photo02', `membership_company`.`fo_Photo03` as 'fo_Photo03', `membership_company`.`fo_Address` as 'fo_Address', `membership_company`.`fo_City` as 'fo_City', `membership_company`.`fo_Region` as 'fo_Region', `membership_company`.`fo_PostalCode` as 'fo_PostalCode', `membership_company`.`fo_Country` as 'fo_Country', `membership_company`.`fo_Phone_1` as 'fo_Phone_1', `membership_company`.`fo_Phone_2` as 'fo_Phone_2', `membership_company`.`fo_Fax` as 'fo_Fax', `membership_company`.`fo_Email` as 'fo_Email', `membership_company`.`fo_Admin_Email` as 'fo_Admin_Email', `membership_company`.`ot_Comments` as 'ot_Comments', `membership_company`.`ot_otherDetails` as 'ot_otherDetails', `membership_company`.`ot_SharedLink1` as 'ot_SharedLink1', `membership_company`.`ot_SharedLink2` as 'ot_SharedLink2', `membership_company`.`ot_Ref01` as 'ot_Ref01', `membership_company`.`ot_Ref02` as 'ot_Ref02', `membership_company`.`ot_Ref03` as 'ot_Ref03', `membership_company`.`ot_Ref04` as 'ot_Ref04', `membership_company`.`ot_Ref05` as 'ot_Ref05', `membership_company`.`ot_Ref06` as 'ot_Ref06', if(`membership_company`.`ot_ap_filed`,date_format(`membership_company`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_filed', if(`membership_company`.`ot_ap_lastmodified`,date_format(`membership_company`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'kpi' => "`kpi`.`id` as 'id', if(`kpi`.`ot_ap_Date`,date_format(`kpi`.`ot_ap_Date`,'%m/%d/%Y'),'') as 'ot_ap_Date', `kpi`.`fo_Section_Name` as 'fo_Section_Name', `kpi`.`fo_Section_Caption` as 'fo_Section_Caption', `kpi`.`fo_MinRecordRequired` as 'fo_MinRecordRequired', `kpi`.`fo_TaskCompDuration` as 'fo_TaskCompDuration', `kpi`.`fo_PercentageAchieved` as 'fo_PercentageAchieved', if(`kpi`.`ot_ap_lastmodified`,date_format(`kpi`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'",
			'summary_dashboard' => "`summary_dashboard`.`id` as 'id', if(`summary_dashboard`.`ot_ap_Date`,date_format(`summary_dashboard`.`ot_ap_Date`,'%m/%d/%Y'),'') as 'ot_ap_Date', `summary_dashboard`.`fo_Section_Name` as 'fo_Section_Name', `summary_dashboard`.`fo_Section_Caption` as 'fo_Section_Caption', `summary_dashboard`.`fo_TotalDisplayField` as 'fo_TotalDisplayField', `summary_dashboard`.`fo_TotalCount` as 'fo_TotalCount', `summary_dashboard`.`fo_ReviewCount` as 'fo_ReviewCount', `summary_dashboard`.`fo_ApprovalCount` as 'fo_ApprovalCount', `summary_dashboard`.`fo_IMSControlCount` as 'fo_IMSControlCount', `summary_dashboard`.`fo_CustomDisplayField1` as 'fo_CustomDisplayField1', `summary_dashboard`.`fo_CustomDisplayValue1` as 'fo_CustomDisplayValue1', `summary_dashboard`.`fo_CustomDisplayField2` as 'fo_CustomDisplayField2', `summary_dashboard`.`fo_CustomDisplayValue2` as 'fo_CustomDisplayValue2', if(`summary_dashboard`.`ot_ap_lastmodified`,date_format(`summary_dashboard`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'') as 'ot_ap_lastmodified'"
		);

		if(isset($sql_fields[$table_name])){
			return $sql_fields[$table_name];
		}

		return false;
	}

	#########################################################

	function get_sql_from($table_name, $skip_permissions = false){
		$sql_from = array(   
			'OrgContentContext' => "`OrgContentContext` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`OrgContentContext`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`OrgContentContext`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`OrgContentContext`.`ot_ap_QC` ",
			'Marketing' => "`Marketing` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Marketing`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Marketing`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Marketing`.`ot_ap_QC` ",
			'Client' => "`Client` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Client`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Client`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Client`.`ot_ap_QC` ",
			'Inquiry' => "`Inquiry` LEFT JOIN `Client` as Client1 ON `Client1`.`id`=`Inquiry`.`ClientID` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`Inquiry`.`fo_Logistic` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Inquiry`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Inquiry`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Inquiry`.`ot_ap_QC` ",
			'DesignProposal' => "`DesignProposal` LEFT JOIN `Inquiry` as Inquiry1 ON `Inquiry1`.`id`=`DesignProposal`.`InquiryID` LEFT JOIN `Client` as Client1 ON `Client1`.`id`=`Inquiry1`.`ClientID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`DesignProposal`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`DesignProposal`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`DesignProposal`.`ot_ap_QC` ",
			'ContractDeployment' => "`ContractDeployment` LEFT JOIN `Inquiry` as Inquiry1 ON `Inquiry1`.`id`=`ContractDeployment`.`InquiryID` LEFT JOIN `Client` as Client1 ON `Client1`.`id`=`Inquiry1`.`ClientID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ContractDeployment`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ContractDeployment`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ContractDeployment`.`ot_ap_QC` ",
			'employees' => "`employees` LEFT JOIN `membership_users` as membership_users ON `membership_users`.`memberID`=`employees`.`memberID` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`employees`.`BaseLocation` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`employees`.`fo_ReportsTo` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`employees`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`employees`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`employees`.`ot_ap_QC` ",
			'Recruitment' => "`Recruitment` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`Recruitment`.`EmployeeID` LEFT JOIN `ProjectTeam` as ProjectTeam1 ON `ProjectTeam1`.`ProjectTeamID`=`Recruitment`.`ProjectTeamID` ",
			'PersonnalFile' => "`PersonnalFile` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`PersonnalFile`.`EmployeeID` LEFT JOIN `ProjectTeam` as ProjectTeam1 ON `ProjectTeam1`.`ProjectTeamID`=`PersonnalFile`.`ProjectTeamID` ",
			'Competency' => "`Competency` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`Competency`.`EmployeeID` LEFT JOIN `ProjectTeam` as ProjectTeam1 ON `ProjectTeam1`.`ProjectTeamID`=`Competency`.`ProjectTeamID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Competency`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Competency`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Competency`.`ot_ap_QC` ",
			'Training' => "`Training` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`Training`.`EmployeeID` LEFT JOIN `ProjectTeam` as ProjectTeam1 ON `ProjectTeam1`.`ProjectTeamID`=`Training`.`ProjectTeamID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Training`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Training`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Training`.`ot_ap_QC` ",
			'JD_JS' => "`JD_JS` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`JD_JS`.`fo_EmployeeID` LEFT JOIN `ProjectTeam` as ProjectTeam1 ON `ProjectTeam1`.`ProjectTeamID`=`JD_JS`.`fo_ProjectTeamID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`JD_JS`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`JD_JS`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`JD_JS`.`ot_ap_QC` ",
			'InOutRegister' => "`InOutRegister` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`InOutRegister`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`InOutRegister`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`InOutRegister`.`ot_ap_QC` ",
			'vendor' => "`vendor` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`vendor`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`vendor`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`vendor`.`ot_ap_QC` ",
			'ManagingVendor' => "`ManagingVendor` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`ManagingVendor`.`fo_VendorID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ManagingVendor`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ManagingVendor`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ManagingVendor`.`ot_ap_QC` ",
			'VenPerformance' => "`VenPerformance` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`VenPerformance`.`fo_SupplierID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`VenPerformance`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`VenPerformance`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`VenPerformance`.`ot_ap_QC` ",
			'Logistics' => "`Logistics` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Logistics`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Logistics`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Logistics`.`ot_ap_QC` ",
			'Inventory' => "`Inventory` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Inventory`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Inventory`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Inventory`.`ot_ap_QC` ",
			'CalibrationCtrl' => "`CalibrationCtrl` LEFT JOIN `Inventory` as Inventory1 ON `Inventory1`.`id`=`CalibrationCtrl`.`fo_InventoryID` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`CalibrationCtrl`.`fo_CalCom` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`CalibrationCtrl`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`CalibrationCtrl`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`CalibrationCtrl`.`ot_ap_QC` ",
			'WorkOrder' => "`WorkOrder` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`WorkOrder`.`fo_EmployeeID` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`WorkOrder`.`fo_BaseLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`WorkOrder`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`WorkOrder`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`WorkOrder`.`ot_ap_QC` ",
			'MWO' => "`MWO` LEFT JOIN `Inventory` as Inventory1 ON `Inventory1`.`id`=`MWO`.`fo_InventoryID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MWO`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MWO`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MWO`.`ot_ap_QC` ",
			'MWOPlanned' => "`MWOPlanned` LEFT JOIN `MWO` as MWO1 ON `MWO1`.`id`=`MWOPlanned`.`MwoID` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`MWOPlanned`.`fo_EmployeeID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MWOPlanned`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MWOPlanned`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MWOPlanned`.`ot_ap_QC` ",
			'MWOpreventive' => "`MWOpreventive` LEFT JOIN `MWO` as MWO1 ON `MWO1`.`id`=`MWOpreventive`.`MwoID` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`MWOpreventive`.`fo_EmployeeID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MWOpreventive`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MWOpreventive`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MWOpreventive`.`ot_ap_QC` ",
			'MWOproactive' => "`MWOproactive` LEFT JOIN `MWO` as MWO1 ON `MWO1`.`id`=`MWOproactive`.`MwoID` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`MWOproactive`.`fo_EmployeeID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MWOproactive`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MWOproactive`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MWOproactive`.`ot_ap_QC` ",
			'MWConditionBased' => "`MWConditionBased` LEFT JOIN `MWO` as MWO1 ON `MWO1`.`id`=`MWConditionBased`.`MwoID` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`MWConditionBased`.`fo_EmployeeID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MWConditionBased`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MWConditionBased`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MWConditionBased`.`ot_ap_QC` ",
			'MWOReactive' => "`MWOReactive` LEFT JOIN `MWO` as MWO1 ON `MWO1`.`id`=`MWOReactive`.`MwoID` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`MWOReactive`.`fo_EmployeeID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MWOReactive`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MWOReactive`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MWOReactive`.`ot_ap_QC` ",
			'MWOCorrective' => "`MWOCorrective` LEFT JOIN `MWO` as MWO1 ON `MWO1`.`id`=`MWOCorrective`.`MwoID` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`MWOCorrective`.`fo_EmployeeID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MWOCorrective`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MWOCorrective`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MWOCorrective`.`ot_ap_QC` ",
			'LogisticRequest' => "`LogisticRequest` LEFT JOIN `resources` as resources1 ON `resources1`.`Id`=`LogisticRequest`.`fo_ResourcesID` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`LogisticRequest`.`fo_ProjectID` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`LogisticRequest`.`fo_ShipVia` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`LogisticRequest`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`LogisticRequest`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`LogisticRequest`.`ot_ap_QC` ",
			'orders' => "`orders` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`orders`.`fo_ProjectID` LEFT JOIN `Inventory` as Inventory1 ON `Inventory1`.`id`=`orders`.`fo_InventoryID` LEFT JOIN `Item` as Item1 ON `Item1`.`ProductID`=`orders`.`fo_ItemID` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`orders`.`fo_ShipVia` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`orders`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`orders`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`orders`.`ot_ap_QC` LEFT JOIN `categories` as categories1 ON `categories1`.`CategoryID`=`Item1`.`fo_CategoryID` ",
			'Quotation' => "`Quotation` LEFT JOIN `orders` as orders1 ON `orders1`.`id`=`Quotation`.`OrderID` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`Quotation`.`fo_Vendor` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`Quotation`.`fo_ShipVia` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Quotation`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Quotation`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Quotation`.`ot_ap_QC` ",
			'PurchaseOrder' => "`PurchaseOrder` LEFT JOIN `orders` as orders1 ON `orders1`.`id`=`PurchaseOrder`.`OrderID` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`PurchaseOrder`.`fo_Vendor` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`PurchaseOrder`.`fo_ShipVia` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`PurchaseOrder`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`PurchaseOrder`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`PurchaseOrder`.`ot_ap_QC` ",
			'DeliveryOrder' => "`DeliveryOrder` LEFT JOIN `orders` as orders1 ON `orders1`.`id`=`DeliveryOrder`.`OrderID` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`DeliveryOrder`.`fo_Vendor` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`DeliveryOrder`.`fo_ShipVia` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`DeliveryOrder`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`DeliveryOrder`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`DeliveryOrder`.`ot_ap_QC` ",
			'AccountPayables' => "`AccountPayables` LEFT JOIN `orders` as orders1 ON `orders1`.`id`=`AccountPayables`.`OrderID` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`AccountPayables`.`fo_Vendor` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`AccountPayables`.`fo_ShipVia` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`AccountPayables`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`AccountPayables`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`AccountPayables`.`ot_ap_QC` ",
			'Item' => "`Item` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`Item`.`fo_SupplierID` LEFT JOIN `categories` as categories1 ON `categories1`.`CategoryID`=`Item`.`fo_CategoryID` ",
			'categories' => "`categories` ",
			'batches' => "`batches` LEFT JOIN `Item` as Item1 ON `Item1`.`ProductID`=`batches`.`fo_item` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`batches`.`fo_suppliers` ",
			'transactions' => "`transactions` LEFT JOIN `Item` as Item1 ON `Item1`.`ProductID`=`transactions`.`fo_item` LEFT JOIN `resources` as resources1 ON `resources1`.`Id`=`transactions`.`fo_ResourcesID` ",
			'CommConsParticipate' => "`CommConsParticipate` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`CommConsParticipate`.`WorkLocationID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`CommConsParticipate`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`CommConsParticipate`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`CommConsParticipate`.`ot_ap_QC` ",
			'ToolBoxMeeting' => "`ToolBoxMeeting` LEFT JOIN `CommConsParticipate` as CommConsParticipate1 ON `CommConsParticipate1`.`id`=`ToolBoxMeeting`.`ccpID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ToolBoxMeeting`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ToolBoxMeeting`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ToolBoxMeeting`.`ot_ap_QC` ",
			'Bi_WeeklyMeeting' => "`Bi_WeeklyMeeting` LEFT JOIN `CommConsParticipate` as CommConsParticipate1 ON `CommConsParticipate1`.`id`=`Bi_WeeklyMeeting`.`ccpID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Bi_WeeklyMeeting`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Bi_WeeklyMeeting`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Bi_WeeklyMeeting`.`ot_ap_QC` ",
			'QuarterlyMeeting' => "`QuarterlyMeeting` LEFT JOIN `CommConsParticipate` as CommConsParticipate1 ON `CommConsParticipate1`.`id`=`QuarterlyMeeting`.`ccpID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`QuarterlyMeeting`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`QuarterlyMeeting`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`QuarterlyMeeting`.`ot_ap_QC` ",
			'Campaign' => "`Campaign` LEFT JOIN `CommConsParticipate` as CommConsParticipate1 ON `CommConsParticipate1`.`id`=`Campaign`.`ccpID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Campaign`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Campaign`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Campaign`.`ot_ap_QC` ",
			'DrillNInspection' => "`DrillNInspection` LEFT JOIN `CommConsParticipate` as CommConsParticipate1 ON `CommConsParticipate1`.`id`=`DrillNInspection`.`ccpID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`DrillNInspection`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`DrillNInspection`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`DrillNInspection`.`ot_ap_QC` ",
			'ManagementVisit' => "`ManagementVisit` LEFT JOIN `CommConsParticipate` as CommConsParticipate1 ON `CommConsParticipate1`.`id`=`ManagementVisit`.`ccpID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ManagementVisit`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ManagementVisit`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ManagementVisit`.`ot_ap_QC` ",
			'EventNotification' => "`EventNotification` LEFT JOIN `CommConsParticipate` as CommConsParticipate1 ON `CommConsParticipate1`.`id`=`EventNotification`.`ccpID` ",
			'ActCard' => "`ActCard` LEFT JOIN `CommConsParticipate` as CommConsParticipate1 ON `CommConsParticipate1`.`id`=`ActCard`.`ccpID` ",
			'KM' => "`KM` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`KM`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`KM`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`KM`.`ot_ap_QC` ",
			'LegalRegister' => "`LegalRegister` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`LegalRegister`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`LegalRegister`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`LegalRegister`.`ot_ap_QC` ",
			'RiskandOpportunity' => "`RiskandOpportunity` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`RiskandOpportunity`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`RiskandOpportunity`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`RiskandOpportunity`.`ot_ap_QC` ",
			'DocControl' => "`DocControl` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`DocControl`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`DocControl`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`DocControl`.`ot_ap_QC` ",
			'DCN' => "`DCN` LEFT JOIN `DocControl` as DocControl1 ON `DocControl1`.`id`=`DCN`.`DCCID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`DCN`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`DCN`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`DCN`.`ot_ap_QC` ",
			'ObsoleteRec' => "`ObsoleteRec` LEFT JOIN `DocControl` as DocControl1 ON `DocControl1`.`id`=`ObsoleteRec`.`DCCID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ObsoleteRec`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ObsoleteRec`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ObsoleteRec`.`ot_ap_QC` ",
			'QA' => "`QA` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`QA`.`BaseLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`QA`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`QA`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`QA`.`ot_ap_QC` ",
			'ERP' => "`ERP` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`ERP`.`BaseLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ERP`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ERP`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ERP`.`ot_ap_QC` ",
			'WorkEnvMonitoring' => "`WorkEnvMonitoring` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`WorkEnvMonitoring`.`BaseLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`WorkEnvMonitoring`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`WorkEnvMonitoring`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`WorkEnvMonitoring`.`ot_ap_QC` ",
			'ScheduleWaste' => "`ScheduleWaste` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`ScheduleWaste`.`worklocID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ScheduleWaste`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ScheduleWaste`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ScheduleWaste`.`ot_ap_QC` ",
			'IncidentReporting' => "`IncidentReporting` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`IncidentReporting`.`BaseLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`IncidentReporting`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`IncidentReporting`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`IncidentReporting`.`ot_ap_QC` ",
			'MgtofChange' => "`MgtofChange` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MgtofChange`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MgtofChange`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MgtofChange`.`ot_ap_QC` ",
			'IMStrackingNmonitoring' => "`IMStrackingNmonitoring` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`IMStrackingNmonitoring`.`WorklocID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`IMStrackingNmonitoring`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`IMStrackingNmonitoring`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`IMStrackingNmonitoring`.`ot_ap_QC` ",
			'IMSDataAnalysis' => "`IMSDataAnalysis` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`IMSDataAnalysis`.`worklocID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`IMSDataAnalysis`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`IMSDataAnalysis`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`IMSDataAnalysis`.`ot_ap_QC` ",
			'Audit' => "`Audit` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Audit`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Audit`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Audit`.`ot_ap_QC` ",
			'NonConformance' => "`NonConformance` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`NonConformance`.`worklocID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`NonConformance`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`NonConformance`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`NonConformance`.`ot_ap_QC` ",
			'ContinualImprovement' => "`ContinualImprovement` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ContinualImprovement`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ContinualImprovement`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ContinualImprovement`.`ot_ap_QC` ",
			'StakeholderSatisfaction' => "`StakeholderSatisfaction` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`StakeholderSatisfaction`.`fo_ProjectId` LEFT JOIN `resources` as resources1 ON `resources1`.`Id`=`StakeholderSatisfaction`.`fo_Recources` LEFT JOIN `Client` as Client1 ON `Client1`.`id`=`StakeholderSatisfaction`.`fo_ClientID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`StakeholderSatisfaction`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`StakeholderSatisfaction`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`StakeholderSatisfaction`.`ot_ap_QC` ",
			'MRM' => "`MRM` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MRM`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MRM`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MRM`.`ot_ap_QC` ",
			'projects' => "`projects` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`projects`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`projects`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`projects`.`ot_ap_QC` ",
			'WorkLocation' => "`WorkLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`WorkLocation`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`WorkLocation`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`WorkLocation`.`ot_ap_QC` ",
			'WorkPermit' => "`WorkPermit` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`WorkPermit`.`WrLocID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`WorkPermit`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`WorkPermit`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`WorkPermit`.`ot_ap_QC` ",
			'ProjectTeam' => "`ProjectTeam` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`ProjectTeam`.`BaseLocation` LEFT JOIN `ProjectTeam` as ProjectTeam1 ON `ProjectTeam1`.`ProjectTeamID`=`ProjectTeam`.`fo_ReportsTo` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ProjectTeam`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ProjectTeam`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ProjectTeam`.`ot_ap_QC` ",
			'resources' => "`resources` ",
			'PROInitiation' => "`PROInitiation` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`PROInitiation`.`ProjectsID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`PROInitiation`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`PROInitiation`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`PROInitiation`.`ot_ap_QC` ",
			'PROPlanning' => "`PROPlanning` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`PROPlanning`.`ProjectsID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`PROPlanning`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`PROPlanning`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`PROPlanning`.`ot_ap_QC` ",
			'PROExecution' => "`PROExecution` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`PROExecution`.`ProjectsID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`PROExecution`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`PROExecution`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`PROExecution`.`ot_ap_QC` ",
			'DailyProgressReport' => "`DailyProgressReport` LEFT JOIN `PROExecution` as PROExecution1 ON `PROExecution1`.`id`=`DailyProgressReport`.`DPRID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`DailyProgressReport`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`DailyProgressReport`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`DailyProgressReport`.`ot_ap_QC` ",
			'MonthlyTimesheet' => "`MonthlyTimesheet` LEFT JOIN `PROExecution` as PROExecution1 ON `PROExecution1`.`id`=`MonthlyTimesheet`.`MTSID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MonthlyTimesheet`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MonthlyTimesheet`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MonthlyTimesheet`.`ot_ap_QC` ",
			'Breakdown' => "`Breakdown` LEFT JOIN `PROExecution` as PROExecution1 ON `PROExecution1`.`id`=`Breakdown`.`MTSID` LEFT JOIN `resources` as resources1 ON `resources1`.`Id`=`Breakdown`.`ResourceId` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Breakdown`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Breakdown`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Breakdown`.`ot_ap_QC` ",
			'PROControlMonitoring' => "`PROControlMonitoring` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`PROControlMonitoring`.`ProjectsID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`PROControlMonitoring`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`PROControlMonitoring`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`PROControlMonitoring`.`ot_ap_QC` ",
			'PROVariation' => "`PROVariation` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`PROVariation`.`ProjectsID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`PROVariation`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`PROVariation`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`PROVariation`.`ot_ap_QC` ",
			'PROCompletion' => "`PROCompletion` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`PROCompletion`.`ProjectsID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`PROCompletion`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`PROCompletion`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`PROCompletion`.`ot_ap_QC` ",
			'Receivables' => "`Receivables` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`Receivables`.`ProjectsID` LEFT JOIN `resources` as resources1 ON `resources1`.`Id`=`Receivables`.`ResourcesID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Receivables`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Receivables`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Receivables`.`ot_ap_QC` ",
			'ClaimRecord' => "`ClaimRecord` LEFT JOIN `Receivables` as Receivables1 ON `Receivables1`.`id`=`ClaimRecord`.`ReceivablesID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ClaimRecord`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ClaimRecord`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ClaimRecord`.`ot_ap_QC` ",
			'TeamSoftBoard' => "`TeamSoftBoard` ",
			'SoftboardComment' => "`SoftboardComment` LEFT JOIN `TeamSoftBoard` as TeamSoftBoard1 ON `TeamSoftBoard1`.`Postid`=`SoftboardComment`.`PostID` ",
			'IMSReport' => "`IMSReport` ",
			'ReportComment' => "`ReportComment` LEFT JOIN `IMSReport` as IMSReport1 ON `IMSReport1`.`Postid`=`ReportComment`.`PostID` ",
			'Leadership' => "`Leadership` ",
			'Approval' => "`Approval` ",
			'IMSControl' => "`IMSControl` ",
			'membership_company' => "`membership_company` ",
			'kpi' => "`kpi` ",
			'summary_dashboard' => "`summary_dashboard` "
		);

		$pkey = array(   
			'OrgContentContext' => 'id',
			'Marketing' => 'id',
			'Client' => 'id',
			'Inquiry' => 'id',
			'DesignProposal' => 'id',
			'ContractDeployment' => 'id',
			'employees' => 'EmployeeID',
			'Recruitment' => 'RecruitID',
			'PersonnalFile' => 'PersonalFileID',
			'Competency' => 'CompetencyID',
			'Training' => 'TrainingID',
			'JD_JS' => 'id',
			'InOutRegister' => 'id',
			'vendor' => 'VendorID',
			'ManagingVendor' => 'id',
			'VenPerformance' => 'id',
			'Logistics' => 'ShipperID',
			'Inventory' => 'id',
			'CalibrationCtrl' => 'id',
			'WorkOrder' => 'id',
			'MWO' => 'id',
			'MWOPlanned' => 'WMOPlannedID',
			'MWOpreventive' => 'id',
			'MWOproactive' => 'id',
			'MWConditionBased' => 'id',
			'MWOReactive' => 'id',
			'MWOCorrective' => 'id',
			'LogisticRequest' => 'id',
			'orders' => 'id',
			'Quotation' => 'id',
			'PurchaseOrder' => 'id',
			'DeliveryOrder' => 'id',
			'AccountPayables' => 'id',
			'Item' => 'ProductID',
			'categories' => 'CategoryID',
			'batches' => 'id',
			'transactions' => 'id',
			'CommConsParticipate' => 'id',
			'ToolBoxMeeting' => 'id',
			'Bi_WeeklyMeeting' => 'id',
			'QuarterlyMeeting' => 'id',
			'Campaign' => 'id',
			'DrillNInspection' => 'id',
			'ManagementVisit' => 'id',
			'EventNotification' => 'id',
			'ActCard' => 'id',
			'KM' => 'id',
			'LegalRegister' => 'id',
			'RiskandOpportunity' => 'id',
			'DocControl' => 'id',
			'DCN' => 'id',
			'ObsoleteRec' => 'id',
			'QA' => 'id',
			'ERP' => 'id',
			'WorkEnvMonitoring' => 'id',
			'ScheduleWaste' => 'id',
			'IncidentReporting' => 'id',
			'MgtofChange' => 'id',
			'IMStrackingNmonitoring' => 'id',
			'IMSDataAnalysis' => 'id',
			'Audit' => 'id',
			'NonConformance' => 'id',
			'ContinualImprovement' => 'id',
			'StakeholderSatisfaction' => 'id',
			'MRM' => 'id',
			'projects' => 'Id',
			'WorkLocation' => 'id',
			'WorkPermit' => 'id',
			'ProjectTeam' => 'ProjectTeamID',
			'resources' => 'Id',
			'PROInitiation' => 'id',
			'PROPlanning' => 'id',
			'PROExecution' => 'id',
			'DailyProgressReport' => 'id',
			'MonthlyTimesheet' => 'id',
			'Breakdown' => 'Id',
			'PROControlMonitoring' => 'id',
			'PROVariation' => 'id',
			'PROCompletion' => 'id',
			'Receivables' => 'id',
			'ClaimRecord' => 'id',
			'TeamSoftBoard' => 'Postid',
			'SoftboardComment' => 'RunningID',
			'IMSReport' => 'Postid',
			'ReportComment' => 'RunningID',
			'Leadership' => 'id',
			'Approval' => 'id',
			'IMSControl' => 'id',
			'membership_company' => 'compID',
			'kpi' => 'id',
			'summary_dashboard' => 'id'
		);

		if(isset($sql_from[$table_name])){
			if($skip_permissions) return $sql_from[$table_name];

			// mm: build the query based on current member's permissions
			$perm = getTablePermissions($table_name);
			if($perm[2] == 1){ // view owner only
				$sql_from[$table_name] .= ", membership_userrecords WHERE `{$table_name}`.`{$pkey[$table_name]}`=membership_userrecords.pkValue and membership_userrecords.tableName='{$table_name}' and lcase(membership_userrecords.memberID)='" . getLoggedMemberID() . "'";
			}elseif($perm[2] == 2){ // view group only
				$sql_from[$table_name] .= ", membership_userrecords WHERE `{$table_name}`.`{$pkey[$table_name]}`=membership_userrecords.pkValue and membership_userrecords.tableName='{$table_name}' and membership_userrecords.groupID='" . getLoggedGroupID() . "'";
			}elseif($perm[2] == 3){ // view all
				$sql_from[$table_name] .= ' WHERE 1=1';
			}else{ // view none
				return false;
			}
			return $sql_from[$table_name];
		}

		return false;
	}

	#########################################################

	function get_joined_record($table, $id, $skip_permissions = false){
		$sql_fields = get_sql_fields($table);
		$sql_from = get_sql_from($table, $skip_permissions);

		if(!$sql_fields || !$sql_from) return false;

		$pk = getPKFieldName($table);
		if(!$pk) return false;

		$safe_id = makeSafe($id, false);
		$sql = "SELECT {$sql_fields} FROM {$sql_from} AND `{$table}`.`{$pk}`='{$safe_id}'";
		$eo['silentErrors'] = true;
		$res = sql($sql, $eo);
		if($row = db_fetch_assoc($res)) return $row;

		return false;
	}

	#########################################################

	function get_defaults($table){
		/* array of tables and their fields, with default values (or empty), excluding automatic values */
		$defaults = array(
			'OrgContentContext' => array(
				'id' => '',
				'RecordNumber' => '',
				'DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Type' => 'Unknown',
				'fo_genrec' => '',
				'fo_Update' => '',
				'fo_DateUpload' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Marketing' => array(
				'id' => '',
				'RecordNumber' => '',
				'DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Type' => 'Unknown',
				'fo_Source' => '',
				'fo_Qualification' => '',
				'fo_DateUpload' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Client' => array(
				'id' => '',
				'ClientID' => '',
				'CompanyName' => '',
				'fo_ContactName' => '',
				'fo_ContactTitle' => '',
				'fo_Address' => '',
				'fo_City' => '',
				'fo_Region' => '',
				'fo_PostalCode' => '',
				'fo_Country' => '',
				'fo_Phone' => '',
				'fo_Fax' => '',
				'fo_Email' => '',
				'ot_FileLoc' => '',
				'ot_otherDetails' => '',
				'ot_Comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Inquiry' => array(
				'id' => '',
				'InqNumber' => '',
				'ClientID' => '',
				'fo_InquiryDate' => '1',
				'fo_DueDate' => '1',
				'fo_Classification' => 'Unknown',
				'fo_DeliveryDate' => '',
				'fo_Logistic' => '',
				'fo_Freight' => '0',
				'fo_ShipName' => '',
				'fo_ShipAddress' => '',
				'fo_ShipCity' => '',
				'fo_ShipRegion' => '',
				'fo_ShipPostalCode' => '',
				'fo_ShipCountry' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'DesignProposal' => array(
				'id' => '',
				'DocconNumber' => '',
				'InquiryID' => '',
				'fo_Type' => 'Unknown',
				'fo_Intro' => '',
				'fo_DocumentDescription' => '',
				'fo_RecSub' => '',
				'fo_Submissiondate' => '',
				'fo_contact_person' => '',
				'fo_Price' => '0.00',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ContractDeployment' => array(
				'id' => '',
				'DocconNumber' => '',
				'InquiryID' => '',
				'fo_Type' => '',
				'fo_Intro' => '',
				'fo_DocumentDescription' => '',
				'fo_ExeDate' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'employees' => array(
				'EmployeeID' => '',
				'memberID' => '',
				'EmpNo' => '',
				'Name' => '',
				'BaseLocation' => '',
				'fo_TermEmployment' => '',
				'fo_Photo01' => '',
				'fo_Photo02' => '',
				'fo_Photo03' => '',
				'fo_Position' => '',
				'fo_HireDate' => '1',
				'fo_OffHireDate' => '',
				'fo_Address' => '',
				'fo_City' => '',
				'fo_Region' => '',
				'fo_PostalCode' => '',
				'fo_Country' => '',
				'fo_HomePhone' => '',
				'fo_Extension' => '',
				'fo_Notes' => '',
				'fo_ReportsTo' => '',
				'fo_Acknowledgement' => '0',
				'fo_Induction' => '0',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Recruitment' => array(
				'RecruitID' => '',
				'CompID' => '',
				'EmployeeID' => '',
				'ProjectTeamID' => '',
				'fo_RecruitmentSession' => '',
				'fo_Description' => '',
				'fo_Date' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'PersonnalFile' => array(
				'PersonalFileID' => '',
				'FileID' => '',
				'EmployeeID' => '',
				'ProjectTeamID' => '',
				'fo_PersonalFileDesc' => '',
				'fo_Description' => '',
				'fo_Date' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Competency' => array(
				'CompetencyID' => '',
				'CompID' => '',
				'EmployeeID' => '',
				'ProjectTeamID' => '',
				'fo_CompetencySession' => '',
				'fo_Description' => '',
				'fo_Date' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Training' => array(
				'TrainingID' => '',
				'TraningNo' => '',
				'EmployeeID' => '',
				'ProjectTeamID' => '',
				'fo_TrainingSession' => '',
				'fo_Classification' => '',
				'fo_Description' => '',
				'fo_Date' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'JD_JS' => array(
				'id' => '',
				'RecordNumber' => '',
				'DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_EmployeeID' => '',
				'fo_ProjectTeamID' => '',
				'fo_JDDesc' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'InOutRegister' => array(
				'id' => '',
				'RecordNumber' => '',
				'DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Delivdate' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'vendor' => array(
				'VendorID' => '',
				'CompanyID' => '',
				'CopanyName' => '',
				'fo_AVList' => '0',
				'fo_ContactTitle' => '',
				'fo_Address' => '',
				'fo_City' => '',
				'fo_Region' => '',
				'fo_PostalCode' => '',
				'fo_Country' => '',
				'fo_Phone' => '',
				'fo_Fax' => '',
				'fo_HomePage' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ManagingVendor' => array(
				'id' => '',
				'ManagingVendNumber' => '',
				'DocItem' => '',
				'fo_VendorID' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Auditdate' => '',
				'fo_image' => '',
				'fo_address' => '',
				'fo_city' => '',
				'fo_state' => '',
				'fo_zip' => '',
				'fo_workphone' => '',
				'fo_mobile' => '',
				'fo_contactperson' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'VenPerformance' => array(
				'id' => '',
				'VendPerfNumber' => '',
				'DocItem' => '',
				'fo_SupplierID' => '',
				'fo_NewList' => '0',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Perfdate' => '1',
				'fo_image' => '',
				'fo_address' => '',
				'fo_city' => '',
				'fo_state' => '',
				'fo_zip' => '',
				'fo_workphone' => '',
				'fo_mobile' => '',
				'fo_contactperson' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Logistics' => array(
				'ShipperID' => '',
				'LogisticID' => '',
				'CompanyName' => '',
				'fo_AVList' => '0',
				'fo_Phone' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_last_modified' => ''
			),
			'Inventory' => array(
				'id' => '',
				'InventoryID' => '',
				'asset_title' => '',
				'Description' => '',
				'fo_Type' => '',
				'fo_Manufacturer' => '',
				'fo_ModelNumber' => '',
				'fo_SerialNumber' => '',
				'fo_Condition' => 'Unknown',
				'fo_history' => 'Unknown',
				'fo_Quantity' => '0',
				'fo_UnitPrice' => '0',
				'fo_Remarks' => '',
				'fo_date' => '1',
				'fo_ItemLocation' => '',
				'fo_image' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_last_modified' => ''
			),
			'CalibrationCtrl' => array(
				'id' => '',
				'CalibrationID' => '',
				'Calibtitle' => '',
				'fo_InventoryID' => 'Unknown',
				'fo_CalCom' => '',
				'fo_DurCal' => '',
				'fo_Delivdate' => '',
				'fo_contact_person' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'WorkOrder' => array(
				'id' => '',
				'WONumber' => '',
				'Task' => '',
				'fo_Critical' => 'Unknown',
				'fo_EmployeeID' => '',
				'fo_Position' => '',
				'fo_BaseLocation' => '',
				'fo_JobInstruction' => 'Unknown',
				'fo_DetailInstruction' => '',
				'fo_Resources' => '',
				'fo_Duedate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MWO' => array(
				'id' => '',
				'MWONumber' => '',
				'Critical' => 'Unknown',
				'fo_InventoryID' => 'Unknown',
				'fo_Task' => '',
				'fo_Category' => 'Unknown',
				'fo_JobInstruction' => 'Unknown',
				'fo_DetailInstruction' => '',
				'fo_Resources' => '',
				'fo_Duedate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MWOPlanned' => array(
				'WMOPlannedID' => '',
				'PlannedID' => '',
				'MwoID' => '0',
				'fo_EmployeeID' => '',
				'fo_Position' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MWOpreventive' => array(
				'id' => '',
				'PreventiveID' => '',
				'MwoID' => '0',
				'fo_EmployeeID' => '',
				'fo_Position' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MWOproactive' => array(
				'id' => '',
				'ProactiveID' => '',
				'MwoID' => '0',
				'fo_EmployeeID' => '',
				'fo_Position' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MWConditionBased' => array(
				'id' => '',
				'CondBaseID' => '',
				'MwoID' => '0',
				'fo_EmployeeID' => '',
				'fo_Position' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MWOReactive' => array(
				'id' => '',
				'ReactiveID' => '',
				'MwoID' => '0',
				'fo_EmployeeID' => '',
				'fo_Position' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MWOCorrective' => array(
				'id' => '',
				'CorrectiveID' => '',
				'MwoID' => '0',
				'fo_EmployeeID' => '',
				'fo_Position' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'LogisticRequest' => array(
				'id' => '',
				'LogisticNumber' => '',
				'Market_Survey' => 'Unknown',
				'fo_ResourcesID' => 'Unknown',
				'fo_ProjectID' => 'Unknown',
				'fo_ShipVia' => '',
				'fo_Deliverydate' => '1',
				'fo_address' => '',
				'fo_city' => '',
				'fo_zip' => '',
				'fo_Countrys' => '',
				'fo_homephone' => '',
				'fo_workphone' => '',
				'fo_contactperson' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'orders' => array(
				'id' => '',
				'OrderID' => '',
				'Market_Survey' => 'Unknown',
				'fo_Classification' => 'Unknown',
				'fo_Critical' => 'Unknown',
				'fo_Justification' => 'Unknown',
				'fo_ProjectID' => '',
				'fo_InventoryID' => '',
				'fo_ItemID' => '',
				'fo_ProductID' => '0',
				'fo_Description' => '',
				'fo_Detail' => '',
				'fo_OrderDate' => '1',
				'fo_RequiredDate' => '1',
				'fo_ShippedDate' => '',
				'fo_ShipVia' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Quotation' => array(
				'id' => '',
				'QuoID' => '',
				'OrderID' => '0',
				'fo_Vendor' => '0',
				'fo_ShipVia' => '',
				'fo_Price' => '0.00',
				'fo_Description' => '',
				'fo_Discount' => '0',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_last_modified' => ''
			),
			'PurchaseOrder' => array(
				'id' => '',
				'POID' => '',
				'OrderID' => '0',
				'fo_Vendor' => '0',
				'fo_ShipVia' => '',
				'fo_Price' => '0.00',
				'fo_Description' => '',
				'fo_Discount' => '0',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'DeliveryOrder' => array(
				'id' => '',
				'DOID' => '',
				'OrderID' => '0',
				'fo_Vendor' => '0',
				'fo_ShipVia' => '',
				'fo_Description' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'AccountPayables' => array(
				'id' => '',
				'APID' => '',
				'OrderID' => '0',
				'fo_Vendor' => '0',
				'fo_ShipVia' => '',
				'fo_UnitPrice' => '0',
				'fo_Description' => '',
				'fo_Discount' => '0',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Item' => array(
				'ProductID' => '',
				'ItemID' => '',
				'ProductName' => '',
				'fo_SupplierID' => '',
				'fo_CategoryID' => '',
				'fo_QuantityPerUnit' => '',
				'fo_UnitPrice' => '0',
				'fo_UnitsInStock' => '0',
				'fo_UnitsOnOrder' => '0',
				'fo_ReorderLevel' => '0',
				'fo_Description' => '',
				'fo_Discontinued' => '0',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'categories' => array(
				'CategoryID' => '',
				'CategoryName' => '',
				'fo_Description' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Picture01' => '',
				'ot_Picture02' => '',
				'ot_Picture03' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'batches' => array(
				'id' => '',
				'batch_no' => '',
				'fo_item' => '',
				'fo_suppliers' => '',
				'fo_manudate' => '1',
				'fo_expdate' => '1',
				'fo_Quantity' => '',
				'ot_FileLoc' => '',
				'fo_otherdetails' => '',
				'fo_comments' => '',
				'fo_SharedLink1' => '',
				'fo_SharedLink2' => '',
				'fo_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'fo_ap_filed' => '',
				'fo_lastmodified' => ''
			),
			'transactions' => array(
				'id' => '',
				'TransCode' => '',
				'fo_transaction_date' => '1',
				'fo_item' => '',
				'fo_ResourcesID' => '',
				'fo_transactiontype' => '',
				'fo_quantity' => '1.00',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'CommConsParticipate' => array(
				'id' => '',
				'ccpID' => '',
				'WorkLocationID' => '',
				'fo_WorkDate' => '1',
				'fo_RequiredDate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ToolBoxMeeting' => array(
				'id' => '',
				'tbmID' => '',
				'ccpID' => '0',
				'fo_Desc' => '',
				'fo_RequiredDate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Bi_WeeklyMeeting' => array(
				'id' => '',
				'BwmID' => '',
				'ccpID' => '0',
				'fo_Desc' => '',
				'fo_RequiredDate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'QuarterlyMeeting' => array(
				'id' => '',
				'QmID' => '',
				'ccpID' => '0',
				'fo_Desc' => '',
				'fo_RequiredDate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Campaign' => array(
				'id' => '',
				'CampaignID' => '',
				'ccpID' => '0',
				'fo_Desc' => '',
				'fo_RequiredDate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_last_modified' => ''
			),
			'DrillNInspection' => array(
				'id' => '',
				'DillID' => '',
				'ccpID' => '0',
				'fo_Desc' => '',
				'fo_Classification' => 'Unknown',
				'fo_RequiredDate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ManagementVisit' => array(
				'id' => '',
				'MgtVstID' => '',
				'ccpID' => '0',
				'fo_Desc' => '',
				'fo_Classification' => 'Unknown',
				'fo_RequiredDate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'EventNotification' => array(
				'id' => '',
				'ENID' => '',
				'ccpID' => '0',
				'fo_Desc' => '',
				'fo_RequiredDate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ActCard' => array(
				'id' => '',
				'ACID' => '',
				'ccpID' => '0',
				'fo_Desc' => '',
				'fo_Classification' => 'Unknown',
				'fo_RequiredDate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_filed' => '',
				'ot_ap_last_modified' => ''
			),
			'KM' => array(
				'id' => '',
				'DocumentName' => '',
				'fo_Description' => '',
				'fo_Reference' => '',
				'fo_Volume' => '',
				'fo_Classification' => 'Unknown',
				'fo_Class' => 'Unknown',
				'fo_Regdate' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'LegalRegister' => array(
				'id' => '',
				'LRNumber' => '',
				'LegalItem' => '',
				'fo_LRDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Class' => 'Unknown',
				'fo_date' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'RiskandOpportunity' => array(
				'id' => '',
				'RISKid' => '',
				'Item' => '',
				'fo_Description' => '',
				'fo_Class' => 'Unknown',
				'fo_Riskregister' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'DocControl' => array(
				'id' => '',
				'DocconNumber' => '',
				'DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Class' => 'Unknown',
				'fo_DocumentType' => '',
				'fo_Rev' => '00',
				'fo_date' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'DCN' => array(
				'id' => '',
				'DocconNumber' => '',
				'DCCID' => '0',
				'fo_DCCITEM' => '0',
				'fo_Description' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ObsoleteRec' => array(
				'id' => '',
				'DocconNumber' => '',
				'DCCID' => '0',
				'fo_DCCITEM' => '0',
				'fo_Description' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'QA' => array(
				'id' => '',
				'DocconNumber' => '',
				'BaseLocation' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Class' => 'Unknown',
				'fo_Classification' => 'Unknown',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_last_modified' => ''
			),
			'ERP' => array(
				'id' => '',
				'DocconNumber' => '',
				'BaseLocation' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Impact' => 'Unknown',
				'fo_Registerdate' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'WorkEnvMonitoring' => array(
				'id' => '',
				'DocconNumber' => '',
				'BaseLocation' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Impact' => 'Unknown',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherDetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ScheduleWaste' => array(
				'id' => '',
				'DocconNumber' => '',
				'worklocID' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Impact' => 'Unknown',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'IncidentReporting' => array(
				'id' => '',
				'DocconNumber' => '',
				'BaseLocation' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Impact' => 'Unknown',
				'fo_regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MgtofChange' => array(
				'id' => '',
				'DocconNumber' => '',
				'title' => '',
				'fo_Desc' => '',
				'fo_class' => 'Unknown',
				'fo_regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'IMStrackingNmonitoring' => array(
				'id' => '',
				'DocconNumber' => '',
				'WorklocID' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Impact' => 'Unknown',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'IMSDataAnalysis' => array(
				'id' => '',
				'DocconNumber' => '',
				'worklocID' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Impact' => 'Unknown',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Audit' => array(
				'id' => '',
				'AuditNo' => '',
				'Rectitle' => '',
				'fo_Desc' => '',
				'fo_Auditor' => '',
				'fo_Classification' => 'Unknown',
				'fo_Regdate' => '1',
				'fo_AuditMemo' => '0',
				'fo_AuditPlan' => '0',
				'fo_AuditNote' => '0',
				'fo_AuditReport' => '0',
				'fo_NoObservation' => '0',
				'fo_NoMinorNC' => '0',
				'fo_NoMajorNC' => '0',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'NonConformance' => array(
				'id' => '',
				'DocconNumber' => '',
				'worklocID' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Impact' => 'Unknown',
				'fo_Regdate' => '1',
				'fo_ClosedIssue' => '0',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ContinualImprovement' => array(
				'id' => '',
				'CAPARno' => '',
				'RecTitle' => '',
				'fo_Class' => '',
				'fo_CAPAR' => '',
				'fo_Desc' => '',
				'fo_Regdate' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'StakeholderSatisfaction' => array(
				'id' => '',
				'RecordID' => '',
				'RecTitle' => '',
				'fo_ProjectId' => '',
				'fo_Recources' => '',
				'fo_ClientID' => '',
				'fo_gender' => '',
				'fo_SurveyType' => '',
				'fo_Stakeholder' => '',
				'fo_Description' => '',
				'fo_Regdate' => '1',
				'fo_website' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MRM' => array(
				'id' => '',
				'DocconNumber' => '',
				'DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Classification' => 'Unknown',
				'fo_Impact' => 'Unknown',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'projects' => array(
				'Id' => '',
				'projectID' => '',
				'Name' => '',
				'fo_ProjectIndication' => 'Unknown',
				'fo_DocumentDescription' => '',
				'fo_StartDate' => '1',
				'fo_EndDate' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'WorkLocation' => array(
				'id' => '',
				'BaseLocation' => '',
				'DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Type' => 'Unknown',
				'fo_Sector' => '',
				'fo_Zone' => '',
				'fo_Country' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'WorkPermit' => array(
				'id' => '',
				'RecNum' => '',
				'WrLocID' => '0',
				'fo_Type' => 'Unknown',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ProjectTeam' => array(
				'ProjectTeamID' => '',
				'EmpNo' => '',
				'Name' => '',
				'BaseLocation' => '',
				'fo_TermEmployment' => '',
				'fo_Photo01' => '',
				'fo_Photo02' => '',
				'fo_Photo03' => '',
				'fo_Position' => '',
				'fo_HireDate' => '1',
				'fo_OffHireDate' => '',
				'fo_Address' => '',
				'fo_City' => '',
				'fo_Region' => '',
				'fo_PostalCode' => '',
				'fo_Country' => '',
				'fo_HomePhone' => '',
				'fo_Extension' => '',
				'fo_Notes' => '',
				'fo_ReportsTo' => '',
				'fo_Acknowledgement' => '0',
				'fo_Induction' => '0',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'resources' => array(
				'Id' => '',
				'ResourcesID' => '',
				'Name' => '',
				'fo_Type' => 'Unknown',
				'fo_Description' => '',
				'fo_Available' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'PROInitiation' => array(
				'id' => '',
				'InitiationNo' => '',
				'ProjectsID' => '',
				'fo_InitiationForm' => 'Unknown',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'PROPlanning' => array(
				'id' => '',
				'PlanningNo' => '',
				'ProjectsID' => '',
				'fo_RelatedDocument' => 'Unknown',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'PROExecution' => array(
				'id' => '',
				'ExecutionNo' => '',
				'ProjectsID' => '',
				'fo_Classification' => 'Unknown',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'DailyProgressReport' => array(
				'id' => '',
				'ProgressReportId' => '',
				'DPRID' => '0',
				'fo_Class' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Location' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'MonthlyTimesheet' => array(
				'id' => '',
				'TimesheetID' => '',
				'MTSID' => '0',
				'fo_Class' => '',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Breakdown' => array(
				'Id' => '',
				'recID' => '',
				'MTSID' => '',
				'ResourceId' => '',
				'Title' => '',
				'fo_Description' => '',
				'ot_FileLoc' => '',
				'ot_otherDetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'PROControlMonitoring' => array(
				'id' => '',
				'ContMonitNo' => '',
				'ProjectsID' => '',
				'fo_AuditInspection' => 'Unknown',
				'fo_Classification' => 'Unknown',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'PROVariation' => array(
				'id' => '',
				'VariationNo' => '',
				'ProjectsID' => '',
				'fo_Classification' => 'Unknown',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'PROCompletion' => array(
				'id' => '',
				'CompletionNo' => '',
				'ProjectsID' => '',
				'fo_Classification' => 'Unknown',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_Regdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'Receivables' => array(
				'id' => '',
				'ClaimNo' => '',
				'ProjectsID' => '',
				'ResourcesID' => 'Unknown',
				'fo_Classification' => 'Unknown',
				'fo_DocItem' => '',
				'fo_UnitPrice' => '0',
				'fo_DocumentDescription' => '',
				'fo_Registerdate' => '1',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'ClaimRecord' => array(
				'id' => '',
				'CRID' => '',
				'ReceivablesID' => '0',
				'fo_DocItem' => '',
				'fo_DocumentDescription' => '',
				'fo_UnitPrice' => '0',
				'ot_FileLoc' => '',
				'ot_otherdetails' => '',
				'ot_comments' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_Photo01' => '',
				'ot_Photo02' => '',
				'ot_Photo03' => '',
				'ot_ap_Review' => '1',
				'ot_ap_RevComment' => '',
				'ot_ap_Approval' => '1',
				'ot_ap_ApprComment' => '',
				'ot_ap_QC' => '1',
				'ot_ap_QCComment' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'TeamSoftBoard' => array(
				'Postid' => '',
				'Title' => '',
				'image01' => '',
				'image02' => '',
				'image03' => '',
				'TextPost' => '',
				'website' => '',
				'Ref01' => '',
				'Ref02' => '',
				'Ref03' => '',
				'Ref04' => '',
				'Ref05' => '',
				'Ref06' => '',
				'filed' => '',
				'last_modified' => ''
			),
			'SoftboardComment' => array(
				'RunningID' => '',
				'PostID' => '0',
				'TextPost' => '',
				'filed' => '',
				'last_modified' => ''
			),
			'IMSReport' => array(
				'Postid' => '',
				'Title' => '',
				'image' => '',
				'TextPost' => '',
				'website' => '',
				'Ref01' => '',
				'Ref02' => '',
				'Ref03' => '',
				'Ref04' => '',
				'Ref05' => '',
				'Ref06' => '',
				'ClosedIssue' => '0',
				'filed' => '',
				'last_modified' => ''
			),
			'ReportComment' => array(
				'RunningID' => '',
				'PostID' => '0',
				'TextPost' => '',
				'filed' => '',
				'last_modified' => ''
			),
			'Leadership' => array(
				'id' => '',
				'Status' => '',
				'Description' => '',
				'other_details' => '',
				'filed' => '',
				'last_modified' => ''
			),
			'Approval' => array(
				'id' => '',
				'Status' => '',
				'Description' => '',
				'other_details' => '',
				'filed' => '',
				'last_modified' => ''
			),
			'IMSControl' => array(
				'id' => '',
				'Status' => '',
				'Description' => '',
				'other_details' => '',
				'filed' => '',
				'last_modified' => ''
			),
			'membership_company' => array(
				'compID' => '',
				'fo_Name' => '',
				'fo_RegistrationID' => '',
				'fo_Logo' => '',
				'fo_Banner' => '',
				'fo_Photo01' => '',
				'fo_Photo02' => '',
				'fo_Photo03' => '',
				'fo_Address' => '',
				'fo_City' => '',
				'fo_Region' => '',
				'fo_PostalCode' => '',
				'fo_Country' => '',
				'fo_Phone_1' => '',
				'fo_Phone_2' => '',
				'fo_Fax' => '',
				'fo_Email' => '',
				'fo_Admin_Email' => '',
				'ot_Comments' => '',
				'ot_otherDetails' => '',
				'ot_SharedLink1' => '',
				'ot_SharedLink2' => '',
				'ot_Ref01' => '',
				'ot_Ref02' => '',
				'ot_Ref03' => '',
				'ot_Ref04' => '',
				'ot_Ref05' => '',
				'ot_Ref06' => '',
				'ot_ap_filed' => '',
				'ot_ap_lastmodified' => ''
			),
			'kpi' => array(
				'id' => '',
				'ot_ap_Date' => '',
				'fo_Section_Name' => '',
				'fo_Section_Caption' => '',
				'fo_MinRecordRequired' => '',
				'fo_TaskCompDuration' => '',
				'fo_PercentageAchieved' => '',
				'ot_ap_lastmodified' => ''
			),
			'summary_dashboard' => array(
				'id' => '',
				'ot_ap_Date' => '',
				'fo_Section_Name' => '',
				'fo_Section_Caption' => '',
				'fo_TotalDisplayField' => '',
				'fo_TotalCount' => '',
				'fo_ReviewCount' => '',
				'fo_ApprovalCount' => '',
				'fo_IMSControlCount' => '',
				'fo_CustomDisplayField1' => '',
				'fo_CustomDisplayValue1' => '',
				'fo_CustomDisplayField2' => '',
				'fo_CustomDisplayValue2' => '',
				'ot_ap_lastmodified' => ''
			)
		);

		return isset($defaults[$table]) ? $defaults[$table] : array();
	}

	#########################################################

	function logInMember(){
		global $adminConfig;
		$redir = 'index.php';
		if($_POST['signIn'] != ''){
			if($_POST['username'] != '' && $_POST['token'] != ''){
				$username = makeSafe(strtolower($_POST['username']));
				// $password = md5($_POST['password']);
				$token = $_POST['token'];

				if(sqlValue("select count(1) from membership_users where lcase(memberID)='$username' and passMD5='$token' and isApproved=1 and isBanned=0")==1){
					$_SESSION['memberID']=$username;
					$_SESSION['memberGroupID']=sqlValue("select groupID from membership_users where lcase(memberID)='$username'");
					if($_POST['rememberMe']==1){
						@setcookie('IMS_rememberMe', $username.$token, time()+86400*30);
					}else{
						@setcookie('IMS_rememberMe', '', time()-86400*30);
					}

					// hook: login_ok
					if(function_exists('login_ok')){
						$args=array();
						if(!$redir=login_ok(getMemberInfo(), $args)){
							$redir='index.php';
						}
					}

					redirect($redir);
					exit;
				}
			}

			// hook: login_failed
			if(function_exists('login_failed')){
				$args=array();
				login_failed(array(
					'username' => $_POST['username'],
					'password' => $_POST['token'],
					'IP' => $_SERVER['REMOTE_ADDR']
					), $args);
			}

			if(!headers_sent()) header('HTTP/1.0 403 Forbidden');
			redirect("../index.php?loginFailed=1");
			exit;
		}elseif((!$_SESSION['memberID'] || $_SESSION['memberID']==$adminConfig['anonymousMember']) && $_COOKIE['IMS_rememberMe']!=''){
			$chk=makeSafe($_COOKIE['IMS_rememberMe']);
			if($username=sqlValue("select memberID from membership_users where convert(md5(concat(memberID, passMD5)), char)='$chk' and isBanned=0")){
				$_SESSION['memberID']=$username;
				$_SESSION['memberGroupID']=sqlValue("select groupID from membership_users where lcase(memberID)='$username'");
			}
		}
	}

	#########################################################

	function htmlUserBar(){
		global $adminConfig, $Translation;
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');

		ob_start();
		$home_page = (basename($_SERVER['PHP_SELF'])=='index.php' ? true : false);

		?>
<header class="topbar" style="position: fixed; top: 0px; width: 100%;">
	<nav class="navbar top-navbar navbar-expand-md navbar-light">
		<!-- ============================================================== -->
		<!-- Logo -->
		<!-- ============================================================== -->
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo PREPEND_PATH; ?>index.php">
				<!-- Logo icon --><b>
					<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
					<!-- Dark Logo icon -->
					<img src="images/logo/icon.png" alt="homepage" class="icon dark-logo">
					<!-- Light Logo icon -->
					<img src="images/logo/light-icon.png" alt="homepage" class="light-logo">
				</b>
				<!--End Logo icon -->
				<!-- Logo text --><span>
					<!-- dark Logo text -->
					<img src="images/logo/text.png" alt="homepage" class="text dark-logo">
					<!-- Light Logo text -->    
					<img src="images/logo/light-text.png" class="light-logo" alt="homepage"></span> </a>
		</div>
		<!-- ============================================================== -->
		<!-- End Logo -->
		<!-- ============================================================== -->
		
		<div class="navbar-collapse">
			<ul class="navbar-nav mr-auto mt-md-0 "></ul>
			<ul class="navbar-nav my-lg-0">
			<div class="nav-item dropdown">
				<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:grey !important;"><i class="fa fa-user-circle" style="font-size: 4rem;vertical-align: middle;"></i></a>
				<div class="dropdown-menu dropdown-menu-right animated flipInY">
					<ul class="dropdown-user">
						<li>
							<div class="dw-user-box">
								<div class="u-img"><i class="fa fa-user-circle" style="font-size: 5rem;"></i></div>
								<div class="u-text">
									<h4><?php echo getLoggedMemberID(); ?></h4>
									<a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="btn btn-rounded btn-danger btn-sm no-margin">View Profile</a></div>
							</div>
						</li>
						<?php if(getLoggedAdmin()){ ?>
						<li role="separator" class="divider"></li>
						<li><a class="user-menu" href="<?php echo PREPEND_PATH; ?>admin/pageHome.php"><i class="fa fa-cog"></i><?php echo $Translation['admin area']; ?></a></li>
						<?php } ?>
						<li role="separator" class="divider"></li>
						<li><a class="user-menu" href="<?php echo PREPEND_PATH; ?>../index.php"><i class="fa fa-retweet"></i><?php echo 'Switch Account' ?></a></li>
						<li role="separator" class="divider"></li>
						<li><a class="user-menu" href="<?php echo PREPEND_PATH; ?>../index.php?signOut=1"><i class="fa fa-power-off"></i> <?php echo $Translation['sign out']; ?></a></li>
					</ul>
				</div>
			</div>
			</ul>
		</div>
	</nav>
</header>
<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
		<nav class="sidebar-nav active" role="navigation">
			<div class="navbar-header">
				<?php if(!$_GET['signIn']) { ?>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-header">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php } ?>
				<!-- application title is obtained from the name besides the yellow database icon in AppGini, use underscores for spaces -->
				<!-- <a class="btn navbar-btn btn-default" style="position:absolute;right:0px" href="<?php echo PREPEND_PATH; ?>../index.php"><i class="glyphicon glyphicon-retweet"></i>&nbsp;&nbsp;&nbsp;<?php echo 'Switch Account' ?></a> -->
			</div>
			<ul class="in" id="sidebarnav" class="top-menu" style="display: inline-block;">
					<?php /*if(!$home_page){ */?>
						<?php echo NavMenus(); ?>
					<?php /*} */?>
				</ul>

				<?php if(!$_GET['signIn'] && !$_GET['loginFailed']){ ?>
					<?php if(getLoggedMemberID() == $adminConfig['anonymousMember']){ ?>
						<p class="navbar-text navbar-right">&nbsp;</p>
						<a href="<?php echo PREPEND_PATH; ?>../index.php?signIn=1" class="btn btn-success navbar-btn navbar-right"><?php echo $Translation['sign in']; ?></a>
						<p class="navbar-text navbar-right">
							<?php echo $Translation['not signed in']; ?>
						</p>
					<?php }else{ ?>
						<!-- <ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">
							<a class="btn navbar-btn btn-default" href="<?php echo PREPEND_PATH; ?>../index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
							<p class="navbar-text">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link"><?php echo getLoggedMemberID(); ?></a></strong>
							</p>
						</ul>
						<ul class="nav navbar-nav visible-xs">
							<a class="btn navbar-btn btn-default btn-lg visible-xs" href="<?php echo PREPEND_PATH; ?>../index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
							<p class="navbar-text text-center">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link"><?php echo getLoggedMemberID(); ?></a></strong>
							</p>
						</ul> -->

						<script>
							/* periodically check if user is still signed in */
							setInterval(function(){
								$j.ajax({
									url: '<?php echo PREPEND_PATH; ?>ajax_check_login.php',
									success: function(username){
										if(!username.length) window.location = '<?php echo PREPEND_PATH; ?>../index.php?signIn=1';
									}
								});
							}, 60000);
						</script>
					<?php } ?>
				<?php } ?>
			<!-- <div class="collapse navbar-collapse mainBg sidebar-nav">
				<ul class="nav navbar-nav navbar-right hidden-xs sign-out">
					<a class="btn btn-sm btn-danger" href="<?php echo PREPEND_PATH; ?>../index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
					<p class="navbar-text">
						<?php if(getLoggedMemberID() != $adminConfig['anonymousMember']){ ?>
							<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link"><?php echo getLoggedMemberID(); ?></a></strong>
						<?php } ?>
					</p>
				</ul>
			</div> -->
		</nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
		<?php

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	#########################################################

	function showNotifications($msg = '', $class = '', $fadeout = true){
		global $Translation;

		$notify_template_no_fadeout = '<div id="%%ID%%" class="alert alert-dismissable %%CLASS%%" style="display: none; padding-top: 6px; padding-bottom: 6px;">' .
					'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' .
					'%%MSG%%</div>' .
					'<script> jQuery(function(){ /* */ jQuery("#%%ID%%").show("slow"); }); </script>'."\n";
		$notify_template = '<div id="%%ID%%" class="alert %%CLASS%%" style="display: none; padding-top: 6px; padding-bottom: 6px;">%%MSG%%</div>' .
					'<script>' .
						'jQuery(function(){' .
							'jQuery("#%%ID%%").show("slow", function(){' .
								'setTimeout(function(){ /* */ jQuery("#%%ID%%").hide("slow"); }, 4000);' .
							'});' .
						'});' .
					'</script>'."\n";

		if(!$msg){ // if no msg, use url to detect message to display
			if($_REQUEST['record-added-ok'] != ''){
				$msg = $Translation['new record saved'];
				$class = 'alert-success';
			}elseif($_REQUEST['record-added-error'] != ''){
				$msg = $Translation['Couldn\'t save the new record'];
				$class = 'alert-danger';
				$fadeout = false;
			}elseif($_REQUEST['record-updated-ok'] != ''){
				$msg = $Translation['record updated'];
				$class = 'alert-success';
			}elseif($_REQUEST['record-updated-error'] != ''){
				$msg = $Translation['Couldn\'t save changes to the record'];
				$class = 'alert-danger';
				$fadeout = false;
			}elseif($_REQUEST['record-deleted-ok'] != ''){
				$msg = $Translation['The record has been deleted successfully'];
				$class = 'alert-success';
				$fadeout = false;
			}elseif($_REQUEST['record-deleted-error'] != ''){
				$msg = $Translation['Couldn\'t delete this record'];
				$class = 'alert-danger';
				$fadeout = false;
			}else{
				return '';
			}
		}
		$id = 'notification-' . rand();

		$out = ($fadeout ? $notify_template : $notify_template_no_fadeout);
		$out = str_replace('%%ID%%', $id, $out);
		$out = str_replace('%%MSG%%', $msg, $out);
		$out = str_replace('%%CLASS%%', $class, $out);

		return $out;
	}

	#########################################################

	function parseMySQLDate($date, $altDate){
		// is $date valid?
		if(preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($date))){
			return trim($date);
		}

		if($date != '--' && preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($altDate))){
			return trim($altDate);
		}

		if($date != '--' && $altDate && intval($altDate)==$altDate){
			return @date('Y-m-d', @time() + ($altDate >= 1 ? $altDate - 1 : $altDate) * 86400);
		}

		return '';
	}

	#########################################################

	function parseCode($code, $isInsert=true, $rawData=false){
		if($isInsert){
			$arrCodes=array(
				'<%%creatorusername%%>' => $_SESSION['memberID'],
				'<%%creatorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%creatorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%creatorgroup%%>' => sqlValue("select name from membership_groups where groupID='{$_SESSION['memberGroupID']}'"),

				'<%%creationdate%%>' => ($rawData ? @date('Y-m-d') : @date('n/j/Y')),
				'<%%creationtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%creationdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('n/j/Y h:i:s a')),
				'<%%creationtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			);
		}else{
			$arrCodes=array(
				'<%%editorusername%%>' => $_SESSION['memberID'],
				'<%%editorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%editorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%editorgroup%%>' => sqlValue("select name from membership_groups where groupID='{$_SESSION['memberGroupID']}'"),

				'<%%editingdate%%>' => ($rawData ? @date('Y-m-d') : @date('n/j/Y')),
				'<%%editingtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%editingdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('n/j/Y h:i:s a')),
				'<%%editingtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			);
		}

		$pc=str_ireplace(array_keys($arrCodes), array_values($arrCodes), $code);

		return $pc;
	}

	#########################################################

	function addFilter($index, $filterAnd, $filterField, $filterOperator, $filterValue){
		// validate input
		if($index < 1 || $index > 80 || !is_int($index)) return false;
		if($filterAnd != 'or')   $filterAnd = 'and';
		$filterField = intval($filterField);

		/* backward compatibility */
		if(in_array($filterOperator, $GLOBALS['filter_operators'])){
			$filterOperator = array_search($filterOperator, $GLOBALS['filter_operators']);
		}

		if(!in_array($filterOperator, array_keys($GLOBALS['filter_operators']))){
			$filterOperator = 'like';
		}

		if(!$filterField){
			$filterOperator = '';
			$filterValue = '';
		}

		$_REQUEST['FilterAnd'][$index] = $filterAnd;
		$_REQUEST['FilterField'][$index] = $filterField;
		$_REQUEST['FilterOperator'][$index] = $filterOperator;
		$_REQUEST['FilterValue'][$index] = $filterValue;

		return true;
	}

	#########################################################

	function clearFilters(){
		for($i=1; $i<=80; $i++){
			addFilter($i, '', 0, '', '');
		}
	}

	#########################################################

	if(!function_exists('str_ireplace')){
		function str_ireplace($search, $replace, $subject){
			$ret=$subject;
			if(is_array($search)){
				for($i=0; $i<count($search); $i++){
					$ret=str_ireplace($search[$i], $replace[$i], $ret);
				}
			}else{
				$ret=preg_replace('/'.preg_quote($search, '/').'/i', $replace, $ret);
			}

			return $ret;
		} 
	} 

	#########################################################

	/**
	* Loads a given view from the templates folder, passing the given data to it
	* @param $view the name of a php file (without extension) to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_view (optional) associative array containing the data to pass to the view
	* @return the output of the parsed view as a string
	*/
	function loadView($view, $the_data_to_pass_to_the_view=false){
		global $Translation;

		$view = dirname(__FILE__)."/templates/$view.php";
		if(!is_file($view)) return false;

		if(is_array($the_data_to_pass_to_the_view)){
			foreach($the_data_to_pass_to_the_view as $k => $v)
				$$k = $v;
		}
		unset($the_data_to_pass_to_the_view, $k, $v);

		ob_start();
		@include($view);
		$out=ob_get_contents();
		ob_end_clean();

		return $out;
	}

	#########################################################

	/**
	* Loads a table template from the templates folder, passing the given data to it
	* @param $table_name the name of the table whose template is to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_table associative array containing the data to pass to the table template
	* @return the output of the parsed table template as a string
	*/
	function loadTable($table_name, $the_data_to_pass_to_the_table = array()){
		$dont_load_header = $the_data_to_pass_to_the_table['dont_load_header'];
		$dont_load_footer = $the_data_to_pass_to_the_table['dont_load_footer'];

		$header = $table = $footer = '';

		if(!$dont_load_header){
			// try to load tablename-header
			if(!($header = loadView("{$table_name}-header", $the_data_to_pass_to_the_table))){
				$header = loadView('table-common-header', $the_data_to_pass_to_the_table);
			}
		}

		$table = loadView($table_name, $the_data_to_pass_to_the_table);

		if(!$dont_load_footer){
			// try to load tablename-footer
			if(!($footer = loadView("{$table_name}-footer", $the_data_to_pass_to_the_table))){
				$footer = loadView('table-common-footer', $the_data_to_pass_to_the_table);
			}
		}

		return "{$header}{$table}{$footer}";
	}

	#########################################################

	function filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo){
		$filterersArray = explode(',', $filterers);
		$parentFilterersArray = explode(',', $parentFilterers);
		$parentFiltererList = '`' . implode('`, `', $parentFilterersArray) . '`';
		$res=sql("SELECT `$parentPKField`, $parentCaption, $parentFiltererList FROM `$parentTable` ORDER BY 2", $eo);
		$filterableData = array();
		while($row=db_fetch_row($res)){
			$filterableData[$row[0]] = $row[1];
			$filtererIndex = 0;
			foreach($filterersArray as $filterer){
				$filterableDataByFilterer[$filterer][$row[$filtererIndex + 2]][$row[0]] = $row[1];
				$filtererIndex++;
			}
			$row[0] = addslashes($row[0]);
			$row[1] = addslashes($row[1]);
			$jsonFilterableData .= "\"{$row[0]}\":\"{$row[1]}\",";
		}
		$jsonFilterableData .= '}';
		$jsonFilterableData = '{'.str_replace(',}', '}', $jsonFilterableData);     
		$filterJS = "\nvar {$filterable}_data = $jsonFilterableData;";

		foreach($filterersArray as $filterer){
			if(is_array($filterableDataByFilterer[$filterer])) foreach($filterableDataByFilterer[$filterer] as $filtererItem => $filterableItem){
				$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filtererItem).'":{';
				foreach($filterableItem as $filterableItemID => $filterableItemData){
					$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filterableItemID).'":"'.addslashes($filterableItemData).'",';
				}
				$jsonFilterableDataByFilterer[$filterer] .= '},';
			}
			$jsonFilterableDataByFilterer[$filterer] .= '}';
			$jsonFilterableDataByFilterer[$filterer] = '{'.str_replace(',}', '}', $jsonFilterableDataByFilterer[$filterer]);

			$filterJS.="\n\n// code for filtering {$filterable} by {$filterer}\n";
			$filterJS.="\nvar {$filterable}_data_by_{$filterer} = {$jsonFilterableDataByFilterer[$filterer]}; ";
			$filterJS.="\nvar selected_{$filterable} = \$j('#{$filterable}').val();";
			$filterJS.="\nvar {$filterable}_change_by_{$filterer} = function(){";
			$filterJS.="\n\t$('{$filterable}').options.length=0;";
			$filterJS.="\n\t$('{$filterable}').options[0] = new Option();";
			$filterJS.="\n\tif(\$j('#{$filterer}').val()){";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[\$j('#{$filterer}').val()]){";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data_by_{$filterer}[\$j('#{$filterer}').val()][{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t}else{";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data){";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data[{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t\tif(selected_{$filterable} && selected_{$filterable} == \$j('#{$filterable}').val()){";
			$filterJS.="\n\t\t\tfor({$filterer}_item in {$filterable}_data_by_{$filterer}){";
			$filterJS.="\n\t\t\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[{$filterer}_item]){";
			$filterJS.="\n\t\t\t\t\tif({$filterable}_item == selected_{$filterable}){";
			$filterJS.="\n\t\t\t\t\t\t$('{$filterer}').value = {$filterer}_item;";
			$filterJS.="\n\t\t\t\t\t\tbreak;";
			$filterJS.="\n\t\t\t\t\t}";
			$filterJS.="\n\t\t\t\t}";
			$filterJS.="\n\t\t\t\tif({$filterable}_item == selected_{$filterable}) break;";
			$filterJS.="\n\t\t\t}";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t}";
			$filterJS.="\n\t$('{$filterable}').highlight();";
			$filterJS.="\n};";
			$filterJS.="\n$('{$filterer}').observe('change', function(){ /* */ window.setTimeout({$filterable}_change_by_{$filterer}, 25); });";
			$filterJS.="\n";
		}

		$filterableCombo = new Combo;
		$filterableCombo->ListType = 0;
		$filterableCombo->ListItem = array_slice(array_values($filterableData), 0, 10);
		$filterableCombo->ListData = array_slice(array_keys($filterableData), 0, 10);
		$filterableCombo->SelectName = $filterable;
		$filterableCombo->AllowNull = true;

		return $filterJS;
	}

	#########################################################
	function br2nl($text){
		return  preg_replace('/\<br(\s*)?\/?\>/i', "\n", $text);
	}

	#########################################################

	if(!function_exists('htmlspecialchars_decode')){
		function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT){
			return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
		}
	}

	#########################################################

	function entitiesToUTF8($input){
		return preg_replace_callback('/(&#[0-9]+;)/', '_toUTF8', $input);
	}

	function _toUTF8($m){
		if(function_exists('mb_convert_encoding')){
			return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
		}else{
			return $m[1];
		}
	}

	#########################################################

	function func_get_args_byref() {
		if(!function_exists('debug_backtrace')) return false;

		$trace = debug_backtrace();
		return $trace[1]['args'];
	}

	#########################################################

	function permissions_sql($table, $level = 'all'){
		if(!in_array($level, array('user', 'group'))){ $level = 'all'; }
		$perm = getTablePermissions($table);
		$from = '';
		$where = '';
		$pk = getPKFieldName($table);

		if($perm[2] == 1 || ($perm[2] > 1 && $level == 'user')){ // view owner only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."')";
		}elseif($perm[2] == 2 || ($perm[2] > 2 && $level == 'group')){ // view group only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and membership_userrecords.groupID='".getLoggedGroupID()."')";
		}elseif($perm[2] == 3){ // view all
			// no further action
		}elseif($perm[2] == 0){ // view none
			return false;
		}

		return array('where' => $where, 'from' => $from, 0 => $where, 1 => $from);
	}

	#########################################################

	function error_message($msg, $back_url = '', $full_page = true){
		$curr_dir = dirname(__FILE__);
		global $Translation;

		ob_start();

		if($full_page) include_once($curr_dir . '/header.php');

		echo '<div class="panel panel-danger">';
			echo '<div class="panel-heading"><h3 class="panel-title">' . $Translation['error:'] . '</h3></div>';
			echo '<div class="panel-body"><p class="text-danger">' . $msg . '</p>';
			if($back_url !== false){ // explicitly passing false suppresses the back link completely
				echo '<div class="text-center">';
				if($back_url){
					echo '<a href="' . $back_url . '" class="btn btn-danger btn-lg vspacer-lg"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				}else{
					echo '<a href="#" class="btn btn-danger btn-lg vspacer-lg" onclick="history.go(-1); return false;"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				}
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';

		if($full_page) include_once($curr_dir . '/footer.php');

		$out = ob_get_contents();
		ob_end_clean();

		return $out;
	}

	#########################################################

	function toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format){
		// extract date elements
		$de=explode($sep, $formattedDate);
		$mySQLDate=intval($de[strpos($ord, 'Y')]).'-'.intval($de[strpos($ord, 'm')]).'-'.intval($de[strpos($ord, 'd')]);
		return $mySQLDate;
	}

	#########################################################

	function reIndex(&$arr){
		$i=1;
		foreach($arr as $n=>$v){
			$arr2[$i]=$n;
			$i++;
		}
		return $arr2;
	}

	#########################################################

	function get_embed($provider, $url, $max_width = '', $max_height = '', $retrieve = 'html'){
		global $Translation;
		if(!$url) return '';

		$providers = array(
			'youtube' => array('oembed' => 'http://www.youtube.com/oembed?'),
			'googlemap' => array('oembed' => '', 'regex' => '/^http.*\.google\..*maps/i')
		);

		if(!isset($providers[$provider])){
			return '<div class="text-danger">' . $Translation['invalid provider'] . '</div>';
		}

		if(isset($providers[$provider]['regex']) && !preg_match($providers[$provider]['regex'], $url)){
			return '<div class="text-danger">' . $Translation['invalid url'] . '</div>';
		}

		if($providers[$provider]['oembed']){
			$oembed = $providers[$provider]['oembed'] . 'url=' . urlencode($url) . "&maxwidth={$max_width}&maxheight={$max_height}&format=json";
			$data_json = request_cache($oembed);

			$data = json_decode($data_json, true);
			if($data === null){
				/* an error was returned rather than a json string */
				if($retrieve == 'html') return "<div class=\"text-danger\">{$data_json}\n<!-- {$oembed} --></div>";
				return '';
			}

			return (isset($data[$retrieve]) ? $data[$retrieve] : $data['html']);
		}

		/* special cases (where there is no oEmbed provider) */
		if($provider == 'googlemap') return get_embed_googlemap($url, $max_width, $max_height, $retrieve);

		return '<div class="text-danger">Invalid provider!</div>';
	}

	#########################################################

	function get_embed_googlemap($url, $max_width = '', $max_height = '', $retrieve = 'html'){
		global $Translation;
		$url_parts = parse_url($url);
		$coords_regex = '/-?\d+(\.\d+)?[,+]-?\d+(\.\d+)?(,\d{1,2}z)?/'; /* https://stackoverflow.com/questions/2660201 */

		if(preg_match($coords_regex, $url_parts['path'] . '?' . $url_parts['query'], $m)){
			list($lat, $long, $zoom) = explode(',', $m[0]);
			$zoom = intval($zoom);
			if(!$zoom) $zoom = 10; /* default zoom */
			if(!$max_height) $max_height = 360;
			if(!$max_width) $max_width = 480;

			$api_key = 'AIzaSyDG-U70-2O3DWkLhlDR5m5uL4FaOjPQ6X8';
			$embed_url = "https://www.google.com/maps/embed/v1/view?key={$api_key}&center={$lat},{$long}&zoom={$zoom}&maptype=roadmap";
			$thumbnail_url = "https://maps.googleapis.com/maps/api/staticmap?key={$api_key}&center={$lat},{$long}&zoom={$zoom}&maptype=roadmap&size={$max_width}x{$max_height}";

			if($retrieve == 'html'){
				return "<iframe width=\"{$max_width}\" height=\"{$max_height}\" frameborder=\"0\" style=\"border:0\" src=\"{$embed_url}\"></iframe>";
			}else{
				return $thumbnail_url;
			}
		}else{
			return '<div class="text-danger">' . $Translation['cant retrieve coordinates from url'] . '</div>';
		}
	}

	#########################################################

	function request_cache($request, $force_fetch = false){
		$max_cache_lifetime = 7 * 86400; /* max cache lifetime in seconds before refreshing from source */

		/* membership_cache table exists? if not, create it */
		static $cache_table_exists = false;
		if(!$cache_table_exists && !$force_fetch){
			$te = sqlValue("show tables like 'membership_cache'");
			if(!$te){
				if(!sql("CREATE TABLE `membership_cache` (`request` VARCHAR(100) NOT NULL, `request_ts` INT, `response` TEXT NOT NULL, PRIMARY KEY (`request`))", $eo)){
					/* table can't be created, so force fetching request */
					return request_cache($request, true);
				}
			}
			$cache_table_exists = true;
		}

		/* retrieve response from cache if exists */
		if(!$force_fetch){
			$res = sql("select response, request_ts from membership_cache where request='" . md5($request) . "'", $eo);
			if(!$row = db_fetch_array($res)) return request_cache($request, true);

			$response = $row[0];
			$response_ts = $row[1];
			if($response_ts < time() - $max_cache_lifetime) return request_cache($request, true);
		}

		/* if no response in cache, issue a request */
		if(!$response || $force_fetch){
			$response = @file_get_contents($request);
			if($response === false){
				$error = error_get_last();
				$error_message = preg_replace('/.*: (.*)/', '$1', $error['message']);
				return $error_message;
			}elseif($cache_table_exists){
				/* store response in cache */
				$ts = time();
				sql("replace into membership_cache set request='" . md5($request) . "', request_ts='{$ts}', response='" . makeSafe($response, false) . "'", $eo);
			}
		}

		return $response;
	}

	#########################################################

	function check_record_permission($table, $id, $perm = 'view'){
		if($perm != 'edit' && $perm != 'delete') $perm = 'view';

		$perms = getTablePermissions($table);
		if(!$perms[$perm]) return false;

		$safe_id = makeSafe($id);
		$safe_table = makeSafe($table);

		if($perms[$perm] == 1){ // own records only
			$username = getLoggedMemberID();
			$owner = sqlValue("select memberID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner == $username) return true;
		}elseif($perms[$perm] == 2){ // group records
			$group_id = getLoggedGroupID();
			$owner_group_id = sqlValue("select groupID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner_group_id == $group_id) return true;
		}elseif($perms[$perm] == 3){ // all records
			return true;
		}

		return false;
	}

	#########################################################

	function NavMenus($options = array()){
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		global $Translation;
		$prepend_path = PREPEND_PATH;

		/* default options */
		if(empty($options)){
			$options = array(
				'tabs' => 7
			);
		}

		$table_group_name = array_keys(get_table_groups()); /* 0 => group1, 1 => group2 .. */
		/* if only one group named 'None', set to translation of 'select a table' */
		if((count($table_group_name) == 1 && $table_group_name[0] == 'None') || count($table_group_name) < 1) $table_group_name[0] = ''; // $Translation['select a table'];
		$table_group_index = array_flip($table_group_name); /* group1 => 0, group2 => 1 .. */
		$menu = array_fill(0, count($table_group_name), '');

		$t = time();
		$arrTables = getTableList();
		if(is_array($arrTables)){
			foreach($arrTables as $tn => $tc){
				/* ---- list of tables where hide link in nav menu is set ---- */
				$tChkHL = array_search($tn, array());

				/* ---- list of tables where filter first is set ---- */
				$tChkFF = array_search($tn, array());
				if($tChkFF !== false && $tChkFF !== null){
					$searchFirst = '&Filter_x=1';
				}else{
					$searchFirst = '';
				}

				/* when no groups defined, $table_group_index['None'] is NULL, so $menu_index is still set to 0 */
				$menu_index = intval($table_group_index[$tc[3]]);
				if(!$tChkHL && $tChkHL !== 0) $menu[$menu_index] .= "<li><a href=\"{$prepend_path}{$tn}_view.php?t={$t}{$searchFirst}\">{$tc[0]}</a></li>";
			}
		}

		// custom nav links, as defined in "hooks/links-navmenu.php" 
		global $navLinks;
		if(is_array($navLinks)){
			$memberInfo = getMemberInfo();
			$links_added = array();
			foreach($navLinks as $link){
				if(!isset($link['url']) || !isset($link['title'])) continue;
				if($memberInfo['admin'] || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])){
					$menu_index = intval($link['table_group']);
					// if(!$links_added[$menu_index]) $menu[$menu_index] .= '<li class="divider"></li>';

					/* add prepend_path to custom links if they aren't absolute links */
					if(!preg_match('/^(http|\/\/)/i', $link['url'])) $link['url'] = $prepend_path . $link['url'];
					if(!preg_match('/^(http|\/\/)/i', $link['icon']) && $link['icon']) $link['icon'] = $prepend_path . $link['icon'];

					
					$menu[$menu_index] .= "<li><a href=\"{$link['url']}\"> {$link['title']}</a></li>";
					$links_added[$menu_index]++;
				}
			}
		}

		$menu_wrapper = '';
		for($i = 0; $i < count($menu); $i++){
			if($i <= 7){
				$menu_wrapper .= <<<EOT
					<li>
						<a href="#" class="topbar dropdown-toggle" data-toggle="topbar dropdown">{$table_group_name[$i]} </a>
						<ul class="dropdown-menu" role="menu">{$menu[$i]}</ul>
					</li>
EOT;
			}
			else{
				$menu_wrapper .= <<<EOT
				<li>
					$menu[$i]
				</li>
EOT;
			}
		}

		return $menu_wrapper;
	}

	#########################################################

	function StyleSheet(){
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		$prepend_path = PREPEND_PATH;

		$css_links = <<<EOT

			<link rel="stylesheet" href="{$prepend_path}resources/initializr/css/bootstrap.css">
			<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>../assets/plugins/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>assets/css/style.css">
			<!--[if gt IE 8]><!-->
				<link rel="stylesheet" href="{$prepend_path}resources/initializr/css/bootstrap-theme.css">
			<!--<![endif]-->';
			<link rel="stylesheet" href="{$prepend_path}resources/lightbox/css/lightbox.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/select2/select2.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/timepicker/bootstrap-timepicker.min.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}dynamic.css.php">
			<link rel="stylesheet" href="{$prepend_path}assets/plugins/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="{$prepend_path}assets/css/style.css">
EOT;

		return $css_links;
	}

	#########################################################

	function getUploadDir($dir){
		global $Translation;

		if($dir==""){
			$dir=$Translation['ImageFolder'];
		}

		if(substr($dir, -1)!="/"){
			$dir.="/";
		}

		return $dir;
	}

	#########################################################

	function PrepareUploadedFile($FieldName, $MaxSize, $FileTypes = 'jpg|jpeg|gif|png', $NoRename = false, $dir = ''){
		global $Translation;
		$f = $_FILES[$FieldName];
		if($f['error'] == 4 || !$f['name']) return '';

		$dir = getUploadDir($dir);

		/* get php.ini upload_max_filesize in bytes */
		$php_upload_size_limit = trim(ini_get('upload_max_filesize'));
		$last = strtolower($php_upload_size_limit[strlen($php_upload_size_limit) - 1]);
		switch($last){
			case 'g':
				$php_upload_size_limit *= 1024;
			case 'm':
				$php_upload_size_limit *= 1024;
			case 'k':
				$php_upload_size_limit *= 1024;
		}

		$MaxSize = min($MaxSize, $php_upload_size_limit);

		if($f['size'] > $MaxSize || $f['error']){
			echo error_message(str_replace('<MaxSize>', intval($MaxSize / 1024), $Translation['file too large']));
			exit;
		}
		if(!preg_match('/\.(' . $FileTypes . ')$/i', $f['name'], $ft)){
			echo error_message(str_replace('<FileTypes>', str_replace('|', ', ', $FileTypes), $Translation['invalid file type']));
			exit;
		}

		$name = str_replace(' ', '_', $f['name']);
		if(!$NoRename) $name = substr(md5(microtime() . rand(0, 100000)), -17) . $ft[0];

		if(!file_exists($dir)) @mkdir($dir, 0777);

		if(!@move_uploaded_file($f['tmp_name'], $dir . $name)){
			echo error_message("Couldn't save the uploaded file. Try chmoding the upload folder '{$dir}' to 777.");
			exit;
		}

		@chmod($dir . $name, 0666);
		return $name;
	}

	#########################################################

	function get_home_links($homeLinks, $default_classes, $tgroup = ''){
		if(!is_array($homeLinks) || !count($homeLinks)) return '';

		$memberInfo = getMemberInfo();

		ob_start();
		foreach($homeLinks as $link){
			if(!isset($link['url']) || !isset($link['title'])) continue;
			if($tgroup != $link['table_group'] && $tgroup != '*') continue;

			/* fall-back classes if none defined */
			if(!$link['grid_column_classes']) $link['grid_column_classes'] = $default_classes['grid_column'];
			if(!$link['panel_classes']) $link['panel_classes'] = $default_classes['panel'];
			if(!$link['link_classes']) $link['link_classes'] = $default_classes['link'];

			if($memberInfo['admin'] || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])){
				?>
				<div class="col-xs-12 <?php echo $link['grid_column_classes']; ?>">
					<div class="panel <?php echo $link['panel_classes']; ?>">
						<div class="panel-body">
							<a class="btn btn-block btn-lg <?php echo $link['link_classes']; ?>" title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", html_attr(strip_tags($link['description']))); ?>" href="<?php echo $link['url']; ?>"><?php echo ($link['icon'] ? '<img src="' . $link['icon'] . '">' : ''); ?><strong><?php echo $link['title']; ?></strong></a>
							<div class="panel-body-description"><?php echo $link['description']; ?></div>
						</div>
					</div>
				</div>
				<?php
			}
		}

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	#########################################################

	function quick_search_html($search_term, $label, $separate_dv = true){
		global $Translation;

		$safe_search = html_attr($search_term);
		$safe_label = html_attr($label);
		$safe_clear_label = html_attr($Translation['Reset Filters']);

		if($separate_dv){
			$reset_selection = "document.myform.SelectedID.value = '';";
		}else{
			$reset_selection = "document.myform.writeAttribute('novalidate', 'novalidate');";
		}
		$reset_selection .= ' document.myform.NoDV.value=1; return true;';

		$html = <<<EOT
		<div class="input-group" id="quick-search">
			<input type="text" id="SearchString" name="SearchString" value="{$safe_search}" class="form-control" style="margin-right: 78px;" placeholder="{$safe_label}">
			<span class="input-group-btn table-search">
				<button name="Search_x" value="1" id="Search" type="submit" onClick="{$reset_selection}" class="btn btn-outline-plain" title="{$safe_label}"><i class="glyphicon glyphicon-search"></i></button>
				<button name="ClearQuickSearch" value="1" id="ClearQuickSearch" type="submit" onClick="\$j('#SearchString').val(''); {$reset_selection}" class="btn btn-outline-plain" title="{$safe_clear_label}"><i class="glyphicon glyphicon-remove-circle"></i></button>
			</span>
		</div>
EOT;
		return $html;
	}

	#########################################################

	function get_summary_counters_sql($tableName, $metricPosition){
		$returnQuery = 'select null';
		$arrSummaryQueryList = array(
			/* 'table_name' => [0: 'selectTotalCount', 1: 'selectReviewCount', 2: 'selectApprovalCount', 3: 'selectIMSControlCount', 4: 'selectCustomDisplayValue1', 5: 'selectCustomDisplayValue2'] */   
			"employees" => array("select count(1) from `employees`", "select count(1) from `employees` where `ot_ap_Review` = 4", "select count(1) from `employees` where `ot_ap_Approval` = 4", "select count(1) from `employees` where `ot_ap_QC` = 4", "select (select count(1) from `employees`) - (select count(1) from `employees` where `fo_OffHireDate` is not null and `fo_OffHireDate` <= CURRENT_DATE) as current_staff_count", "select count(1) from `employees` where `fo_Acknowledgement` = 1 and `fo_Induction` = 1"),
			"InOutRegister" => array("select count(1) from `InOutRegister`", "select count(1) from `InOutRegister` where `ot_ap_Review` = 4", "select count(1) from `InOutRegister` where `ot_ap_Approval` = 4", "select count(1) from `InOutRegister` where `ot_ap_QC` = 4", "select count(1) from `InOutRegister` where `fo_Classification` = 'Incoming'", "select count(1) from `InOutRegister` where `fo_Classification` = 'Outgoing'"),
			"JD_JS" => array("select count(1) from `JD_JS`", "select count(1) from `JD_JS` where `ot_ap_Review` = 4", "select count(1) from `JD_JS` where `ot_ap_Approval` = 4", "select count(1) from `JD_JS` where `ot_ap_QC` = 4", "select null", "select null"),
			"CalibrationCtrl" => array("select count(1) from `CalibrationCtrl`", "select count(1) from `CalibrationCtrl` where `ot_ap_Review` = 4", "select count(1) from `CalibrationCtrl` where `ot_ap_Approval` = 4", "select count(1) from `CalibrationCtrl` where `ot_ap_QC` = 4", "select count(1) from `CalibrationCtrl` where MONTH(`fo_Delivdate`) = MONTH(CURRENT_DATE()) and YEAR(`fo_Delivdate`) = YEAR(CURRENT_DATE())", "select null"),
			"Inventory" => array("select count(1) from `Inventory`", "select count(1) from `Inventory` where `ot_ap_Review` = 4", "select count(1) from `Inventory` where `ot_ap_Approval` = 4", "select count(1) from `Inventory` where `ot_ap_QC` = 4", "select count(1) from `Inventory` WHERE `fo_Condition` = 'Operational Ready'", "select coalesce(sum(`fo_UnitPrice`), 0.00) from `Inventory`"),
			"LogisticRequest" => array("select count(1) from `LogisticRequest`", "select count(1) from `LogisticRequest` where `ot_ap_Review` = 4", "select count(1) from `LogisticRequest` where `ot_ap_Approval` = 4", "select count(1) from `LogisticRequest` where `ot_ap_QC` = 4", "select count(1) from `LogisticRequest` where `Market_Survey` = 'Market Survey'", "select count(1) from `LogisticRequest` where `Market_Survey` = 'Logistic Request'"),
			"Logistics" => array("select count(1) from `Logistics`", "select count(1) from `Logistics` where `ot_ap_Review` = 4", "select count(1) from `Logistics` where `ot_ap_Approval` = 4", "select count(1) from `Logistics` where `ot_ap_QC` = 4", "select count(1) from `Logistics` where `fo_AVList` = 1", "select null"),
			"MWO" => array("select count(1) from `MWO`", "select count(1) from `MWO` where `ot_ap_Review` = 4", "select count(1) from `MWO` where `ot_ap_Approval` = 4", "select count(1) from `MWO` where `ot_ap_QC` = 4", "select count(1) from `MWO` where `fo_Category` = 'Asset'", "select count(1) from `MWO` where `fo_Category` = 'Facilities'"),
			"vendor" => array("select count(1) from `vendor`", "select count(1) from `vendor` where `ot_ap_Review` = 4", "select count(1) from `vendor` where `ot_ap_Approval` = 4", "select count(1) from `vendor` where `ot_ap_QC` = 4", "select count(1) from `vendor` where `fo_AVList` = 1", "select null"),
			"WorkOrder" => array("select count(1) from `WorkOrder`", "select count(1) from `WorkOrder` where `ot_ap_Review` = 4", "select count(1) from `WorkOrder` where `ot_ap_Approval` = 4", "select count(1) from `WorkOrder` where `ot_ap_QC` = 4", "select count(1) from `WorkOrder` where `Task` in ('Technical Task', 'Project Task', 'Client Requirement')", "select count(1) from `WorkOrder` where `Task` in ('General Task', 'Vendor Communication', 'Integrated Management System Duty', 'Logistic Duty', '5S Housekeeping')"),
			"Client" => array("select count(1) from `Client`", "select count(1) from `Client` where `ot_ap_Review` = 4", "select count(1) from `Client` where `ot_ap_Approval` = 4", "select count(1) from `Client` where `ot_ap_QC` = 4", "select count(distinct c.id) from `Client` c join `Inquiry` i on (c.`id` = i.`ClientID` and i.`fo_DueDate` >= CURRENT_DATE)", "select count(distinct c.id) from `Client` c left join `Inquiry` i on (c.`id` = i.`ClientID` and i.`fo_DueDate` >= CURRENT_DATE) where i.`id` is null"),
			"Inquiry" => array("select count(1) from `Inquiry`", "select count(1) from `Inquiry` where `ot_ap_Review` = 4", "select count(1) from `Inquiry` where `ot_ap_Approval` = 4", "select count(1) from `Inquiry` where `ot_ap_QC` = 4", "select count(1) from `Inquiry` where `fo_Classification` in ('Email', 'Discussion')", "select count(1) from `Inquiry` where `fo_Classification` in ('Market Survey', 'Tender Bidding')"),
			"Marketing" => array("select count(1) from `Marketing`", "select count(1) from `Marketing` where `ot_ap_Review` = 4", "select count(1) from `Marketing` where `ot_ap_Approval` = 4", "select count(1) from `Marketing` where `ot_ap_QC` = 4", "select count(1) from `Marketing` where `fo_Qualification` in ('Working', 'Check Back Quarterly', 'Active Opportunity')", "select count(1) from `Marketing` where `fo_Qualification` in ('Cold', 'Dead Opportunity', 'Bad Fit')"),
			"OrgContentContext" => array("select count(1) from `OrgContentContext`", "select count(1) from `OrgContentContext` where `ot_ap_Review` = 4", "select count(1) from `OrgContentContext` where `ot_ap_Approval` = 4", "select count(1) from `OrgContentContext` where `ot_ap_QC` = 4", "select count(1) from `OrgContentContext` where `fo_Type` in ('Market Survey', 'Prospect Outlook', 'Industry Analysis')", "select count(1) from `OrgContentContext` where `fo_genrec` in ('Internal Record')"),
			"AccountPayables" => array("select count(1) from `AccountPayables`", "select count(1) from `AccountPayables` where `ot_ap_Review` = 4", "select count(1) from `AccountPayables` where `ot_ap_Approval` = 4", "select count(1) from `AccountPayables` where `ot_ap_QC` = 4", "select coalesce(sum(`fo_UnitPrice`), 0.00) from `AccountPayables` where (YEARWEEK(`ot_ap_filed`, 1) = YEARWEEK(CURDATE(), 1) or YEARWEEK(`ot_ap_lastmodified`, 1) = YEARWEEK(CURDATE(), 1))", "select coalesce(sum(`fo_UnitPrice`), 0.00) from `AccountPayables` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())"),
			"ActCard" => array("select count(1) from `ActCard`", "select null", "select null", "select null", "select count(1) from `ActCard` where (MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE()) and YEAR(`fo_RequiredDate`) = YEAR(CURRENT_DATE()) and `fo_Classification` in ('Positive Observation'))", "select count(1) from `ActCard` where (MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE()) and YEAR(`fo_RequiredDate`) = YEAR(CURRENT_DATE()) and `fo_Classification` in ('Unsafe Act', 'Unsafe Behavior'))"),
			"Bi_WeeklyMeeting" => array("select count(1) from `Bi_WeeklyMeeting`", "select count(1) from `Bi_WeeklyMeeting` where `ot_ap_Review` = 4", "select count(1) from `Bi_WeeklyMeeting` where `ot_ap_Approval` = 4", "select count(1) from `Bi_WeeklyMeeting` where `ot_ap_QC` = 4", "select count(1) from `Bi_WeeklyMeeting` where MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE()) and YEAR(`fo_RequiredDate`) = YEAR(CURRENT_DATE())", "select null"),
			"Breakdown" => array("select count(1) from `Breakdown`", "select count(1) from `Breakdown` where `ot_ap_Review` = 4", "select count(1) from `Breakdown` where `ot_ap_Approval` = 4", "select count(1) from `Breakdown` where `ot_ap_QC` = 4", "select count(1) from `Breakdown` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())", "select count(1) from `Breakdown` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and ((MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())) or (MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_lastmodified`) = YEAR(CURRENT_DATE())))"),
			"Campaign" => array("select count(1) from `Campaign`", "select count(1) from `Campaign` where `ot_ap_Review` = 4", "select count(1) from `Campaign` where `ot_ap_Approval` = 4", "select count(1) from `Campaign` where `ot_ap_QC` = 4", "select (select count(1) from `Campaign`) - (select count(1) from `Campaign` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4)", "select count(1) from `Campaign` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4"),
			"ClaimRecord" => array("select count(1) from `ClaimRecord`", "select count(1) from `ClaimRecord` where `ot_ap_Review` = 4", "select count(1) from `ClaimRecord` where `ot_ap_Approval` = 4", "select count(1) from `ClaimRecord` where `ot_ap_QC` = 4", "select count(1) from `ClaimRecord` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())", "select coalesce(sum(`fo_UnitPrice`), 0.00) from `ClaimRecord` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())"),
			"Competency" => array("select count(1) from `Competency`", "select count(1) from `Competency` where `ot_ap_Review` = 4", "select count(1) from `Competency` where `ot_ap_Approval` = 4", "select count(1) from `Competency` where `ot_ap_QC` = 4", "select count(1) from `Competency` where (MONTH(`fo_Date`) = MONTH(CURRENT_DATE()) and YEAR(`fo_Date`) = YEAR(CURRENT_DATE()) and `fo_CompetencySession` in ('Internal Review'))", "select count(1) from `Competency` where (MONTH(`fo_Date`) = MONTH(CURRENT_DATE()) and YEAR(`fo_Date`) = YEAR(CURRENT_DATE()) and `fo_CompetencySession` in ('External Review'))"),
			"ContractDeployment" => array("select count(1) from `ContractDeployment`", "select count(1) from `ContractDeployment` where `ot_ap_Review` = 4", "select count(1) from `ContractDeployment` where `ot_ap_Approval` = 4", "select count(1) from `ContractDeployment` where `ot_ap_QC` = 4", "select count(1) from `ContractDeployment` where `fo_Type` in ('Kick Off Meeting', 'Coordination Meeting')", "select count(1) from `ContractDeployment` where `fo_Type` in ('Subcontractor Meeting')"),
			"DailyProgressReport" => array("select count(1) from `DailyProgressReport`", "select count(1) from `DailyProgressReport` where `ot_ap_Review` = 4", "select count(1) from `DailyProgressReport` where `ot_ap_Approval` = 4", "select count(1) from `DailyProgressReport` where `ot_ap_QC` = 4", "select count(1) from `DailyProgressReport` where (MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE()) and `fo_Class` in ('Daily Log'))", "select count(1) from `DailyProgressReport` where (MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE()) and `fo_Class` in ('Daily Checklist'))"),
			"DCN" => array("select count(1) from `DCN`", "select count(1) from `DCN` where `ot_ap_Review` = 4", "select count(1) from `DCN` where `ot_ap_Approval` = 4", "select count(1) from `DCN` where `ot_ap_QC` = 4", "select count(1) from `DCN` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())", "select null"),
			"DeliveryOrder" => array("select count(1) from `DeliveryOrder`", "select count(1) from `DeliveryOrder` where `ot_ap_Review` = 4", "select count(1) from `DeliveryOrder` where `ot_ap_Approval` = 4", "select count(1) from `DeliveryOrder` where `ot_ap_QC` = 4", "select count(1) from `DeliveryOrder` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and ((MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())) or (MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_lastmodified`) = YEAR(CURRENT_DATE())))", "select null"),
			"DesignProposal" => array("select count(1) from `DesignProposal`", "select count(1) from `DesignProposal` where `ot_ap_Review` = 4", "select count(1) from `DesignProposal` where `ot_ap_Approval` = 4", "select count(1) from `DesignProposal` where `ot_ap_QC` = 4", "select count(1) from `DesignProposal` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE()) and `fo_RecSub` in ('Internal Submission')", "select count(1) from `DesignProposal` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE()) and `fo_RecSub` in ('External Submission')"),
			"DrillNInspection" => array("select count(1) from `DrillNInspection`", "select count(1) from `DrillNInspection` where `ot_ap_Review` = 4", "select count(1) from `DrillNInspection` where `ot_ap_Approval` = 4", "select count(1) from `DrillNInspection` where `ot_ap_QC` = 4", "select count(1) from `DrillNInspection` where `fo_Classification` in ('Drill')", "select count(1) from `DrillNInspection` where `fo_Classification` in ('Inspection')"),
			"EventNotification" => array("select count(1) from `EventNotification`", "select null", "select null", "select null", "select null", "select null"),
			"ManagementVisit" => array("select count(1) from `ManagementVisit`", "select count(1) from `ManagementVisit` where `ot_ap_Review` = 4", "select count(1) from `ManagementVisit` where `ot_ap_Approval` = 4", "select count(1) from `ManagementVisit` where `ot_ap_QC` = 4", "select count(1) from `ManagementVisit` where `fo_Classification` in ('Internal Visit')", "select count(1) from `ManagementVisit` where `fo_Classification` in ('External Visit')"),
			"ManagingVendor" => array("select count(1) from `ManagingVendor`", "select count(1) from `ManagingVendor` where `ot_ap_Review` = 4", "select count(1) from `ManagingVendor` where `ot_ap_Approval` = 4", "select count(1) from `ManagingVendor` where `ot_ap_QC` = 4", "select count(1) from `ManagingVendor` where `fo_Classification` in ('Technical Audit', 'Inspection and Survey')", "select count(1) from `ManagingVendor` where `fo_Classification` in ('IMS Audit', 'Procurement Audit', 'Project Audit')"),
			"MonthlyTimesheet" => array("select count(1) from `MonthlyTimesheet`", "select count(1) from `MonthlyTimesheet` where `ot_ap_Review` = 4", "select count(1) from `MonthlyTimesheet` where `ot_ap_Approval` = 4", "select count(1) from `MonthlyTimesheet` where `ot_ap_QC` = 4", "select count(1) from `MonthlyTimesheet` where `fo_Class` in ('Certificate of Completion')", "select count(1) from `MonthlyTimesheet` where `fo_Class` in ('Manpower Timesheet', 'Equipment Timesheet')"),
			"MWConditionBased" => array("select count(1) from `MWConditionBased`", "select count(1) from `MWConditionBased` where `ot_ap_Review` = 4", "select count(1) from `MWConditionBased` where `ot_ap_Approval` = 4", "select count(1) from `MWConditionBased` where `ot_ap_QC` = 4", "select count(1) from `MWConditionBased` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and ((MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())) or (MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_lastmodified`) = YEAR(CURRENT_DATE())))", "select null"),
			"MWOCorrective" => array("select count(1) from `MWOCorrective`", "select count(1) from `MWOCorrective` where `ot_ap_Review` = 4", "select count(1) from `MWOCorrective` where `ot_ap_Approval` = 4", "select count(1) from `MWOCorrective` where `ot_ap_QC` = 4", "select count(1) from `MWOCorrective` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and ((MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())) or (MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_lastmodified`) = YEAR(CURRENT_DATE())))", "select null"),
			"MWOPlanned" => array("select count(1) from `MWOPlanned`", "select count(1) from `MWOPlanned` where `ot_ap_Review` = 4", "select count(1) from `MWOPlanned` where `ot_ap_Approval` = 4", "select count(1) from `MWOPlanned` where `ot_ap_QC` = 4", "select count(1) from `MWOPlanned` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and ((MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())) or (MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_lastmodified`) = YEAR(CURRENT_DATE())))", "select null"),
			"MWOpreventive" => array("select count(1) from `MWOpreventive`", "select count(1) from `MWOpreventive` where `ot_ap_Review` = 4", "select count(1) from `MWOpreventive` where `ot_ap_Approval` = 4", "select count(1) from `MWOpreventive` where `ot_ap_QC` = 4", "select count(1) from `MWOpreventive` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and ((MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())) or (MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_lastmodified`) = YEAR(CURRENT_DATE())))", "select null"),
			"MWOproactive" => array("select count(1) from `MWOproactive`", "select count(1) from `MWOproactive` where `ot_ap_Review` = 4", "select count(1) from `MWOproactive` where `ot_ap_Approval` = 4", "select count(1) from `MWOproactive` where `ot_ap_QC` = 4", "select count(1) from `MWOproactive` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and ((MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())) or (MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_lastmodified`) = YEAR(CURRENT_DATE())))", "select null"),
			"MWOReactive" => array("select count(1) from `MWOReactive`", "select count(1) from `MWOReactive` where `ot_ap_Review` = 4", "select count(1) from `MWOReactive` where `ot_ap_Approval` = 4", "select count(1) from `MWOReactive` where `ot_ap_QC` = 4", "select count(1) from `MWOReactive` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and ((MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())) or (MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_lastmodified`) = YEAR(CURRENT_DATE())))", "select null"),
			"ObsoleteRec" => array("select count(1) from `ObsoleteRec`", "select count(1) from `ObsoleteRec` where `ot_ap_Review` = 4", "select count(1) from `ObsoleteRec` where `ot_ap_Approval` = 4", "select count(1) from `ObsoleteRec` where `ot_ap_QC` = 4", "select count(1) from `ObsoleteRec` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and ((MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())) or (MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_lastmodified`) = YEAR(CURRENT_DATE())))", "select null"),
			"PersonnalFile" => array("select count(1) from `PersonnalFile`", "select null", "select null", "select null", "select count(1) from `PersonnalFile` where `fo_PersonalFileDesc` in ('Certificate')", "select null"),
			"PurchaseOrder" => array("select count(1) from `PurchaseOrder`", "select count(1) from `PurchaseOrder` where `ot_ap_Review` = 4", "select count(1) from `PurchaseOrder` where `ot_ap_Approval` = 4", "select count(1) from `PurchaseOrder` where `ot_ap_QC` = 4", "select coalesce(sum(`fo_Price`), 0.00) - coalesce(sum(`fo_Discount`), 0.00) from `PurchaseOrder`", "select count(1) from `PurchaseOrder` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())"),
			"QuarterlyMeeting" => array("select count(1) from `QuarterlyMeeting`", "select count(1) from `QuarterlyMeeting` where `ot_ap_Review` = 4", "select count(1) from `QuarterlyMeeting` where `ot_ap_Approval` = 4", "select count(1) from `QuarterlyMeeting` where `ot_ap_QC` = 4", "select count(1) from `QuarterlyMeeting` where MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE()) and YEAR(`fo_RequiredDate`) = YEAR(CURRENT_DATE())", "select null"),
			"Quotation" => array("select count(1) from `Quotation`", "select count(1) from `Quotation` where `ot_ap_Review` = 4", "select count(1) from `Quotation` where `ot_ap_Approval` = 4", "select count(1) from `Quotation` where `ot_ap_QC` = 4", "select coalesce(sum(`fo_Price`), 0.00) - coalesce(sum(`fo_Discount`), 0.00) from `Quotation`", "select count(1) from `Quotation` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())"),
			"Recruitment" => array("select count(1) from `Recruitment`", "select null", "select null", "select null", "select count(1) from `Recruitment` where `fo_RecruitmentSession` in ('Phone Interview', 'Physical Interview Session')", "select count(1) from `Recruitment` where `fo_RecruitmentSession` in ('Desktop Review Session')"),
			"ReportComment" => array("select count(1) from `ReportComment`", "select null", "select null", "select null", "select count(1) from `ReportComment` where (YEARWEEK(`filed`, 1) = YEARWEEK(CURDATE(), 1) or YEARWEEK(`last_modified`, 1) = YEARWEEK(CURDATE(), 1))", "select count(1) from `ReportComment` where (MONTH(`filed`) = MONTH(CURRENT_DATE()) and YEAR(`filed`) = YEAR(CURRENT_DATE())) or (MONTH(`last_modified`) = MONTH(CURRENT_DATE()) and YEAR(`last_modified`) = YEAR(CURRENT_DATE()))"),
			"SoftboardComment" => array("select count(1) from `SoftboardComment`", "select null", "select null", "select null", "select count(1) from `SoftboardComment` where (YEARWEEK(`filed`, 1) = YEARWEEK(CURDATE(), 1) or YEARWEEK(`last_modified`, 1) = YEARWEEK(CURDATE(), 1))", "select count(1) from `SoftboardComment` where (MONTH(`filed`) = MONTH(CURRENT_DATE()) and YEAR(`filed`) = YEAR(CURRENT_DATE())) or (MONTH(`last_modified`) = MONTH(CURRENT_DATE()) and YEAR(`last_modified`) = YEAR(CURRENT_DATE()))"),
			"ToolBoxMeeting" => array("select count(1) from `ToolBoxMeeting`", "select count(1) from `ToolBoxMeeting` where `ot_ap_Review` = 4", "select count(1) from `ToolBoxMeeting` where `ot_ap_Approval` = 4", "select count(1) from `ToolBoxMeeting` where `ot_ap_QC` = 4", "select count(1) from `ToolBoxMeeting` where MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE()) and YEAR(`fo_RequiredDate`) = YEAR(CURRENT_DATE())", "select null"),
			"Training" => array("select count(1) from `Training`", "select count(1) from `Training` where `ot_ap_Review` = 4", "select count(1) from `Training` where `ot_ap_Approval` = 4", "select count(1) from `Training` where `ot_ap_QC` = 4", "select count(1) from `Training` where (MONTH(`fo_Date`) = MONTH(CURRENT_DATE()) and YEAR(`fo_Date`) = YEAR(CURRENT_DATE()) and `fo_TrainingSession` in ('Internal Training'))", "select count(1) from `Training` where (MONTH(`fo_Date`) = MONTH(CURRENT_DATE()) and YEAR(`fo_Date`) = YEAR(CURRENT_DATE()) and `fo_TrainingSession` in ('External Training'))"),
			"VenPerformance" => array("select count(1) from `VenPerformance`", "select count(1) from `VenPerformance` where `ot_ap_Review` = 4", "select count(1) from `VenPerformance` where `ot_ap_Approval` = 4", "select count(1) from `VenPerformance` where `ot_ap_QC` = 4", "select count(1) from `VenPerformance` where `fo_Classification` in ('Above Average')", "select count(1) from `VenPerformance` where `fo_Classification` in ('Below Average')"),
			"WorkPermit" => array("select count(1) from `WorkPermit`", "select count(1) from `WorkPermit` where `ot_ap_Review` = 4", "select count(1) from `WorkPermit` where `ot_ap_Approval` = 4", "select count(1) from `WorkPermit` where `ot_ap_QC` = 4", "select count(1) from `WorkPermit` where `fo_Type` in ('Hot Work Permit','Working At Height','Chemical Handling','Confined Space','High Voltage','Rigging and Scaffolding','High Pressure')", "select count(1) from `WorkPermit` where `fo_Type` in ('Cold Work Permit')"),
			"PROCompletion" => array("select count(1) from `PROCompletion`", "select count(1) from `PROCompletion` where `ot_ap_Review` = 4", "select count(1) from `PROCompletion` where `ot_ap_Approval` = 4", "select count(1) from `PROCompletion` where `ot_ap_QC` = 4", "select count(1) from `PROCompletion` where `fo_Classification` in ('End of Trip Report', 'Project Completion Report', 'Project Deliverables Report')", "select count(1) from `PROCompletion` where `fo_Classification` in ('Lesson Learnt', 'Project Feedback Meeting')"),
			"PROControlMonitoring" => array("select count(1) from `PROControlMonitoring`", "select count(1) from `PROControlMonitoring` where `ot_ap_Review` = 4", "select count(1) from `PROControlMonitoring` where `ot_ap_Approval` = 4", "select count(1) from `PROControlMonitoring` where `ot_ap_QC` = 4", "select count(1) from `PROControlMonitoring` where `fo_AuditInspection` in ('Inspection')", "select count(1) from `PROControlMonitoring` where `fo_Classification` in ('Performance Tracking', 'Schedule Tracking', 'Cost Tracking')"),
			"PROExecution" => array("select count(1) from `PROExecution`", "select count(1) from `PROExecution` where `ot_ap_Review` = 4", "select count(1) from `PROExecution` where `ot_ap_Approval` = 4", "select count(1) from `PROExecution` where `ot_ap_QC` = 4", "select count(1) from `PROExecution` where `fo_Classification` in ('Subcontractor Report')", "select count(1) from `PROExecution` where `fo_Classification` in ('Client Instruction')"),
			"PROInitiation" => array("select count(1) from `PROInitiation`", "select count(1) from `PROInitiation` where `ot_ap_Review` = 4", "select count(1) from `PROInitiation` where `ot_ap_Approval` = 4", "select count(1) from `PROInitiation` where `ot_ap_QC` = 4", "select count(1) from `PROInitiation` where `fo_InitiationForm` in ('Project Kick Off Meeting')", "select null"),
			"projects" => array("select count(1) from `projects`", "select count(1) from `projects` where `ot_ap_Review` = 4", "select count(1) from `projects` where `ot_ap_Approval` = 4", "select count(1) from `projects` where `ot_ap_QC` = 4", "select count(1) from `projects` where `fo_ProjectIndication` = 'Main Contractor'", "select count(1) from `projects` where `fo_ProjectIndication` = 'Sub-Contractor'"),
			"ProjectTeam" => array("select count(1) from `ProjectTeam`", "select count(1) from `ProjectTeam` where `ot_ap_Review` = 4", "select count(1) from `ProjectTeam` where `ot_ap_Approval` = 4", "select count(1) from `ProjectTeam` where `ot_ap_QC` = 4", "select count(1) from `ProjectTeam` where `fo_TermEmployment` = 'Permanent' and (`fo_OffHireDate` is null or `fo_OffHireDate` > CURRENT_DATE)", "select count(1) from `ProjectTeam` where `fo_TermEmployment` = 'Contract' and (`fo_OffHireDate` is null or `fo_OffHireDate` > CURRENT_DATE)"),
			"PROPlanning" => array("select count(1) from `PROPlanning`", "select count(1) from `PROPlanning` where `ot_ap_Review` = 4", "select count(1) from `PROPlanning` where `ot_ap_Approval` = 4", "select count(1) from `PROPlanning` where `ot_ap_QC` = 4", "select count(1) from `PROPlanning` where `fo_RelatedDocument` in ('Project Management Plan')", "select count(1) from `PROPlanning` where `fo_RelatedDocument` in ('Project Assurance Launch Matrix', 'Planned Profit & Loss')"),
			"PROVariation" => array("select count(1) from `PROVariation`", "select count(1) from `PROVariation` where `ot_ap_Review` = 4", "select count(1) from `PROVariation` where `ot_ap_Approval` = 4", "select count(1) from `PROVariation` where `ot_ap_QC` = 4", "select count(1) from `PROVariation` where `fo_Classification` in ('Service Variation')", "select count(1) from `PROVariation` where `fo_Classification` in ('Equipment Variation', 'Manpower Variation')"),
			"Receivables" => array("select count(1) from `Receivables`", "select count(1) from `Receivables` where `ot_ap_Review` = 4", "select count(1) from `Receivables` where `ot_ap_Approval` = 4", "select count(1) from `Receivables` where `ot_ap_QC` = 4", "select count(1) from `Receivables` where `fo_Classification` in ('Claim')", "select count(1) from `Receivables` where `fo_Classification` in ('Credit Note', 'Debit Note')"),
			"resources" => array("select count(1) from `resources`", "select null", "select null", "select null", "select count(1) from `resources` where `fo_Available` = 1", "select count(1) from `resources` where `fo_Type` in ('TOOLS', 'MACHINERY', 'VEHICLE', 'FACILITY')"),
			"WorkLocation" => array("select count(1) from `WorkLocation`", "select count(1) from `WorkLocation` where `ot_ap_Review` = 4", "select count(1) from `WorkLocation` where `ot_ap_Approval` = 4", "select count(1) from `WorkLocation` where `ot_ap_QC` = 4", "select count(distinct `fo_Type`) from `WorkLocation`", "select null"),
			"Audit" => array("select count(1) from `Audit`", "select count(1) from `Audit` where `ot_ap_Review` = 4", "select count(1) from `Audit` where `ot_ap_Approval` = 4", "select count(1) from `Audit` where `ot_ap_QC` = 4", "select count(1) from `Audit` where `fo_Auditor` in ('Internal Auditor')", "select count(1) from `Audit` where `fo_Auditor` in ('External Auditor')"),
			"CommConsParticipate" => array("select count(1) from `CommConsParticipate`", "select count(1) from `CommConsParticipate` where `ot_ap_Review` = 4", "select count(1) from `CommConsParticipate` where `ot_ap_Approval` = 4", "select count(1) from `CommConsParticipate` where `ot_ap_QC` = 4", "select count(1) from `CommConsParticipate` where `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4", "select null"),
			"ContinualImprovement" => array("select count(1) from `ContinualImprovement`", "select count(1) from `ContinualImprovement` where `ot_ap_Review` = 4", "select count(1) from `ContinualImprovement` where `ot_ap_Approval` = 4", "select count(1) from `ContinualImprovement` where `ot_ap_QC` = 4", "select count(1) from `ContinualImprovement` where `fo_Class` in ('Internal')", "select count(1) from `ContinualImprovement` where `fo_Class` in ('External')"),
			"DocControl" => array("select count(1) from `DocControl`", "select count(1) from `DocControl` where `ot_ap_Review` = 4", "select count(1) from `DocControl` where `ot_ap_Approval` = 4", "select count(1) from `DocControl` where `ot_ap_QC` = 4", "select count(1) from `DocControl` where `fo_DocumentType` in ('Procedure')", "select count(1) from `DocControl` where `fo_DocumentType` in ('Forms')"),
			"ERP" => array("select count(1) from `ERP`", "select count(1) from `ERP` where `ot_ap_Review` = 4", "select count(1) from `ERP` where `ot_ap_Approval` = 4", "select count(1) from `ERP` where `ot_ap_QC` = 4", "select count(1) from `ERP` where `fo_Classification` in ('Emergency Response')", "select count(1) from `ERP` where `fo_Classification` in ('Contingency Response')"),
			"IMSDataAnalysis" => array("select count(1) from `IMSDataAnalysis`", "select count(1) from `IMSDataAnalysis` where `ot_ap_Review` = 4", "select count(1) from `IMSDataAnalysis` where `ot_ap_Approval` = 4", "select count(1) from `IMSDataAnalysis` where `ot_ap_QC` = 4", "select count(1) from `IMSDataAnalysis` where `fo_Classification` in ('Organization Improvement')", "select count(1) from `IMSDataAnalysis` where `fo_Classification` in ('Project Improvement')"),
			"IMStrackingNmonitoring" => array("select count(1) from `IMStrackingNmonitoring`", "select count(1) from `IMStrackingNmonitoring` where `ot_ap_Review` = 4", "select count(1) from `IMStrackingNmonitoring` where `ot_ap_Approval` = 4", "select count(1) from `IMStrackingNmonitoring` where `ot_ap_QC` = 4", "select count(1) from `IMStrackingNmonitoring` where `fo_Classification` in ('Internal Monitoring')", "select count(1) from `IMStrackingNmonitoring` where `fo_Classification` in ('External Monitoring')"),
			"IncidentReporting" => array("select count(1) from `IncidentReporting`", "select count(1) from `IncidentReporting` where `ot_ap_Review` = 4", "select count(1) from `IncidentReporting` where `ot_ap_Approval` = 4", "select count(1) from `IncidentReporting` where `ot_ap_QC` = 4", "select count(1) from `IncidentReporting` where `fo_Classification` in ('Incident Report')", "select count(1) from `IncidentReporting` where `fo_Classification` in ('Accident Report')"),
			"KM" => array("select count(1) from `KM`", "select count(1) from `KM` where `ot_ap_Review` = 4", "select count(1) from `KM` where `ot_ap_Approval` = 4", "select count(1) from `KM` where `ot_ap_QC` = 4", "select count(1) from `KM` where `fo_Reference` in ('Internal Reference')", "select count(1) from `KM` where `fo_Reference` in ('External Reference')"),
			"LegalRegister" => array("select count(1) from `LegalRegister`", "select count(1) from `LegalRegister` where `ot_ap_Review` = 4", "select count(1) from `LegalRegister` where `ot_ap_Approval` = 4", "select count(1) from `LegalRegister` where `ot_ap_QC` = 4", "select count(1) from `LegalRegister` where `fo_Classification` in ('Legal')", "select count(1) from `LegalRegister` where `fo_Classification` in ('Standards')"),
			"MgtofChange" => array("select count(1) from `MgtofChange`", "select count(1) from `MgtofChange` where `ot_ap_Review` = 4", "select count(1) from `MgtofChange` where `ot_ap_Approval` = 4", "select count(1) from `MgtofChange` where `ot_ap_QC` = 4", "select count(1) from `MgtofChange` where `fo_Class` in ('Process')", "select count(1) from `MgtofChange` where `fo_Class` in ('Procedure', 'Forms')"),
			"MRM" => array("select count(1) from `MRM`", "select count(1) from `MRM` where `ot_ap_Review` = 4", "select count(1) from `MRM` where `ot_ap_Approval` = 4", "select count(1) from `MRM` where `ot_ap_QC` = 4", "select count(1) from `MRM` where `fo_Classification` in ('Internal Meeting')", "select count(1) from `MRM` where `fo_Classification` in ('External Meeting')"),
			"NonConformance" => array("select count(1) from `NonConformance`", "select count(1) from `NonConformance` where `ot_ap_Review` = 4", "select count(1) from `NonConformance` where `ot_ap_Approval` = 4", "select count(1) from `NonConformance` where `ot_ap_QC` = 4", "select count(1) from `NonConformance` where `fo_Classification` in ('Minor Non Conformance')", "select count(1) from `NonConformance` where `fo_Classification` in ('Major Non Conformance')"),
			"QA" => array("select count(1) from `QA`", "select count(1) from `QA` where `ot_ap_Review` = 4", "select count(1) from `QA` where `ot_ap_Approval` = 4", "select count(1) from `QA` where `ot_ap_QC` = 4", "select count(1) from `QA` where `fo_Class` in ('Internal use')", "select count(1) from `QA` where `fo_Class` in ('External use')"),
			"RiskandOpportunity" => array("select count(1) from `RiskandOpportunity`", "select count(1) from `RiskandOpportunity` where `ot_ap_Review` = 4", "select count(1) from `RiskandOpportunity` where `ot_ap_Approval` = 4", "select count(1) from `RiskandOpportunity` where `ot_ap_QC` = 4", "select count(1) from `RiskandOpportunity` where `fo_Class` in ('Quality', 'Health', 'Safety', 'Environment')", "select count(1) from `RiskandOpportunity` where `fo_Class` in ('Technical', 'Organization')"),
			"ScheduleWaste" => array("select count(1) from `ScheduleWaste`", "select count(1) from `ScheduleWaste` where `ot_ap_Review` = 4", "select count(1) from `ScheduleWaste` where `ot_ap_Approval` = 4", "select count(1) from `ScheduleWaste` where `ot_ap_QC` = 4", "select count(1) from `ScheduleWaste` where `fo_Classification` in ('Solid Waste', 'Liquid Waste', 'General Waste')", "select count(1) from `ScheduleWaste` where `fo_Classification` in ('Hazardous Solid Waste', 'Hazardous Liquid Waste')"),
			"StakeholderSatisfaction" => array("select count(1) from `StakeholderSatisfaction`", "select count(1) from `StakeholderSatisfaction` where `ot_ap_Review` = 4", "select count(1) from `StakeholderSatisfaction` where `ot_ap_Approval` = 4", "select count(1) from `StakeholderSatisfaction` where `ot_ap_QC` = 4", "select count(1) from `StakeholderSatisfaction` where MONTH(`fo_Regdate`) = MONTH(CURRENT_DATE()) and YEAR(`fo_Regdate`) = YEAR(CURRENT_DATE())", "select null"),
			"WorkEnvMonitoring" => array("select count(1) from `WorkEnvMonitoring`", "select count(1) from `WorkEnvMonitoring` where `ot_ap_Review` = 4", "select count(1) from `WorkEnvMonitoring` where `ot_ap_Approval` = 4", "select count(1) from `WorkEnvMonitoring` where `ot_ap_QC` = 4", "select count(1) from `WorkEnvMonitoring` where `fo_Classification` in ('Internal Monitoring')", "select count(1) from `WorkEnvMonitoring` where `fo_Classification` in ('External Monitoring')"),
			"batches" => array("select count(1) from `batches`", "select null", "select null", "select null", "select null", "select null"),
			"categories" => array("select count(1) from `categories`", "select null", "select null", "select null", "select null", "select null"),
			"Item" => array("select count(1) from `Item`", "select null", "select null", "select null", "select coalesce(sum(`fo_UnitPrice`), 0.00) from `Item` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())", "select null"),
			"orders" => array("select count(1) from `orders`", "select count(1) from `orders` where `ot_ap_Review` = 4", "select count(1) from `orders` where `ot_ap_Approval` = 4", "select count(1) from `orders` where `ot_ap_QC` = 4", "select count(1) from `orders` where `fo_Classification` in ('System', 'Equipment', 'Assembly', 'Component', 'Parts', 'Consumables')", "select count(1) from `orders` where `fo_Classification` in ('Services')"),
			"transactions" => array("select count(1) from `transactions`", "select null", "select null", "select null", "select count(1) from `transactions` where `fo_transactiontype` in ('Incoming', 'Outgoing')", "select count(1) from `transactions` where `fo_transactiontype` in ('Expired', 'Damaged')"),
			"IMSReport" => array("select count(1) from `IMSReport`", "select null", "select null", "select null", "select count(1) from `IMSReport` where MONTH(`filed`) = MONTH(CURRENT_DATE()) and YEAR(`filed`) = YEAR(CURRENT_DATE())", "select null"),
			"TeamSoftBoard" => array("select count(1) from `TeamSoftBoard`", "select null", "select null", "select null", "select count(1) from `TeamSoftBoard` where MONTH(`filed`) = MONTH(CURRENT_DATE()) and YEAR(`filed`) = YEAR(CURRENT_DATE())", "select null")
		);
		
		if(is_array($arrSummaryQueryList) && array_key_exists($tableName, $arrSummaryQueryList)){
			$tableQueries = $arrSummaryQueryList[$tableName];
			if(array_key_exists($metricPosition, $tableQueries))
			$returnQuery = $tableQueries[$metricPosition];
		}

		return $returnQuery;
	}

	#########################################################

	function get_summary_select_sql($tableName, $metricPosition){
		$returnQuery = 'select null';
		$arrSummarySelectSqlList = array(
			/* [0: 'selectTotalCount', 1: 'selectTotalDisplayField', 2: 'selectReviewCount', 3: 'selectApprovalCount', 4: 'selectIMSControlCount', 5: 'selectCustomDisplayField1', 6: 'selectCustomDisplayValue1', 7: 'selectCustomDisplayField2', 8: 'selectCustomDisplayValue2'] */   
			"select fo_TotalCount from summary_dashboard where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = CURRENT_DATE",
			"select fo_TotalDisplayField from summary_dashboard where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = CURRENT_DATE",
			"select fo_ReviewCount from summary_dashboard where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = CURRENT_DATE",
			"select fo_ApprovalCount from summary_dashboard where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = CURRENT_DATE",
			"select fo_IMSControlCount from summary_dashboard where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = CURRENT_DATE",
			"select fo_CustomDisplayField1 from summary_dashboard where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = CURRENT_DATE",
			"select fo_CustomDisplayValue1 from summary_dashboard where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = CURRENT_DATE",
			"select fo_CustomDisplayField2 from summary_dashboard where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = CURRENT_DATE",
			"select fo_CustomDisplayValue2 from summary_dashboard where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = CURRENT_DATE"
		);
		
		if(is_array($arrSummarySelectSqlList) && array_key_exists($metricPosition, $arrSummarySelectSqlList)){
			$returnQuery = $arrSummarySelectSqlList[$metricPosition];
		}

		return $returnQuery;

	}

	#########################################################

	function get_summary_update_sql($tableName, $metricValue, $metricPosition){
		$returnQuery = 'select null';
		$arrSummaryUpdateSqlList = array(
			/* [0: 'updateTotalCount', 1: 'updateReviewCount', 2: 'updateApprovalCount', 3: 'updateIMSControlCount', 4: 'updateCustomDisplayValue1',  5: 'updateCustomDisplayValue2'] */   
			"update summary_dashboard set fo_TotalCount='{$metricValue}' where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = (select CURRENT_DATE)",
			"update summary_dashboard set fo_ReviewCount='{$metricValue}' where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = (select CURRENT_DATE)",
			"update summary_dashboard set fo_ApprovalCount='{$metricValue}' where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = (select CURRENT_DATE)",
			"update summary_dashboard set fo_IMSControlCount='{$metricValue}' where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = (select CURRENT_DATE)",
			"update summary_dashboard set fo_CustomDisplayValue1='{$metricValue}' where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = (select CURRENT_DATE)",
			"update summary_dashboard set fo_CustomDisplayValue2='{$metricValue}' where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = (select CURRENT_DATE)"
		);

		if($metricPosition == 4 && get_summary_custom_display($tableName, 2) == "null"){
			$arrSummaryUpdateSqlList[$metricPosition] = "update summary_dashboard set fo_CustomDisplayValue1=null where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = (select CURRENT_DATE)";
		}
		else if ($metricPosition == 5 && get_summary_custom_display($tableName, 4) == "null"){
			$arrSummaryUpdateSqlList[$metricPosition] = "update summary_dashboard set fo_CustomDisplayValue2=null where fo_Section_Name='" . makeSafe($tableName). "' and ot_ap_Date = (select CURRENT_DATE)";
		}

		if(is_array($arrSummaryUpdateSqlList) && array_key_exists($metricPosition, $arrSummaryUpdateSqlList)){
			$returnQuery = $arrSummaryUpdateSqlList[$metricPosition];
		}

		return $returnQuery;

	}

	#########################################################

	function get_summary_custom_display($tableName, $metricPosition){
		$returnValue = '';
		$arrSummaryCustomDisplayList = array(
			/* 'table_name' => [0: 'total display field', 1: 'custom display field 1', 2: 'custom display field 1 data type', 3: 'custom display field 2', 4: 'custom display field 2 data type' */   
			"employees" => array("Employees", "Current Staff", "int", "Staff with Complete Induction", "int"),
			"InOutRegister" => array("Incoming Outgoing Records", "No. of Incoming Records", "int", "No. of Outgoing Records", "int"),
			"JD_JS" => array("Jobs", "null", "null", "null", "null"),
			"CalibrationCtrl" => array("Controls", "No. of Calibrations this Month", "int", "null", "null"),
			"Inventory" => array("Asset Register", "Operational Ready", "int", "Estimated Asset Value Amount", "float"),
			"LogisticRequest" => array("Logistic Requests", "No. of Market Surveys", "int", "No. of Request Orders", "int"),
			"Logistics" => array("Logistics", "No. of AVLs", "int", "null", "null"),
			"MWO" => array("MWOs", "No. of Assets", "int", "No. of Facilities", "int"),
			"vendor" => array("Vendors", "No. of AVLs", "int", "null", "null"),
			"WorkOrder" => array("Work Orders", "No. of Technical Related Tasks", "int", "No. of Non-Technical Related Tasks", "int"),
			"Client" => array("Clients", "Active Clients", "int", "Non-active Clients", "int"),
			"Inquiry" => array("Inquiries", "Input from Email & Discussion", "int", "Input from Market Survey & Tender Bidding", "int"),
			"Marketing" => array("Marketing Leads", "Positive Leads Qualifications", "int", "Negative Leads Qualifications", "int"),
			"OrgContentContext" => array("Org Contents", "No.of External Documents", "int", "No. of Generated Records", "int"),
			"AccountPayables" => array("Account Payables", "Total LumpSum Price this Week", "float", "Total LumpSum Price this Month", "float"),
			"ActCard" => array("Act Cards", "No. of Positive Observations this Month", "int", "No. of Unsafe Acts and Behaviors this Month", "int"),
			"Bi_WeeklyMeeting" => array("Meetings", "No. of Meetings this Month", "int", "null", "null"),
			"Breakdown" => array("Reports", "No. of Issues Opened this Month", "int", "No. of Issues Closed this Month", "int"),
			"Campaign" => array("Campaigns", "No. of Open Campaigns", "int", "No. of Closed Campaigns", "int"),
			"ClaimRecord" => array("Claims", "No. of Claim Submissions this Month", "int", "Total Lump Sum Amount this Month", "float"),
			"Competency" => array("Competencies", "No. of Internal Reviews this Month", "int", "No. of External Reviews this Month", "int"),
			"ContractDeployment" => array("Deployments", "No. of Kick-off and Coordination Meetings", "int", "No. of Subcontractor Meetings", "int"),
			"DailyProgressReport" => array("Reports", "No. of Daily Logs this Month", "int", "No. of Daily Checklists this Month", "int"),
			"DCN" => array("Change Notices", "No. of Document Change Notices this Month", "int", "null", "null"),
			"DeliveryOrder" => array("Delivery Orders", "No. of Deliveries this Month", "int", "null", "null"),
			"DesignProposal" => array("Proposals", "No. of Internal Submissions", "int", "No. of External Submissions", "int"),
			"DrillNInspection" => array("Drill Inspections", "No. of Drills", "int", "No. of Inspections", "int"),
			"EventNotification" => array("Notifications", "null", "null", "null", "null"),
			"ManagementVisit" => array("Visits", "No. of Internal Visits", "int", "No. of External Visits", "int"),
			"ManagingVendor" => array("Managing Vendors", "No. of Technical Inspections", "int", "No. of Commercial Inspections", "int"),
			"MonthlyTimesheet" => array("Timesheet", "No. of Certificates of Completion", "int", "No. of Manpower & Equipment", "int"),
			"MWConditionBased" => array("Conditions", "No. of Condition Based this Month", "int", "null", "null"),
			"MWOCorrective" => array("Correctives", "No. of Correctives this Month", "int", "null", "null"),
			"MWOPlanned" => array("Schedules", "No. of Schedules this Month", "int", "null", "null"),
			"MWOpreventive" => array("Preventives", "No. of Preventives this Month", "int", "null", "null"),
			"MWOproactive" => array("Proactives", "No. of Proactives this Month", "int", "null", "null"),
			"MWOReactive" => array("Reactives", "No. of Reactives this Month", "int", "null", "null"),
			"ObsoleteRec" => array("Obsoletes", "No. of Obsolete Record Registers this Month", "int", "null", "null"),
			"PersonnalFile" => array("Files", "No. of Certificates", "int", "null", "null"),
			"PurchaseOrder" => array("Purchase Orders", "Price", "float", "No. of Purchase Orders this Month", "int"),
			"QuarterlyMeeting" => array("Meetings", "No. of Meetings this Month", "int", "null", "null"),
			"Quotation" => array("Quotations", "Price", "float", "No. of Quotations this Month", "int"),
			"Recruitment" => array("Recruitments", "Total Interviews", "int", "Total Desktop Review Sessions", "int"),
			"ReportComment" => array("Comments", "No. of Report Comments this Month", "int", "No. of Report Comments this Month", "int"),
			"SoftboardComment" => array("Comments", "No. of Softboard Comments this Week", "int", "No. of Softboard Comments this Month", "int"),
			"ToolBoxMeeting" => array("Meetings", "No. of Meetings this Month", "int", "null", "null"),
			"Training" => array("Trainings", "No. of Internal Trainings", "int", "No. of External Trainings", "int"),
			"VenPerformance" => array("Vendor Performances", "No. of Above Average Performances", "int", "No. of Below Average Performances", "int"),
			"WorkPermit" => array("Work Permits", "No. of High Risk Work Permits", "int", "No. of Medium Risk Work Permits", "int"),
			"PROCompletion" => array("Project Completions", "No. of Project Deliverables Records", "int", "Project Deliverables Records", "int"),
			"PROControlMonitoring" => array("Project Monitorings", "No. of Inspections", "int", "No. of Trackings", "int"),
			"PROExecution" => array("Project Executions", "No. of Subcontractor Documents & Reports", "int", "No. of Client Documents & Reports", "int"),
			"PROInitiation" => array("Project Initiations", "No. of Kick-Offs", "int", "null", "null"),
			"projects" => array("Projects", "No. of Main Contractors", "int", "No. of Subcontractors", "int"),
			"ProjectTeam" => array("Project Teams", "No. of Permanent Staff", "int", "No. of Contract Staff", "int"),
			"PROPlanning" => array("Project Plannings", "No. of Project Management Plans", "int", "No. of Project Assurance Launch Matrix and Profit & Loss", "int"),
			"PROVariation" => array("Project Variation Orders", "No. of Service Variations", "int", "No. of Equipment & Manpower Variations", "int"),
			"Receivables" => array("Receivables", "No. of Claims", "int", "No. of Debit& Credit Notes", "int"),
			"resources" => array("Resources", "No. of Availables", "int", "No. of Tools, Machinery, Vehicles, Facilities", "int"),
			"WorkLocation" => array("Locations", "No. of Sections", "int", "null", "null"),
			"Audit" => array("Audits", "No. of Internal Auditors", "int", "No. of External Auditors", "int"),
			"CommConsParticipate" => array("Communications", "No. of Total Completed", "int", "null", "null"),
			"ContinualImprovement" => array("CAPAR", "No. of Internal CAPAR", "int", "No. of External CAPAR", "int"),
			"DocControl" => array("Controls", "No. of Procedures", "int", "No. of Forms", "int"),
			"ERP" => array("ERP Items", "No. of Emergency Responses", "int", "No. of Contingency Responses", "int"),
			"IMSDataAnalysis" => array("Continual Improvement Plan", "No. of Organization Improvements", "int", "No. of Project Improvements", "int"),
			"IMStrackingNmonitoring" => array("IMS Monitorings", "No. of Internal Monitorings", "int", "No. of External Monitorings", "int"),
			"IncidentReporting" => array("Incidents", "No. of Incident Reports", "int", "No. of Accident Reports", "int"),
			"KM" => array("Org Knowledge", "No. of Internal References", "int", "No. of External References", "int"),
			"LegalRegister" => array("Legal Registers", "No. of Legals", "int", "No. of Standards", "int"),
			"MgtofChange" => array("Changes", "No. of Processes", "int", "No. of Procedures and Forms", "int"),
			"MRM" => array("Meetings", "No. of Internal Meetings", "int", "No. of External Meetings", "int"),
			"NonConformance" => array("Non Conformances", "No. of Minor Non Conformances", "int", "No. of Major Non Conformances", "int"),
			"QA" => array("IMS Plannings", "No. of Internal Uses", "int", "No. of External Uses", "int"),
			"RiskandOpportunity" => array("Risk Managements", "No. of Quality, Health, Safety and Environment", "int", "No. of Technical and Organization", "int"),
			"ScheduleWaste" => array("Waste Disposals", "No. of Non-Hazardous Wastes", "int", "No. of Hazardous Wastes", "int"),
			"StakeholderSatisfaction" => array("Satisfaction Surveys", "No. of Surveys this Month", "int", "null", "null"),
			"WorkEnvMonitoring" => array("Work Env Monitorings", "No. of Internal Monitorings", "int", "No. of External Monitorings", "int"),
			"batches" => array("Batches", "null", "null", "null", "null"),
			"categories" => array("Item Categories", "null", "null", "null", "null"),
			"Item" => array("Resources Inventory", "Total Value this Month", "float", "null", "null"),
			"orders" => array("Request & Service Orders", "No. of Physical Requests", "int", "No. of Services Requests", "int"),
			"transactions" => array("Transfer Item", "No. of Incoming and Outgoing", "int", "No. of Expired and Damaged", "int"),
			"IMSReport" => array("IMS Reports", "No. of Complaint Reports this Month", "int", "null", "null"),
			"TeamSoftBoard" => array("Org Softboard Items", "No. of Softboards this Month", "int", "null", "null")
		);
		
		if(is_array($arrSummaryCustomDisplayList) && array_key_exists($tableName, $arrSummaryCustomDisplayList)){
			$tableCustomDisplayList = $arrSummaryCustomDisplayList[$tableName];
			if(array_key_exists($metricPosition, $tableCustomDisplayList))
			$returnValue = $tableCustomDisplayList[$metricPosition];
		}

		return $returnValue;

	}

	#########################################################

	function summary_update_after_insert_delete($tableName, $operation){
		$currentTotal = 0; 
		$newTotal = 0;

		if(function_exists('get_summary_select_sql')){
			$currentTotal = sqlValue(get_summary_select_sql($tableName, 0));
		}

		if(!isset($currentTotal) || empty($currentTotal)) {
			$currentTotal = 0;
		}

		if($operation == 'insert'){
			$newTotal = $currentTotal + 1;
		}
		else if($operation == 'delete'){
			$newTotal = $currentTotal - 1;
		}
		
		if(function_exists('summary_update_after_update')){
			summary_update_after_update($tableName);
		}
		
		if(function_exists('summary_update_after_update')){
			sql(get_summary_update_sql($tableName, $newTotal, 0), $eo);
		}

		return TRUE;
	}

	#########################################################

	function summary_update_after_update($tableName){
		$currentReviewClosed = "";
		$currentApprovalClosed = "";
		$currentIMSControlClosed = "";
		$currentCustomValue1 = "";
		$currentCustomValue2 = "";

		if(function_exists('get_summary_counters_sql')){
			$currentReviewClosed = sqlValue(get_summary_counters_sql($tableName, 1));
			$currentApprovalClosed = sqlValue(get_summary_counters_sql($tableName, 2));
			$currentIMSControlClosed = sqlValue(get_summary_counters_sql($tableName, 3));
			$currentCustomValue1 = sqlValue(get_summary_counters_sql($tableName, 4));
			$currentCustomValue2 = sqlValue(get_summary_counters_sql($tableName, 5));

			if(!isset($currentReviewClosed) || empty($currentReviewClosed)) 		$currentReviewClosed = "";
			if(!isset($currentApprovalClosed) || empty($currentApprovalClosed)) 	$currentApprovalClosed = "";
			if(!isset($currentIMSControlClosed) || empty($currentIMSControlClosed)) $currentIMSControlClosed = "";
			if(!isset($currentCustomValue1) || empty($currentCustomValue1)) 		$currentCustomValue1 = "";
			if(!isset($currentCustomValue2) || empty($currentCustomValue2)) 		$currentCustomValue2 = "";
		}

		if(function_exists('get_summary_update_sql')){
			sql(get_summary_update_sql($tableName, $currentReviewClosed, 1), $eo);
			sql(get_summary_update_sql($tableName, $currentApprovalClosed, 2), $eo);
			sql(get_summary_update_sql($tableName, $currentIMSControlClosed, 3), $eo);
			sql(get_summary_update_sql($tableName, $currentCustomValue1, 4), $eo);
			sql(get_summary_update_sql($tableName, $currentCustomValue2, 5), $eo);
		}

		return TRUE;
	}

	#########################################################

	function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a days, %h hours');
	}

	#########################################################

	function thousandsCurrencyFormat($num) {

		if($num>1000) {
	  
			  $x = round($num);
			  $x_number_format = number_format($x);
			  $x_array = explode(',', $x_number_format);
			  $x_parts = array('k', 'm', 'b', 't');
			  $x_count_parts = count($x_array) - 1;
			  $x_display = $x;
			  $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
			  $x_display .= $x_parts[$x_count_parts - 1];
	  
			  return $x_display;
	  
		}
	  
		return $num;
	}

	#########################################################

	function dbCalendarEvent($title, $start, $end, $tableName, $pkValue, $review, $approval, $imscontrol, $operation) {
		if((!isset($start) || empty($start)) && $operation != 'delete') return FALSE;  else $start = "'".$start."'";
		if(!isset($end) || empty($end)) $end = 'null'; else $end = "'".$end."'";
		$sql_operation = '';
		$values = [];

		switch ($operation) {
			case 'insert':	
				$sql_operation = "INSERT INTO `events` (`title`, `start`, `end`, `tableName`, `pkValue`, `ot_ap_Review`, `ot_ap_Approval`, `ot_ap_QC`) VALUES ('".$title."', ".$start.", ".$end.", '".$tableName."', '".$pkValue."', ".$review.", ".$approval.", ".$imscontrol.")";
				break;
			case 'update':
				$sql_operation = "UPDATE `events` SET `title`='".$title."',`start`=".$start.",`end`=".$end.",`tableName`='".$tableName."',`pkValue`='".$pkValue."',`ot_ap_Review`=".$review.",`ot_ap_Approval`=".$approval.",`ot_ap_QC`=".$imscontrol." WHERE `tableName`='".$tableName."' and `pkValue`='".$pkValue."'";
				break;
			case 'delete':
				$sql_operation = "DELETE FROM `events` WHERE `tableName`='".$tableName."' and `pkValue`='".$pkValue."'";
				break;
			default:
				return FALSE;
		}
		sql($sql_operation, $eo);
		return TRUE;
	}

	#########################################################

	function getTableList2($skip_authentication = false){
		$arrAccessTables = array();
		$arrTables = array(   
			'OrgContentContext' => 'Organization Content & Context',
			'Marketing' => 'Marketing & Lead Generation',
			'Client' => 'Client & Main Contractor',
			'Inquiry' => 'Inquiry & Tender',
			'DesignProposal' => 'Service Design & Proposal',
			'ContractDeployment' => 'Project & Contract Deployment',
			'employees' => 'Human Resources Matrix',
			'Recruitment' => 'Recruitment',
			'PersonnalFile' => 'Personal File',
			'Competency' => 'Competency',
			'Training' => 'Training',
			'JD_JS' => 'Job Description & Specification Register',
			'InOutRegister' => 'Incoming & Outgoing Record Register',
			'vendor' => 'Vendor & Subcontractor Register',
			'ManagingVendor' => 'Managing Vendor & Subcontractor',
			'VenPerformance' => 'Vendor Performance and Evaluation',
			'Logistics' => 'Logistics & Freight Agent',
			'Inventory' => 'Asset Register',
			'CalibrationCtrl' => 'Calibration Control',
			'WorkOrder' => 'General Work Order',
			'MWO' => 'Maintenance Work Order',
			'MWOPlanned' => 'Planned Schedule',
			'MWOpreventive' => 'Preventive',
			'MWOproactive' => 'Proactive',
			'MWConditionBased' => 'Condition Based',
			'MWOReactive' => 'Reactive',
			'MWOCorrective' => 'Corrective',
			'LogisticRequest' => 'Logistic Request Order',
			'orders' => 'Request & Service Order',
			'Quotation' => 'Quotations',
			'PurchaseOrder' => 'Purchase Order',
			'DeliveryOrder' => 'Delivery Order',
			'AccountPayables' => 'Account Payables',
			'Item' => 'Resources Inventory',
			'categories' => 'Item Categories',
			'batches' => 'Batches',
			'transactions' => 'Transfer Item',
			'CommConsParticipate' => 'Communication, Consultation & Participation',
			'ToolBoxMeeting' => 'ToolBox Meeting',
			'Bi_WeeklyMeeting' => 'Bi-Weekly Meeting',
			'QuarterlyMeeting' => 'Quarterly Meeting',
			'Campaign' => 'Campaign',
			'DrillNInspection' => 'Drill & Inspection',
			'ManagementVisit' => 'Management Visit',
			'EventNotification' => 'Event Notification',
			'ActCard' => 'Act Card',
			'KM' => 'Organizational Knowledge',
			'LegalRegister' => 'Legal Register',
			'RiskandOpportunity' => 'Risks Management',
			'DocControl' => 'Document & Record Control',
			'DCN' => 'Document Change Notice',
			'ObsoleteRec' => 'Obsolete Record Register',
			'QA' => 'IMS Planning & Assurance',
			'ERP' => 'Emergency Preparedness & Response',
			'WorkEnvMonitoring' => 'Work Environment Monitoring and Control',
			'ScheduleWaste' => 'Schedule Waste Disposal Register',
			'IncidentReporting' => 'Incident & Accident Reporting',
			'MgtofChange' => 'Management Of Change',
			'IMStrackingNmonitoring' => 'IMS Data Tracking & Monitoring',
			'IMSDataAnalysis' => 'Continual Improvement Plan',
			'Audit' => 'Management System Audit',
			'NonConformance' => 'IMS Non Conformance',
			'ContinualImprovement' => 'CAPAR',
			'StakeholderSatisfaction' => 'Stakeholder Satisfaction Survey',
			'MRM' => 'Management Review Meeting',
			'projects' => 'Project Register',
			'WorkLocation' => 'Work Site Location',
			'WorkPermit' => 'Work Permit',
			'ProjectTeam' => 'Project Team Matrix',
			'resources' => 'Resources & Equipment',
			'PROInitiation' => 'Project Initiation',
			'PROPlanning' => 'Project Planning',
			'PROExecution' => 'Project Execution',
			'DailyProgressReport' => 'Daily Progress Report',
			'MonthlyTimesheet' => 'Monthly Timesheet',
			'Breakdown' => 'Breakdown & Fault Report',
			'PROControlMonitoring' => 'Project Control And Monitoring',
			'PROVariation' => 'Project Variation Order',
			'PROCompletion' => 'Project Completion',
			'Receivables' => 'Project Receivables',
			'ClaimRecord' => 'Claim Submission',
			'TeamSoftBoard' => 'Organization Softboard',
			'SoftboardComment' => 'Softboard Comment',
			'IMSReport' => 'IMS Complaint Report',
			'ReportComment' => 'Report Comment',
			'Leadership' => 'Review & Verification',
			'Approval' => 'Approval',
			'IMSControl' => 'IMS Control',
			'membership_company' => 'Company',
			'kpi' => 'KPI',
			'summary_dashboard' => 'Summary Dashboard'
		);
		if($skip_authentication || getLoggedAdmin()) return $arrTables;

		if(is_array($arrTables)){
			foreach($arrTables as $tn => $tc){
				$arrPerm = getTablePermissions($tn);
				if($arrPerm[0]){
					$arrAccessTables[$tn] = $tc;
				}
			}
		}

		return $arrAccessTables;
	}

	#########################################################

	function getDbDateFiledField($tableName, $sort){
		$arrTables = array(   
			'OrgContentContext' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Marketing' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Client' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Inquiry' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'DesignProposal' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ContractDeployment' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'employees' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Recruitment' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'PersonnalFile' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Competency' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Training' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'JD_JS' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'InOutRegister' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'vendor' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ManagingVendor' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'VenPerformance' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Logistics' => array('ot_ap_filed', 'ot_ap_last_modified' ),
			'Inventory' => array('ot_ap_filed', 'ot_ap_last_modified' ),
			'CalibrationCtrl' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'WorkOrder' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MWO' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MWOPlanned' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MWOpreventive' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MWOproactive' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MWConditionBased' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MWOReactive' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MWOCorrective' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'LogisticRequest' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'orders' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Quotation' => array('ot_ap_filed', 'ot_ap_last_modified' ),
			'PurchaseOrder' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'DeliveryOrder' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'AccountPayables' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Item' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'categories' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'batches' => array('fo_ap_filed', 'fo_lastmodified' ),
			'transactions' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'CommConsParticipate' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ToolBoxMeeting' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Bi_WeeklyMeeting' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'QuarterlyMeeting' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Campaign' => array('ot_ap_filed', 'ot_ap_last_modified' ),
			'DrillNInspection' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ManagementVisit' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'EventNotification' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ActCard' => array('ot_ap_filed', 'ot_ap_last_modified' ),
			'KM' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'LegalRegister' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'RiskandOpportunity' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'DocControl' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'DCN' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ObsoleteRec' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'QA' => array('ot_ap_filed', 'ot_ap_last_modified' ),
			'ERP' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'WorkEnvMonitoring' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ScheduleWaste' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'IncidentReporting' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MgtofChange' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'IMStrackingNmonitoring' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'IMSDataAnalysis' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Audit' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'NonConformance' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ContinualImprovement' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'StakeholderSatisfaction' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MRM' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'projects' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'WorkLocation' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'WorkPermit' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ProjectTeam' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'resources' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'PROInitiation' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'PROPlanning' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'PROExecution' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'DailyProgressReport' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'MonthlyTimesheet' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Breakdown' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'PROControlMonitoring' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'PROVariation' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'PROCompletion' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'Receivables' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'ClaimRecord' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'TeamSoftBoard' => array('filed', 'last_modified' ),
			'SoftboardComment' => array('filed', 'last_modified' ),
			'IMSReport' => array('filed', 'last_modified' ),
			'ReportComment' => array('filed', 'last_modified' ),
			'Leadership' => array('filed', 'last_modified' ),
			'Approval' => array('filed', 'last_modified' ),
			'IMSControl' => array('filed', 'last_modified' ),
			'membership_company' => array('ot_ap_filed', 'ot_ap_lastmodified' ),
			'kpi' => array('ot_ap_lastmodified', 'ot_ap_lastmodified' ),
			'summary_dashboard' => array('ot_ap_Date', 'ot_ap_lastmodified' )
		);
		$field = '';
		if(is_array($arrTables)){
			foreach($arrTables as $tn => $tc){
				if($tableName == $tn){
					if($sort=='dateAdded') $field = $tc[0];
					else if($sort=='dateModified') $field = $tc[1];
				}
			}
		}

		return $field;
	}


	