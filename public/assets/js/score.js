
var colorObject = {
    good:"#5CB85C",
    poor:"#D9534F"

};

function medication(answers) {


    var score = parseInt(answers.Q1) + parseInt(answers.Q2) + parseInt(answers.Q3);
    var color = "";
    var toReturn = [];
    var action = [];
    var suggestion = [];
    var probes = [];

    if(score == 21){
        var toAdd  ={ action: "", suggestion: "", probes:""};
        toAdd.action ="Excellent - Praise";
        toAdd.suggestion= "You are doing a great job taking your BP pills every day. Keep up the good work!";
        color = colorObject.good;
        toReturn.push(toAdd);
    }else if(score <21 && score >= 16)
    {
        action.push("Interpretation: Good - Comment and probe.");
        suggestion.push("You are doing well taking your mediation. It is really important to keep up with your BP pills.");
        probes.push("Tell me about your routine for taking your BP pills.","What gets in the way of taking your pills?");

        color = colorObject.good;
        var toAdd  ={ action: action, suggestion: suggestion, probes: probes};

        toReturn.push(toAdd);
    }
    else if(score < 16)
    {
        action.push("Interpretation: Poor - comment and probe.");
        color = colorObject.poor;
        if(parseInt(answers.Q1) < 7){

            suggestion.push("It is really important that you take your BP pills every day.");
            probes.push("Is there someone in your family who could help you remember to take your pills?");
        }if(parseInt(answers.Q3) < 7){
            suggestion.push("You should be taking the number of pills your doctor prescribed.");
            probes.push("Are you having side effects when you take your pills?");
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
        action.push("Interpretation: Excellent - Praise.");
        suggestion.push("Looks like you eat a healthy, well-balanced diet. Congratulations! I know how hard that can be.");
        var toAdd = {action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }
    else if(score < 52)
    {
        color = colorObject.poor;
        action.push("Interpretation: Poor - comment and probe.");
        if(parseInt(answers.Q8) < 4)
        {
            //toAdd.action ="Poor - comment and probe";
            suggestion.push("Eating fresh fruits and vegetables is part of a healthy diet and can help manage BP (or risk of high BP).");
            probes.push("What are your favorite fruits and vegetables?","How can you eat more of these throughout the day?","Where can you get fresh produce?");

        } if((parseInt(answers.Q12) +  parseInt(answers.Q13)) < 6)
        {
            //toAdd.action ="Okay - comment and recommend";
            suggestion.push("Eating foods that have potassium in them is especially important for BP. Eat more broccoli, greens, spinach, potatoes, squash, apples, bananas, oranges, melons, and raisins.");
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

        action.push("Interpretation: Excellent - Praise.");
        suggestion.push("Keep up your activity level! You are meeting the public health guidelines for exercise. That will help manage your blood pressure.");
        var toAdd = {action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }
    else if(score< 8)
    {
        color = colorObject.poor;

        action.push("Interpretation: Poor - comment and probe.");
        suggestion.push("It can really help your BP and your heart if you move more.  Increase your physical activity slowly- one more day each week where you’re active.");
        probes.push("What kinds of physical activity do you enjoy?","What gets in the way of being more active?", " Who could support you in increasing your activity level?");
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
        action.push("Interpretation: Excellent - Praise.");
        suggestion.push("You are avoiding tobacco and cigarette smoke, which can increase blood pressure and risk for lung cancer. Great job!");
        var toAdd = {action: action, suggestion: suggestion, probes: probes};
        toReturn.push(toAdd);
    }else if(score > 0 )
    {
        color = colorObject.poor;
        action.push("Interpretation: Poor - comment and probe.");
        if(parseInt(answers.Q19) > 0){
            suggestion.push("Any amount of tobacco can make your BP higher. If you aren’t ready to quit, cutting back will also help your BP and overall health.");
            probes.push("How much do you smoke?","Can you work on cutting that in half?");
        } if(parseInt(answers.Q20) > 0)
        {
            suggestion.push("It’s important to stay away from other friends and family members who smoke. Even inhaling someone else’s smoke can be harmful to you.");
            probes.push("Tell me about the other people you live with, do any of them smoke?","Do you ride to school or work with someone who smokes?","Do you have another form of transportation?");
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
        toAdd1.action ="Interpretation: If individual has no significant weight issues: Excellent - Praise.";
        toAdd1.suggestion= "It looks like you have some good habits to help you maintain your weight. It’s important to keep your weight stable.";

        toReturn.push(toAdd1);
        var toAdd2 = {action: "", suggestion: "", probes: ""};
        toAdd2.action ="Interpretation: Habits are good but individual has significant weight issues: Good - comment and probe.";
        toAdd2.suggestion= "It looks like you are doing a lot of the right things to help control your weight but more effort is needed. It’s important to keep your weight stable so that you don’t increase your risk of health problems down the road.";
        toAdd2.probes = ["If patient has gained weight or had weight issues in the past:",
            "Discuss importance of keeping an even weight.",
            "Discuss paying attention to how body feels, if clothes are getting tighter, etc.",
            "Suggestions for weight maintenance: cut out sugary sodas, eat smaller portions, skip second helpings, log what and how much you are eating."];

        toReturn.push(toAdd2);
    }
    else if(score < 40)
    {
        color = colorObject.poor;
        var toAdd1 = {action: "", suggestion: "", probes: "", "score": score};
        toAdd1.action ="Interpretation: If individual has no significant weight issues: Poor - Comment and recommend.";
        toAdd1.suggestion= "It’s important to keep your weight stable so that you don’t increase your risk of health problems down the road.";

        toReturn.push(toAdd1);
        var toAdd2 = {action: "", suggestion: "", probes: ""};
        toAdd2.action ="Interpretation: Habits are poor AND individual has significant weight issues: Poor - comment and recommend.";
        toAdd2.suggestion= "I want you to focus some effort on controlling your weight. It’s important to keep your weight stable so that you don’t increase your risk of health problems down the road.";

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
                action.push("Interpretation: Good - Comment.");
                suggestion.push("It looks like you don’t drink alcohol and that’s fine.");
                color = colorObject.good;
            }
            else if(score <= 14)
            {
                action.push("Interpretation: Good - Comment.");
                suggestion.push("It looks like your drinking is moderate.");
                color = colorObject.good;
            }
            else if(score > 14)
            {
                action.push("Interpretation: Poor - Comment and recommend.");
                suggestion.push("The recommended number of drinks per day for adult males is 2, and for adult females is 1. Cutting back on alcohol can help manage your BP.");
                color = colorObject.poor;
            }
            var toAdd ={ action: action, suggestion: suggestion, probes:probes};
            break;
        case "FEMALE":
            if(score == 0)
            {
                action.push("Interpretation: Good - Comment.");
                suggestion.push("It looks like you don’t drink alcohol and that’s fine.");
                color = colorObject.good;
            }
            else if(score <= 7)
            {
                action.push("Interpretation: Good - Comment.");
                suggestion.push("It looks like your drinking is moderate.");
                color = colorObject.good;
            }
            else if(score > 7)
            {
                action.push("Interpretation: Poor - Comment and recommend.");
                suggestion.push("The recommended number of drinks per day for adult males is 2, and for adult females is 1. Cutting back on alcohol can help manage your BP.");
                color = colorObject.poor;
            }
            var toAdd ={ action: action, suggestion: suggestion, probes:probes};
            break;
    }
    toReturn.push(toAdd);


    return {"score": score, "feedBack": toReturn, "color":color};


}
