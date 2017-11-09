
var colorObject = {
    good:"#5CB85C",
    poor:"#D9534F"

};

function checkResponses(answers){

  for(var i=1;i<=33;i++){
      if(answers["Q"+ i] == "-1"){
          answers["Q"+ i] = "null";
      }
  }
return answers;
}

function medication(answers) {

    answers = checkResponses(answers);



    var score = parseInt(answers.Q1) + parseInt(answers.Q2) + parseInt(answers.Q3);
    var color = "";
    var toReturn = [];
    var action = [];
    var suggestion = [];
    var probes = [];

    if(score == 21){
        var toAdd  ={ action: "", suggestion: "", probes:""};
        toAdd.action ="";
        toAdd.suggestion= "";
        color = colorObject.good;
        toReturn.push(toAdd);
    }else if(score <21 && score >= 16)
    {
        action.push("");
        suggestion.push("");
        probes.push("");

        color = colorObject.good;
        var toAdd  ={ action: action, suggestion: suggestion, probes: probes};

        toReturn.push(toAdd);
    }
    else if(score < 16)
    {
        action.push("");
        color = colorObject.poor;
        if(parseInt(answers.Q1) < 7){

            suggestion.push("");
            probes.push("");
        }if(parseInt(answers.Q3) < 7){
            suggestion.push("");
            probes.push("");
        }
        var toAdd  ={ action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }

    return {"score": score, "feedBack": toReturn, "color": color};

}

function diet(answers) {

    var score = (parseInt(answers.Q4) + parseInt(answers.Q5) + parseInt(answers.Q6)
    +parseInt(answers.Q7) + parseInt(answers.Q8) + parseInt(answers.Q9)
    +parseInt(answers.Q10) + parseInt(answers.Q11) + parseInt(answers.Q12)
    +parseInt(answers.Q13) + parseInt(answers.Q14));

    var color ="";
    var toReturn = [];
    var action = [];
    var suggestion = [];
    var probes = [];

    if(score >= 52)
    {
        color = colorObject.good;
        action.push("");
        suggestion.push("");
        var toAdd = {action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }
    else if(score < 52)
    {
        color = colorObject.poor;
        action.push("");
        if(parseInt(answers.Q8) < 4)
        {
            //toAdd.action ="Poor - comment and probe";
            suggestion.push("");
            probes.push("");

        } if((parseInt(answers.Q12) +  parseInt(answers.Q13)) < 6)
        {
            //toAdd.action ="Okay - comment and recommend";
            suggestion.push("");
        }
        var toAdd = {action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }

    return {"score": score, "feedBack": toReturn,"color": color};


}

function physicalActivity(answers){
    var score = (parseInt(answers.Q15) + parseInt(answers.Q16));
    var toReturn = [];
    var action = [];
    var suggestion = [];
    var probes = [];
    var color = "";
    if(score>=8)
    {
        color = colorObject.good;

        action.push("");
        suggestion.push("");
        var toAdd = {action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }
    else if(score< 8)
    {
        color = colorObject.poor;

        action.push("");
        suggestion.push("");
        probes.push("");
        var toAdd = {action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }


    return {"score": score, "feedBack": toReturn, "color":color};

}

function smoking(answers) {

    var score  = (parseInt(answers.Q19) + parseInt(answers.Q20) );
    var color ="";
    var toReturn = [];
    var action = [];
    var suggestion = [];
    var probes = [];

    if(score == 0)
    {
        color = colorObject.good;
        action.push("");
        suggestion.push("");
        var toAdd = {action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }else if(score > 0 )
    {
        color = colorObject.poor;
        action.push("");
        if(parseInt(answers.Q19) > 0){
            suggestion.push("");
            probes.push("");
        } if(parseInt(answers.Q20) > 0)
        {
            suggestion.push("");
            probes.push("");
        }
        var toAdd = {action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }


    return {"score": score, "feedBack": toReturn,"color": color};

}

function weightManagement(answers) {

    var score = (parseInt(answers.Q21) + parseInt(answers.Q22) + parseInt(answers.Q23)
    +parseInt(answers.Q24) + parseInt(answers.Q25) + parseInt(answers.Q26)
    +parseInt(answers.Q27) + parseInt(answers.Q28) + parseInt(answers.Q29)
    +parseInt(answers.Q30));

    var color = "";
    var toReturn = [];

    if(score >= 40)
    {
        color = colorObject.good;
        var toAdd1 = {action: "", suggestion: "", probes: ""};
        toAdd1.action ="";
        toAdd1.suggestion= "";

        toReturn.push(toAdd1);
        var toAdd2 = {action: "", suggestion: "", probes: ""};
        toAdd2.action ="";
        toAdd2.suggestion= "";
        toAdd2.probes = [""];

        toReturn.push(toAdd2);
    }
    else if(score < 40)
    {
        color = colorObject.poor;
        var toAdd1 = {action: "", suggestion: "", probes: "", "score": score};
        toAdd1.action ="";
        toAdd1.suggestion= "";

        toReturn.push(toAdd1);
        var toAdd2 = {action: "", suggestion: "", probes: ""};
        toAdd2.action ="";
        toAdd2.suggestion= "";

        toReturn.push(toAdd2);
    }

    return  {"score": score, "feedBack": toReturn,"color":color};

}

function alcohol(answers,gender){


    var score = (parseInt(answers.Q31) + parseInt(answers.Q32) + parseInt(answers.Q33) );
    var color = "";
    var toReturn = [];
    var action = [];
    var suggestion = [];
    var probes = [];

    switch (gender){

        case "MALE":
            if(score == 0)
            {
                action.push("");
                suggestion.push("");
                color = colorObject.good;
            }
            else if(score <= 14)
            {
                action.push("");
                suggestion.push("");
                color = colorObject.good;
            }
            else if(score > 14)
            {
                action.push("");
                suggestion.push("");
                color = colorObject.poor;
            }
            var toAdd ={ action: action, suggestion: suggestion, probes:probes};
            break;
        case "FEMALE":
            if(score == 0)
            {
                action.push("");
                suggestion.push("");
                color = colorObject.good;
            }
            else if(score <= 7)
            {
                action.push("");
                suggestion.push("");
                color = colorObject.good;
            }
            else if(score > 7)
            {
                action.push("");
                suggestion.push("");
                color = colorObject.poor;
            }
            var toAdd ={ action: action, suggestion: suggestion, probes:probes};
            break;
    }
    toReturn.push(toAdd);


    return {"score": score, "feedBack": toReturn, "color":color};


}
