function toggle(obj_a,obj_b) {
    $(document).ready(function(){
    $(obj_a).click(function(){
        $(obj_b).slideToggle();
    });
}); 
}