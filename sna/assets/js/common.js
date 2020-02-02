$j(document).ready(function(){
    $j("#adminActions").click(function(){
        $j(".adminButtons").toggleClass("show");
    });
    $j("#fab1").click(function(){
        $j("#fab1_content").toggleClass("show");
    });
    $j("#fab2").click(function(){
        $j("#fab2_content").toggleClass("show");
    });

    $j("#mobile_menu").click(function(){
        $j("#left_sidebar").toggleClass("show");
        $j("#mobile_menu i").toggleClass("ti-menu ti-close");
    });
    $j("#sidebarnav li").click(function(e){
        if(!['fullsearchicon', 'mfullsearchicon', 'searchText', 'msearchText'].includes(event.target.id)){
            $j("a").not(this).attr("aria-expanded","false");
            $j(this).find("a").attr("aria-expanded","true");
            $j(this).find("ul").attr("aria-expanded","true").toggleClass("in");
        }
    });
});
