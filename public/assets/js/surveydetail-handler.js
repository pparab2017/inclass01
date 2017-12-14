
var thisStudyId;
var questionCount = 0;
var questionsList = [];
var addSurvey = "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/add"

function InitSurveyDetail(studyid, surveyid) {

    console.log(studyid + surveyid);
    //get selected study id
    thisStudyId = studyid;
    //Adding a blank Question Row on page load.
    var rowKey = "row" + questionCount;
    console.log("rtrying to bind");
    AddNewRowHtml(rowKey);

    BindQuestionAddButtonEvents();

    $("#btnBack").click(function () {
        $("#surveysContent").load("/assets/js/SurveyInformation.html #surveycontainer");
        setTimeout(function () {
            InitSurveyInfo(thisStudyId);
        }, 50);
    });

    //Save Survey
    $('#submitSurvey').click(function () {
        var objToPost = GetObjectToPost("add");
        console.log(objToPost);
        $.ajax({
            type: 'POST',
            url: addSurvey,
            data: objToPost,
            success: function (res) {
                if (res.status == "ok") {
                    $("#surveysContent").load("/assets/js/SurveyInformation.html #surveycontainer");
                    setTimeout(function () {
                        InitSurveyInfo(thisStudyId);
                    }, 50);
                } else {
                    $("#errorTextSurvey").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });
}

function BindQuestionAddButtonEvents() {

    console.log("binding events");
    //delete question row.
    $("#questionList > .row").on('click', '.btn-danger', function () {
        var rowKey = $(this).closest(".row").attr("id");
        console.log(rowKey);
        for (var i = 0; i < questionsList.length; i++) {
            if (questionsList[i].htmlIndex == rowKey)
                questionsList.splice(i, 1);
        }
        //delete questionsList[rowKey];
        console.log(questionsList);
        $("#no-of-questions").val(questionsList.length);
        $("#questionList").find("#" + rowKey).remove();
    });
    //save question row.
    $("#questionList > .row").on('click', '.btn-success', function () {
        console.log("ddfdfdf");
        var quesType = $(this).closest(".row").find("#question-type").val();
        var quesText = $(this).closest(".row").find("#question-text").val();
        var choices = "";
        var choicesCount = 0;
        if (quesType == QUESTION_TYPE.MCQ) {
            choices = $(this).closest(".row").find("#question-choices").val();
            if (choices != null || choices != "") {
                choicesCount = choices.split("|").length;
            }
        }
        //save question in array
        var rowKey = "row" + questionCount;
        var newSurveyQuestion = new SurveyQuestion(quesType, quesText, choicesCount, choices, "", rowKey);

        questionsList.push(newSurveyQuestion);

        console.log(questionsList);

        $("#no-of-questions").val(questionsList.length);
        //add new blank row
        questionCount++;
        var newRowKey = "row" + questionCount;
        AddNewRowHtml(newRowKey);
        $(this).attr("disabled", true);
        $(this).closest(".row").find(".btn-danger").attr("disabled", false);
    });
    //change event for question type
    $("#questionList > .row").on('change', 'select', function () {
        console.log("refrete");
        if ($(this).val() == QUESTION_TYPE.MCQ) {
            $(this).closest(".row").find('#question-choices').attr("disabled", false);
            $(this).closest(".row").find('#question-choices').val("");
        }
        if ($(this).val() == QUESTION_TYPE.TEXT) {
            $(this).closest(".row").find('#question-choices').attr("disabled", true);
            $(this).closest(".row").find('#question-choices').val("");
        }
    });
}
function AddNewRowHtml(rowKey) {
    //add empty question row
    var questionHtml = GetBlankQuestionRow(rowKey);
    $("#questionList").append(questionHtml);
    console.log("rer");

}


function GetBlankQuestionRow(rowKey) {
    return '<div class="row well" id="' + rowKey + '">' +
                    '<div class="col-xs-6">' +
                        '<label>Question Type</label>' +
                        '<select class="form-control" id="question-type" name="question-type">' +
                            '<option value="TEXT" selected>TEXT</option>' +
                            '<option value="MCQ">MCQ</option>' +
                       ' </select>' +
                    '</div>' +
                   ' <br />' +
                    '<div class="col-xs-12">' +
                        '<label>Question</label>' +
                        '<input class="form-control" type="text" id="question-text" name="question-text" placeholder="Enter Question">' +
                    '</div>' +
                    '<br />' +
                    '<div class="col-xs-12">' +
                        '<label>Choices</label>&nbsp;&nbsp;<small>enter | separated choices.</small>' +
                        '<input class="form-control" type="text" id="question-choices" name="question-choices" placeholder="Enter Choices ex: Yes|No" disabled>' +
                    '</div>' +
                   ' <br /><div class="col-xs-12"></div>' +
                   '<div class="col-xs-3 col-xs-offset-6">' +
                       ' <button id="btnAddQuestion" type="button" class="btn btn-success" type="submit">' +
                            '<i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;SAVE' +
                        '</button> &nbsp;&nbsp;&nbsp;' +
                        '<button id="btnDeleteQuestion" type="button" class="btn btn-danger" disabled>' +
                            '<i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;DELETE' +
                       ' </button>' +
                    '</div>' +
             '</div>';
}


function BindSurveyEvents() {
    //Coordinator button clicks
    $("#submitSurvey").unbind();
    $("#updateSurvey").unbind();
    $("#deleteSurvey").unbind();

    //Add Message
    $('#submitSurvey').click(function () {
        var objToPost = GetSurveyObjectToPost("add");


        console.log(objToPost);
        $.ajax({
            type: 'POST',
            url: surveyRoutes.addSurvey,
            data: objToPost,
            success: function (res) {
                if (res.status == "ok") {
                    tableSurveys.ajax.reload();
                    $('#survey-modal').modal('hide');
                } else {
                    $("#errorTextSurvey").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });

    //Update Existing Message
    $('#updateSurvey').click(function () {
        var objToPost = GetSurveyObjectToPost("update");
        $.ajax({
            type: 'POST',
            url: surveyRoutes.updateSurvey,
            data: objToPost,
            success: function (res) {
                if (res.status == "ok") {
                    tableSurveys.ajax.reload();
                    $('#survey-modal').modal('hide');
                } else {
                    $("#errorTextSurvey").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });

    //Delete Message
    $('#deleteSurvey').click(function () {
        var deleteUrl = surveyRoutes.deleteSurvey.replace("{id}", selectedSurvey.id);
        $.ajax({
            type: 'GET',
            url: deleteUrl,
            success: function (res) {
                if (res.status == "ok") {
                    tableSurveys.ajax.reload();
                    $('#survey-modal').modal('hide');
                } else {
                    $("#errorTextSurvey").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });
}
function ClearSurveyForm() {
    $('#message-type').val("MESSAGE");
    $('#message-text').val("");
    $('#question-choices').val("");
    $('#reminder-type').val("H");
    $('#reminder-time-1').val("");
    $('#reminder-time-2').val("");
    $('#question-choices').attr("disabled", true);
    $('#reminder-time-1').attr("disabled", true);
    $('#reminder-time-2').attr("disabled", true);
    $('#errorTextSurvey').text("");
    selectedSurvey = "";
}
function FormsDoNothing() {
    $('#Survey-form').submit(function (event) {
        event.preventDefault();
    });
}
function GetSurveyObjectToPost(action) {

    var reminderType = "O";
    var msgType = MESSAGE_TYPE.SURVEY;
    var reminderTime = "";

    var surveyTitle = $("#survey-title").val();
    var surveyDescription = $("#survey-description").val();
    var surveyInstruction = $("#survey-instruction").val();
    var noOfQuestions = $("#no-of-questions").val();

    var newSurey = new Survey(surveyTitle, surveyDescription, surveyInstruction, questionsList.length, questionsList);
    console.log((newSurey));

    var newMessage = new Message(msgType, surveyTitle, 0, "", "", newSurey);
    console.log((newMessage));

    if (action == "add") {
        var obj = {
            "text": JSON.stringify(newMessage),
            "reminderType": reminderType,
            "type": msgType,
            "time": reminderTime,
            "studyId": thisStudyId
        };
        console.log(obj);
        return obj;
    }
    else if (action == "update") {
        var obj = {
            "text": JSON.stringify(newMessage),
            "reminderType": reminderType,
            "type": msgType,
            "time": reminderTime,
            "studyId": thisStudyId,
            "id": selectedMessage.id
        };
        console.log(obj);
        return obj;
    }
}