function add_div_mand( x ){

    //alert(x);
    document.getElementById('mandatory'+x).style.display = "";
    document.getElementById(x).required = true;

}

function del_div_mand( x ){

    //alert(x);
    document.getElementById('mandatory'+x).style.display = "none";
    document.getElementById(x).required = false;
    document.getElementById(x).value = "";
    document.getElementById('checkbox'+x).checked = false;

}