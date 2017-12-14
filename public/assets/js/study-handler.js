
var selectedStudy;
var tableStudies;

var studyRoutes = {
    listStudies: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/allStudy",
    addStudy: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/study/add",
    updateStudy: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/study/update",
    deleteStudy: "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/coordinator/study/delete/{id}"
};
//var getUsersRoute = "http://ec2-18-216-112-134.us-east-2.compute.amazonaws.com/admin/user/getAll"

$(document).ready(function () {

    FormsDoNothing();
    BindStudyEvents();
    
    $("#btnAddStudy").click(function () {
        $("#studyPanelHeader").text("Create New Study");
        ClearStudyForm();
        $('#submitUpdate').remove();
        $('#submitDelete').remove();

        if (!$("#submitBtn").length) {
            var btnSubmit = $(' <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>');
            $('#btnContainer-study').append(btnSubmit);
        }
        BindStudyEvents();
    });

    tableStudies = $('#tblStudies')
            .on('xhr.dt', function (e, settings, json, xhr) { // To test the Ajax_output
                console.log(json);
            })
            .DataTable(
            {
                "processing": true,
                "ajax": {
                    "url": studyRoutes.listStudies,
                    "dataSrc": function (json) {
                        return json.Study;
                    }
                },
                "columns": [
                    { "defaultContent": " <a href='#' id='selectStudy'><span class='glyphicon glyphicon-expand'></span> Show Details  </a>  ", "autoWidth": false, "orderable": false },
                    { "data": 'StudyName', "width": '85%'},
                    ]
            });
    $('.dataTables_filter input').attr("type", "search");

    // See Study Details
    $('#tblStudies tbody').on('click', '#selectStudy', function () {
        var tr = $(this).closest('tr');
        var row = tableStudies.row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            $(this).html("<span class='glyphicon glyphicon glyphicon-expand'></span> Show Details");
        }
        else {
            // Open this row
            row.child(GetStudyDetail(row.data())).show();
            $(this).html("<span class='glyphicon glyphicon-collapse-down'></span> Hide Details");
        }
    });
    //Edit Study Details Pop Up
    $('#tblStudies tbody').on('click', '#btnEditStudy', function (e) {
        e.preventDefault();
        $("#studyPanelHeader").text("Edit Study");
        ClearStudyForm();
        $('#submitBtn').remove();
        if (!$("#submitUpdate").length) {
            var btnUpdate = $(' <button type="submit" id="submitUpdate" class="btn btn-warning" hidden>Update</button>');
            $('#btnContainer-study').append(btnUpdate);
        }
        if (!$("#submitDelete").length) {
            var btnDelete = $(' <button id="submitDelete" type="button" class="btn btn-danger" >Delete</button>');
            $('#btnContainer-study').append(btnDelete);
        }
        var tr = $(this).closest('tr');
        var parenttr = $(this).closest('tr').parents('tr').prev();
        var row = tableStudies.row(parenttr);
        selectedStudy = row.data();
        $("#study-name").val(selectedStudy.StudyName);
        $("#study-description").val(selectedStudy.StudyDescription);
        BindStudyEvents();
    });
    $('#tblStudies tbody').on('click', '#btnViewStudyDetails', function (e) {
        // e.preventDefault();
        //this will redirect us in same window
        var tr = $(this).closest('tr');
        var parenttr = $(this).closest('tr').parents('tr').prev();
        var row = tableStudies.row(parenttr);
        selectedStudy = row.data();
        document.location.href = "/coordinator/viewStudy?studyId=" + selectedStudy.Id;
    });
});
function GetStudyDetail(study) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:10%;">' +
        '<tr>' +
            '<td>Study Description:</td>' +
            '<td>' + study.StudyDescription + '</td>' +
        '</tr>' +
        '<tr>' +
            '<td>Users Enrolled:</td>' +
            '<td>' + study.EnrolledUsersCount + '</td>' +
            '<td><a href="#" id="seeStudyUsers"><span class="glyphicon glyphicon-information"></span> View Enrolled Users  </a></td>' +
        '</tr>' +
        '<tr>' +
            '<td>Messages Sent:</td>' +
            '<td>' + study.MessagesCount + '</td>' +
            '<td><a href="#" id="seeMessages"><span class="glyphicon glyphicon-information"></span> View All Messages  </a></td>' +
        '</tr>' +
        '<tr>' +
            '<td>Surveys Sent:</td>' +
            '<td>' + study.SurveyCount + '</td>' +
            '<td><a href="#" id="seeSurveys"><span class="glyphicon glyphicon-information"></span> View All Surveys  </a></td>' +
        '</tr><br/>' +
        '<tr>' +
        '<td colspan=3>' +
        '<button id="btnEditStudy" type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-study-modal-lg" data-keyboard="false" data-backdrop="static">'+
         'Edit Study <i class="glyphicon glyphicon-edit"></i>'+
        '</button>&nbsp&nbsp&nbsp' +
         '<button id="btnViewStudyDetails" type="button" class="btn btn-success">'+
         'View Details <i class="glyphicon glyphicon-info-sign"></i></button>'
        '</td>'
        '</tr>'
        '<tr><br/></tr>'+
    '</table>';
}

function BindStudyEvents() {
    //Coordinator button clicks
    $("#submitBtn").unbind();
    $("#submitUpdate").unbind();
    $("#submitDelete").unbind();

    //Add New Study
    $('#submitBtn').click(function () {
        if ($('#Study-form')[0].checkValidity()) {
            var objToPost = {
                "studyName": $("#study-name").val(),
                "studyDesc": $("#study-description").val(),
            }
            console.log(objToPost);
            $.ajax({
                type: 'POST',
                url: studyRoutes.addStudy,
                data: objToPost,
                success: function (res) {
                    if (res.status == "ok") {
                        tableStudies.ajax.reload();
                        $('#study-modal').modal('hide');
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

    //Update Existing Study
    $('#submitUpdate').click(function () {
        //if ($('#Question-form')[0].checkValidity()) {
            var objToPost = {
                "id": selectedStudy.Id,
                "studyName": $("#study-name").val(),
                "studyDesc": $("#study-description").val()
            }
            console.log(objToPost);
            $.ajax({
                type: 'POST',
                url: studyRoutes.updateStudy,
                data: objToPost,
                success: function (res) {
                    if (res.status == "ok") {
                        tableStudies.ajax.reload();
                        $('#study-modal').modal('hide');
                    } else {
                        $("#errorText").text(res);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('error: ' + errorThrown);
                }
            });
        //}
    });

    //Delete Study
    $('#submitDelete').click(function () {
        var deleteUrl = studyRoutes.deleteStudy.replace("{id}", selectedStudy.Id);
        $.ajax({
            type: 'GET',
            url: deleteUrl,
            success: function (res) {
                if (res.status == 'ok') {
                    tableStudies.ajax.reload();
                    $('#study-modal').modal('hide');
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

function FormsDoNothing() {
    $('#Study-form').submit(function (event) {
        event.preventDefault();
    });
}

function ClearStudyForm() {
    $('#study-name').val("");
    $('#study-description').val("");
    $('#errorText').text("");
    selectedStudy = "";
}




