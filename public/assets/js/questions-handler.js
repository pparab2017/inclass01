
var selectedQuestion;
var tableQuestions;


var getUsersRoute = "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/admin/user/getAll"
$(document).ready(function () {

    //$('[data-toggle="popover"]').popover();

    FormsDoNothing();
    BindQuestionEvents();
    //$("#btnGetResponseLog").click(function () {

    //});
    $("#btnAddQuestion").click(function () {

        $("#questionPanelHeader").text("Add New Question");
        ClearQuestionForm();
        $('#submitUpdate').remove();
        $('#submitDelete').remove();

        PopulateUsersDropdown();
        BindOnChangeReminderType();

       
        if (!$("#submitBtn").length) {
            var btnSubmit = $(' <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>');
            $('#btnContainer-question').append(btnSubmit);
        }
        BindQuestionEvents();
    });

    tableQuestions = $('#tblQuestions')
            .on('xhr.dt', function (e, settings, json, xhr) { // To test the Ajax_output
                console.log(json);
            })
            .DataTable(
            {
                "processing": true,
                "ajax": {
                    "url": questionRoutes.listQuestions,
                    "dataSrc": function (json) {
                        var length = json.Questionss.length;
                        for (var i = 0 ; i < length ; i++) {
                            if (json.Questionss[i]["Type"] == "H")
                                json.Questionss[i]["TypeText"] = "Hourly";
                            else if (json.Questionss[i]["Type"] == "O")
                                json.Questionss[i]["TypeText"] = "Once A Day";
                            else if (json.Questionss[i]["Type"] == "T")
                                json.Questionss[i]["TypeText"] = "Twice A Day";

                            json.Questionss[i]["UserName"] = json.Questionss[i]["Newuser.Fname"] + " " + json.Questionss[i]["Newuser.Lname"];
                        }
                        return json.Questionss;
                    }
                },
                "columns": [
                    { "data": 'Text' },
                    { "data": 'Choises' },
                    { "data": 'TypeText' },
                    { "data": 'Time' },
                    { "data": 'UserName' },
                    { "defaultContent": " <a href='#' id='editQuestion' class='selectUser' data-toggle='modal' data-target='.bd-question-modal-lg'><span class='glyphicon glyphicon-edit'></span> Edit  </a>  ", "autoWidth": true, "orderable": false }
                ]
            });

    //On Edit Link Click for a DataRow
    $("#tblQuestions").on('click', '#editQuestion', function (e) {
        e.preventDefault();
        $("#questionPanelHeader").text("Edit Question");

        ClearQuestionForm();

        $('#submitBtn').remove();

        PopulateUsersDropdown();

        BindOnChangeReminderType();

        if (!$("#submitUpdate").length) {
            var btnUpdate = $(' <button type="submit" id="submitUpdate" class="btn btn-warning" hidden>Update</button>');
            $('#btnContainer-question').append(btnUpdate);
        }
        if (!$("#submitDelete").length) {
            var btnDelete = $(' <button id="submitDelete" type="button" class="btn btn-danger" >Delete</button>');
            $('#btnContainer-question').append(btnDelete);
        }

        var currentRow = $(this).closest("tr");
        var data = $('#tblQuestions').DataTable().row(currentRow).data();
        
        var selected_question = data;
        selectedQuestion = data;

        $('#user-name').val(selected_question.userId);
        $('#question-text').val(selected_question.Text);
        $('#question-choices').val(selected_question.Choises);
        $('#reminder-type').val(selected_question.Type);

        if (selected_question.Type == "O") {
            $('#reminder-time-1').val(selected_question.Time.split(",")[0]);
           // $('#reminder-time-1').timepicker('setTime', selected_question.Time.split(",")[0]);
            $('#reminder-time-1').attr('disabled', false);
        }
        else if (selected_question.Type == "T") {
            $('#reminder-time-1').val(selected_question.Time.split(",")[0]);
            $('#reminder-time-1').attr('disabled', false);
            //$('#reminder-time-1').timepicker('setTime', selected_question.Time.split(",")[0]);

            $('#reminder-time-2').val(selected_question.Time.split(",")[1]);
            $('#reminder-time-2').attr('disabled', false);
            //$('#reminder-time-2').timepicker('setTime', selected_question.Time.split(",")[1]);
        }

        BindQuestionEvents();
    });
    $('.dataTables_filter input').attr("type", "search");
});

