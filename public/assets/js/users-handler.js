
var selectedUser;
var tableUsers;
var userthisStudyId;
var userRoutes = {
    listUsers: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/user/getbyStudyId/{Study_id}",
    addUser: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/user/add",
    updateUser: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/user/update",
    deleteUser: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/user/delete/{id}",
    userResponses: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/response/user/{id}"
};

function InitUserInfo(studyId) {

    userthisStudyId = studyId;
    userRoutes.listUsers = userRoutes.listUsers.replace("{Study_id}", userthisStudyId);
    UserFormsDoNothing();
    BindUserEvents();

    $("#btnAddUser").click(function () {
        $("#userPanelHeader").text("Enroll New User");
        ClearUserForm();
        $('#submitUpdate').remove();
        $('#submitDelete').remove();

        if (!$("#submitBtn").length) {
            var btnSubmit = $(' <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>');
            $('#btnContainer-user').append(btnSubmit);
        }
        BindUserEvents();
    });

    tableUsers = $('#tblUsers')
            .on('xhr.dt', function (e, settings, json, xhr) { // To test the Ajax_output
                // console.log(json);
            })
            .DataTable(
            {
                "processing": true,
                "ajax": {
                    "url": userRoutes.listUsers.replace("{Study_id}", userthisStudyId),
                    "dataSrc": function (json) {
                        for (i = 0; i < json.user.length; i++) {
                            if (json.user[i].StudyId == userthisStudyId) {
                                json.user[i]["Name"] = json.user[i]["Fname"] + " " + json.user[i]["Lname"];
                            }
                        }
                        return json.user;
                    }
                },
                "columns": [
                    { "data": 'Name' },
                    { "data": 'Gender' },
                    { "data": 'Email' },
                    { "data": 'Subscribed' },
                    { "defaultContent": " <a href='#' id='selectUser' data-toggle='modal' data-target='.bd-user-modal-lg' data-keyboard='false' data-backdrop='static'><span class='glyphicon glyphicon-edit'></span> Show Details  </a>  ", "autoWidth": false, "orderable": false },
                    { "defaultContent": " <a href='#' id='responseLog' data-toggle='modal' data-target='.bd-messageresponse-modal-lg' data-keyboard='false' data-backdrop='static'><span class='glyphicon glyphicon-info-sign'></span> Study Responses  </a>  ", "autoWidth": false, "orderable": false }
                ]
            });
    $('.dataTables_filter input').attr("type", "search");

    $('#tblUsers tbody').on('click', '#responseLog', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = tableUsers.row(tr);
        var responseForUser = row.data();
        var url = userRoutes.userResponses.replace("{id}", responseForUser.Id);

        $("#messageresponsePanelHeader").text(responseForUser.Name + "'s Responses");
        var tableMessageResponses = $('#tblUserMessageResponses')
         .on('xhr.dt', function (e, settings, json, xhr) { // To test the Ajax_output
             console.log("user responses");
             console.log(json);
         })
         .DataTable(
         {
             "destroy": true,
             "processing": true,
             "ajax": {
                 "url": url,
                 "dataSrc": function (json) {
                     var filteredMsgs = [];
                     for (var i = 0; i < json.Messages.length; i++) {
                         if (json.Messages[i].response_text != null && json.Messages[i].response_text != "") {
                             filteredMsgs.push(json.Messages[i]);
                         }
                     }
                     return filteredMsgs;
                 }
             },
             "columns": [
                 { "defaultContent": "", "autoWidth": false, "orderable": false },
                 { "data": 'response_text.message_type' },
                 { "data": 'response_text.message' },
                 { "data": 'response_text.choices' },
                 { "data": 'response_text.response' }
             ],
             "order": [[1, 'asc']]
         });
        tableMessageResponses.on('order.dt search.dt', function () {
            tableMessageResponses.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        $('#tblUserMessageResponses .dataTables_filter input').attr("type", "search");
    });
    // See User Details
    $('#tblUsers tbody').on('click', '#selectUser', function (e) {
        e.preventDefault();
        $("#userPanelHeader").text("Edit User");
        ClearUserForm();
        $('#submitBtn').remove();
        if (!$("#submitUpdate").length) {
            var btnUpdate = $(' <button type="submit" id="submitUpdate" class="btn btn-warning" hidden>Update</button>');
            $('#btnContainer-user').append(btnUpdate);
        }
        if (!$("#submitDelete").length) {
            var btnDelete = $(' <button id="submitDelete" type="button" class="btn btn-danger" >Delete</button>');
            $('#btnContainer-user').append(btnDelete);
        }
        var tr = $(this).closest('tr');
        var row = tableUsers.row(tr);
        selectedUser = row.data();
        $("#first-name").val(selectedUser.Fname);
        $("#last-name").val(selectedUser.Lname);
        $("#gender").val(selectedUser.Gender);
        $("#email").val(selectedUser.Email);
        $("#pasword").val("");
        BindUserEvents();
    });
}

function BindUserEvents() {
    //Coordinator button clicks
    $("#submitBtn").unbind();
    $("#submitUpdate").unbind();
    $("#submitDelete").unbind();

    //Add New User
    $('#submitBtn').click(function (e) {
        if ($('#User-form')[0].checkValidity()) {
            e.preventDefault();
            UserFormsDoNothing();
            var objToPost = {
                "password": $("#password").val(),
                "userGender": $("#gender").val(),
                "userFname": $("#first-name").val(),
                "userLname": $("#last-name").val(),
                "userStudyId": userthisStudyId,
                "userRole": "STUDENT",
                "userEmail": $("#email").val(),
            }
            console.log(objToPost);
            $.ajax({
                type: 'POST',
                url: userRoutes.addUser,
                data: objToPost,
                success: function (res) {
                    if (res.status == "ok") {
                        tableUsers.ajax.reload();
                        $('#user-modal').modal('hide');
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

    //Update Existing User
    $('#submitUpdate').click(function (e) {

        if ($('#User-form')[0].checkValidity()) {
            e.preventDefault();
            UserFormsDoNothing();
            var objToPost = {
                "password": $("#password").val(),
                "userGender": $("#gender").val(),
                "userFname": $("#first-name").val(),
                "userLname": $("#last-name").val(),
                "userStudyId": userthisStudyId,
                "userRole": "STUDENT",
                "userEmail": $("#email").val(),
                "id": selectedUser.Id
            }
            console.log(objToPost);
            $.ajax({
                type: 'POST',
                url: userRoutes.updateUser,
                data: objToPost,
                success: function (res) {
                    if (res.status == "ok") {
                        tableUsers.ajax.reload();
                        $('#user-modal').modal('hide');
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

    //Delete User
    $('#submitDelete').click(function (e) {
        var deleteUrl = userRoutes.deleteUser.replace("{id}", selectedUser.Id);
        $.ajax({
            type: 'GET',
            url: deleteUrl,
            success: function (res) {
                if (res.status == 'ok') {
                    tableUsers.ajax.reload();
                    $('#user-modal').modal('hide');
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

function UserFormsDoNothing() {
    $('#User-form').submit(function (event) {
        event.preventDefault();
    });
}

function ClearUserForm() {
    $('#errorText').text("");
    selectedUser = "";
    $("#first-name").val("");
    $("#last-name").val("");
    $("#gender").val("");
    $("#email").val("");
    $("#pasword").val("");
}




