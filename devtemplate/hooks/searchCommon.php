<?php
    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    $output = array();

    function searchQueryBuilder($departmentID, $tableName, $searchText, $sort, $sortDir, $dateStart, $dateEnd, $countFlag, $start, $recordsPerPage){
        $departments = get_table_groups();
        $tables = getTableList2();
        $dID = intval($departmentID); // d
        $tableList = array();
        $tableName = $tableName; // t
        $whereConvertArr = array();
        $keywords = preg_split("/[\s,\']+/", $searchText);
        $keywordsCount = count($keywords);
        $dateStart = $dateStart . " 00:00:00";
        $dateEnd = $dateEnd . " 23:59:59";
        
        //  if d is All and t is All, check for all tables in #0
        //  if d is Specified and t is ALL, check for all t in Specified d in #0

        //  if d is All and t is Specified, check for Specified t in #0
        //  if d is Specified and t is Specified, check for Specified t in #0

        // check for Specified tableName only
        if ($tableName != 'All tables' && $tableName != ''){    
            $tableList[$tableName] = get_sql_fields($tableName);
        }
        // check for all t in Specified d
        else if ($dID != '0' && $dID != ''){
            // get respective tables per given department
            switch ($dID){
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
            /* example: 
                $returnTables: 
                    0:"projects"
                    1:"WorkLocation"
                    2:"ProjectTeam"
                    3:"resources"
            */
            foreach($returnTables as $tn => $tc){
                $tableList[$tc] = get_sql_fields($tc);
            }
        }
        // check for all t if ($dID == '0') and ($tableName == 'All tables')
        else {
            foreach($tables as $tn => $tc){
                $tableList[$tn] = get_sql_fields($tn);
            }
        }
        /* example:           
            $tableList:
                OrgContentContext:"
                    `OrgContentContext`.`id` as 'id', 
                    `OrgContentContext`.`RecordNumber` as 'RecordNumber', `OrgContentContext`.`ot_Ref04` as 'ot_Ref04', 
                    `OrgContentContext`.`ot_R...`
                ",
                Marketing:
        */
        foreach($tableList as $tn => $sqlFields){
            // check whether select count or select *
            if ($countFlag == 1) $whereConvertArr[$tn] = 'SELECT COUNT(*) FROM ';
            else $whereConvertArr[$tn] = 'SELECT * FROM ';

            // get the sqlFrom with joins for the table
            $whereConvertArr[$tn] .= get_sql_from($tn, true) . ' WHERE ( ';

            // split the sqlFields with regex expression for "as 'renamed_column'"
            $currSqlFieldsRegex = preg_split("/as '.*?['\"],/", $sqlFields);

            $currConvertString = array();
            $countFields = count($currSqlFieldsRegex);
            
            $currKeywordIndex = 0;

            // for each keyword
            foreach($keywords as $i => $w){
                $currIndex = 0;
                // for each field, build the convert string using the keyword
                foreach($currSqlFieldsRegex as $x => $fields){
                    $currConvertString = 'CONVERT(' . $fields . ' USING utf8) LIKE ';
                
                    if ($currIndex == 0){ // first field starts with ( and ends with OR
                        $whereConvertArr[$tn] .= "(" . $currConvertString . "'%". $w . "%' OR ";
                    }
                    else if($currIndex == (intval($countFields)-1)){ // last field ends with )
                        // split the sqlFields with regex expression for "as 'renamed_column'"
                        $currSqlFieldsRegex2 = preg_replace("/as '.*?['\"]/", "", $fields);
                        $currConvertString2 = 'CONVERT(' . $currSqlFieldsRegex2 . ' USING utf8) LIKE ';
                        $whereConvertArr[$tn] .= $currConvertString2 . "'%". $w . "%')";
                    }
                    else{ // for any fields in between, ends with OR
                        $whereConvertArr[$tn] .= $currConvertString . "'%". $w . "%' OR ";
                    }
                    $currIndex++;
                }
                if($currKeywordIndex != intval($keywordsCount)-1){ // if more keywords to search
                    $whereConvertArr[$tn] .= " AND ";
                }
                $currKeywordIndex++;
            }
            $whereConvertArr[$tn] .= ' ) ';

            // get the respective date field name for given table name and sort field
            $currDateField = getDbDateFiledField($tn, $sort);
            $whereDate = '';
            if(isset($currDateField) && $currDateField != ''){
                // process date range if available only for tables other than kpi and summary_dashboard
                if (isset($dateStart) && $dateStart != '' && isset($dateEnd) && $dateEnd != ''){
                    if($tn != 'kpi' && $tn != 'summary_dashboard'){
                        $whereDate = '`' . $tn . '`.`' . $currDateField . '` BETWEEN "'. $dateStart . '" AND "' . $dateEnd . '" ';
                    }
                }
                // add date filter clause if available
                if ($whereDate != '') $whereConvertArr[$tn] .= ' AND ' . $whereDate;
                // add order by clause
                $whereConvertArr[$tn] .= "order by `" . $tn . "`.`" . "$currDateField" . "` " . $sortDir;

                if ($countFlag != 1) $whereConvertArr[$tn] .= " limit $start, " . $recordsPerPage;
                
            }
            
        }
        // print_r($whereConvertArr);
        return $whereConvertArr;
    }
/*
SELECT *
FROM
        `priggm80_bsm01`.`ActCard`
WHERE
(        (
                CONVERT(`id` USING utf8)                  LIKE '%ROV%'
        OR      CONVERT(`ACID` USING utf8)                LIKE '%ROV%'
        OR      CONVERT(`ccpID` USING utf8)               LIKE '%ROV%'
        OR      CONVERT(`fo_Desc` USING utf8)             LIKE '%ROV%'
        OR      CONVERT(`fo_RequiredDate` USING utf8)     LIKE '%ROV%'
        OR      CONVERT(`ot_FileLoc` USING utf8)          LIKE '%ROV%'
        OR      CONVERT(`ot_otherdetails` USING utf8)     LIKE '%ROV%'
        OR      CONVERT(`ot_comments` USING utf8)         LIKE '%ROV%'
        OR      CONVERT(`ot_SharedLink1` USING utf8)      LIKE '%ROV%'
        OR      CONVERT(`ot_SharedLink2` USING utf8)      LIKE '%ROV%'
        OR      CONVERT(`ot_Ref01` USING utf8)            LIKE '%ROV%'
        OR      CONVERT(`ot_Ref02` USING utf8)            LIKE '%ROV%'
        OR      CONVERT(`ot_Photo` USING utf8)            LIKE '%ROV%'
        OR      CONVERT(`ot_ap_filed` USING utf8)         LIKE '%ROV%'
        OR      CONVERT(`ot_ap_last_modified` USING utf8) LIKE '%ROV%')
OR      (
                CONVERT(`id` USING utf8)                  LIKE '%EQUIPMENT%'
        OR      CONVERT(`ACID` USING utf8)                LIKE '%EQUIPMENT%'
        OR      CONVERT(`ccpID` USING utf8)               LIKE '%EQUIPMENT%'
        OR      CONVERT(`fo_Desc` USING utf8)             LIKE '%EQUIPMENT%'
        OR      CONVERT(`fo_RequiredDate` USING utf8)     LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_FileLoc` USING utf8)          LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_otherdetails` USING utf8)     LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_comments` USING utf8)         LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_SharedLink1` USING utf8)      LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_SharedLink2` USING utf8)      LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_Ref01` USING utf8)            LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_Ref02` USING utf8)            LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_Photo` USING utf8)            LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_ap_filed` USING utf8)         LIKE '%EQUIPMENT%'
        OR      CONVERT(`ot_ap_last_modified` USING utf8) LIKE '%EQUIPMENT%')
OR      (
                CONVERT(`id` USING utf8)                  LIKE '%&%'
        OR      CONVERT(`ACID` USING utf8)                LIKE '%&%'
        OR      CONVERT(`ccpID` USING utf8)               LIKE '%&%'
        OR      CONVERT(`fo_Desc` USING utf8)             LIKE '%&%'
        OR      CONVERT(`fo_RequiredDate` USING utf8)     LIKE '%&%'
        OR      CONVERT(`ot_FileLoc` USING utf8)          LIKE '%&%'
        OR      CONVERT(`ot_otherdetails` USING utf8)     LIKE '%&%'
        OR      CONVERT(`ot_comments` USING utf8)         LIKE '%&%'
        OR      CONVERT(`ot_SharedLink1` USING utf8)      LIKE '%&%'
        OR      CONVERT(`ot_SharedLink2` USING utf8)      LIKE '%&%'
        OR      CONVERT(`ot_Ref01` USING utf8)            LIKE '%&%'
        OR      CONVERT(`ot_Ref02` USING utf8)            LIKE '%&%'
        OR      CONVERT(`ot_Photo` USING utf8)            LIKE '%&%'
        OR      CONVERT(`ot_ap_filed` USING utf8)         LIKE '%&%'
        OR      CONVERT(`ot_ap_last_modified` USING utf8) LIKE '%&%')
)
and `ot_ap_filed` between '2018-08-25 15:05:32' and '2018-08-25 15:06:09' order by `ot_ap_filed` desc
*/


    