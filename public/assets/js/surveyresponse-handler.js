var thisSurveyId;
var selectedUserResponse;
var surveyResponsesUrl = "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/response/survey/{id}"

function InitSurveyResponseDetail(surveyid, surveyTitle) {

    //get selected study id
    thisSurveyId = surveyid;
    $("#surveyResponsesPanelHeader").html("Survey Title: " + surveyTitle);

    $("#btnBackToSurveys").click(function () {
        $("#surveysContent").load("SurveyInformation.html #surveycontainer");
        setTimeout(function () {
            InitSurveyInfo(thisStudyId);
        }, 50);
    });

    tableSurveyResponses = $('#tblSurveyResponses')
           .on('xhr.dt', function (e, settings, json, xhr) { // To test the Ajax_output
               console.log(json);
           })
           .DataTable(
           {
               "processing": true,
               "ajax": {
                   "url": surveyResponsesUrl.replace("{id}", thisSurveyId),
                   "dataSrc": function (json) {
                       var filteredSurveys = [];
                       var length = json.Messages.length;
                       for (var i = 0 ; i < length ; i++) {
                           if (json.Messages[i].response_text.message_type == MESSAGE_TYPE.SURVEY) {
                               json.Messages[i]["user_name"] = json.Messages[i].fname + " " + json.Messages[i].lname;
                               json.Messages[i]["responded"] = json.Messages[i].response_text != "" ? "Yes" : "No";
                               json.Messages[i]["opened_at"] = json.Messages[i].opened_at == null ? "" : json.Messages[i].opened_at;
                               filteredSurveys.push(json.Messages[i]);
                           }
                       }
                       return filteredSurveys;
                   }
               },
               "columns": [
                   { "data": 'user_name' },
                   { "data": 'opened_at' },
                   { "data": 'responded' },
                   { "defaultContent": " <a href='#' id='viewAllResponses' data-toggle='modal' data-target='.bd-surveyresponse-modal-lg' data-keyboard='false' data-backdrop='static'><span class='glyphicon glyphicon-info-show'></span> View Responses</a>  ", "autoWidth": false, "orderable": false },
               ]
           });

    //setting up filter
    $('.dataTables_filter input').attr("type", "search");

   // var responseTable;
    $('#tblSurveyResponses tbody').on('click', '#viewAllResponses', function (e) {

        e.preventDefault();
        var tr = $(this).closest('tr');
        //var parenttr = $(this).parents('tr').prev();
        var row = tableSurveyResponses.row(tr);
        selectedUserResponse = row.data();
        var questionsListWithResponses = selectedUserResponse.response_text.survey.questions;
        $("#surveyresponsePanelHeader").text(selectedUserResponse.user_name + "'s Responses");

        var responseTable = $('#tblUserResponses').DataTable(
         {
             "destroy": true,
             "processing": true,
             "data": questionsListWithResponses,
             "columns": [
                 { "defaultContent": " ", "autoWidth": false, "orderable": false },
                 {"data":  'question_type'},
                 { "data": 'question_text' },
                 { "data": 'question_choices'},
                 { "data": 'response' }
             ],
             "order": [[1, 'asc']]
         });
        responseTable.on('order.dt search.dt', function () {
            responseTable.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });
}
//function BindQuestion(question) {
//    var questionText = "QuestionA";
//    var choices = "1|2|3|4";
//    var response = "1";
//    var questionHtml = '<div class="row">' +
//                                '<div class="col-xs-12">' +
//                                    '<label>Question - </label>' +
//                                    '<label>Choices - </label>' +
//                                    '<label>Response</label>' +
//                                '</div>' +
//                            '</div>'
//    return questionHtml;
//}