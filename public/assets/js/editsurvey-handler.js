var objSurvey;
var thisStudyId;
var editQuestionsList = [];
var selectedQuestionForEdit;
var tableEditSurveyQuestions;
var updateSurvey = "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/update/{id}"
function InitSurveyEdit(surveyToEdit, studyId) {

    //get selected study id
    objSurvey = surveyToEdit
    thisStudyId = studyId
    BindPageControls();

    $("#btnBack").click(function () {
        $("#surveysContent").load("SurveyInformation.html #surveycontainer");
        setTimeout(function () {
            InitSurveyInfo(thisStudyId);
        }, 50);
    });

    //Update Survey
    $('#updateSurvey').click(function () {
        var objToPost = GetObjectToPost("update");
        console.log(objToPost);
        $.ajax({
            type: 'POST',
            url: addSurvey,
            data: objToPost,
            success: function (res) {
                if (res.status == "ok") {
                    //go back to survey list after update.
                    $("#surveysContent").load("SurveyInformation.html #surveycontainer");
                    setTimeout(function () {
                        InitSurveyInfo(thisStudyId);
                    }, 50);

                } else {
                    $("#errorTextEditSurvey").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });
    $("#btnAddNewQuestionToSurvey").click(function () {
        $("#editQuestionModalHeader").text("Add New Question");
        ClearQuestionForm();
        $('#btnUpdateQuestion').remove();
        $('#btnDeleteQuestion').remove();

        if (!$("#btnAddQuestion").length) {
            var btnAddQuestion = $(' <button type="submit" id="btnAddQuestion" class="btn btn-success">Submit</button>');
            $('#btnContainer-editQuestion').append(btnAddQuestion);
        }
        BindQuestionEvents();
    });
}
function ClearQuestionForm() {
    selectedQuestionForEdit = "";
    $("#question-type").val("TEXT");
    $("#question-text").val("");
    $("#question-choices").val("");
}
function BindPageControls() {
    $("#edit-survey-title").val(objSurvey.text.survey.survey_title);
    $("#edit-survey-description").val(objSurvey.text.survey.survey_desc);
    $("#edit-survey-instruction").val(objSurvey.text.survey.survey_instruction);
    editQuestionsList = objSurvey.text.survey.questions;
    var countQuestions = objSurvey.text.survey.number_of_questions;
    editQuestionsList = objSurvey.text.survey.questions;

    $("#edit-no-of-questions").text(countQuestions);

    tableEditSurveyQuestions = $('#tblEditSurveyQuestions')
        .on('xhr.dt', function (e, settings, json, xhr) { // To test the Ajax_output
            console.log("user responses");
            console.log(json);
        })
        .DataTable(
        {
            "destroy": true,
            "processing": true,
            "data": editQuestionsList,
            "columns": [
                { "defaultContent": "", "autoWidth": false, "orderable": false },
                { "data": 'question_type' },
                { "data": 'question_text' },
                { "data": 'question_choices' },
                { "defaultContent": "<a href='#' id='editSurveyQuestion'><span class='glyphicon glyphicon-edit'></span>Edit</a>  ", "autoWidth": false, "orderable": false },
            ],
            "order": [[1, 'asc']]
        });
    tableEditSurveyQuestions.on('order.dt search.dt', function () {
        tableEditSurveyQuestions.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    $('#tblEditSurveyQuestions .dataTables_filter input').attr("type", "search");
}
function EditQuestionFormsDoNothing() {
    $('#edit-survey-question-form').submit(function (event) {
        event.preventDefault();
    });
}
function BindQuestionEvents() {
    //delete question row.
    $("#edit-survey-question > #btnContainer-editQuestion").on('click', '#btnDeleteQuestion', function (e) {
        for (var i = 0; i < editQuestionsList.length; i++) {
            if (editQuestionsList[i].htmlIndex == selectedQuestionForEdit.htmlIndex)
                editQuestionsList.splice(i, 1);
        }
        console.log(editQuestionsList);
        $("#edit-no-of-questions").val(editQuestionsList.length);
        tableEditSurveyQuestions.reload();
    });
    //save question row.
    $("#edit-survey-question > #btnContainer-editQuestion").on('click', '#btnAddQuestion', function (e) {
        if ($('#edit-survey-question-form')[0].checkValidity()) {
            e.preventDefault();
            EditQuestionFormsDoNothing();

            var quesType = $("#edit-question-type").val();
            var quesText = $(this).closest(".row").find("#edit-question-text").val();
            var choices = "";
            var choicesCount = 0;
            if (quesType == QUESTION_TYPE.MCQ) {
                choices = $("#edit-question-choices").val();
                if (choices != null || choices != "") {
                    choicesCount = choices.split("|").length;
                }
            }
            //save question in array

            for (var i = 0; i < editQuestionsList.length; i++) {
                if (editQuestionsList[i].htmlIndex == selectedQuestionForEdit.htmlIndex)
                    editQuestionsList[i].question_type = quesType;
                    editQuestionsList[i].question_text = quesText;
                    editQuestionsList[i].number_of_choices = choicesCount;
                    editQuestionsList[i].question_choices = choices;
                    console.log(editQuestionsList[i]);
            }
        }
    });
    //update question row.
    $("#edit-survey-question > #btnContainer-editQuestion").on('click', '#btnUpdateQuestion', function (e) {
        if ($('#edit-survey-question-form')[0].checkValidity()) {
            e.preventDefault();
            EditQuestionFormsDoNothing();

            var quesType = $("#edit-question-type").val();
            var quesText = $(this).closest(".row").find("#edit-question-text").val();
            var choices = "";
            var choicesCount = 0;
            if (quesType == QUESTION_TYPE.MCQ) {
                choices = $("#edit-question-choices").val();
                if (choices != null || choices != "") {
                    choicesCount = choices.split("|").length;
                }
            }

            //save question in array
            var rowKey = "row" + questionCount;
            var newSurveyQuestion = new SurveyQuestion(quesType, quesText, choicesCount, choices, "", rowKey);
            editQuestionsList.push(newSurveyQuestion);
            console.log(editQuestionsList);
            $("#edit-no-of-questions").val(editQuestionsList.length);
        }
    });
    //change event for question type
    $("#edit-survey-question > .modal-body").on('change', '#edit-question-type', function (e) {
        if ($(this).val() == QUESTION_TYPE.MCQ) {
            $('#editquestion-choices').attr("disabled", false);
            $('#edit-question-choices').val("");
        }
        if ($(this).val() == QUESTION_TYPE.TEXT) {
            $('#editquestion-choices').attr("disabled", true);
            $('#edit-question-choices').val("");
        }
    });
}

function GetObjectToPost(action) {

    var reminderType = "O";
    var msgType = MESSAGE_TYPE.SURVEY;
    var reminderTime = "";

    var surveyTitle = $("#edit-survey-title").val();
    var surveyDescription = $("#edit-survey-description").val();
    var surveyInstruction = $("#edit-survey-instruction").val();
    var noOfQuestions = $("#edit-no-of-questions").val();

    var newSurey = new Survey(surveyTitle, surveyDescription, surveyInstruction, editQuestionsList.length, editQuestionsList);
    //console.log((newSurey));

    var newMessage = new Message(msgType, surveyTitle, 0, "", "", newSurey);
    //console.log((newMessage));

    if (action == "update") {
        var obj = {
            "text": JSON.stringify(newMessage),
            "reminderType": reminderType,
            "type": msgType,
            "time": reminderTime,
            "studyId": thisStudyId,
            "id": objSurvey.id
        };
        //console.log(obj);
        return obj;
    }
}
