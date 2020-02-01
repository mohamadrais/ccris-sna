var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// OrgContentContext table
OrgContentContext_addTip=["",spacer+"This option allows all members of the group to add records to the 'Organization Content & Context' table. A member who adds a record to the table becomes the 'owner' of that record."];

OrgContentContext_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Organization Content & Context' table."];
OrgContentContext_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Organization Content & Context' table."];
OrgContentContext_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Organization Content & Context' table."];
OrgContentContext_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Organization Content & Context' table."];

OrgContentContext_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Organization Content & Context' table."];
OrgContentContext_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Organization Content & Context' table."];
OrgContentContext_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Organization Content & Context' table."];
OrgContentContext_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Organization Content & Context' table, regardless of their owner."];

OrgContentContext_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Organization Content & Context' table."];
OrgContentContext_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Organization Content & Context' table."];
OrgContentContext_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Organization Content & Context' table."];
OrgContentContext_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Organization Content & Context' table."];

// Marketing table
Marketing_addTip=["",spacer+"This option allows all members of the group to add records to the 'Marketing & Lead Generation' table. A member who adds a record to the table becomes the 'owner' of that record."];

Marketing_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Marketing & Lead Generation' table."];
Marketing_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Marketing & Lead Generation' table."];
Marketing_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Marketing & Lead Generation' table."];
Marketing_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Marketing & Lead Generation' table."];

Marketing_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Marketing & Lead Generation' table."];
Marketing_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Marketing & Lead Generation' table."];
Marketing_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Marketing & Lead Generation' table."];
Marketing_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Marketing & Lead Generation' table, regardless of their owner."];

Marketing_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Marketing & Lead Generation' table."];
Marketing_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Marketing & Lead Generation' table."];
Marketing_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Marketing & Lead Generation' table."];
Marketing_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Marketing & Lead Generation' table."];

// Client table
Client_addTip=["",spacer+"This option allows all members of the group to add records to the 'Client & Main Contractor' table. A member who adds a record to the table becomes the 'owner' of that record."];

Client_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Client & Main Contractor' table."];
Client_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Client & Main Contractor' table."];
Client_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Client & Main Contractor' table."];
Client_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Client & Main Contractor' table."];

Client_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Client & Main Contractor' table."];
Client_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Client & Main Contractor' table."];
Client_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Client & Main Contractor' table."];
Client_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Client & Main Contractor' table, regardless of their owner."];

Client_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Client & Main Contractor' table."];
Client_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Client & Main Contractor' table."];
Client_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Client & Main Contractor' table."];
Client_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Client & Main Contractor' table."];

// Inquiry table
Inquiry_addTip=["",spacer+"This option allows all members of the group to add records to the 'Inquiry & Tender' table. A member who adds a record to the table becomes the 'owner' of that record."];

Inquiry_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Inquiry & Tender' table."];
Inquiry_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Inquiry & Tender' table."];
Inquiry_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Inquiry & Tender' table."];
Inquiry_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Inquiry & Tender' table."];

Inquiry_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Inquiry & Tender' table."];
Inquiry_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Inquiry & Tender' table."];
Inquiry_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Inquiry & Tender' table."];
Inquiry_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Inquiry & Tender' table, regardless of their owner."];

Inquiry_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Inquiry & Tender' table."];
Inquiry_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Inquiry & Tender' table."];
Inquiry_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Inquiry & Tender' table."];
Inquiry_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Inquiry & Tender' table."];

// DesignProposal table
DesignProposal_addTip=["",spacer+"This option allows all members of the group to add records to the 'Service Design & Proposal' table. A member who adds a record to the table becomes the 'owner' of that record."];

DesignProposal_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Service Design & Proposal' table."];
DesignProposal_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Service Design & Proposal' table."];
DesignProposal_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Service Design & Proposal' table."];
DesignProposal_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Service Design & Proposal' table."];

DesignProposal_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Service Design & Proposal' table."];
DesignProposal_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Service Design & Proposal' table."];
DesignProposal_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Service Design & Proposal' table."];
DesignProposal_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Service Design & Proposal' table, regardless of their owner."];

DesignProposal_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Service Design & Proposal' table."];
DesignProposal_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Service Design & Proposal' table."];
DesignProposal_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Service Design & Proposal' table."];
DesignProposal_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Service Design & Proposal' table."];

// ContractDeployment table
ContractDeployment_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project & Contract Deployment' table. A member who adds a record to the table becomes the 'owner' of that record."];

ContractDeployment_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project & Contract Deployment' table."];
ContractDeployment_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project & Contract Deployment' table."];
ContractDeployment_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project & Contract Deployment' table."];
ContractDeployment_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project & Contract Deployment' table."];

ContractDeployment_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project & Contract Deployment' table."];
ContractDeployment_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project & Contract Deployment' table."];
ContractDeployment_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project & Contract Deployment' table."];
ContractDeployment_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project & Contract Deployment' table, regardless of their owner."];

ContractDeployment_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project & Contract Deployment' table."];
ContractDeployment_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project & Contract Deployment' table."];
ContractDeployment_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project & Contract Deployment' table."];
ContractDeployment_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project & Contract Deployment' table."];

// employees table
employees_addTip=["",spacer+"This option allows all members of the group to add records to the 'Human Resources Matrix' table. A member who adds a record to the table becomes the 'owner' of that record."];

employees_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Human Resources Matrix' table."];
employees_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Human Resources Matrix' table."];
employees_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Human Resources Matrix' table."];
employees_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Human Resources Matrix' table."];

employees_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Human Resources Matrix' table."];
employees_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Human Resources Matrix' table."];
employees_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Human Resources Matrix' table."];
employees_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Human Resources Matrix' table, regardless of their owner."];

employees_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Human Resources Matrix' table."];
employees_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Human Resources Matrix' table."];
employees_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Human Resources Matrix' table."];
employees_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Human Resources Matrix' table."];

// Recruitment table
Recruitment_addTip=["",spacer+"This option allows all members of the group to add records to the 'Recruitment' table. A member who adds a record to the table becomes the 'owner' of that record."];

Recruitment_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Recruitment' table."];
Recruitment_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Recruitment' table."];
Recruitment_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Recruitment' table."];
Recruitment_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Recruitment' table."];

Recruitment_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Recruitment' table."];
Recruitment_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Recruitment' table."];
Recruitment_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Recruitment' table."];
Recruitment_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Recruitment' table, regardless of their owner."];

Recruitment_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Recruitment' table."];
Recruitment_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Recruitment' table."];
Recruitment_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Recruitment' table."];
Recruitment_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Recruitment' table."];

// PersonnalFile table
PersonnalFile_addTip=["",spacer+"This option allows all members of the group to add records to the 'Personal File' table. A member who adds a record to the table becomes the 'owner' of that record."];

PersonnalFile_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Personal File' table."];
PersonnalFile_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Personal File' table."];
PersonnalFile_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Personal File' table."];
PersonnalFile_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Personal File' table."];

PersonnalFile_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Personal File' table."];
PersonnalFile_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Personal File' table."];
PersonnalFile_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Personal File' table."];
PersonnalFile_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Personal File' table, regardless of their owner."];

PersonnalFile_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Personal File' table."];
PersonnalFile_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Personal File' table."];
PersonnalFile_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Personal File' table."];
PersonnalFile_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Personal File' table."];

// Competency table
Competency_addTip=["",spacer+"This option allows all members of the group to add records to the 'Competency' table. A member who adds a record to the table becomes the 'owner' of that record."];

Competency_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Competency' table."];
Competency_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Competency' table."];
Competency_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Competency' table."];
Competency_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Competency' table."];

Competency_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Competency' table."];
Competency_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Competency' table."];
Competency_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Competency' table."];
Competency_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Competency' table, regardless of their owner."];

Competency_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Competency' table."];
Competency_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Competency' table."];
Competency_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Competency' table."];
Competency_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Competency' table."];

// Training table
Training_addTip=["",spacer+"This option allows all members of the group to add records to the 'Training' table. A member who adds a record to the table becomes the 'owner' of that record."];

Training_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Training' table."];
Training_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Training' table."];
Training_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Training' table."];
Training_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Training' table."];

Training_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Training' table."];
Training_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Training' table."];
Training_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Training' table."];
Training_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Training' table, regardless of their owner."];

Training_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Training' table."];
Training_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Training' table."];
Training_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Training' table."];
Training_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Training' table."];

// JD_JS table
JD_JS_addTip=["",spacer+"This option allows all members of the group to add records to the 'Job Description & Specification Register' table. A member who adds a record to the table becomes the 'owner' of that record."];

JD_JS_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Job Description & Specification Register' table."];
JD_JS_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Job Description & Specification Register' table."];
JD_JS_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Job Description & Specification Register' table."];
JD_JS_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Job Description & Specification Register' table."];

JD_JS_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Job Description & Specification Register' table."];
JD_JS_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Job Description & Specification Register' table."];
JD_JS_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Job Description & Specification Register' table."];
JD_JS_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Job Description & Specification Register' table, regardless of their owner."];

JD_JS_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Job Description & Specification Register' table."];
JD_JS_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Job Description & Specification Register' table."];
JD_JS_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Job Description & Specification Register' table."];
JD_JS_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Job Description & Specification Register' table."];

