
var selectedMessage;
var tableMessages;
var thisStudyIdMsgs;

var messageRoutes = {
    listMessages: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/byStudy/{id}",
    addMessage: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/add",
    updateMessage: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/update",
    deleteMessage: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/message/delete/{id}"
};

function InitMessageInfo(studyId) {
    thisStudyIdMsgs = studyId;

    FormsDoNothing();
    BindMessageEvents();

    $("#btnAddMessage").click(function () {
        //setTimeout(function () {
        $("#messagePanelHeader").text("Add New Question");
        $('#updateMessage').remove();
        $('#deleteMessage').remove();
        ClearMessageForm();
        BindOnChangeMessageType();
        BindOnChangeReminderType();
        if (!$("#submitMessage").length) {
            var btnSubmit = $(' <button type="submit" id="submitMessage" class="btn btn-success">Submit</button>');
            $('#btnContainer-message').append(btnSubmit);
        }
        BindMessageEvents();
        // }, 500);
    });

    tableMessages = $('#tblMessages')
            .on('xhr.dt', function (e, settings, json, xhr) { // To test the Ajax_output
                console.log(json);
            })
            .DataTable(
            {
                "processing": true,
                "ajax": {
                    "url": messageRoutes.listMessages.replace("{id}", thisStudyIdMsgs),
                    "dataSrc": function (json) {
                        var filteredMessages = [];
                        var length = json.Messages.length;
                        for (var i = 0 ; i < length ; i++) {
                            if (json.Messages[i]["reminder_type"] == "H")
                                json.Messages[i]["reminder_type_text"] = "Hourly";
                            else if (json.Messages[i]["reminder_type"] == "O")
                                json.Messages[i]["reminder_type_text"] = "Once A Day";
                            else if (json.Messages[i]["reminder_type"] == "T")
                                json.Messages[i]["reminder_type_text"] = "Twice A Day";
                            if (json.Messages[i].type != "SURVEY") {
                                filteredMessages.push(json.Messages[i]);
                            }
                        }
                        return filteredMessages;
                    }
                },
                "columns": [
                    { "defaultContent": " <a href='#' id='selectMessage'><span class='glyphicon glyphicon-expand'></span>Show Details</a>", "autoWidth": false, "orderable": false },
                    { "data": 'type' },
                    { "data": 'text.message' },
                    { "data": 'reminder_type_text' },
                    { "data": 'LastSent' },
                    { "defaultContent": " <a href='#' id='editMessage' data-toggle='modal' data-target='.bd-message-modal-lg' data-keyboard='false' data-backdrop='static'><span class='glyphicon glyphicon-edit'></span> Edit</a>  ", "autoWidth": false, "orderable": false },
                ],
                "createdRow": function (row, data, dataIndex) {
                    //if (data.type == "MESSAGE" && (data.Time == null || data.Time == "")) {
                    //    $(row).find("#selectMessage").hide();
                    //}
                }
            });

    //setting up filter
    $('.dataTables_filter input').attr("type", "search");

    // See Message Details
    $('#tblMessages tbody').on('click', '#selectMessage', function () {
        var tr = $(this).closest('tr');
        var row = tableMessages.row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            $(this).html("<span class='glyphicon glyphicon glyphicon-expand'></span> Show Details");
        }
        else {
            // Open this row
            row.child(GetMessageDetails(row.data())).show();
            $(this).html("<span class='glyphicon glyphicon-collapse-down'></span> Hide Details");
        }
    });

    //On Edit Link Click for a DataRow
    $("#tblMessages tbody").on('click', '#editMessage', function (e) {
        e.preventDefault();
        $("#messagePanelHeader").text("Edit Message");

        ClearMessageForm();

        $('#submitMessage').remove();

        BindOnChangeMessageType();
        BindOnChangeReminderType();

        if ($("#updateMessage").length == 0) {
            var btnUpdate = $(' <button type="submit" id="updateMessage" class="btn btn-warning" hidden>Update</button>');
            $('#btnContainer-message').append(btnUpdate);
        }
        if ($("#deleteMessage").length == 0) {
            var btnDelete = $(' <button id="deleteMessage" type="button" class="btn btn-danger" >Delete</button>');
            $('#btnContainer-message').append(btnDelete);
        }

        var currentRow = $(this).closest("tr");
        var data = tableMessages.row(currentRow).data();

        var selected_message = data;
        selectedMessage = data;
        $('#message-type').val(selected_message.type);
        $('#message-text').val(selected_message.text.message);
        $('#reminder-type').val(selected_message.reminder_type);

        if (selected_message.type == MESSAGE_TYPE.QUESTION) {
            $('#question-choices').attr('disabled', false);
            $('#question-choices').val(selected_message.text.choices);
        }
        if (selected_message.reminder_type == "O" && selected_message.Time!=null) {
            
            $('#reminder-time-1').val(selected_message.Time.split(",")[0]);
            $('#reminder-time-1').attr('disabled', false);
        }
        else if (selected_message.reminder_type == "T" && selected_message.Time!=null) {
          
            $('#reminder-time-1').val(selected_message.Time.split(",")[0]);
            $('#reminder-time-1').attr('disabled', false);

            $('#reminder-time-2').val(selected_message.Time.split(",")[1]);
            $('#reminder-time-2').attr('disabled', false);
        }

        BindMessageEvents();
    });

}
function ClearMessageForm() {
    $('#message-type').val("MESSAGE");
    $('#message-text').val("");
    $('#question-choices').val("");
    $('#reminder-type').val("H");
    $('#reminder-time-1').val("");
    $('#reminder-time-2').val("");
    $('#question-choices').attr("disabled", true);
    $('#reminder-time-1').attr("disabled", true);
    $('#reminder-time-2').attr("disabled", true);
    $('#errorTextMsgMsg').text("");
    selectedMessage = "";
}

