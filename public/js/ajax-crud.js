var _PremiumApiBaseURL = 'http://api.worldweatheronline.com/premium/v1/';
var _PremiumApiKey = '291610860f7e478b90b95310160905';
$(document).ready(function() {
    $("#btn-save").attr('disabled', 'disabled');
    var url = "/ajax-crud/public/cities";
    //display modal form for task editing
    $("#tasks-list").on("click", ".open-modal", function() {
        var city_id = $(this).val();
        $.get(url + '/' + city_id, function(data) {
            //success data
            console.log(data);
            $('#city_id').val(data.id);
            $('#cityname').val(data.cityname);
            $('#pincode').val(data.pincode);
            $('#cloudcover').val(data.cloudcover);
            $('#humidity').val(data.humidity);
            $('#temp_C').val(data.temp_C);
            $('#visibility').val(data.visibility);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
        })
    });
    //display modal form for creating new task
    $(".container-narrow").on("click", "#btn-add", function() {

        $('#btn-save').val("add");
        $('#frmTasks').trigger("reset");
        $('#myModal').modal('show');
    });
    //delete city and remove it from list
        $("#tasks-list").on("click", ".delete-task", function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        var city_id = $(this).val();
        $.ajax({
            type: "DELETE",
            url: url + '/' + city_id,
            success: function(data) {
                console.log(data);
                $("#city" + city_id).remove();
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });
    $("#getCurrentweather").click(function(e) {
        if ($('#cityname').val() != "") {
            GetLocalWeather($('#cityname').val());
        } else {
            alert("Please Enter City Name first");
        }
        e.preventDefault();
    });
    //create new City / update existing city Weather
    $("#btn-save").click(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault();
        if ($('#cityname').val() != "" && $('#pincode').val() != "") {
            var formData = {
                    cityname: $('#cityname').val(),
                    pincode: $('#pincode').val(),
                    cloudcover: $('#cloudcover').val(),
                    humidity: $('#humidity').val(),
                    temp_C: $('#temp_C').val(),
                    visibility: $('#visibility').val()
                }
                //used to determine the http verb to use [add=POST], [update=PUT]
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var city_id = $('#city_id').val();;
            var my_url = url;
            if (state == "update") {
                type = "PUT"; //for updating existing resource
                my_url += '/' + city_id;
            }
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function(data) {

                    console.log(data.cloudcover);
                    var cityname = '<tr id="city' + data.id + '">' +
                        '<td>' + data.id + '</td>' +
                        '<td>' + data.cityname + '</td>' +
                        '<td>' + data.pincode + '</td>' +
                        '<td>' + data.cloudcover + '</td>' +
                        '<td>' + data.humidity + '</td>' +
                        '<td>' + data.temp_C + '</td>' +
                        '<td>' + data.visibility + '</td>' +
                        '<td>' + data.created_at + '</td>';
                    cityname += '<td>'+
                '<button class="btn btn-warning btn-xs btn-detail open-modal" value="' +
                 data.id + '"> Edit </button>';
                    cityname += '<button class="btn btn-danger btn-xs btn-delete delete-task" value="' +
                    data.id + '">Delete</button>'+

                    '</td></tr>';
                    console.log(cityname);

                    if (state == "add") { //if user added a new record
                        $('#tasks-list').append(cityname);
                    } else { //if user updated an existing record
                        $("#city" + city_id).replaceWith(cityname);
                    }

                   $('#frmTasks').trigger("reset");

                 $('.modal').modal('hide');

                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        } else {
            alert('City Name and Pincode Compulsary');
        }
    });

//$("#tasks-list").on("click", "#myalert", function() { alert('hii'); } );

});

//Calling laravel with ajax

function GetLocalWeather(city_name) {
     var url = "/ajax-crud/public/cities";

      $.get(url + '/weather/' + city_name, function(localWeather) {
        console.log('nilesh');
$('#cloudcover').val(localWeather.data.current_condition[0].cloudcover);
    $('#humidity').val(localWeather.data.current_condition[0].humidity);
    $('#temp_C').val(localWeather.data.current_condition[0].temp_C);
    $('#visibility').val(localWeather.data.current_condition[0].weatherDesc[0].value);
     $("#btn-save").removeAttr('disabled');
      });


}
/*
function LocalWeatherCallback(localWeather) {
    $('#cloudcover').val(localWeather.data.current_condition[0].cloudcover);
    $('#humidity').val(localWeather.data.current_condition[0].humidity);
    $('#temp_C').val(localWeather.data.current_condition[0].temp_C);
    $('#visibility').val(localWeather.data.current_condition[0].weatherDesc[0].value);
}

function JSONP_LocalWeather(input) {
    var url = _PremiumApiBaseURL + 'weather.ashx?q=' + input.query + '&format=' + input.format + '&extra=' + input.extra + '&num_of_days=' + input.num_of_days + '&date=' + input.date + '&fx=' + input.fx + '&tp=' + input.tp + '&cc=' + input.cc + '&includelocation=' + input.includelocation + '&show_comments=' + input.show_comments + '&key=' + _PremiumApiKey;
    jsonP(url, input.callback);
}
// Helper Method
function jsonP(url, callback) {
    $.ajax({
        type: 'GET',
        url: url,
        async: false,
        contentType: "application/json",
        jsonpCallback: callback,
        dataType: 'jsonp',
        success: function(json) {
            $("#btn-save").removeAttr('disabled');
        },
        error: function(e) {
            console.log(e.message);
        }
    });
}*/


