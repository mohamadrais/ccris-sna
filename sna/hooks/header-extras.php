<?php
    global $adminConfig;
    if(getLoggedMemberID() != $adminConfig['anonymousMember']){
        include($currDir."/templates/Print_letterhead.php");
        echo print_letterhead();
    }
?>