// InOutRegister table
InOutRegister_addTip=["",spacer+"This option allows all members of the group to add records to the 'Incoming & Outgoing Record Register' table. A member who adds a record to the table becomes the 'owner' of that record."];

InOutRegister_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Incoming & Outgoing Record Register' table."];
InOutRegister_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Incoming & Outgoing Record Register' table."];
InOutRegister_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Incoming & Outgoing Record Register' table."];
InOutRegister_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Incoming & Outgoing Record Register' table."];

InOutRegister_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Incoming & Outgoing Record Register' table."];
InOutRegister_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Incoming & Outgoing Record Register' table."];
InOutRegister_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Incoming & Outgoing Record Register' table."];
InOutRegister_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Incoming & Outgoing Record Register' table, regardless of their owner."];

InOutRegister_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Incoming & Outgoing Record Register' table."];
InOutRegister_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Incoming & Outgoing Record Register' table."];
InOutRegister_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Incoming & Outgoing Record Register' table."];
InOutRegister_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Incoming & Outgoing Record Register' table."];

// vendor table
vendor_addTip=["",spacer+"This option allows all members of the group to add records to the 'Vendor & Subcontractor Register' table. A member who adds a record to the table becomes the 'owner' of that record."];

vendor_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Vendor & Subcontractor Register' table."];
vendor_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Vendor & Subcontractor Register' table."];
vendor_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Vendor & Subcontractor Register' table."];
vendor_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Vendor & Subcontractor Register' table."];

vendor_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Vendor & Subcontractor Register' table."];
vendor_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Vendor & Subcontractor Register' table."];
vendor_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Vendor & Subcontractor Register' table."];
vendor_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Vendor & Subcontractor Register' table, regardless of their owner."];

vendor_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Vendor & Subcontractor Register' table."];
vendor_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Vendor & Subcontractor Register' table."];
vendor_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Vendor & Subcontractor Register' table."];
vendor_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Vendor & Subcontractor Register' table."];

// ManagingVendor table
ManagingVendor_addTip=["",spacer+"This option allows all members of the group to add records to the 'Managing Vendor & Subcontractor' table. A member who adds a record to the table becomes the 'owner' of that record."];

ManagingVendor_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Managing Vendor & Subcontractor' table."];
ManagingVendor_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Managing Vendor & Subcontractor' table."];
ManagingVendor_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Managing Vendor & Subcontractor' table."];
ManagingVendor_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Managing Vendor & Subcontractor' table."];

ManagingVendor_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Managing Vendor & Subcontractor' table."];
ManagingVendor_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Managing Vendor & Subcontractor' table."];
ManagingVendor_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Managing Vendor & Subcontractor' table."];
ManagingVendor_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Managing Vendor & Subcontractor' table, regardless of their owner."];

ManagingVendor_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Managing Vendor & Subcontractor' table."];
ManagingVendor_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Managing Vendor & Subcontractor' table."];
ManagingVendor_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Managing Vendor & Subcontractor' table."];
ManagingVendor_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Managing Vendor & Subcontractor' table."];

// VenPerformance table
VenPerformance_addTip=["",spacer+"This option allows all members of the group to add records to the 'Vendor Performance and Evaluation' table. A member who adds a record to the table becomes the 'owner' of that record."];

VenPerformance_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Vendor Performance and Evaluation' table."];
VenPerformance_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Vendor Performance and Evaluation' table."];
VenPerformance_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Vendor Performance and Evaluation' table."];
VenPerformance_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Vendor Performance and Evaluation' table."];

VenPerformance_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Vendor Performance and Evaluation' table."];
VenPerformance_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Vendor Performance and Evaluation' table."];
VenPerformance_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Vendor Performance and Evaluation' table."];
VenPerformance_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Vendor Performance and Evaluation' table, regardless of their owner."];

VenPerformance_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Vendor Performance and Evaluation' table."];
VenPerformance_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Vendor Performance and Evaluation' table."];
VenPerformance_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Vendor Performance and Evaluation' table."];
VenPerformance_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Vendor Performance and Evaluation' table."];

// Logistics table
Logistics_addTip=["",spacer+"This option allows all members of the group to add records to the 'Logistics & Freight Agent' table. A member who adds a record to the table becomes the 'owner' of that record."];

Logistics_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Logistics & Freight Agent' table."];
Logistics_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Logistics & Freight Agent' table."];
Logistics_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Logistics & Freight Agent' table."];
Logistics_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Logistics & Freight Agent' table."];

Logistics_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Logistics & Freight Agent' table."];
Logistics_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Logistics & Freight Agent' table."];
Logistics_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Logistics & Freight Agent' table."];
Logistics_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Logistics & Freight Agent' table, regardless of their owner."];

Logistics_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Logistics & Freight Agent' table."];
Logistics_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Logistics & Freight Agent' table."];
Logistics_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Logistics & Freight Agent' table."];
Logistics_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Logistics & Freight Agent' table."];

// Inventory table
Inventory_addTip=["",spacer+"This option allows all members of the group to add records to the 'Asset Register' table. A member who adds a record to the table becomes the 'owner' of that record."];

Inventory_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Asset Register' table."];
Inventory_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Asset Register' table."];
Inventory_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Asset Register' table."];
Inventory_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Asset Register' table."];

Inventory_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Asset Register' table."];
Inventory_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Asset Register' table."];
Inventory_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Asset Register' table."];
Inventory_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Asset Register' table, regardless of their owner."];

Inventory_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Asset Register' table."];
Inventory_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Asset Register' table."];
Inventory_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Asset Register' table."];
Inventory_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Asset Register' table."];

// CalibrationCtrl table
CalibrationCtrl_addTip=["",spacer+"This option allows all members of the group to add records to the 'Calibration Control' table. A member who adds a record to the table becomes the 'owner' of that record."];

CalibrationCtrl_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Calibration Control' table."];
CalibrationCtrl_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Calibration Control' table."];
CalibrationCtrl_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Calibration Control' table."];
CalibrationCtrl_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Calibration Control' table."];

CalibrationCtrl_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Calibration Control' table."];
CalibrationCtrl_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Calibration Control' table."];
CalibrationCtrl_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Calibration Control' table."];
CalibrationCtrl_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Calibration Control' table, regardless of their owner."];

CalibrationCtrl_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Calibration Control' table."];
CalibrationCtrl_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Calibration Control' table."];
CalibrationCtrl_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Calibration Control' table."];
CalibrationCtrl_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Calibration Control' table."];

// WorkOrder table
WorkOrder_addTip=["",spacer+"This option allows all members of the group to add records to the 'General Work Order' table. A member who adds a record to the table becomes the 'owner' of that record."];

WorkOrder_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'General Work Order' table."];
WorkOrder_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'General Work Order' table."];
WorkOrder_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'General Work Order' table."];
WorkOrder_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'General Work Order' table."];

WorkOrder_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'General Work Order' table."];
WorkOrder_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'General Work Order' table."];
WorkOrder_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'General Work Order' table."];
WorkOrder_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'General Work Order' table, regardless of their owner."];

WorkOrder_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'General Work Order' table."];
WorkOrder_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'General Work Order' table."];
WorkOrder_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'General Work Order' table."];
WorkOrder_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'General Work Order' table."];

// MWO table
MWO_addTip=["",spacer+"This option allows all members of the group to add records to the 'Maintenance Work Order' table. A member who adds a record to the table becomes the 'owner' of that record."];

MWO_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Maintenance Work Order' table."];
MWO_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Maintenance Work Order' table."];
MWO_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Maintenance Work Order' table."];
MWO_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Maintenance Work Order' table."];

MWO_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Maintenance Work Order' table."];
MWO_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Maintenance Work Order' table."];
MWO_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Maintenance Work Order' table."];
MWO_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Maintenance Work Order' table, regardless of their owner."];

MWO_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Maintenance Work Order' table."];
MWO_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Maintenance Work Order' table."];
MWO_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Maintenance Work Order' table."];
MWO_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Maintenance Work Order' table."];

// MWOPlanned table
MWOPlanned_addTip=["",spacer+"This option allows all members of the group to add records to the 'Planned Schedule' table. A member who adds a record to the table becomes the 'owner' of that record."];

MWOPlanned_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Planned Schedule' table."];
MWOPlanned_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Planned Schedule' table."];
MWOPlanned_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Planned Schedule' table."];
MWOPlanned_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Planned Schedule' table."];

MWOPlanned_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Planned Schedule' table."];
MWOPlanned_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Planned Schedule' table."];
MWOPlanned_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Planned Schedule' table."];
MWOPlanned_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Planned Schedule' table, regardless of their owner."];

MWOPlanned_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Planned Schedule' table."];
MWOPlanned_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Planned Schedule' table."];
MWOPlanned_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Planned Schedule' table."];
MWOPlanned_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Planned Schedule' table."];

// MWOpreventive table
MWOpreventive_addTip=["",spacer+"This option allows all members of the group to add records to the 'Preventive' table. A member who adds a record to the table becomes the 'owner' of that record."];

