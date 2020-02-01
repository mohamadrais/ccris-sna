<?php
    $_script_started = microtime(1);

    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../defaultLang.php");
    include("$hooks_dir/../language.php");
    include("$hooks_dir/../lib.php");
    $o = array('silentErrors' => true);
    $dashboardSQL = "INSERT INTO
    `summary_dashboard`
    (
            `ot_ap_Date`            ,
            `fo_Section_Name`       ,
            `fo_Section_Caption`    ,
            `fo_TotalDisplayField`  ,
            `fo_TotalCount`         ,
            `fo_ReviewCount`        ,
            `fo_ApprovalCount`      ,
            `fo_IMSControlCount`    ,
            `fo_CustomDisplayField1`,
            `fo_CustomDisplayValue1`,
            `fo_CustomDisplayField2`,
            `fo_CustomDisplayValue2`,
            `ot_ap_lastmodified`
    )
    VALUES
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'employees'),
    (
            SELECT
                    'Human Resources Matrix'),
    (
            SELECT
                    'Employees'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `employees`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `employees`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `employees`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `employees`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'Current Staff'),
    (
            SELECT
                    (
                            SELECT
                                    COUNT(1)
                            FROM
                                    `employees`) -
                    (
                            SELECT
                                    COUNT(1)
                            FROM
                                    `employees`
                            WHERE
                                    `fo_OffHireDate` IS NOT NULL
                            AND     `fo_OffHireDate`          <= CURRENT_DATE) AS current_staff_count),
    (
            SELECT
                    'Staff with Complete Induction'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `employees`
            WHERE
                    `fo_Acknowledgement` = 1
            AND     `fo_Induction`       = 1),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'InOutRegister'),
    (
            SELECT
                    'Incoming & Outgoing Record Register'),
    (
            SELECT
                    'Incoming Outgoing Records'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `InOutRegister`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `InOutRegister`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `InOutRegister`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `InOutRegister`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Incoming Records'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `InOutRegister`
            WHERE
                    `fo_Classification` = 'Incoming'),
    (
            SELECT
                    'No. of Outgoing Records'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `InOutRegister`
            WHERE
                    `fo_Classification` = 'Outgoing'),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'JD_JS'),
    (
            SELECT
                    'Job Description & Specification Register'),
    (
            SELECT
                    'Jobs'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `JD_JS`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `JD_JS`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `JD_JS`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `JD_JS`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'CalibrationCtrl'),
    (
            SELECT
                    'Calibration Control'),
    (
            SELECT
                    'Controls'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CalibrationCtrl`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CalibrationCtrl`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CalibrationCtrl`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CalibrationCtrl`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Calibrations this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CalibrationCtrl`
            WHERE
                    MONTH(`fo_Delivdate`) = MONTH(CURRENT_DATE())
            AND     YEAR(`fo_Delivdate`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Inventory'),
    (
            SELECT
                    'Asset Register'),
    (
            SELECT
                    'Asset Register'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inventory`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inventory`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inventory`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inventory`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'Operational Ready'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inventory`
            WHERE
                    `fo_Condition` = 'Operational Ready'),
    (
            SELECT
                    'Estimated Asset Value Amount'),
    (
            SELECT
                    COALESCE(SUM(`fo_UnitPrice`), 0.00)
            FROM
                    `Inventory`),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'LogisticRequest'),
    (
            SELECT
                    'Logistic Request Order'),
    (
            SELECT
                    'Logistic Requests'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LogisticRequest`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LogisticRequest`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LogisticRequest`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LogisticRequest`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Market Surveys'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LogisticRequest`
            WHERE
                    `Market_Survey` = 'Market Survey'),
    (
            SELECT
                    'No. of Request Orders'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LogisticRequest`
            WHERE
                    `Market_Survey` = 'Logistic Request'),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Logistics'),
    (
            SELECT
                    'Logistics & Freight Agent'),
    (
            SELECT
                    'Logistics'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Logistics`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Logistics`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Logistics`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Logistics`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of AVLs'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Logistics`
            WHERE
                    `fo_AVList` = 1),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MWO'),
    (
            SELECT
                    'Maintenance Work Order'),
    (
            SELECT
                    'MWOs'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWO`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWO`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWO`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWO`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Assets'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWO`
            WHERE
                    `fo_Category` = 'Asset'),
    (
            SELECT
                    'No. of Facilities'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWO`
            WHERE
                    `fo_Category` = 'Facilities'),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'vendor'),
    (
            SELECT
                    'Vendor & Subcontractor Register'),
    (
            SELECT
                    'Vendors'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `vendor`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `vendor`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `vendor`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `vendor`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of AVLs'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `vendor`
            WHERE
                    `fo_AVList` = 1),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'WorkOrder'),
    (
            SELECT
                    'General Work Order'),
    (
            SELECT
                    'Work Orders'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkOrder`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkOrder`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkOrder`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkOrder`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Technical Related Tasks'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkOrder`
            WHERE
                    `Task` IN ('Technical Task'      ,
                               'Project Task'        ,
                               'Client Requirement')),
    (
            SELECT
                    'No. of Non-Technical Related Tasks'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkOrder`
            WHERE
                    `Task` IN ('General Task'                     ,
                               'Vendor Communication'             ,
                               'Integrated Management System Duty',
                               'Logistic Duty'                    ,
                               '5S Housekeeping'))                ,
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Client'),
    (
            SELECT
                    'Client & Main Contractor'),
    (
            SELECT
                    'Clients'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Client`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Client`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Client`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Client`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'Active Clients'),
    (
            SELECT
                    COUNT(DISTINCT c.id)
            FROM
                    `Client` c
            JOIN
                    `Inquiry` i
            ON
                    (
                            c.`id`          = i.`ClientID`
                    AND     i.`fo_DueDate` >= CURRENT_DATE)),
    (
            SELECT
                    'Non-active Clients'),
    (
            SELECT
                    COUNT(DISTINCT c.id)
            FROM
                    `Client` c
            LEFT JOIN
                    `Inquiry` i
            ON
                    (
                            c.`id`          = i.`ClientID`
                    AND     i.`fo_DueDate` >= CURRENT_DATE)
            WHERE
                    i.`id` IS NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Inquiry'),
    (
            SELECT
                    'Inquiry & Tender'),
    (
            SELECT
                    'Inquiries'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inquiry`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inquiry`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inquiry`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inquiry`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'Input from Email & Discussion'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inquiry`
            WHERE
                    `fo_Classification` IN ('Email'       ,
                                            'Discussion')),
    (
            SELECT
                    'Input from Market Survey & Tender Bidding'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Inquiry`
            WHERE
                    `fo_Classification` IN ('Market Survey'   ,
                                            'Tender Bidding')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Marketing'),
    (
            SELECT
                    'Marketing & Lead Generation'),
    (
            SELECT
                    'Marketing Leads'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Marketing`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Marketing`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Marketing`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Marketing`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'Positive Leads Qualifications'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Marketing`
            WHERE
                    `fo_Qualification` IN ('Working'             ,
                                           'Check Back Quarterly',
                                           'Active Opportunity')),
    (
            SELECT
                    'Negative Leads Qualifications'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Marketing`
            WHERE
                    `fo_Qualification` IN ('Cold'            ,
                                           'Dead Opportunity',
                                           'Bad Fit'))       ,
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'OrgContentContext'),
    (
            SELECT
                    'Organization Content & Context'),
    (
            SELECT
                    'Org Contents'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `OrgContentContext`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `OrgContentContext`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `OrgContentContext`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `OrgContentContext`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No.of External Documents'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `OrgContentContext`
            WHERE
                    `fo_Type` IN ('Market Survey'      ,
                                  'Prospect Outlook'   ,
                                  'Industry Analysis')),
    (
            SELECT
                    'No. of Generated Records'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `OrgContentContext`
            WHERE
                    `fo_genrec` IN ('Internal Record')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'AccountPayables'),
    (
            SELECT
                    'Account Payables'),
    (
            SELECT
                    'Account Payables'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `AccountPayables`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `AccountPayables`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `AccountPayables`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `AccountPayables`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'Total LumpSum Price for this Week'),
    (
            SELECT
                    COALESCE(SUM(`fo_UnitPrice`), 0.00)
            FROM
                    `AccountPayables`
            WHERE
                    (
                            YEARWEEK(`ot_ap_filed`, 1)        = YEARWEEK(CURDATE(), 1)
                    OR      YEARWEEK(`ot_ap_lastmodified`, 1) = YEARWEEK(CURDATE(), 1))),
    (
            SELECT
                    'Total LumpSum Price for this Month'),
    (
            SELECT
                    COALESCE(SUM(`fo_UnitPrice`), 0.00)
            FROM
                    `AccountPayables`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ActCard'),
    (
            SELECT
                    'Act Card'),
    (
            SELECT
                    'Act Cards'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ActCard`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'No. of Positive Observations this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ActCard`
            WHERE
                    (
                            MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`fo_RequiredDate`)  = YEAR(CURRENT_DATE())
                    AND     `fo_Classification` IN ('Positive Observation'))),
    (
            SELECT
                    'No. of Unsafe Acts and Behaviors this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ActCard`
            WHERE
                    (
                            MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`fo_RequiredDate`)  = YEAR(CURRENT_DATE())
                    AND     `fo_Classification` IN ('Unsafe Act'        ,
                                                    'Unsafe Behavior'))),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Bi_WeeklyMeeting'),
    (
            SELECT
                    'Bi-Weekly Meeting'),
    (
            SELECT
                    'Meetings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Bi_WeeklyMeeting`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Bi_WeeklyMeeting`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Bi_WeeklyMeeting`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Bi_WeeklyMeeting`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Meetings this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Bi_WeeklyMeeting`
            WHERE
                    MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE())
            AND     YEAR(`fo_RequiredDate`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Breakdown'),
    (
            SELECT
                    'Breakdown & Fault Report'),
    (
            SELECT
                    'Reports'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Breakdown`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Breakdown`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Breakdown`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Breakdown`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Issues Opened this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Breakdown`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    'No. of Issues Closed this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Breakdown`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4
            AND     ((
                                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE()))
                    OR      (
                                    MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_lastmodified`)  = YEAR(CURRENT_DATE())))),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Campaign'),
    (
            SELECT
                    'Campaign'),
    (
            SELECT
                    'Campaigns'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Campaign`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Campaign`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Campaign`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Campaign`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Open Campaigns'),
    (
            SELECT
                    (
                            SELECT
                                    COUNT(1)
                            FROM
                                    `Campaign`) -
                    (
                            SELECT
                                    COUNT(1)
                            FROM
                                    `Campaign`
                            WHERE
                                    `ot_ap_Review`   = 4
                            AND     `ot_ap_Approval` = 4
                            AND     `ot_ap_QC`       = 4)),
    (
            SELECT
                    'No. of Closed Campaigns'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Campaign`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ClaimRecord'),
    (
            SELECT
                    'Claim Submission'),
    (
            SELECT
                    'Claims'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ClaimRecord`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ClaimRecord`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ClaimRecord`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ClaimRecord`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Claim Submissions this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ClaimRecord`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    'Total Lump Sum Amount this Month'),
    (
            SELECT
                    COALESCE(SUM(`fo_UnitPrice`), 0.00)
            FROM
                    `ClaimRecord`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Competency'),
    (
            SELECT
                    'Competency'),
    (
            SELECT
                    'Competencies'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Competency`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Competency`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Competency`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Competency`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal Reviews this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Competency`
            WHERE
                    (
                            MONTH(`fo_Date`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`fo_Date`)  = YEAR(CURRENT_DATE())
                    AND     `fo_CompetencySession` IN ('Internal Review'))),
    (
            SELECT
                    'No. of External Reviews this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Competency`
            WHERE
                    (
                            MONTH(`fo_Date`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`fo_Date`)  = YEAR(CURRENT_DATE())
                    AND     `fo_CompetencySession` IN ('External Review'))),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ContractDeployment'),
    (
            SELECT
                    'Project & Contract Deployment'),
    (
            SELECT
                    'Deployments'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContractDeployment`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContractDeployment`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContractDeployment`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContractDeployment`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Kick-off and Coordination Meetings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContractDeployment`
            WHERE
                    `fo_Type` IN ('Kick Off Meeting'      ,
                                  'Coordination Meeting')),
    (
            SELECT
                    'No. of Subcontractor Meetings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContractDeployment`
            WHERE
                    `fo_Type` IN ('Subcontractor Meeting')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'DailyProgressReport'),
    (
            SELECT
                    'Daily Progress Report'),
    (
            SELECT
                    'Reports'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DailyProgressReport`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DailyProgressReport`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DailyProgressReport`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DailyProgressReport`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Daily Logs this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DailyProgressReport`
            WHERE
                    (
                            MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())
                    AND     `fo_Class` IN ('Daily Log'))),
    (
            SELECT
                    'No. of Daily Checklists this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DailyProgressReport`
            WHERE
                    (
                            MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())
                    AND     `fo_Class` IN ('Daily Checklist'))),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'DCN'),
    (
            SELECT
                    'Document Change Notice'),
    (
            SELECT
                    'Change Notices'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DCN`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DCN`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DCN`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DCN`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Document Change Notices this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DCN`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'DeliveryOrder'),
    (
            SELECT
                    'Delivery Order'),
    (
            SELECT
                    'Delivery Orders'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DeliveryOrder`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DeliveryOrder`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DeliveryOrder`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DeliveryOrder`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Deliveries this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DeliveryOrder`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4
            AND     ((
                                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE()))
                    OR      (
                                    MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_lastmodified`)  = YEAR(CURRENT_DATE())))),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'DesignProposal'),
    (
            SELECT
                    'Service Design & Proposal'),
    (
            SELECT
                    'Proposals'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DesignProposal`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DesignProposal`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DesignProposal`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DesignProposal`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal Submissions'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DesignProposal`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())
            AND     `fo_RecSub` IN ('Internal Submission')),
    (
            SELECT
                    'No. of External Submissions'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DesignProposal`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())
            AND     `fo_RecSub` IN ('External Submission')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'DrillNInspection'),
    (
            SELECT
                    'Drill & Inspection'),
    (
            SELECT
                    'Drill Inspections'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DrillNInspection`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DrillNInspection`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DrillNInspection`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DrillNInspection`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Drills'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DrillNInspection`
            WHERE
                    `fo_Classification` IN ('Drill')),
    (
            SELECT
                    'No. of Inspections'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DrillNInspection`
            WHERE
                    `fo_Classification` IN ('Inspection')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'EventNotification'),
    (
            SELECT
                    'Event Notification'),
    (
            SELECT
                    'Notifications'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `EventNotification`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ManagementVisit'),
    (
            SELECT
                    'Management Visit'),
    (
            SELECT
                    'Visits'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagementVisit`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagementVisit`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagementVisit`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagementVisit`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal Visits'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagementVisit`
            WHERE
                    `fo_Classification` IN ('Internal Visit')),
    (
            SELECT
                    'No. of External Visits'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagementVisit`
            WHERE
                    `fo_Classification` IN ('External Visit')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ManagingVendor'),
    (
            SELECT
                    'Managing Vendor & Subcontractor'),
    (
            SELECT
                    'Managing Vendors'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagingVendor`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagingVendor`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagingVendor`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagingVendor`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Technical Inspections'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagingVendor`
            WHERE
                    `fo_Classification` IN ('Technical Audit'        ,
                                            'Inspection and Survey')),
    (
            SELECT
                    'No. of Commercial Inspections'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ManagingVendor`
            WHERE
                    `fo_Classification` IN ('IMS Audit'        ,
                                            'Procurement Audit',
                                            'Project Audit'))  ,
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MonthlyTimesheet'),
    (
            SELECT
                    'Monthly Timesheet'),
    (
            SELECT
                    'Timesheet'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MonthlyTimesheet`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MonthlyTimesheet`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MonthlyTimesheet`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MonthlyTimesheet`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Certificates of Completion'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MonthlyTimesheet`
            WHERE
                    `fo_Class` IN ('Certificate of Completion')),
    (
            SELECT
                    'No. of Manpower & Equipment'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MonthlyTimesheet`
            WHERE
                    `fo_Class` IN ('Manpower Timesheet'   ,
                                   'Equipment Timesheet')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MWConditionBased'),
    (
            SELECT
                    'Condition Based'),
    (
            SELECT
                    'Conditions'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWConditionBased`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWConditionBased`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWConditionBased`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWConditionBased`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Condition Based this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWConditionBased`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4
            AND     ((
                                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE()))
                    OR      (
                                    MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_lastmodified`)  = YEAR(CURRENT_DATE())))),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MWOCorrective'),
    (
            SELECT
                    'Corrective'),
    (
            SELECT
                    'Correctives'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOCorrective`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOCorrective`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOCorrective`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOCorrective`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Correctives this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOCorrective`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4
            AND     ((
                                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE()))
                    OR      (
                                    MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_lastmodified`)  = YEAR(CURRENT_DATE())))),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MWOPlanned'),
    (
            SELECT
                    'Planned Scheduled'),
    (
            SELECT
                    'Schedules'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOPlanned`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOPlanned`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOPlanned`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOPlanned`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Schedules this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOPlanned`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4
            AND     ((
                                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE()))
                    OR      (
                                    MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_lastmodified`)  = YEAR(CURRENT_DATE())))),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MWOpreventive'),
    (
            SELECT
                    'Preventive'),
    (
            SELECT
                    'Preventives'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOpreventive`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOpreventive`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOpreventive`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOpreventive`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Preventives this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOpreventive`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4
            AND     ((
                                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE()))
                    OR      (
                                    MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_lastmodified`)  = YEAR(CURRENT_DATE())))),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MWOproactive'),
    (
            SELECT
                    'Proactive'),
    (
            SELECT
                    'Proactives'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOproactive`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOproactive`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOproactive`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOproactive`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Proactives this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOproactive`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4
            AND     ((
                                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE()))
                    OR      (
                                    MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_lastmodified`)  = YEAR(CURRENT_DATE())))),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MWOReactive'),
    (
            SELECT
                    'Reactive'),
    (
            SELECT
                    'Reactives'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOReactive`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOReactive`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOReactive`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOReactive`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Reactives this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MWOReactive`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4
            AND     ((
                                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE()))
                    OR      (
                                    MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_lastmodified`)  = YEAR(CURRENT_DATE())))),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ObsoleteRec'),
    (
            SELECT
                    'Obsolete Record Register'),
    (
            SELECT
                    'Obsoletes'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ObsoleteRec`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ObsoleteRec`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ObsoleteRec`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ObsoleteRec`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Obsolete Record Registers this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ObsoleteRec`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4
            AND     ((
                                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE()))
                    OR      (
                                    MONTH(`ot_ap_lastmodified`) = MONTH(CURRENT_DATE())
                            AND     YEAR(`ot_ap_lastmodified`)  = YEAR(CURRENT_DATE())))),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'PersonnalFile'),
    (
            SELECT
                    'Personnal File'),
    (
            SELECT
                    'Files'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PersonnalFile`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'No. of Certificates'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PersonnalFile`
            WHERE
                    `fo_PersonalFileDesc` IN ('Certificate')),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'PurchaseOrder'),
    (
            SELECT
                    'Purchase Order'),
    (
            SELECT
                    'Purchase Orders'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PurchaseOrder`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PurchaseOrder`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PurchaseOrder`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PurchaseOrder`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'Price'),
    (
            SELECT
                    COALESCE(SUM(`fo_Price`), 0.00) - COALESCE(SUM(`fo_Discount`), 0.00)
            FROM
                    `PurchaseOrder`),
    (
            SELECT
                    'No. of Purchase Orders this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PurchaseOrder`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'QuarterlyMeeting'),
    (
            SELECT
                    'Quarterly Meeting'),
    (
            SELECT
                    'Meetings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QuarterlyMeeting`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QuarterlyMeeting`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QuarterlyMeeting`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QuarterlyMeeting`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Meetings this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QuarterlyMeeting`
            WHERE
                    MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE())
            AND     YEAR(`fo_RequiredDate`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Quotation'),
    (
            SELECT
                    'Quotations'),
    (
            SELECT
                    'Quotations'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Quotation`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Quotation`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Quotation`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Quotation`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'Price'),
    (
            SELECT
                    COALESCE(SUM(`fo_Price`), 0.00) - COALESCE(SUM(`fo_Discount`), 0.00)
            FROM
                    `Quotation`),
    (
            SELECT
                    'No. of Quotations this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Quotation`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Recruitment'),
    (
            SELECT
                    'Recruitment'),
    (
            SELECT
                    'Recruitments'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Recruitment`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'Total Interviews'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Recruitment`
            WHERE
                    `fo_RecruitmentSession` IN ('Phone Interview'             ,
                                                'Physical Interview Session')),
    (
            SELECT
                    'Total Desktop Review Sessions'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Recruitment`
            WHERE
                    `fo_RecruitmentSession` IN ('Desktop Review Session')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ReportComment'),
    (
            SELECT
                    'Report Comment'),
    (
            SELECT
                    'Comments'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ReportComment`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'No. of Report Comments this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ReportComment`
            WHERE
                    (
                            YEARWEEK(`filed`, 1)         = YEARWEEK(CURDATE(), 1)
                    OR      YEARWEEK(`last_modified`, 1) = YEARWEEK(CURDATE(), 1))),
    (
            SELECT
                    'No. of Report Comments this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ReportComment`
            WHERE
                    (
                            MONTH(`filed`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`filed`)  = YEAR(CURRENT_DATE()))
            OR      (
                            MONTH(`last_modified`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`last_modified`)  = YEAR(CURRENT_DATE()))),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'SoftboardComment'),
    (
            SELECT
                    'Softboard Comment'),
    (
            SELECT
                    'Comments'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `SoftboardComment`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'No. of Softboard Comments this Week'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `SoftboardComment`
            WHERE
                    (
                            YEARWEEK(`filed`, 1)         = YEARWEEK(CURDATE(), 1)
                    OR      YEARWEEK(`last_modified`, 1) = YEARWEEK(CURDATE(), 1))),
    (
            SELECT
                    'No. of Softboard Comments this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `SoftboardComment`
            WHERE
                    (
                            MONTH(`filed`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`filed`)  = YEAR(CURRENT_DATE()))
            OR      (
                            MONTH(`last_modified`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`last_modified`)  = YEAR(CURRENT_DATE()))),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ToolBoxMeeting'),
    (
            SELECT
                    'ToolBox Meeting'),
    (
            SELECT
                    'Meetings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ToolBoxMeeting`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ToolBoxMeeting`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ToolBoxMeeting`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ToolBoxMeeting`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Meetings this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ToolBoxMeeting`
            WHERE
                    MONTH(`fo_RequiredDate`) = MONTH(CURRENT_DATE())
            AND     YEAR(`fo_RequiredDate`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Training'),
    (
            SELECT
                    'Training'),
    (
            SELECT
                    'Trainings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Training`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Training`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Training`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Training`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal Trainings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Training`
            WHERE
                    (
                            MONTH(`fo_Date`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`fo_Date`)  = YEAR(CURRENT_DATE())
                    AND     `fo_TrainingSession` IN ('Internal Training'))),
    (
            SELECT
                    'No. of External Trainings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Training`
            WHERE
                    (
                            MONTH(`fo_Date`) = MONTH(CURRENT_DATE())
                    AND     YEAR(`fo_Date`)  = YEAR(CURRENT_DATE())
                    AND     `fo_TrainingSession` IN ('External Training'))),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'VenPerformance'),
    (
            SELECT
                    'Vendor Performance and Evaluation'),
    (
            SELECT
                    'Vendor Performances'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `VenPerformance`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `VenPerformance`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `VenPerformance`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `VenPerformance`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Above Average Performances'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `VenPerformance`
            WHERE
                    `fo_Classification` IN ('Above Average')),
    (
            SELECT
                    'No. of Below Average Performances'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `VenPerformance`
            WHERE
                    `fo_Classification` IN ('Below Average')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'WorkPermit'),
    (
            SELECT
                    'Work Permit'),
    (
            SELECT
                    'Work Permits'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkPermit`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkPermit`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkPermit`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkPermit`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of High Risk Work Permits'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkPermit`
            WHERE
                    `fo_Type` IN ('Hot Work Permit'        ,
                                  'Working At Height'      ,
                                  'Chemical Handling'      ,
                                  'Confined Space'         ,
                                  'High Voltage'           ,
                                  'Rigging and Scaffolding',
                                  'High Pressure'))        ,
    (
            SELECT
                    'No. of Medium Risk Work Permits'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkPermit`
            WHERE
                    `fo_Type` IN ('Cold Work Permit')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'PROCompletion'),
    (
            SELECT
                    'Project Completion'),
    (
            SELECT
                    'Project Completions'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROCompletion`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROCompletion`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROCompletion`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROCompletion`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Project Deliverables Records'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROCompletion`
            WHERE
                    `fo_Classification` IN ('End of Trip Report'           ,
                                            'Project Completion Report'    ,
                                            'Project Deliverables Report')),
    (
            SELECT
                    'Project Deliverables Records'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROCompletion`
            WHERE
                    `fo_Classification` IN ('Lesson Learnt'             ,
                                            'Project Feedback Meeting')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'PROControlMonitoring'),
    (
            SELECT
                    'Project Control And Monitoring'),
    (
            SELECT
                    'Project Monitorings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROControlMonitoring`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROControlMonitoring`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROControlMonitoring`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROControlMonitoring`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Inspections'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROControlMonitoring`
            WHERE
                    `fo_AuditInspection` IN ('Inspection')),
    (
            SELECT
                    'No. of Trackings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROControlMonitoring`
            WHERE
                    `fo_Classification` IN ('Performance Tracking',
                                            'Schedule Tracking'   ,
                                            'Cost Tracking'))     ,
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'PROExecution'),
    (
            SELECT
                    'Project Execution'),
    (
            SELECT
                    'Project Executions'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROExecution`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROExecution`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROExecution`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROExecution`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Subcontractor Documents & Reports'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROExecution`
            WHERE
                    `fo_Classification` IN ('Subcontractor Report')),
    (
            SELECT
                    'No. of Client Documents & Reports'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROExecution`
            WHERE
                    `fo_Classification` IN ('Client Instruction')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'PROInitiation'),
    (
            SELECT
                    'Project Initiation'),
    (
            SELECT
                    'Project Initiations'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROInitiation`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROInitiation`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROInitiation`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROInitiation`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Kick-Offs'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROInitiation`
            WHERE
                    `fo_InitiationForm` IN ('Project Kick Off Meeting')),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'projects'),
    (
            SELECT
                    'Project Register'),
    (
            SELECT
                    'Projects'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `projects`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `projects`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `projects`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `projects`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Main Contractors'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `projects`
            WHERE
                    `fo_ProjectIndication` = 'Main Contractor'),
    (
            SELECT
                    'No. of Subcontractors'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `projects`
            WHERE
                    `fo_ProjectIndication` = 'Sub-Contractor'),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ProjectTeam'),
    (
            SELECT
                    'Project Team Matrix'),
    (
            SELECT
                    'Project Teams'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ProjectTeam`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ProjectTeam`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ProjectTeam`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ProjectTeam`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Permanent Staff'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ProjectTeam`
            WHERE
                    `fo_TermEmployment` = 'Permanent'
            AND     (
                            `fo_OffHireDate` IS NULL
                    OR      `fo_OffHireDate`       > CURRENT_DATE)),
    (
            SELECT
                    'No. of Contract Staff'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ProjectTeam`
            WHERE
                    `fo_TermEmployment` = 'Contract'
            AND     (
                            `fo_OffHireDate` IS NULL
                    OR      `fo_OffHireDate`       > CURRENT_DATE)),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'PROPlanning'),
    (
            SELECT
                    'Project Planning'),
    (
            SELECT
                    'Project Plannings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROPlanning`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROPlanning`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROPlanning`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROPlanning`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Project Management Plans'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROPlanning`
            WHERE
                    `fo_RelatedDocument` IN ('Project Management Plan')),
    (
            SELECT
                    'No. of Project Assurance Launch Matrix and Profit & Loss'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROPlanning`
            WHERE
                    `fo_RelatedDocument` IN ('Project Assurance Launch Matrix',
                                             'Planned Profit & Loss'))        ,
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'PROVariation'),
    (
            SELECT
                    'Project Variation Order'),
    (
            SELECT
                    'Project Variation Orders'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROVariation`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROVariation`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROVariation`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROVariation`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Service Variations'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROVariation`
            WHERE
                    `fo_Classification` IN ('Service Variation')),
    (
            SELECT
                    'No. of Equipment & Manpower Variations'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `PROVariation`
            WHERE
                    `fo_Classification` IN ('Equipment Variation' ,
                                            'Manpower Variation')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Receivables'),
    (
            SELECT
                    'Project Receivables'),
    (
            SELECT
                    'Receivables'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Receivables`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Receivables`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Receivables`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Receivables`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Claims'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Receivables`
            WHERE
                    `fo_Classification` IN ('Claim')),
    (
            SELECT
                    'No. of Debit& Credit Notes'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Receivables`
            WHERE
                    `fo_Classification` IN ('Credit Note' ,
                                            'Debit Note')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'resources'),
    (
            SELECT
                    'Resources & Equipment'),
    (
            SELECT
                    'Resources'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `resources`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'No. of Availables'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `resources`
            WHERE
                    `fo_Available` = 1),
    (
            SELECT
                    'No. of Tools, Machinery, Vehicles, Facilities'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `resources`
            WHERE
                    `fo_Type` IN ('TOOLS'     ,
                                  'MACHINERY' ,
                                  'VEHICLE'   ,
                                  'FACILITY')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'WorkLocation'),
    (
            SELECT
                    'Work Site Location'),
    (
            SELECT
                    'Locations'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkLocation`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkLocation`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkLocation`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkLocation`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Sections'),
    (
            SELECT
                    COUNT(DISTINCT `fo_Type`)
            FROM
                    `WorkLocation`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Audit'),
    (
            SELECT
                    'Management System Audit'),
    (
            SELECT
                    'Audits'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Audit`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Audit`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Audit`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Audit`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal Auditors'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Audit`
            WHERE
                    `fo_Auditor` IN ('Internal Auditor')),
    (
            SELECT
                    'No. of External Auditors'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Audit`
            WHERE
                    `fo_Auditor` IN ('External Auditor')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'CommConsParticipate'),
    (
            SELECT
                    'Communication, Consultation & Participation'),
    (
            SELECT
                    'Communications'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CommConsParticipate`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CommConsParticipate`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CommConsParticipate`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CommConsParticipate`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Total Completed'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `CommConsParticipate`
            WHERE
                    `ot_ap_Review`   = 4
            AND     `ot_ap_Approval` = 4
            AND     `ot_ap_QC`       = 4),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ContinualImprovement'),
    (
            SELECT
                    'CAPAR'),
    (
            SELECT
                    'CAPAR'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContinualImprovement`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContinualImprovement`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContinualImprovement`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContinualImprovement`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal CAPAR'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContinualImprovement`
            WHERE
                    `fo_Class` IN ('Internal')),
    (
            SELECT
                    'No. of External CAPAR'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ContinualImprovement`
            WHERE
                    `fo_Class` IN ('External')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'DocControl'),
    (
            SELECT
                    'Document & Record Control'),
    (
            SELECT
                    'Controls'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DocControl`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DocControl`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DocControl`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DocControl`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Procedures'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DocControl`
            WHERE
                    `fo_DocumentType` IN ('Procedure')),
    (
            SELECT
                    'No. of Forms'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `DocControl`
            WHERE
                    `fo_DocumentType` IN ('Forms')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ERP'),
    (
            SELECT
                    'Emergency Preparedness & Response'),
    (
            SELECT
                    'ERP Items'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ERP`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ERP`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ERP`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ERP`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Emergency Responses'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ERP`
            WHERE
                    `fo_Classification` IN ('Emergency Response')),
    (
            SELECT
                    'No. of Contingency Responses'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ERP`
            WHERE
                    `fo_Classification` IN ('Contingency Response')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'IMSDataAnalysis'),
    (
            SELECT
                    'Continual Improvement Plan'),
    (
            SELECT
                    'Continual Improvement Plan'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMSDataAnalysis`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMSDataAnalysis`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMSDataAnalysis`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMSDataAnalysis`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Organization Improvements'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMSDataAnalysis`
            WHERE
                    `fo_Classification` IN ('Organization Improvement')),
    (
            SELECT
                    'No. of Project Improvements'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMSDataAnalysis`
            WHERE
                    `fo_Classification` IN ('Project Improvement')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'IMStrackingNmonitoring'),
    (
            SELECT
                    'IMS Data Tracking & Monitoring'),
    (
            SELECT
                    'IMS Monitorings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMStrackingNmonitoring`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMStrackingNmonitoring`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMStrackingNmonitoring`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMStrackingNmonitoring`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal Monitorings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMStrackingNmonitoring`
            WHERE
                    `fo_Classification` IN ('Internal Monitoring')),
    (
            SELECT
                    'No. of External Monitorings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMStrackingNmonitoring`
            WHERE
                    `fo_Classification` IN ('External Monitoring')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'IncidentReporting'),
    (
            SELECT
                    'Incident & Accident Reporting'),
    (
            SELECT
                    'Incidents'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IncidentReporting`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IncidentReporting`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IncidentReporting`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IncidentReporting`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Incident Reports'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IncidentReporting`
            WHERE
                    `fo_Classification` IN ('Incident Report')),
    (
            SELECT
                    'No. of Accident Reports'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IncidentReporting`
            WHERE
                    `fo_Classification` IN ('Accident Report')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'KM'),
    (
            SELECT
                    'Organizational Knowledge'),
    (
            SELECT
                    'Org Knowledge'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `KM`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `KM`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `KM`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `KM`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal References'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `KM`
            WHERE
                    `fo_Reference` IN ('Internal Reference')),
    (
            SELECT
                    'No. of External References'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `KM`
            WHERE
                    `fo_Reference` IN ('External Reference')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'LegalRegister'),
    (
            SELECT
                    'Legal Register'),
    (
            SELECT
                    'Legal Registers'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LegalRegister`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LegalRegister`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LegalRegister`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LegalRegister`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Legals'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LegalRegister`
            WHERE
                    `fo_Classification` IN ('Legal')),
    (
            SELECT
                    'No. of Standards'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `LegalRegister`
            WHERE
                    `fo_Classification` IN ('Standards')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MgtofChange'),
    (
            SELECT
                    'Management Of Change'),
    (
            SELECT
                    'Changes'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MgtofChange`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MgtofChange`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MgtofChange`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MgtofChange`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Processes'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MgtofChange`
            WHERE
                    `fo_Class` IN ('Process')),
    (
            SELECT
                    'No. of Procedures and Forms'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MgtofChange`
            WHERE
                    `fo_Class` IN ('Procedure',
                                   'Forms'))  ,
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'MRM'),
    (
            SELECT
                    'Management Review Meeting'),
    (
            SELECT
                    'Meetings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MRM`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MRM`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MRM`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MRM`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal Meetings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MRM`
            WHERE
                    `fo_Classification` IN ('Internal Meeting')),
    (
            SELECT
                    'No. of External Meetings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `MRM`
            WHERE
                    `fo_Classification` IN ('External Meeting')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'NonConformance'),
    (
            SELECT
                    'IMS Non Conformance'),
    (
            SELECT
                    'Non Conformances'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `NonConformance`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `NonConformance`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `NonConformance`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `NonConformance`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Minor Non Conformances'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `NonConformance`
            WHERE
                    `fo_Classification` IN ('Minor Non Conformance')),
    (
            SELECT
                    'No. of Major Non Conformances'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `NonConformance`
            WHERE
                    `fo_Classification` IN ('Major Non Conformance')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'QA'),
    (
            SELECT
                    'IMS Planning & Assurance'),
    (
            SELECT
                    'IMS Plannings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QA`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QA`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QA`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QA`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal Uses'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QA`
            WHERE
                    `fo_Class` IN ('Internal use')),
    (
            SELECT
                    'No. of External Uses'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `QA`
            WHERE
                    `fo_Class` IN ('External use')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'RiskandOpportunity'),
    (
            SELECT
                    'Risks Management'),
    (
            SELECT
                    'Risk Managements'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `RiskandOpportunity`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `RiskandOpportunity`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `RiskandOpportunity`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `RiskandOpportunity`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Quality, Health, Safety and Environment'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `RiskandOpportunity`
            WHERE
                    `fo_Class` IN ('Quality'      ,
                                   'Health'       ,
                                   'Safety'       ,
                                   'Environment')),
    (
            SELECT
                    'No. of Technical and Organization'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `RiskandOpportunity`
            WHERE
                    `fo_Class` IN ('Technical'     ,
                                   'Organization')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'ScheduleWaste'),
    (
            SELECT
                    'Schedule Waste Disposal Register'),
    (
            SELECT
                    'Waste Disposals'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ScheduleWaste`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ScheduleWaste`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ScheduleWaste`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ScheduleWaste`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Non-Hazardous Wastes'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ScheduleWaste`
            WHERE
                    `fo_Classification` IN ('Solid Waste'    ,
                                            'Liquid Waste'   ,
                                            'General Waste')),
    (
            SELECT
                    'No. of Hazardous Wastes'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `ScheduleWaste`
            WHERE
                    `fo_Classification` IN ('Hazardous Solid Waste'   ,
                                            'Hazardous Liquid Waste')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'StakeholderSatisfaction'),
    (
            SELECT
                    'Stakeholder Satisfaction Survey'),
    (
            SELECT
                    'Satisfaction Surveys'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `StakeholderSatisfaction`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `StakeholderSatisfaction`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `StakeholderSatisfaction`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `StakeholderSatisfaction`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Surveys this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `StakeholderSatisfaction`
            WHERE
                    MONTH(`fo_Regdate`) = MONTH(CURRENT_DATE())
            AND     YEAR(`fo_Regdate`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'WorkEnvMonitoring'),
    (
            SELECT
                    'Work Environment Monitoring and Control'),
    (
            SELECT
                    'Work Env Monitorings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkEnvMonitoring`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkEnvMonitoring`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkEnvMonitoring`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkEnvMonitoring`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Internal Monitorings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkEnvMonitoring`
            WHERE
                    `fo_Classification` IN ('Internal Monitoring')),
    (
            SELECT
                    'No. of External Monitorings'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `WorkEnvMonitoring`
            WHERE
                    `fo_Classification` IN ('External Monitoring')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'batches'),
    (
            SELECT
                    'Batches'),
    (
            SELECT
                    'Batches'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `batches`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'categories'),
    (
            SELECT
                    'Item Categories'),
    (
            SELECT
                    'Item Categories'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `categories`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'Item'),
    (
            SELECT
                    'Resources Inventory'),
    (
            SELECT
                    'Resources Inventory'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `Item`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'Total Value this Month'),
    (
            SELECT
                    COALESCE(SUM(`fo_UnitPrice`), 0.00)
            FROM
                    `Item`
            WHERE
                    MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`ot_ap_filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'orders'),
    (
            SELECT
                    'Request & Service Order'),
    (
            SELECT
                    'Request & Service Orders'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `orders`),
    (
            SELECT
                    COUNT(1)
            FROM
                    `orders`
            WHERE
                    `ot_ap_Review` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `orders`
            WHERE
                    `ot_ap_Approval` = 4),
    (
            SELECT
                    COUNT(1)
            FROM
                    `orders`
            WHERE
                    `ot_ap_QC` = 4),
    (
            SELECT
                    'No. of Physical Requests'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `orders`
            WHERE
                    `fo_Classification` IN ('System'       ,
                                            'Equipment'    ,
                                            'Assembly'     ,
                                            'Component'    ,
                                            'Parts'        ,
                                            'Consumables')),
    (
            SELECT
                    'No. of Services Requests'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `orders`
            WHERE
                    `fo_Classification` IN ('Services')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'transactions'),
    (
            SELECT
                    'Transfer Item'),
    (
            SELECT
                    'Transfer Item'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `transactions`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'No. of Incoming and Outgoing'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `transactions`
            WHERE
                    `fo_transactiontype` IN ('Incoming'  ,
                                             'Outgoing')),
    (
            SELECT
                    'No. of Expired and Damaged'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `transactions`
            WHERE
                    `fo_transactiontype` IN ('Expired'  ,
                                             'Damaged')),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'IMSReport'),
    (
            SELECT
                    'IMS Complaint Report'),
    (
            SELECT
                    'IMS Reports'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMSReport`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'No. of Complaint Reports this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `IMSReport`
            WHERE
                    MONTH(`filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    )
    ,
    (
    (
            SELECT
                    CURRENT_DATE
    )
    ,
    (
            SELECT
                    'TeamSoftBoard'),
    (
            SELECT
                    'Organization Softboard'),
    (
            SELECT
                    'Org Softboard Items'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `TeamSoftBoard`),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    'No. of Softboards this Month'),
    (
            SELECT
                    COUNT(1)
            FROM
                    `TeamSoftBoard`
            WHERE
                    MONTH(`filed`) = MONTH(CURRENT_DATE())
            AND     YEAR(`filed`)  = YEAR(CURRENT_DATE())),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL),
    (
            SELECT
                    NULL)
    );";
    sql($dashboardSQL, $o);

    $_page_time_seconds = microtime(1) - $_script_started;
    echo 'Summary dashboard metrics succcessfully populated for current day (time taken: '. $_page_time_seconds . ' seconds).';
?>

 


