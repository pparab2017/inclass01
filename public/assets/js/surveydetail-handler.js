
var thisStudyId;
var questionCount = 0;
var questionsList = [];
var addSurvey = "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/add"

function InitSurveyDetail(studyid, surveyid) {

    //get selected study id
    thisStudyId = studyid;
    //Adding a blank Question Row on page load.
    var rowKey = "row" + questionCount;
    AddNewRowHtml(rowKey);


    $("#btnBack").click(function () {
        $("#surveysContent").load("/assets/js/SurveyInformation.html #surveycontainer");
        setTimeout(function () {
            InitSurveyInfo(thisStudyId);
        }, 500);
    });

    //Save Survey
    $('#submitSurvey').click(function () {
        //if ($('#SurveyDetail-form')[0].checkValidity()) {
        //    e.preventDefault();
        //    SurveyDetailsFormsDoNothing();

        var objToPost = GetObjectToPost_Method("add");
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
                    }, 500);

                } else {
                    $("#errorTextSurvey").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
        //}
    });
}

function BindQuestionMyEvents() {
    //delete question row.
    $("#addQuestionList > .row").on('click', '.btn-danger', function () {
        var rowKey = $(this).closest(".row").attr("id");
        console.log(rowKey);
        for (var i = 0; i < questionsList.length; i++) {
            if (questionsList[i].htmlIndex == rowKey)
                questionsList.splice(i, 1);
        }
        //delete questionsList[rowKey];
        console.log(questionsList);
        $("#no-of-questions").val(questionsList.length);
        $("#addQuestionList").find("#" + rowKey).remove();
    });
    //save question row.
    $("#addQuestionList > .row").on('click', '.btn-success', function () {
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
    $("#addQuestionList > .row").on('change', 'select', function () {
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
    // SurveyDetailsFormsDoNothing();
    var questionHtml = GetBlankQuestionRow(rowKey);
    $("#addQuestionList").append(questionHtml);
    BindQuestionMyEvents();
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
function SurveyDetailsFormsDoNothing() {
    $('#SurveyDetail-form').submit(function (event) {
        event.preventDefault();
    });
}
function GetObjectToPost_Method(action) {

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