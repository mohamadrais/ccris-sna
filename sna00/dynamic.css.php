<?php header('Content-type: text/css'); ?>

@media (min-width: 768px){ .container{ width: 90% !important; } }
@media (max-width: 767px){ .detail_view{ padding: 0; } }
@media print{
	a[href]:after{ content: "" !important; }
	.container{ width: 98% !important; }
}

.rtl{ direction: rtl !important; }
.ltr{ direction: ltr !important; }

.navbar-brand{ text-transform: capitalize; }

table a, .table a { text-decoration: none !important; }

#children-tabs li a{ display: block !important; }

.hidden{ visibility: hidden !important; }

iframe{ border: none; overflow: auto; }

.tab-content{ padding: 10px 20px; border: 1px solid #DDDDDD; border-top: none; }

#pc-loading{ background: none repeat scroll 0 0 yellow; font-family: arial; left: 10px; margin-top: -10px; opacity: 0.85; position: absolute; top: 20px; width: 150px; }

.navbar a.btn { margin-left: 10px; margin-right: 10px; }

.view-on-click a.btn { max-width: 75px; }

/* prevent prototype conflicts */
li.dropdown{ display: block !important; }

.hspacer-xs{ margin-left: 0.1em; margin-right: 0.1em; }
.hspacer-sm{ margin-left: 0.2em; margin-right: 0.2em; }
.hspacer-md{ margin-left: 0.4em; margin-right: 0.4em; }
.hspacer-lg{ margin-left: 0.8em; margin-right: 0.8em; }
.vspacer-xs{ margin-top: 0.1em; margin-bottom: 0.1em; }
.vspacer-sm{ margin-top: 0.2em; margin-bottom: 0.2em; }
.vspacer-md{ margin-top: 0.4em; margin-bottom: 0.4em; }
.vspacer-lg{ margin-top: 0.8em; margin-bottom: 0.8em; }

div.datePicker{ font-size: 1.3em; }
.always_shown{ display: inline !important; }
.text-bold{ font-weight: bold; }
.text-italic{ font-style: italic; }

/* .form-control, .help-block .alert{ width: 90% !important; } */
.input-group .form-control{ width: 100% !important; }
.form-inline .form-control{ width: auto !important; }
.panel .btn{ overflow: hidden; }

.select2-container .select2-choice{ height: 2.4em; line-height: 2.2em; }
.select2-container .select2-choice .select2-arrow b{ background-position: 0 -0.1em; }

.navbar ul.dropdown-menu{ max-height: 400px; overflow-y: auto; }

.date_combo { padding-right: 0.5em; }
/* .date_combo select { width: 100% !important; padding-left: 0; padding-right: 0; } */

img[src="blank.gif"] { max-height: 10px !important; }

/* fix for scrolling wide tables horizontally on iOS, https://stackoverflow.com/a/39073181/1945185 */
.table-responsive .table {
	max-width: none;
	-webkit-overflow-scrolling: touch !important;
}

.OrgContentContext-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Marketing-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Client-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Inquiry-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.DesignProposal-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ContractDeployment-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.employees-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Recruitment-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.PersonnalFile-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Competency-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Training-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.JD_JS-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.InOutRegister-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.vendor-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ManagingVendor-fo_mobile{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ManagingVendor-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.VenPerformance-fo_mobile{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.VenPerformance-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Logistics-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Inventory-fo_ItemLocation{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Inventory-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.CalibrationCtrl-fo_CalCom{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.CalibrationCtrl-fo_DurCal{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.CalibrationCtrl-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.WorkOrder-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MWO-MWONumber{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MWO-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MWOPlanned-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MWOpreventive-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MWOproactive-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MWConditionBased-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MWOReactive-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MWOCorrective-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.LogisticRequest-LogisticNumber{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.LogisticRequest-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.orders-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Quotation-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.PurchaseOrder-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.DeliveryOrder-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.AccountPayables-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Item-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.categories-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.batches-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.transactions-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.CommConsParticipate-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ToolBoxMeeting-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Bi_WeeklyMeeting-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.QuarterlyMeeting-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Campaign-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.DrillNInspection-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ManagementVisit-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.EventNotification-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ActCard-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.KM-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.LegalRegister-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.RiskandOpportunity-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.DocControl-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.DCN-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ObsoleteRec-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.QA-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ERP-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.WorkEnvMonitoring-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ScheduleWaste-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.IncidentReporting-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MgtofChange-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.IMStrackingNmonitoring-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.IMSDataAnalysis-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Audit-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.NonConformance-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ContinualImprovement-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.StakeholderSatisfaction-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MRM-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.projects-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.WorkLocation-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.WorkPermit-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ProjectTeam-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.resources-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.PROInitiation-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.PROPlanning-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.PROExecution-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.DailyProgressReport-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.MonthlyTimesheet-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Breakdown-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.PROControlMonitoring-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.PROVariation-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.PROCompletion-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.Receivables-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }
.ClaimRecord-ot_FileLoc{ white-space: normal !important; max-width: 100px !important; min-width: 100px !important; overflow: hidden;  }

/* fixes for glyph icons in some themes */
.glyphicon-camera:before { content: "\e046"; }
.glyphicon-lock:before { content: "\e033"; }
.glyphicon-eur:before { content: "\20ac"; }
.glyphicon-calendar:before { content: "\e109"; }
.glyphicon-bell:before { content: "\e123"; }
.glyphicon-wrench:before { content: "\e136"; }
.glyphicon-briefcase:before { content: "\e139"; }

.navbar-right {
	margin-right: 0 !important;
}

.no-caption .field-caption-tv{  display: none; }
.no-caption dd{ margin-left: 0; margin-right: 0; }

.nav-tabs a img{ margin: 0 0.25em; }

/* rotation classes */
.rotate90{ -ms-transform: rotate(90deg); -webkit-transform: rotate(90deg); transform: rotate(90deg); }
.rotate180{ -ms-transform: rotate(180deg); -webkit-transform: rotate(180deg); transform: rotate(180deg); }
.rotate270{ -ms-transform: rotate(270deg); -webkit-transform: rotate(270deg); transform: rotate(270deg); }

/* compacting mobile borders for DV */
.detail_view .form-group hr { margin: 0 0 0.5em 0; border-top-style: dashed; }

/* tv tools button widths */
.tv-tools .btn { width: 5em; }

/* compact theme styles */
.container.theme-compact{ font-size: 0.857em; }

.theme-compact .btn {
	font-size: 12px;
	padding: 4px 10px;
}

.theme-compact .btn-lg, .theme-compact .btn-group-lg > .btn {
	font-size: 15px;
	padding: 6px 15px;
}

.theme-compact .form-group {
	margin-bottom: 8px;
}

.theme-compact .form-control {
	font-size: 12px;
	height: auto;
	padding: 4px 6px;
}

.theme-compact .input-sm {
	border-radius: 3px;
	font-size: 12px;
	padding: 2px 6px;
}

.theme-compact select.input-sm {
	height: 25px;
	line-height: 25px;
}

.theme-compact .dropdown-menu {
	font-size: 12px;
}

.theme-compact .table > thead > tr > th, .theme-compact .table > tbody > tr > th, .theme-compact .table > tfoot > tr > th, .theme-compact .table > thead > tr > td, .theme-compact .table > tbody > tr > td, .theme-compact .table > tfoot > tr > td {
	padding: 4px;
}

.theme-compact h1, .theme-compact h2, .theme-compact h3, .theme-compact h4, .theme-compact h5, .theme-compact h6, .theme-compact .h1, .theme-compact .h2, .theme-compact .h3, .theme-compact .h4, .theme-compact .h5, .theme-compact .h6 {
	line-height: 2;
}

.theme-compact h1, .theme-compact .h1 {
	font-size: 27px;
}

.theme-compact h2, .theme-compact .h2 {
	font-size: 24px;
}

.theme-compact h3, .theme-compact .h3 {
	font-size: 20px;
}

.theme-compact h4, .theme-compact .h4 {
	font-size: 16px;
}

.theme-compact .navbar {
	margin-bottom: 13px;
	min-height: 40px;
}

.theme-compact .navbar-fixed-bottom {
	margin-bottom: 0 !important;
}

.theme-compact .navbar-brand {
	font-size: 15px;
	height: 40px;
	padding: 12px;
}

.theme-compact .navbar-nav > li > a {
	padding-bottom: 9px;
	padding-top: 9px;
	line-height: 26px;
}

.theme-compact .navbar-text {
	margin-bottom: 12px;
	margin-top: 14px;
}

.theme-compact .page-header {
	margin: 20px 0 10px;
	padding-bottom: 0;
}

.theme-compact .navbar-nav > li > a { margin-top: 0; margin-bottom: 0; }

.theme-compact .panel-heading {
	padding: 6px;
}

.theme-compact .panel-title {
	font-size: 14px;
}

