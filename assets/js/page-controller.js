$(document).ready(function () {
    $("#main-content").load("pages/dashboard.php");
});

$(".nav-link").click(function (e) { 
    e.preventDefault();
    let navlinkId = $(this).attr("id");
    $(".nav-link").removeClass("active");
    $(this).addClass("active");

    console.log(navlinkId);
    if(navlinkId === "dashboard"){
        $("#main-content").load("pages/dashboard.php");
    }else if(navlinkId === "log-data"){
        $("#main-content").load("pages/log-data.php");
    }
});