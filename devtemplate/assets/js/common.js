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
});