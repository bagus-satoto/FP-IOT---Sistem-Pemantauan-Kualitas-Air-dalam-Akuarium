const detail_quality = {
    "baik" : "Air Layak Dikonsumsi",
    "cukup" : "Air Masih Layak Dikonsumsi",
    "buruk" : "Air Berbahaya Dikonsumsi"
}

function autoReload(){
    setInterval(function(){
        updateInfoBox();
        updateDataChartPh();
        updateDataChartTds();
    },2000);
}
autoReload();

function updateInfoBox(){
    $.getJSON("data/fuzzy-data.php",function (data) {
        $.ajax({
            type: "POST",
            url: "assets/fuzzy-logic/get-final-status.php",
            data: {
                "fuzzy-value-in" : data[0].fuzzy_result
            },
            success: function (response) {
                //setting color of water quality box
                if(response === "baik"){
                    if($("#water-quality-box").hasClass("bg-warning")){
                        $("#water-quality-box").removeClass("bg-warning");
                    }else if($("#water-quality-box").hasClass("bg-danger")){
                        $("#water-quality-box").removeClass("bg-danger");
                    }
                    $("#water-quality-box").addClass("bg-success");
                }else if(response === "cukup"){
                    //setting color of water quality box
                    if($("#water-quality-box").hasClass("bg-success")){
                        $("#water-quality-box").removeClass("bg-success");
                    }else if($("#water-quality-box").hasClass("bg-danger")){
                        $("#water-quality-box").removeClass("bg-danger");
                    }
                    $("#water-quality-box").addClass("bg-warning");
                }else if(response === "buruk"){
                    //setting color of water quality box
                    if($("#water-quality-box").hasClass("bg-success")){
                        $("#water-quality-box").removeClass("bg-success");
                    }else if($("#water-quality-box").hasClass("bg-warning")){
                        $("#water-quality-box").removeClass("bg-warning");
                    }
                    $("#water-quality-box").addClass("bg-danger");
                }
    
                let water_quality_detail;
                if(response === "baik"){
                    water_quality_detail = detail_quality.baik;
                }else if(response === "cukup"){
                    water_quality_detail = detail_quality.cukup;
                }else if( response === "buruk"){
                    water_quality_detail = detail_quality.buruk;
                }
    
                $("#ph-value").html(data[0].ph);
                $("#tds-value").html(data[0].tds);
                $("#water-quality").html(response.toUpperCase());
                $("#quality-detail").html(water_quality_detail);
    
            },
            error : function(xhr, thrownError) {
                console.log ('error');
                console.log(xhr.status);
                console.log(thrownError);
            },
        });
    });
}

function updateDataChartPh(){
    $.getJSON("data/chart-data.php",function (data) {
        //plot data to array
        let ph_data = [];
        for(i=0;i<data.length; i++){
            ph_data.push([i, data[i].ph]);
        }

        //data to json
        let line_data_ph = {
            "data" : ph_data,
            "color" : '#3c8dbc'
        }

        //setup flot chart
        $.plot('#line-chart-ph', [line_data_ph], {
            grid  : {
              hoverable  : true,
              borderColor: '#f3f3f3',
              borderWidth: 1,
              tickColor  : '#f3f3f3'
            },
            series: {
              shadowSize: 0,
              lines     : {
                show: true
              },
              points    : {
                show: true
              }
            },
            lines : {
              fill : false,
              color: ['#3c8dbc', '#f56954']
            },
            yaxis : {
              show: true
            },
            xaxis : {
              show: true
            }
          });
    });
}

function updateDataChartTds(){
    $.getJSON("data/chart-data.php",function (data) {
        //plot data to array
        let tds_data = [];
        for(i=0;i<data.length; i++){
            tds_data.push([i, data[i].tds]);
        }

        //data to json
        let line_data_tds = {
            "data" : tds_data,
            "color" : '#3c8dbc'
        }

        //setup flot chart
        $.plot('#line-chart-tds', [line_data_tds], {
            grid  : {
              hoverable  : true,
              borderColor: '#f3f3f3',
              borderWidth: 1,
              tickColor  : '#f3f3f3'
            },
            series: {
              shadowSize: 0,
              lines     : {
                show: true
              },
              points    : {
                show: true
              }
            },
            lines : {
              fill : false,
              color: ['#3c8dbc', '#f56954']
            },
            yaxis : {
              show: true
            },
            xaxis : {
              show: true
            }
          });
    });
}