MWOpreventive_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Preventive' table."];
MWOpreventive_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Preventive' table."];
MWOpreventive_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Preventive' table."];
MWOpreventive_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Preventive' table."];

MWOpreventive_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Preventive' table."];
MWOpreventive_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Preventive' table."];
MWOpreventive_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Preventive' table."];
MWOpreventive_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Preventive' table, regardless of their owner."];

MWOpreventive_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Preventive' table."];
MWOpreventive_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Preventive' table."];
MWOpreventive_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Preventive' table."];
MWOpreventive_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Preventive' table."];

// MWOproactive table
MWOproactive_addTip=["",spacer+"This option allows all members of the group to add records to the 'Proactive' table. A member who adds a record to the table becomes the 'owner' of that record."];

MWOproactive_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Proactive' table."];
MWOproactive_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Proactive' table."];
MWOproactive_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Proactive' table."];
MWOproactive_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Proactive' table."];

MWOproactive_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Proactive' table."];
MWOproactive_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Proactive' table."];
MWOproactive_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Proactive' table."];
MWOproactive_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Proactive' table, regardless of their owner."];

MWOproactive_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Proactive' table."];
MWOproactive_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Proactive' table."];
MWOproactive_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Proactive' table."];
MWOproactive_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Proactive' table."];

// MWConditionBased table
MWConditionBased_addTip=["",spacer+"This option allows all members of the group to add records to the 'Condition Based' table. A member who adds a record to the table becomes the 'owner' of that record."];

MWConditionBased_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Condition Based' table."];
MWConditionBased_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Condition Based' table."];
MWConditionBased_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Condition Based' table."];
MWConditionBased_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Condition Based' table."];

MWConditionBased_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Condition Based' table."];
MWConditionBased_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Condition Based' table."];
MWConditionBased_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Condition Based' table."];
MWConditionBased_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Condition Based' table, regardless of their owner."];

MWConditionBased_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Condition Based' table."];
MWConditionBased_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Condition Based' table."];
MWConditionBased_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Condition Based' table."];
MWConditionBased_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Condition Based' table."];

// MWOReactive table
MWOReactive_addTip=["",spacer+"This option allows all members of the group to add records to the 'Reactive' table. A member who adds a record to the table becomes the 'owner' of that record."];

MWOReactive_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Reactive' table."];
MWOReactive_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Reactive' table."];
MWOReactive_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Reactive' table."];
MWOReactive_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Reactive' table."];

MWOReactive_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Reactive' table."];
MWOReactive_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Reactive' table."];
MWOReactive_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Reactive' table."];
MWOReactive_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Reactive' table, regardless of their owner."];

MWOReactive_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Reactive' table."];
MWOReactive_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Reactive' table."];
MWOReactive_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Reactive' table."];
MWOReactive_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Reactive' table."];

// MWOCorrective table
MWOCorrective_addTip=["",spacer+"This option allows all members of the group to add records to the 'Corrective' table. A member who adds a record to the table becomes the 'owner' of that record."];

MWOCorrective_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Corrective' table."];
MWOCorrective_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Corrective' table."];
MWOCorrective_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Corrective' table."];
MWOCorrective_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Corrective' table."];

MWOCorrective_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Corrective' table."];
MWOCorrective_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Corrective' table."];
MWOCorrective_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Corrective' table."];
MWOCorrective_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Corrective' table, regardless of their owner."];

MWOCorrective_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Corrective' table."];
MWOCorrective_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Corrective' table."];
MWOCorrective_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Corrective' table."];
MWOCorrective_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Corrective' table."];

// LogisticRequest table
LogisticRequest_addTip=["",spacer+"This option allows all members of the group to add records to the 'Logistic Request Order' table. A member who adds a record to the table becomes the 'owner' of that record."];

LogisticRequest_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Logistic Request Order' table."];
LogisticRequest_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Logistic Request Order' table."];
LogisticRequest_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Logistic Request Order' table."];
LogisticRequest_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Logistic Request Order' table."];

LogisticRequest_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Logistic Request Order' table."];
LogisticRequest_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Logistic Request Order' table."];
LogisticRequest_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Logistic Request Order' table."];
LogisticRequest_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Logistic Request Order' table, regardless of their owner."];

LogisticRequest_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Logistic Request Order' table."];
LogisticRequest_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Logistic Request Order' table."];
LogisticRequest_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Logistic Request Order' table."];
LogisticRequest_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Logistic Request Order' table."];

// orders table
orders_addTip=["",spacer+"This option allows all members of the group to add records to the 'Request & Service Order' table. A member who adds a record to the table becomes the 'owner' of that record."];

orders_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Request & Service Order' table."];
orders_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Request & Service Order' table."];
orders_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Request & Service Order' table."];
orders_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Request & Service Order' table."];

orders_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Request & Service Order' table."];
orders_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Request & Service Order' table."];
orders_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Request & Service Order' table."];
orders_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Request & Service Order' table, regardless of their owner."];

orders_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Request & Service Order' table."];
orders_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Request & Service Order' table."];
orders_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Request & Service Order' table."];
orders_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Request & Service Order' table."];

// Quotation table
Quotation_addTip=["",spacer+"This option allows all members of the group to add records to the 'Quotations' table. A member who adds a record to the table becomes the 'owner' of that record."];

Quotation_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Quotations' table."];
Quotation_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Quotations' table."];
Quotation_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Quotations' table."];
Quotation_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Quotations' table."];

Quotation_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Quotations' table."];
Quotation_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Quotations' table."];
Quotation_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Quotations' table."];
Quotation_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Quotations' table, regardless of their owner."];

Quotation_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Quotations' table."];
Quotation_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Quotations' table."];
Quotation_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Quotations' table."];
Quotation_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Quotations' table."];

// PurchaseOrder table
PurchaseOrder_addTip=["",spacer+"This option allows all members of the group to add records to the 'Purchase Order' table. A member who adds a record to the table becomes the 'owner' of that record."];

PurchaseOrder_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Purchase Order' table."];
PurchaseOrder_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Purchase Order' table."];
PurchaseOrder_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Purchase Order' table."];
PurchaseOrder_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Purchase Order' table."];

PurchaseOrder_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Purchase Order' table."];
PurchaseOrder_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Purchase Order' table."];
PurchaseOrder_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Purchase Order' table."];
PurchaseOrder_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Purchase Order' table, regardless of their owner."];

PurchaseOrder_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Purchase Order' table."];
PurchaseOrder_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Purchase Order' table."];
PurchaseOrder_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Purchase Order' table."];
PurchaseOrder_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Purchase Order' table."];

// DeliveryOrder table
DeliveryOrder_addTip=["",spacer+"This option allows all members of the group to add records to the 'Delivery Order' table. A member who adds a record to the table becomes the 'owner' of that record."];

DeliveryOrder_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Delivery Order' table."];
DeliveryOrder_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Delivery Order' table."];
DeliveryOrder_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Delivery Order' table."];
DeliveryOrder_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Delivery Order' table."];

DeliveryOrder_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Delivery Order' table."];
DeliveryOrder_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Delivery Order' table."];
DeliveryOrder_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Delivery Order' table."];
DeliveryOrder_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Delivery Order' table, regardless of their owner."];

DeliveryOrder_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Delivery Order' table."];
DeliveryOrder_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Delivery Order' table."];
DeliveryOrder_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Delivery Order' table."];
DeliveryOrder_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Delivery Order' table."];

// AccountPayables table
AccountPayables_addTip=["",spacer+"This option allows all members of the group to add records to the 'Account Payables' table. A member who adds a record to the table becomes the 'owner' of that record."];

AccountPayables_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Account Payables' table."];
AccountPayables_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Account Payables' table."];
AccountPayables_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Account Payables' table."];
AccountPayables_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Account Payables' table."];

AccountPayables_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Account Payables' table."];
AccountPayables_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Account Payables' table."];
AccountPayables_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Account Payables' table."];
AccountPayables_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Account Payables' table, regardless of their owner."];

AccountPayables_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Account Payables' table."];
AccountPayables_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Account Payables' table."];
AccountPayables_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Account Payables' table."];
AccountPayables_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Account Payables' table."];

// Item table
Item_addTip=["",spacer+"This option allows all members of the group to add records to the 'Resources Inventory' table. A member who adds a record to the table becomes the 'owner' of that record."];

Item_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Resources Inventory' table."];
Item_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Resources Inventory' table."];
Item_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Resources Inventory' table."];
Item_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Resources Inventory' table."];

Item_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Resources Inventory' table."];
Item_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Resources Inventory' table."];
Item_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Resources Inventory' table."];
Item_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Resources Inventory' table, regardless of their owner."];

Item_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Resources Inventory' table."];
Item_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Resources Inventory' table."];
Item_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Resources Inventory' table."];
Item_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Resources Inventory' table."];

// categories table
categories_addTip=["",spacer+"This option allows all members of the group to add records to the 'Item Categories' table. A member who adds a record to the table becomes the 'owner' of that record."];

categories_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Item Categories' table."];
categories_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Item Categories' table."];
categories_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Item Categories' table."];
categories_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Item Categories' table."];

categories_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Item Categories' table."];
categories_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Item Categories' table."];
categories_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Item Categories' table."];
categories_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Item Categories' table, regardless of their owner."];