function FormsDoNothing() {
    $('#Message-form').submit(function (event) {
        event.preventDefault();
    });
}
function BindOnChangeMessageType() {
    $('#message-type').change(function () {
        if ($(this).val() == "MESSAGE") {
            $('#question-choices').attr("disabled", true);
            $('#question-choices').val("");
        }
        if ($(this).val() == "QUESTION") {
            $('#question-choices').attr("disabled", false);
            $('#question-choices').val("");
        }
    });
}
function BindOnChangeReminderType() {
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

function BindMessageEvents() {
    //Coordinator button clicks
    $("#submitMessage").unbind();
    $("#updateMessage").unbind();
    $("#deleteMessage").unbind();

    //Add Message
    $('#submitMessage').click(function () {
        var objToPost = GetObjectToPostMessage("add");
        console.log(objToPost);
        $.ajax({
            type: 'POST',
            url: messageRoutes.addMessage,
            data: objToPost,
            success: function (res) {
                if (res.status == "ok") {
                    tableMessages.ajax.reload();
                    $('#message-modal').modal('hide');
                } else {
                    $("#errorTextMsg").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });

    //Update Existing Message
    $('#updateMessage').click(function () {
        var objToPost = GetObjectToPostMessage("update");
        $.ajax({
            type: 'POST',
            url: messageRoutes.updateMessage,
            data: objToPost,
            success: function (res) {
                if (res.status == "ok") {
                    tableMessages.ajax.reload();
                    $('#message-modal').modal('hide');
                } else {
                    $("#errorTextMsg").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });

    //Delete Message
    $('#deleteMessage').click(function () {
        var deleteUrl = messageRoutes.deleteMessage.replace("{id}", selectedMessage.id);
        $.ajax({
            type: 'GET',
            url: deleteUrl,
            success: function (res) {
                if (res.status == "ok") {
                    tableMessages.ajax.reload();
                    $('#message-modal').modal('hide');
                } else {
                    $("#errorTextMsg").text(res);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('error: ' + errorThrown);
            }
        });
    });
}
function GetMessageDetails(messageData) {
    switch (messageData.type) {
        case "MESSAGE": return GetInfoMessageDetail(messageData); break;
        default: return GetQuestionDetail(messageData); break;
    }
}
function GetQuestionDetail(m) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:10%;">' +
        '<tr>' +
            '<td><b>Total Choices:</b></td>' +
            '<td>' + m.text.number_of_choices + '</td>' +
        '</tr>' +
        '<tr>' +
            '<td><b>Question Choices:</b></td>' +
            '<td>' + m.text.choices + '</td>' +
        '</tr>' +
         '<tr>' +
            '<td><b>Reminder Times:</b></td>' +
            '<td>' + m.Time + '</td>' +
        '</tr>' +
    '<tr><br/></tr>' +
'</table>';
}
function GetInfoMessageDetail(m) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:10%;">' +
       '<tr>' +
        '<td><b>Reminder Times:</b></td>' +
        '<td>' + m.Time + '</td>' +
       '</tr>' +
     '<tr><br/></tr>' +
 '</table>';
}



function GetObjectToPostMessage(action) {
    var msgType = $("#message-type").val();
    var messageText = $("#message-text").val();
    var choices = "";
    var noOfChoices = 0;
    if (msgType == MESSAGE_TYPE.QUESTION) {
        choices = $("#question-choices").val();
        noOfChoices = choices.split("|").length;
    }
    var reminderTime = "";
    var reminderType = $("#reminder-type").val()
    if (reminderType == "O")
        reminderTime = $("#reminder-time-1").val();
    else if (reminderType == "T")
        reminderTime = $("#reminder-time-1").val() + "," + $("#reminder-time-2").val();

    var newMessage = new Message(msgType, messageText, noOfChoices, choices, "", "");
    //JSON.stringify(newMessage);

    if (action == "add") {
        var obj = {
            "text": JSON.stringify(newMessage),
            "reminderType": reminderType,
            "type": msgType,
            "time": reminderTime,
            "studyId": thisStudyIdMsgs
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
            "studyId": thisStudyIdMsgs,
            "id": selectedMessage.id
        };
        console.log(obj);
        return obj;
    }
}
