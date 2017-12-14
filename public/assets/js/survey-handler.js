var tableSurveys;
var thisStudyId;

var surveyRoutes = {
    listSurvey: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/byStudy/{id}",
    addSurvey: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/add",
    updateSurvey: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/update",
    deleteSurvey: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/delete/{id}"
};

function InitSurveyInfo(studyId) {
    thisStudyId = studyId;
    tableSurveys = $('#tblSurveys')
            .on('xhr.dt', function (e, settings, json, xhr) { // To test the Ajax_output
                console.log(json);
            })
            .DataTable(
            {
                "processing": true,
                "ajax": {
                    "url": surveyRoutes.listSurvey.replace("{id}", thisStudyId),
                    "dataSrc": function (json) {
                        var filteredSurveys = [];
                        var length = json.Messages.length;
                        for (var i = 0 ; i < length ; i++) {
                            if (json.Messages[i].type == MESSAGE_TYPE.SURVEY) {
                                filteredSurveys.push(json.Messages[i]);
                            }
                        }
                        return filteredSurveys;
                    }
                },
                "columns": [
                    { "defaultContent": " <a href='#' id='selectSurvey'><span class='glyphicon glyphicon-expand'></span>Show Details</a>", "autoWidth": false, "orderable": false },
                    { "data": 'text.message' },
                    { "data": 'LastSent' },
                    { "defaultContent": " <a href='#' id='editSurvey'><span class='glyphicon glyphicon-edit'></span> Edit</a>  ", "autoWidth": false, "orderable": false },
                ]
            });

    //setting up filter
    $('.dataTables_filter input').attr("type", "search");

    // See Survey Details
    $('#tblSurveys tbody').on('click', '#selectSurvey', function () {
        var tr = $(this).closest('tr');
        var row = tableSurveys.row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            $(this).html("<span class='glyphicon glyphicon glyphicon-expand'></span> Show Details");
        }
        else {
            // Open this row
            row.child(GetSurveyDetails(row.data())).show();
            $(this).html("<span class='glyphicon glyphicon-collapse-down'></span> Hide Details");
        }
    });

    //Edit Survey
    //TODO: send to new page with survey id and poplate controls there.
    $('#tblSurveys tbody').on('click', '#editSurvey', function (e) {
        // e.preventDefault();
        //this will redirect us in same window
        var tr = $(this).closest('tr');
        var row = tableSurveys.row(tr);
        var selectedSurvey = row.data();  

        $("#surveysContent").load("EditSurvey.html #editSurveycontainer");
        setTimeout(function () {
            InitSurveyEdit(selectedSurvey, thisStudyId);
        }, 50);
    });

    $('#tblSurveys tbody').on('click', '#btnViewSurveyResponses', function (e) {
        // e.preventDefault();
        //this will redirect us in same window
        var tr = $(this).closest('tr');
        var parenttr = $(this).closest('tr').parents('tr').prev();
        var row = tableSurveys.row(parenttr);
        var selectedSurvey = row.data();
        $("#surveysContent").load("/assets/js/StudySurveyResponses.html #studyResponseContainer");
        setTimeout(function () {
            InitSurveyResponseDetail(selectedSurvey.id, selectedSurvey.text.message); //pass survey id and survey title
        }, 50);
    });

    $('#tblSurveys tbody').on('click', '#btnDeleteSurvey', function (e) {
        // e.preventDefault();
        //this will redirect us in same window
        var tr = $(this).closest('tr');
        var parenttr = $(this).closest('tr').parents('tr').prev();
        var row = tableSurveys.row(parenttr);
        var selectedSurvey = row.data();
        
        var deleteUrl = surveyRoutes.deleteSurvey.replace("{id}", selectedSurvey.id);

        $.ajax({
            type: 'GET',
            url: deleteUrl,
            success: function (res) {
                if (res.status == 'ok') {
                    tblSurveys.ajax.reload();
                } else {
                    console.log(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });

    $("#btnAddSurvey").click(function () {
        $("#surveysContent").load("/assets/js/SurveyDetails.html #surveydetailcontainer");
        setTimeout(function () {
            InitSurveyDetail(studyId,"new");
        }, 50);
    });
}
function GetSurveyDetails(surveyData) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:10%;">' +
        '<tr>' +
            '<td><b>Survey Description:</b></td>' +
            '<td>' + surveyData.text.survey.survey_desc + '</td>' +
        '</tr>' +
         '<tr>' +
            '<td><b>Survey Instructions:</b></td>' +
            '<td>' + surveyData.text.survey.survey_instruction + '</td>' +
        '</tr>' +
        '<tr>' +
            '<td><b>No. Of Questions:</b></td>' +
            '<td>' + surveyData.text.survey.number_of_questions + '</td>' +
        '</tr>' +
         '<tr>' +
            '<td>' +
          '<button id="btnViewSurveyResponses" type="button" class="btn btn-success">View Survey Responses&nbsp;&nbsp;<i class="glyphicon glyphicon-info-sign"></i></button>' +
          '</td>' +
         '<td>' +
          '<button id="btnDeleteSurvey" type="button" class="btn btn-danger">Delete Survey&nbsp;&nbsp;<i class="glyphicon glyphicon-trash"></i></button>' +
          '</td>' +
         '</tr>' +
    '<tr><br/></tr>' +
'</table>';
}