categories_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Item Categories' table."];
categories_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Item Categories' table."];
categories_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Item Categories' table."];
categories_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Item Categories' table."];

// batches table
batches_addTip=["",spacer+"This option allows all members of the group to add records to the 'Batches' table. A member who adds a record to the table becomes the 'owner' of that record."];

batches_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Batches' table."];
batches_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Batches' table."];
batches_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Batches' table."];
batches_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Batches' table."];

batches_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Batches' table."];
batches_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Batches' table."];
batches_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Batches' table."];
batches_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Batches' table, regardless of their owner."];

batches_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Batches' table."];
batches_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Batches' table."];
batches_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Batches' table."];
batches_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Batches' table."];

// transactions table
transactions_addTip=["",spacer+"This option allows all members of the group to add records to the 'Transfer Item' table. A member who adds a record to the table becomes the 'owner' of that record."];

transactions_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Transfer Item' table."];
transactions_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Transfer Item' table."];
transactions_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Transfer Item' table."];
transactions_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Transfer Item' table."];

transactions_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Transfer Item' table."];
transactions_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Transfer Item' table."];
transactions_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Transfer Item' table."];
transactions_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Transfer Item' table, regardless of their owner."];

transactions_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Transfer Item' table."];
transactions_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Transfer Item' table."];
transactions_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Transfer Item' table."];
transactions_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Transfer Item' table."];

// CommConsParticipate table
CommConsParticipate_addTip=["",spacer+"This option allows all members of the group to add records to the 'Communication, Consultation & Participation' table. A member who adds a record to the table becomes the 'owner' of that record."];

CommConsParticipate_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Communication, Consultation & Participation' table."];
CommConsParticipate_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Communication, Consultation & Participation' table."];
CommConsParticipate_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Communication, Consultation & Participation' table."];
CommConsParticipate_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Communication, Consultation & Participation' table."];

CommConsParticipate_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Communication, Consultation & Participation' table."];
CommConsParticipate_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Communication, Consultation & Participation' table."];
CommConsParticipate_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Communication, Consultation & Participation' table."];
CommConsParticipate_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Communication, Consultation & Participation' table, regardless of their owner."];

CommConsParticipate_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Communication, Consultation & Participation' table."];
CommConsParticipate_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Communication, Consultation & Participation' table."];
CommConsParticipate_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Communication, Consultation & Participation' table."];
CommConsParticipate_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Communication, Consultation & Participation' table."];

// ToolBoxMeeting table
ToolBoxMeeting_addTip=["",spacer+"This option allows all members of the group to add records to the 'ToolBox Meeting' table. A member who adds a record to the table becomes the 'owner' of that record."];

ToolBoxMeeting_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'ToolBox Meeting' table."];
ToolBoxMeeting_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'ToolBox Meeting' table."];
ToolBoxMeeting_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'ToolBox Meeting' table."];
ToolBoxMeeting_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'ToolBox Meeting' table."];

ToolBoxMeeting_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'ToolBox Meeting' table."];
ToolBoxMeeting_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'ToolBox Meeting' table."];
ToolBoxMeeting_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'ToolBox Meeting' table."];
ToolBoxMeeting_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'ToolBox Meeting' table, regardless of their owner."];

ToolBoxMeeting_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'ToolBox Meeting' table."];
ToolBoxMeeting_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'ToolBox Meeting' table."];
ToolBoxMeeting_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'ToolBox Meeting' table."];
ToolBoxMeeting_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'ToolBox Meeting' table."];

// Bi_WeeklyMeeting table
Bi_WeeklyMeeting_addTip=["",spacer+"This option allows all members of the group to add records to the 'Bi-Weekly Meeting' table. A member who adds a record to the table becomes the 'owner' of that record."];

Bi_WeeklyMeeting_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Bi-Weekly Meeting' table."];
Bi_WeeklyMeeting_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Bi-Weekly Meeting' table."];
Bi_WeeklyMeeting_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Bi-Weekly Meeting' table."];
Bi_WeeklyMeeting_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Bi-Weekly Meeting' table."];

Bi_WeeklyMeeting_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Bi-Weekly Meeting' table."];
Bi_WeeklyMeeting_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Bi-Weekly Meeting' table."];
Bi_WeeklyMeeting_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Bi-Weekly Meeting' table."];
Bi_WeeklyMeeting_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Bi-Weekly Meeting' table, regardless of their owner."];

Bi_WeeklyMeeting_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Bi-Weekly Meeting' table."];
Bi_WeeklyMeeting_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Bi-Weekly Meeting' table."];
Bi_WeeklyMeeting_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Bi-Weekly Meeting' table."];
Bi_WeeklyMeeting_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Bi-Weekly Meeting' table."];

// QuarterlyMeeting table
QuarterlyMeeting_addTip=["",spacer+"This option allows all members of the group to add records to the 'Quarterly Meeting' table. A member who adds a record to the table becomes the 'owner' of that record."];

QuarterlyMeeting_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Quarterly Meeting' table."];
QuarterlyMeeting_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Quarterly Meeting' table."];
QuarterlyMeeting_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Quarterly Meeting' table."];
QuarterlyMeeting_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Quarterly Meeting' table."];

QuarterlyMeeting_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Quarterly Meeting' table."];
QuarterlyMeeting_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Quarterly Meeting' table."];
QuarterlyMeeting_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Quarterly Meeting' table."];
QuarterlyMeeting_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Quarterly Meeting' table, regardless of their owner."];

QuarterlyMeeting_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Quarterly Meeting' table."];
QuarterlyMeeting_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Quarterly Meeting' table."];
QuarterlyMeeting_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Quarterly Meeting' table."];
QuarterlyMeeting_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Quarterly Meeting' table."];

// Campaign table
Campaign_addTip=["",spacer+"This option allows all members of the group to add records to the 'Campaign' table. A member who adds a record to the table becomes the 'owner' of that record."];

Campaign_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Campaign' table."];
Campaign_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Campaign' table."];
Campaign_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Campaign' table."];
Campaign_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Campaign' table."];

Campaign_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Campaign' table."];
Campaign_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Campaign' table."];
Campaign_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Campaign' table."];
Campaign_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Campaign' table, regardless of their owner."];

Campaign_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Campaign' table."];
Campaign_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Campaign' table."];
Campaign_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Campaign' table."];
Campaign_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Campaign' table."];

// DrillNInspection table
DrillNInspection_addTip=["",spacer+"This option allows all members of the group to add records to the 'Drill & Inspection' table. A member who adds a record to the table becomes the 'owner' of that record."];

DrillNInspection_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Drill & Inspection' table."];
DrillNInspection_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Drill & Inspection' table."];
DrillNInspection_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Drill & Inspection' table."];
DrillNInspection_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Drill & Inspection' table."];

DrillNInspection_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Drill & Inspection' table."];
DrillNInspection_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Drill & Inspection' table."];
DrillNInspection_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Drill & Inspection' table."];
DrillNInspection_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Drill & Inspection' table, regardless of their owner."];

DrillNInspection_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Drill & Inspection' table."];
DrillNInspection_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Drill & Inspection' table."];
DrillNInspection_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Drill & Inspection' table."];
DrillNInspection_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Drill & Inspection' table."];

// ManagementVisit table
ManagementVisit_addTip=["",spacer+"This option allows all members of the group to add records to the 'Management Visit' table. A member who adds a record to the table becomes the 'owner' of that record."];

ManagementVisit_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Management Visit' table."];
ManagementVisit_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Management Visit' table."];
ManagementVisit_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Management Visit' table."];
ManagementVisit_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Management Visit' table."];

ManagementVisit_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Management Visit' table."];
ManagementVisit_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Management Visit' table."];
ManagementVisit_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Management Visit' table."];
ManagementVisit_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Management Visit' table, regardless of their owner."];

ManagementVisit_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Management Visit' table."];
ManagementVisit_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Management Visit' table."];
ManagementVisit_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Management Visit' table."];
ManagementVisit_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Management Visit' table."];

// EventNotification table
EventNotification_addTip=["",spacer+"This option allows all members of the group to add records to the 'Event Notification' table. A member who adds a record to the table becomes the 'owner' of that record."];

EventNotification_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Event Notification' table."];
EventNotification_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Event Notification' table."];
EventNotification_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Event Notification' table."];
EventNotification_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Event Notification' table."];

EventNotification_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Event Notification' table."];
EventNotification_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Event Notification' table."];
EventNotification_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Event Notification' table."];
EventNotification_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Event Notification' table, regardless of their owner."];

EventNotification_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Event Notification' table."];
EventNotification_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Event Notification' table."];
EventNotification_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Event Notification' table."];
EventNotification_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Event Notification' table."];

// ActCard table
ActCard_addTip=["",spacer+"This option allows all members of the group to add records to the 'Act Card' table. A member who adds a record to the table becomes the 'owner' of that record."];

ActCard_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Act Card' table."];
ActCard_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Act Card' table."];
ActCard_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Act Card' table."];
ActCard_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Act Card' table."];

ActCard_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Act Card' table."];
ActCard_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Act Card' table."];
ActCard_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Act Card' table."];
ActCard_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Act Card' table, regardless of their owner."];

