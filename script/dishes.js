function selectMomo(){
    var x = document.getElementById("momo").value;
    $.ajax({
        url:"showData.php",
        method: "POST",
        data:{
            id : x
        },
        success : function(data){
            $("#ans").html(data);
        }
    })
}
function selectChowmein(){
    var x = document.getElementById("chowmein").value;
    $.ajax({
        url:"showData.php",
        method: "POST",
        data:{
            id : x
        },
        success : function(data){
            $("#ans").html(data);
        }
    })
}
function selectPizza(){
    var x = document.getElementById("pizza").value;
    $.ajax({
        url:"showData.php",
        method: "POST",
        data:{
            id : x
        },
        success : function(data){
            $("#ans").html(data);
        }
    })
}
function selectBurger(){
    var x = document.getElementById("burger").value;
    $.ajax({
        url:"showData.php",
        method: "POST",
        data:{
            id : x
        },
        success : function(data){
            $("#ans").html(data);
        }
    })
}