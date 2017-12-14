// Different Tyoe of Questions
var QUESTION_TYPE = {
    TEXT: "TEXT",
    MCQ: "MCQ"
}
// Different type of messages
var MESSAGE_TYPE = {
    QUESTION: "QUESTION",
    SURVEY: "SURVEY",
    MESSAGE: "MESSAGE"
}
function validate(variable) {
    if (variable !== undefined && variable !== null) {
        if (variable != "") {
            return true;
        } return false;
    } return false;
}
var Message = (function (message_type, message, number_of_choices, choices, response, survey) {
    this.message_type = validate(message_type) ? message_type : MESSAGE_TYPE.QUESTION; // Enum("QUESTION","SURVEY","MESSAGE")
    this.message = validate(message) ? message : "Hi! How are you?"; // String
    this.number_of_choices = validate(number_of_choices) ? number_of_choices : 0; // String
    this.choices = validate(choices) ? choices : null; // String
    this.response = validate(response) ? response : null; // String
    this.survey = validate(survey) ? survey : null; // survey object
});

// class survey
var Survey = (function (survey_title, survey_desc, survey_instruction, number_of_questions, questions) {
    this.survey_title = validate(survey_title) ? survey_title : null;
    this.survey_desc = validate(survey_desc) ? survey_desc : null;
    this.survey_instruction = validate(survey_instruction) ? survey_instruction : null;
    this.number_of_questions = validate(number_of_questions) ? number_of_questions : 0;
    this.questions = validate(questions) ? questions : [];
});


// class survey question
var SurveyQuestion = (function (question_type, question_text, number_of_choices, question_choices, response, index) {
    this.question_type = validate(question_type) ? question_type : null; // Enum("TEXT","MCQ")
    this.question_text = validate(question_text) ? question_text : null; //Stirng
    this.number_of_choices = validate(number_of_choices) ? number_of_choices : 0; // Int
    this.question_choices = validate(question_choices) ? question_choices : null; //String
    this.response = validate(response) ? response : null; // String
    this.htmlIndex = index;
});