ActCard_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Act Card' table."];
ActCard_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Act Card' table."];
ActCard_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Act Card' table."];
ActCard_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Act Card' table."];

// KM table
KM_addTip=["",spacer+"This option allows all members of the group to add records to the 'Organizational Knowledge' table. A member who adds a record to the table becomes the 'owner' of that record."];

KM_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Organizational Knowledge' table."];
KM_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Organizational Knowledge' table."];
KM_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Organizational Knowledge' table."];
KM_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Organizational Knowledge' table."];

KM_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Organizational Knowledge' table."];
KM_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Organizational Knowledge' table."];
KM_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Organizational Knowledge' table."];
KM_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Organizational Knowledge' table, regardless of their owner."];

KM_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Organizational Knowledge' table."];
KM_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Organizational Knowledge' table."];
KM_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Organizational Knowledge' table."];
KM_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Organizational Knowledge' table."];

// LegalRegister table
LegalRegister_addTip=["",spacer+"This option allows all members of the group to add records to the 'Legal Register' table. A member who adds a record to the table becomes the 'owner' of that record."];

LegalRegister_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Legal Register' table."];
LegalRegister_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Legal Register' table."];
LegalRegister_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Legal Register' table."];
LegalRegister_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Legal Register' table."];

LegalRegister_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Legal Register' table."];
LegalRegister_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Legal Register' table."];
LegalRegister_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Legal Register' table."];
LegalRegister_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Legal Register' table, regardless of their owner."];

LegalRegister_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Legal Register' table."];
LegalRegister_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Legal Register' table."];
LegalRegister_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Legal Register' table."];
LegalRegister_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Legal Register' table."];

// RiskandOpportunity table
RiskandOpportunity_addTip=["",spacer+"This option allows all members of the group to add records to the 'Risks Management' table. A member who adds a record to the table becomes the 'owner' of that record."];

RiskandOpportunity_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Risks Management' table."];
RiskandOpportunity_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Risks Management' table."];
RiskandOpportunity_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Risks Management' table."];
RiskandOpportunity_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Risks Management' table."];

RiskandOpportunity_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Risks Management' table."];
RiskandOpportunity_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Risks Management' table."];
RiskandOpportunity_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Risks Management' table."];
RiskandOpportunity_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Risks Management' table, regardless of their owner."];

RiskandOpportunity_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Risks Management' table."];
RiskandOpportunity_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Risks Management' table."];
RiskandOpportunity_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Risks Management' table."];
RiskandOpportunity_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Risks Management' table."];

// DocControl table
DocControl_addTip=["",spacer+"This option allows all members of the group to add records to the 'Document & Record Control' table. A member who adds a record to the table becomes the 'owner' of that record."];

DocControl_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Document & Record Control' table."];
DocControl_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Document & Record Control' table."];
DocControl_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Document & Record Control' table."];
DocControl_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Document & Record Control' table."];

DocControl_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Document & Record Control' table."];
DocControl_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Document & Record Control' table."];
DocControl_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Document & Record Control' table."];
DocControl_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Document & Record Control' table, regardless of their owner."];

DocControl_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Document & Record Control' table."];
DocControl_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Document & Record Control' table."];
DocControl_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Document & Record Control' table."];
DocControl_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Document & Record Control' table."];

// DCN table
DCN_addTip=["",spacer+"This option allows all members of the group to add records to the 'Document Change Notice' table. A member who adds a record to the table becomes the 'owner' of that record."];

DCN_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Document Change Notice' table."];
DCN_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Document Change Notice' table."];
DCN_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Document Change Notice' table."];
DCN_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Document Change Notice' table."];

DCN_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Document Change Notice' table."];
DCN_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Document Change Notice' table."];
DCN_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Document Change Notice' table."];
DCN_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Document Change Notice' table, regardless of their owner."];

DCN_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Document Change Notice' table."];
DCN_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Document Change Notice' table."];
DCN_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Document Change Notice' table."];
DCN_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Document Change Notice' table."];

// ObsoleteRec table
ObsoleteRec_addTip=["",spacer+"This option allows all members of the group to add records to the 'Obsolete Record Register' table. A member who adds a record to the table becomes the 'owner' of that record."];

ObsoleteRec_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Obsolete Record Register' table."];
ObsoleteRec_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Obsolete Record Register' table."];
ObsoleteRec_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Obsolete Record Register' table."];
ObsoleteRec_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Obsolete Record Register' table."];

ObsoleteRec_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Obsolete Record Register' table."];
ObsoleteRec_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Obsolete Record Register' table."];
ObsoleteRec_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Obsolete Record Register' table."];
ObsoleteRec_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Obsolete Record Register' table, regardless of their owner."];

ObsoleteRec_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Obsolete Record Register' table."];
ObsoleteRec_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Obsolete Record Register' table."];
ObsoleteRec_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Obsolete Record Register' table."];
ObsoleteRec_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Obsolete Record Register' table."];

// QA table
QA_addTip=["",spacer+"This option allows all members of the group to add records to the 'IMS Planning & Assurance' table. A member who adds a record to the table becomes the 'owner' of that record."];

QA_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'IMS Planning & Assurance' table."];
QA_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'IMS Planning & Assurance' table."];
QA_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'IMS Planning & Assurance' table."];
QA_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'IMS Planning & Assurance' table."];

QA_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'IMS Planning & Assurance' table."];
QA_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'IMS Planning & Assurance' table."];
QA_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'IMS Planning & Assurance' table."];
QA_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'IMS Planning & Assurance' table, regardless of their owner."];

QA_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'IMS Planning & Assurance' table."];
QA_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'IMS Planning & Assurance' table."];
QA_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'IMS Planning & Assurance' table."];
QA_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'IMS Planning & Assurance' table."];

// ERP table
ERP_addTip=["",spacer+"This option allows all members of the group to add records to the 'Emergency Preparedness & Response' table. A member who adds a record to the table becomes the 'owner' of that record."];

ERP_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Emergency Preparedness & Response' table."];
ERP_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Emergency Preparedness & Response' table."];
ERP_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Emergency Preparedness & Response' table."];
ERP_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Emergency Preparedness & Response' table."];

ERP_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Emergency Preparedness & Response' table."];
ERP_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Emergency Preparedness & Response' table."];
ERP_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Emergency Preparedness & Response' table."];
ERP_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Emergency Preparedness & Response' table, regardless of their owner."];

ERP_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Emergency Preparedness & Response' table."];
ERP_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Emergency Preparedness & Response' table."];
ERP_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Emergency Preparedness & Response' table."];
ERP_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Emergency Preparedness & Response' table."];

// WorkEnvMonitoring table
WorkEnvMonitoring_addTip=["",spacer+"This option allows all members of the group to add records to the 'Work Environment Monitoring and Control' table. A member who adds a record to the table becomes the 'owner' of that record."];

WorkEnvMonitoring_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Work Environment Monitoring and Control' table."];
WorkEnvMonitoring_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Work Environment Monitoring and Control' table."];
WorkEnvMonitoring_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Work Environment Monitoring and Control' table."];
WorkEnvMonitoring_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Work Environment Monitoring and Control' table."];

WorkEnvMonitoring_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Work Environment Monitoring and Control' table."];
WorkEnvMonitoring_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Work Environment Monitoring and Control' table."];
WorkEnvMonitoring_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Work Environment Monitoring and Control' table."];
WorkEnvMonitoring_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Work Environment Monitoring and Control' table, regardless of their owner."];

WorkEnvMonitoring_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Work Environment Monitoring and Control' table."];
WorkEnvMonitoring_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Work Environment Monitoring and Control' table."];
WorkEnvMonitoring_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Work Environment Monitoring and Control' table."];
WorkEnvMonitoring_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Work Environment Monitoring and Control' table."];

// ScheduleWaste table
ScheduleWaste_addTip=["",spacer+"This option allows all members of the group to add records to the 'Schedule Waste Disposal Register' table. A member who adds a record to the table becomes the 'owner' of that record."];

ScheduleWaste_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Schedule Waste Disposal Register' table."];
ScheduleWaste_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Schedule Waste Disposal Register' table."];
ScheduleWaste_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Schedule Waste Disposal Register' table."];
ScheduleWaste_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Schedule Waste Disposal Register' table."];

ScheduleWaste_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Schedule Waste Disposal Register' table."];
ScheduleWaste_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Schedule Waste Disposal Register' table."];
ScheduleWaste_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Schedule Waste Disposal Register' table."];
ScheduleWaste_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Schedule Waste Disposal Register' table, regardless of their owner."];

ScheduleWaste_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Schedule Waste Disposal Register' table."];
ScheduleWaste_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Schedule Waste Disposal Register' table."];
ScheduleWaste_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Schedule Waste Disposal Register' table."];
ScheduleWaste_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Schedule Waste Disposal Register' table."];

// IncidentReporting table
IncidentReporting_addTip=["",spacer+"This option allows all members of the group to add records to the 'Incident & Accident Reporting' table. A member who adds a record to the table becomes the 'owner' of that record."];

IncidentReporting_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Incident & Accident Reporting' table."];
IncidentReporting_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Incident & Accident Reporting' table."];
IncidentReporting_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Incident & Accident Reporting' table."];
IncidentReporting_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Incident & Accident Reporting' table."];