function ClearQuestionForm() {
    $('#question-text').val("");
    $('#question-choices').val("");
    $('#reminder-type').val("H");
    $('#reminder-time-1').val("");
    $('#reminder-time-2').val("");
    $('#reminder-time-1').attr("disabled", true);
    $('#reminder-time-2').attr("disabled", true);
    $('#user-name').html("");
    $('#errorText').text("");
    selectedQuestion = "";
}

function FormsDoNothing() {
    $('#Question-form').submit(function (event) {
        event.preventDefault();
    });
}
//function bindClick(obj) {
//    tableQuestions.search(obj.innerText).draw();
//}
function PopulateUsersDropdown(){
    $.get(getUsersRoute, function (data) {
        var usersHtml = '';
        var json = JSON.parse(data);
        var userData = json.Newusers;
        $.each(userData, function (i, item) {
            usersHtml += '<option value="' + userData[i]['Id'] + '">' + userData[i]['Fname'] + ' ' + userData[i]['Lname'] + '</option>'
        });
        $('#user-name').html(usersHtml);
    });

}
function BindOnChangeReminderType(){
    $('#reminder-type').change(function () {
        if ($(this).val() == "H") {
            $('#reminder-time-1').attr("disabled", true);
            $('#reminder-time-2').attr("disabled", true);
            $('#reminder-time-1').val("");
            $('#reminder-time-2').val("");
        }
        else if ($(this).val() == "O") {
            $('#reminder-time-1').attr("disabled", false);
            $('#reminder-time-2').attr("disabled", true);
            $('#reminder-time-2').val("");
        }
        else if ($(this).val() == "T") {
            $('#reminder-time-1').attr("disabled", false);
            $('#reminder-time-2').attr("disabled", false);
        }
    });
}

function BindQuestionEvents() {
    //Coordinator button clicks
    $("#submitBtn").unbind();
    $("#submitUpdate").unbind();
    $("#submitDelete").unbind();

    //Add Question
    $('#submitBtn').click(function () {
        if ($('#Question-form')[0].checkValidity()) {
            var reminderTime = "";
            if ($("#reminder-type").val() == "O")
                reminderTime = $("#reminder-time-1").val();
            else if ($("#reminder-type").val() == "T")
                reminderTime = $("#reminder-time-1").val() + "," + $("#reminder-time-2").val();

            var objToPost = {
                "questionText": $("#question-text").val(),
                "choices": $("#question-choices").val(),
                "type": $("#reminder-type").val(),
                "time": reminderTime,
                "userId": $("#user-name").val()
            }
            console.log(objToPost);
            $.ajax({
                type: 'POST',
                url: questionRoutes.addQuestion,
                data: objToPost,
                success: function (res) {
                    res = jQuery.parseJSON(res);
                    if (res.indexOf('OK')>0) {
                        tableQuestions.ajax.reload();
                        $('#question-modal').modal('hide');
                    } else {
                        $("#errorText").text(res);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('error: ' + errorThrown);
                }
            });
        }
    });

    //Update Existing Question
    $('#submitUpdate').click(function () {
        if ($('#Question-form')[0].checkValidity()) {
            var reminderTime = "";
            if ($("#reminder-type").val() == "O")
                reminderTime = $("#reminder-time-1").val();
            else if ($("#reminder-type").val() == "T")
                reminderTime = $("#reminder-time-1").val() + "," + $("#reminder-time-2").val();

            var objToPost = {
                "questionText": $("#question-text").val(),
                "choices": $("#question-choices").val(),
                "type": $("#reminder-type").val(),
                "time": reminderTime,
                "userId": $("#user-name").val(),
                "questionId": selectedQuestion.Id
            }
            console.log(objToPost);
            $.ajax({
                type: 'POST',
                url: questionRoutes.updateQuestion,
                data: objToPost,
                success: function (res) {
                    res = jQuery.parseJSON(res);
                    if (res.indexOf('OK') > 0) {
                        tableQuestions.ajax.reload();
                        $('#question-modal').modal('hide');
                    } else {
                        $("#errorText").text(res);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('error: ' + errorThrown);
                }
            });
        }
    });

    //Delete Question
    $('#submitDelete').click(function () {
        var deleteUrl = questionRoutes.deleteQuestion.replace("{id}", selectedQuestion.Id);
        $.ajax({
            type: 'GET',
            url: deleteUrl,
            success: function (res) {
                res = jQuery.parseJSON(res);
                if (res == 'OK') {
                    tableQuestions.ajax.reload();
                    $('#question-modal').modal('hide');
                } else {
                    $("#errorText").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });
}
