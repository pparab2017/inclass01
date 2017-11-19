
var selectedQuestion;
var tableLogs;

var logRoutes = {
    responseLogs: "{{path_for('admin.messageLog')}}"
};

$(document).ready(function () {

   
    tableLogs = $('#tblResponses')
            .on('xhr.dt', function (e, settings, json, xhr) { // To test the Ajax_output
                console.log(json);
            })
            .DataTable(
            {
                "processing": true,
                "ajax": {
                    "url": logRoutes.responseLogs,
                    "dataSrc": function (json) {
                        var length = json.length;
                        for (var i = 0 ; i < length ; i++) {
                            if (json[i]["type"] == "H")
                                json[i]["TypeText"] = "Hourly";
                            else if (json[i]["type"] == "O")
                                json[i]["TypeText"] = "Once A Day";
                            else if (json[i]["type"] == "T")
                                json[i]["TypeText"] = "Twice A Day";

                            json[i]["UserName"] = json[i]["Fname"] + " " + json[i]["Lname"];
                        }
                        return json;
                    }
                },
                "columns": [
                    { "data": 'Text' },
                    { "data": 'choises' },
                    { "data": 'TypeText' },
                    { "data": 'UserName' },
                    { "data": 'Response' },
                    { "data": 'LastSentTime'},
                   // { "defaultContent": " <a href='#' id='editQuestion' class='selectUser' data-toggle='modal' data-target='.bd-question-modal-lg'><span class='glyphicon glyphicon-edit'></span> Edit  </a>  ", "autoWidth": true, "orderable": false }
                ]
            });
    $('.dataTables_filter input').attr("type", "search");
    $('#btnRefreshLogs').click(function () {
        tableLogs.ajax.reload();
    });
});