IncidentReporting_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Incident & Accident Reporting' table."];
IncidentReporting_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Incident & Accident Reporting' table."];
IncidentReporting_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Incident & Accident Reporting' table."];
IncidentReporting_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Incident & Accident Reporting' table, regardless of their owner."];

IncidentReporting_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Incident & Accident Reporting' table."];
IncidentReporting_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Incident & Accident Reporting' table."];
IncidentReporting_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Incident & Accident Reporting' table."];
IncidentReporting_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Incident & Accident Reporting' table."];

// MgtofChange table
MgtofChange_addTip=["",spacer+"This option allows all members of the group to add records to the 'Management Of Change' table. A member who adds a record to the table becomes the 'owner' of that record."];

MgtofChange_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Management Of Change' table."];
MgtofChange_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Management Of Change' table."];
MgtofChange_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Management Of Change' table."];
MgtofChange_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Management Of Change' table."];

MgtofChange_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Management Of Change' table."];
MgtofChange_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Management Of Change' table."];
MgtofChange_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Management Of Change' table."];
MgtofChange_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Management Of Change' table, regardless of their owner."];

MgtofChange_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Management Of Change' table."];
MgtofChange_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Management Of Change' table."];
MgtofChange_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Management Of Change' table."];
MgtofChange_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Management Of Change' table."];

// IMStrackingNmonitoring table
IMStrackingNmonitoring_addTip=["",spacer+"This option allows all members of the group to add records to the 'IMS Data Tracking & Monitoring' table. A member who adds a record to the table becomes the 'owner' of that record."];

IMStrackingNmonitoring_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'IMS Data Tracking & Monitoring' table."];
IMStrackingNmonitoring_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'IMS Data Tracking & Monitoring' table."];
IMStrackingNmonitoring_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'IMS Data Tracking & Monitoring' table."];
IMStrackingNmonitoring_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'IMS Data Tracking & Monitoring' table."];

IMStrackingNmonitoring_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'IMS Data Tracking & Monitoring' table."];
IMStrackingNmonitoring_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'IMS Data Tracking & Monitoring' table."];
IMStrackingNmonitoring_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'IMS Data Tracking & Monitoring' table."];
IMStrackingNmonitoring_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'IMS Data Tracking & Monitoring' table, regardless of their owner."];

IMStrackingNmonitoring_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'IMS Data Tracking & Monitoring' table."];
IMStrackingNmonitoring_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'IMS Data Tracking & Monitoring' table."];
IMStrackingNmonitoring_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'IMS Data Tracking & Monitoring' table."];
IMStrackingNmonitoring_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'IMS Data Tracking & Monitoring' table."];

// IMSDataAnalysis table
IMSDataAnalysis_addTip=["",spacer+"This option allows all members of the group to add records to the 'Continual Improvement Plan' table. A member who adds a record to the table becomes the 'owner' of that record."];

IMSDataAnalysis_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Continual Improvement Plan' table."];
IMSDataAnalysis_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Continual Improvement Plan' table."];
IMSDataAnalysis_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Continual Improvement Plan' table."];
IMSDataAnalysis_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Continual Improvement Plan' table."];

IMSDataAnalysis_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Continual Improvement Plan' table."];
IMSDataAnalysis_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Continual Improvement Plan' table."];
IMSDataAnalysis_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Continual Improvement Plan' table."];
IMSDataAnalysis_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Continual Improvement Plan' table, regardless of their owner."];

IMSDataAnalysis_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Continual Improvement Plan' table."];
IMSDataAnalysis_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Continual Improvement Plan' table."];
IMSDataAnalysis_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Continual Improvement Plan' table."];
IMSDataAnalysis_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Continual Improvement Plan' table."];

// Audit table
Audit_addTip=["",spacer+"This option allows all members of the group to add records to the 'Management System Audit' table. A member who adds a record to the table becomes the 'owner' of that record."];

Audit_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Management System Audit' table."];
Audit_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Management System Audit' table."];
Audit_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Management System Audit' table."];
Audit_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Management System Audit' table."];

Audit_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Management System Audit' table."];
Audit_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Management System Audit' table."];
Audit_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Management System Audit' table."];
Audit_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Management System Audit' table, regardless of their owner."];

Audit_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Management System Audit' table."];
Audit_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Management System Audit' table."];
Audit_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Management System Audit' table."];
Audit_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Management System Audit' table."];

// NonConformance table
NonConformance_addTip=["",spacer+"This option allows all members of the group to add records to the 'IMS Non Conformance' table. A member who adds a record to the table becomes the 'owner' of that record."];

NonConformance_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'IMS Non Conformance' table."];
NonConformance_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'IMS Non Conformance' table."];
NonConformance_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'IMS Non Conformance' table."];
NonConformance_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'IMS Non Conformance' table."];

NonConformance_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'IMS Non Conformance' table."];
NonConformance_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'IMS Non Conformance' table."];
NonConformance_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'IMS Non Conformance' table."];
NonConformance_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'IMS Non Conformance' table, regardless of their owner."];

NonConformance_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'IMS Non Conformance' table."];
NonConformance_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'IMS Non Conformance' table."];
NonConformance_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'IMS Non Conformance' table."];
NonConformance_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'IMS Non Conformance' table."];

// ContinualImprovement table
ContinualImprovement_addTip=["",spacer+"This option allows all members of the group to add records to the 'CAPAR' table. A member who adds a record to the table becomes the 'owner' of that record."];

ContinualImprovement_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CAPAR' table."];
ContinualImprovement_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CAPAR' table."];
ContinualImprovement_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CAPAR' table."];
ContinualImprovement_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CAPAR' table."];

ContinualImprovement_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CAPAR' table."];
ContinualImprovement_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CAPAR' table."];
ContinualImprovement_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CAPAR' table."];
ContinualImprovement_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CAPAR' table, regardless of their owner."];

ContinualImprovement_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CAPAR' table."];
ContinualImprovement_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CAPAR' table."];
ContinualImprovement_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CAPAR' table."];
ContinualImprovement_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CAPAR' table."];

// StakeholderSatisfaction table
StakeholderSatisfaction_addTip=["",spacer+"This option allows all members of the group to add records to the 'Stakeholder Satisfaction Survey' table. A member who adds a record to the table becomes the 'owner' of that record."];

StakeholderSatisfaction_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Stakeholder Satisfaction Survey' table."];
StakeholderSatisfaction_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Stakeholder Satisfaction Survey' table."];
StakeholderSatisfaction_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Stakeholder Satisfaction Survey' table."];
StakeholderSatisfaction_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Stakeholder Satisfaction Survey' table."];

StakeholderSatisfaction_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Stakeholder Satisfaction Survey' table."];
StakeholderSatisfaction_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Stakeholder Satisfaction Survey' table."];
StakeholderSatisfaction_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Stakeholder Satisfaction Survey' table."];
StakeholderSatisfaction_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Stakeholder Satisfaction Survey' table, regardless of their owner."];

StakeholderSatisfaction_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Stakeholder Satisfaction Survey' table."];
StakeholderSatisfaction_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Stakeholder Satisfaction Survey' table."];
StakeholderSatisfaction_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Stakeholder Satisfaction Survey' table."];
StakeholderSatisfaction_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Stakeholder Satisfaction Survey' table."];

// MRM table
MRM_addTip=["",spacer+"This option allows all members of the group to add records to the 'Management Review Meeting' table. A member who adds a record to the table becomes the 'owner' of that record."];

MRM_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Management Review Meeting' table."];
MRM_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Management Review Meeting' table."];
MRM_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Management Review Meeting' table."];
MRM_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Management Review Meeting' table."];

MRM_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Management Review Meeting' table."];
MRM_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Management Review Meeting' table."];
MRM_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Management Review Meeting' table."];
MRM_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Management Review Meeting' table, regardless of their owner."];

MRM_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Management Review Meeting' table."];
MRM_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Management Review Meeting' table."];
MRM_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Management Review Meeting' table."];
MRM_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Management Review Meeting' table."];

// projects table
projects_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project Register' table. A member who adds a record to the table becomes the 'owner' of that record."];

projects_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project Register' table."];
projects_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project Register' table."];
projects_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project Register' table."];
projects_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project Register' table."];

projects_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project Register' table."];
projects_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project Register' table."];
projects_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project Register' table."];
projects_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project Register' table, regardless of their owner."];

projects_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project Register' table."];
projects_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project Register' table."];
projects_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project Register' table."];
projects_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project Register' table."];

// WorkLocation table
WorkLocation_addTip=["",spacer+"This option allows all members of the group to add records to the 'Work Site Location' table. A member who adds a record to the table becomes the 'owner' of that record."];

WorkLocation_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Work Site Location' table."];
WorkLocation_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Work Site Location' table."];
WorkLocation_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Work Site Location' table."];
WorkLocation_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Work Site Location' table."];

WorkLocation_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Work Site Location' table."];
WorkLocation_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Work Site Location' table."];
WorkLocation_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Work Site Location' table."];
WorkLocation_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Work Site Location' table, regardless of their owner."];

