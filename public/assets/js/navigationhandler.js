$(document).ready(function () {
    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results == null) {
            return null;
        }
        else {
            return decodeURI(results[1]) || 0;
        }
    }
    //get selected study id
    var studyId = $.urlParam("studyId");
    $("#selectedStudyId").val(studyId);

    //setting default tab content
    $("#usersContent").load("/assets/js/UserInformation.html #usercontainer");
    setTimeout(function () {
        InitUserInfo(studyId);
    }, 50);
    

    //tab navigation
    $('nav ul').on('click', '#usersTab', function () {
        $("#usersContent").load("/assets/js/UserInformation.html #usercontainer");
        setTimeout(function () {
            InitUserInfo(studyId);
        }, 50);
    }).on('click', '#messagesTab', function () {
        $("#messagesContent").load("/assets/js/MessageInformation.html #messagecontainer");
        setTimeout(function () {
            InitMessageInfo(studyId);
        }, 50);
    }).on('click', '#surveysTab', function () {
        $("#surveysContent").load("/assets/js/SurveyInformation.html #surveycontainer");
        setTimeout(function () {
            InitSurveyInfo(studyId);
        }, 50);
    });
});