WorkLocation_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Work Site Location' table."];
WorkLocation_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Work Site Location' table."];
WorkLocation_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Work Site Location' table."];
WorkLocation_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Work Site Location' table."];

// WorkPermit table
WorkPermit_addTip=["",spacer+"This option allows all members of the group to add records to the 'Work Permit' table. A member who adds a record to the table becomes the 'owner' of that record."];

WorkPermit_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Work Permit' table."];
WorkPermit_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Work Permit' table."];
WorkPermit_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Work Permit' table."];
WorkPermit_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Work Permit' table."];

WorkPermit_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Work Permit' table."];
WorkPermit_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Work Permit' table."];
WorkPermit_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Work Permit' table."];
WorkPermit_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Work Permit' table, regardless of their owner."];

WorkPermit_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Work Permit' table."];
WorkPermit_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Work Permit' table."];
WorkPermit_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Work Permit' table."];
WorkPermit_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Work Permit' table."];

// ProjectTeam table
ProjectTeam_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project Team Matrix' table. A member who adds a record to the table becomes the 'owner' of that record."];

ProjectTeam_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project Team Matrix' table."];
ProjectTeam_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project Team Matrix' table."];
ProjectTeam_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project Team Matrix' table."];
ProjectTeam_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project Team Matrix' table."];

ProjectTeam_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project Team Matrix' table."];
ProjectTeam_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project Team Matrix' table."];
ProjectTeam_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project Team Matrix' table."];
ProjectTeam_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project Team Matrix' table, regardless of their owner."];

ProjectTeam_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project Team Matrix' table."];
ProjectTeam_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project Team Matrix' table."];
ProjectTeam_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project Team Matrix' table."];
ProjectTeam_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project Team Matrix' table."];

// resources table
resources_addTip=["",spacer+"This option allows all members of the group to add records to the 'Resources & Equipment' table. A member who adds a record to the table becomes the 'owner' of that record."];

resources_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Resources & Equipment' table."];
resources_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Resources & Equipment' table."];
resources_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Resources & Equipment' table."];
resources_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Resources & Equipment' table."];

resources_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Resources & Equipment' table."];
resources_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Resources & Equipment' table."];
resources_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Resources & Equipment' table."];
resources_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Resources & Equipment' table, regardless of their owner."];

resources_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Resources & Equipment' table."];
resources_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Resources & Equipment' table."];
resources_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Resources & Equipment' table."];
resources_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Resources & Equipment' table."];

// PROInitiation table
PROInitiation_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project Initiation' table. A member who adds a record to the table becomes the 'owner' of that record."];

PROInitiation_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project Initiation' table."];
PROInitiation_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project Initiation' table."];
PROInitiation_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project Initiation' table."];
PROInitiation_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project Initiation' table."];

PROInitiation_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project Initiation' table."];
PROInitiation_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project Initiation' table."];
PROInitiation_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project Initiation' table."];
PROInitiation_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project Initiation' table, regardless of their owner."];

PROInitiation_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project Initiation' table."];
PROInitiation_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project Initiation' table."];
PROInitiation_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project Initiation' table."];
PROInitiation_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project Initiation' table."];

// PROPlanning table
PROPlanning_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project Planning' table. A member who adds a record to the table becomes the 'owner' of that record."];

PROPlanning_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project Planning' table."];
PROPlanning_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project Planning' table."];
PROPlanning_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project Planning' table."];
PROPlanning_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project Planning' table."];

PROPlanning_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project Planning' table."];
PROPlanning_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project Planning' table."];
PROPlanning_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project Planning' table."];
PROPlanning_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project Planning' table, regardless of their owner."];

PROPlanning_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project Planning' table."];
PROPlanning_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project Planning' table."];
PROPlanning_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project Planning' table."];
PROPlanning_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project Planning' table."];

// PROExecution table
PROExecution_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project Execution' table. A member who adds a record to the table becomes the 'owner' of that record."];

PROExecution_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project Execution' table."];
PROExecution_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project Execution' table."];
PROExecution_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project Execution' table."];
PROExecution_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project Execution' table."];

PROExecution_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project Execution' table."];
PROExecution_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project Execution' table."];
PROExecution_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project Execution' table."];
PROExecution_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project Execution' table, regardless of their owner."];

PROExecution_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project Execution' table."];
PROExecution_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project Execution' table."];
PROExecution_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project Execution' table."];
PROExecution_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project Execution' table."];

// DailyProgressReport table
DailyProgressReport_addTip=["",spacer+"This option allows all members of the group to add records to the 'Daily Progress Report' table. A member who adds a record to the table becomes the 'owner' of that record."];

DailyProgressReport_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Daily Progress Report' table."];
DailyProgressReport_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Daily Progress Report' table."];
DailyProgressReport_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Daily Progress Report' table."];
DailyProgressReport_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Daily Progress Report' table."];

DailyProgressReport_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Daily Progress Report' table."];
DailyProgressReport_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Daily Progress Report' table."];
DailyProgressReport_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Daily Progress Report' table."];
DailyProgressReport_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Daily Progress Report' table, regardless of their owner."];

DailyProgressReport_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Daily Progress Report' table."];
DailyProgressReport_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Daily Progress Report' table."];
DailyProgressReport_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Daily Progress Report' table."];
DailyProgressReport_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Daily Progress Report' table."];

// MonthlyTimesheet table
MonthlyTimesheet_addTip=["",spacer+"This option allows all members of the group to add records to the 'Monthly Timesheet' table. A member who adds a record to the table becomes the 'owner' of that record."];

MonthlyTimesheet_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Monthly Timesheet' table."];
MonthlyTimesheet_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Monthly Timesheet' table."];
MonthlyTimesheet_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Monthly Timesheet' table."];
MonthlyTimesheet_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Monthly Timesheet' table."];

MonthlyTimesheet_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Monthly Timesheet' table."];
MonthlyTimesheet_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Monthly Timesheet' table."];
MonthlyTimesheet_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Monthly Timesheet' table."];
MonthlyTimesheet_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Monthly Timesheet' table, regardless of their owner."];

MonthlyTimesheet_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Monthly Timesheet' table."];
MonthlyTimesheet_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Monthly Timesheet' table."];
MonthlyTimesheet_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Monthly Timesheet' table."];
MonthlyTimesheet_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Monthly Timesheet' table."];

// Breakdown table
Breakdown_addTip=["",spacer+"This option allows all members of the group to add records to the 'Breakdown & Fault Report' table. A member who adds a record to the table becomes the 'owner' of that record."];

Breakdown_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Breakdown & Fault Report' table."];
Breakdown_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Breakdown & Fault Report' table."];
Breakdown_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Breakdown & Fault Report' table."];
Breakdown_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Breakdown & Fault Report' table."];

Breakdown_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Breakdown & Fault Report' table."];
Breakdown_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Breakdown & Fault Report' table."];
Breakdown_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Breakdown & Fault Report' table."];
Breakdown_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Breakdown & Fault Report' table, regardless of their owner."];

Breakdown_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Breakdown & Fault Report' table."];
Breakdown_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Breakdown & Fault Report' table."];
Breakdown_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Breakdown & Fault Report' table."];
Breakdown_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Breakdown & Fault Report' table."];

// PROControlMonitoring table
PROControlMonitoring_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project Control And Monitoring' table. A member who adds a record to the table becomes the 'owner' of that record."];

PROControlMonitoring_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project Control And Monitoring' table."];
PROControlMonitoring_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project Control And Monitoring' table."];
PROControlMonitoring_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project Control And Monitoring' table."];
PROControlMonitoring_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project Control And Monitoring' table."];

PROControlMonitoring_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project Control And Monitoring' table."];
PROControlMonitoring_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project Control And Monitoring' table."];
PROControlMonitoring_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project Control And Monitoring' table."];
PROControlMonitoring_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project Control And Monitoring' table, regardless of their owner."];

PROControlMonitoring_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project Control And Monitoring' table."];
PROControlMonitoring_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project Control And Monitoring' table."];
PROControlMonitoring_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project Control And Monitoring' table."];
PROControlMonitoring_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project Control And Monitoring' table."];

// PROVariation table
PROVariation_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project Variation Order' table. A member who adds a record to the table becomes the 'owner' of that record."];

PROVariation_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project Variation Order' table."];
PROVariation_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project Variation Order' table."];
PROVariation_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project Variation Order' table."];
PROVariation_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project Variation Order' table."];

PROVariation_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project Variation Order' table."];
PROVariation_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project Variation Order' table."];
PROVariation_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project Variation Order' table."];
PROVariation_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project Variation Order' table, regardless of their owner."];

PROVariation_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project Variation Order' table."];
PROVariation_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project Variation Order' table."];
PROVariation_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project Variation Order' table."];
PROVariation_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project Variation Order' table."];

// PROCompletion table
PROCompletion_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project Completion' table. A member who adds a record to the table becomes the 'owner' of that record."];

PROCompletion_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project Completion' table."];
PROCompletion_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project Completion' table."];
PROCompletion_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project Completion' table."];
PROCompletion_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project Completion' table."];

PROCompletion_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project Completion' table."];
PROCompletion_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project Completion' table."];
PROCompletion_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project Completion' table."];
PROCompletion_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project Completion' table, regardless of their owner."];

PROCompletion_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project Completion' table."];
PROCompletion_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project Completion' table."];
PROCompletion_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project Completion' table."];
PROCompletion_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project Completion' table."];

// Receivables table
Receivables_addTip=["",spacer+"This option allows all members of the group to add records to the 'Project Receivables' table. A member who adds a record to the table becomes the 'owner' of that record."];

Receivables_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Project Receivables' table."];
Receivables_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Project Receivables' table."];
Receivables_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Project Receivables' table."];
Receivables_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Project Receivables' table."];

Receivables_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Project Receivables' table."];
Receivables_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Project Receivables' table."];
Receivables_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Project Receivables' table."];
Receivables_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Project Receivables' table, regardless of their owner."];

Receivables_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Project Receivables' table."];
Receivables_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Project Receivables' table."];
Receivables_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Project Receivables' table."];
Receivables_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Project Receivables' table."];

// ClaimRecord table
ClaimRecord_addTip=["",spacer+"This option allows all members of the group to add records to the 'Claim Submission' table. A member who adds a record to the table becomes the 'owner' of that record."];

ClaimRecord_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Claim Submission' table."];
ClaimRecord_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Claim Submission' table."];
ClaimRecord_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Claim Submission' table."];
ClaimRecord_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Claim Submission' table."];

ClaimRecord_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Claim Submission' table."];
ClaimRecord_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Claim Submission' table."];
ClaimRecord_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Claim Submission' table."];
ClaimRecord_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Claim Submission' table, regardless of their owner."];

ClaimRecord_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Claim Submission' table."];
ClaimRecord_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Claim Submission' table."];
ClaimRecord_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Claim Submission' table."];
ClaimRecord_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Claim Submission' table."];

// TeamSoftBoard table
TeamSoftBoard_addTip=["",spacer+"This option allows all members of the group to add records to the 'Organization Softboard' table. A member who adds a record to the table becomes the 'owner' of that record."];

TeamSoftBoard_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Organization Softboard' table."];
TeamSoftBoard_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Organization Softboard' table."];
TeamSoftBoard_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Organization Softboard' table."];
TeamSoftBoard_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Organization Softboard' table."];

TeamSoftBoard_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Organization Softboard' table."];
TeamSoftBoard_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Organization Softboard' table."];
TeamSoftBoard_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Organization Softboard' table."];
TeamSoftBoard_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Organization Softboard' table, regardless of their owner."];

TeamSoftBoard_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Organization Softboard' table."];
TeamSoftBoard_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Organization Softboard' table."];
TeamSoftBoard_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Organization Softboard' table."];
TeamSoftBoard_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Organization Softboard' table."];

// SoftboardComment table
SoftboardComment_addTip=["",spacer+"This option allows all members of the group to add records to the 'Softboard Comment' table. A member who adds a record to the table becomes the 'owner' of that record."];

SoftboardComment_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Softboard Comment' table."];
SoftboardComment_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Softboard Comment' table."];
SoftboardComment_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Softboard Comment' table."];
SoftboardComment_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Softboard Comment' table."];

SoftboardComment_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Softboard Comment' table."];
SoftboardComment_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Softboard Comment' table."];
SoftboardComment_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Softboard Comment' table."];
SoftboardComment_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Softboard Comment' table, regardless of their owner."];

SoftboardComment_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Softboard Comment' table."];
SoftboardComment_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Softboard Comment' table."];
SoftboardComment_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Softboard Comment' table."];
SoftboardComment_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Softboard Comment' table."];

// IMSReport table
IMSReport_addTip=["",spacer+"This option allows all members of the group to add records to the 'IMS Complaint Report' table. A member who adds a record to the table becomes the 'owner' of that record."];

IMSReport_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'IMS Complaint Report' table."];
IMSReport_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'IMS Complaint Report' table."];
IMSReport_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'IMS Complaint Report' table."];
IMSReport_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'IMS Complaint Report' table."];

IMSReport_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'IMS Complaint Report' table."];
IMSReport_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'IMS Complaint Report' table."];
IMSReport_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'IMS Complaint Report' table."];
IMSReport_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'IMS Complaint Report' table, regardless of their owner."];

IMSReport_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'IMS Complaint Report' table."];
IMSReport_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'IMS Complaint Report' table."];
IMSReport_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'IMS Complaint Report' table."];
IMSReport_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'IMS Complaint Report' table."];

// ReportComment table
ReportComment_addTip=["",spacer+"This option allows all members of the group to add records to the 'Report Comment' table. A member who adds a record to the table becomes the 'owner' of that record."];

ReportComment_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Report Comment' table."];
ReportComment_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Report Comment' table."];
ReportComment_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Report Comment' table."];
ReportComment_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Report Comment' table."];

ReportComment_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Report Comment' table."];
ReportComment_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Report Comment' table."];
ReportComment_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Report Comment' table."];
ReportComment_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Report Comment' table, regardless of their owner."];

ReportComment_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Report Comment' table."];
ReportComment_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Report Comment' table."];
ReportComment_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Report Comment' table."];
ReportComment_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Report Comment' table."];

// Leadership table
Leadership_addTip=["",spacer+"This option allows all members of the group to add records to the 'Review & Verification' table. A member who adds a record to the table becomes the 'owner' of that record."];

Leadership_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Review & Verification' table."];
Leadership_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Review & Verification' table."];
Leadership_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Review & Verification' table."];
Leadership_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Review & Verification' table."];

Leadership_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Review & Verification' table."];
Leadership_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Review & Verification' table."];
Leadership_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Review & Verification' table."];
Leadership_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Review & Verification' table, regardless of their owner."];

Leadership_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Review & Verification' table."];
Leadership_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Review & Verification' table."];
Leadership_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Review & Verification' table."];
Leadership_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Review & Verification' table."];

// Approval table
Approval_addTip=["",spacer+"This option allows all members of the group to add records to the 'Approval' table. A member who adds a record to the table becomes the 'owner' of that record."];

Approval_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Approval' table."];
Approval_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Approval' table."];
Approval_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Approval' table."];
Approval_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Approval' table."];

Approval_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Approval' table."];
Approval_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Approval' table."];
Approval_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Approval' table."];
Approval_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Approval' table, regardless of their owner."];

Approval_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Approval' table."];
Approval_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Approval' table."];
Approval_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Approval' table."];
Approval_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Approval' table."];

// IMSControl table
IMSControl_addTip=["",spacer+"This option allows all members of the group to add records to the 'IMS Control' table. A member who adds a record to the table becomes the 'owner' of that record."];

IMSControl_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'IMS Control' table."];
IMSControl_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'IMS Control' table."];
IMSControl_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'IMS Control' table."];
IMSControl_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'IMS Control' table."];

IMSControl_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'IMS Control' table."];
IMSControl_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'IMS Control' table."];
IMSControl_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'IMS Control' table."];
IMSControl_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'IMS Control' table, regardless of their owner."];

IMSControl_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'IMS Control' table."];
IMSControl_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'IMS Control' table."];
IMSControl_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'IMS Control' table."];
IMSControl_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'IMS Control' table."];

// membership_company table
membership_company_addTip=["",spacer+"This option allows all members of the group to add records to the 'Company' table. A member who adds a record to the table becomes the 'owner' of that record."];

membership_company_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Company' table."];
membership_company_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Company' table."];
membership_company_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Company' table."];
membership_company_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Company' table."];

membership_company_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Company' table."];
membership_company_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Company' table."];
membership_company_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Company' table."];
membership_company_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Company' table, regardless of their owner."];

membership_company_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Company' table."];
membership_company_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Company' table."];
membership_company_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Company' table."];
membership_company_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Company' table."];

// kpi table
kpi_addTip=["",spacer+"This option allows all members of the group to add records to the 'KPI' table. A member who adds a record to the table becomes the 'owner' of that record."];

kpi_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'KPI' table."];
kpi_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'KPI' table."];
kpi_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'KPI' table."];
kpi_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'KPI' table."];

kpi_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'KPI' table."];
kpi_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'KPI' table."];
kpi_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'KPI' table."];
kpi_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'KPI' table, regardless of their owner."];

kpi_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'KPI' table."];
kpi_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'KPI' table."];
kpi_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'KPI' table."];
kpi_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'KPI' table."];

// summary_dashboard table
summary_dashboard_addTip=["",spacer+"This option allows all members of the group to add records to the 'Summary Dashboard' table. A member who adds a record to the table becomes the 'owner' of that record."];

summary_dashboard_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Summary Dashboard' table."];
summary_dashboard_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Summary Dashboard' table."];
summary_dashboard_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Summary Dashboard' table."];
summary_dashboard_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Summary Dashboard' table."];

summary_dashboard_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Summary Dashboard' table."];
summary_dashboard_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Summary Dashboard' table."];
summary_dashboard_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Summary Dashboard' table."];
summary_dashboard_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Summary Dashboard' table, regardless of their owner."];

summary_dashboard_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Summary Dashboard' table."];
summary_dashboard_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Summary Dashboard' table."];
summary_dashboard_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Summary Dashboard' table."];
summary_dashboard_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Summary Dashboard' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
