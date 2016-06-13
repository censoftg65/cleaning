<?php
/**
* 
*/
class Quiz
{
    
    function __construct() {
        # code...
    }

    public function setDetails($arr_quiz) {
        $this->txtQuestion    = $arr_quiz['txtQuestion'];
        $this->txtAnswer      = $arr_quiz['txtAnswer'];
        $this->txtOptionOne   = $arr_quiz['txtOptionOne'];
        $this->txtOptionTwo   = $arr_quiz['txtOptionTwo'];
        $this->txtOptionThree = $arr_quiz['txtOptionThree'];
        $this->txtOptionFour  = $arr_quiz['txtOptionFour'];
    }

    public function insertQuestion() {
        $db = new Config();
        $sql_query = $db->query("INSERT INTO "._DB_PREFIX."quiz(txtQuestion,txtStatus)VALUES('$this->txtQuestion','1')");
        return $queId = mysql_insert_id();
    }

    public function insertQueAns($queId) {
        $db = new Config();
        $sql_query = "INSERT INTO "._DB_PREFIX."quiz_ans(
                                                            txtQuizId,
                                                            txtAnswer,
                                                            txtOptionOne,
                                                            txtOptionTwo,
                                                            txtOptionThree,
                                                            txtOptionFour,
                                                            txtStatus
                                                ) VALUES(
                                                            '$queId',
                                                            '$this->txtAnswer',
                                                            '$this->txtOptionOne',
                                                            '$this->txtOptionTwo',
                                                            '$this->txtOptionThree',
                                                            '$this->txtOptionFour',
                                                            '1'
                                                        )";
        $db->query($sql_query);
    }

    public function updateQuestion($param) {
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."quiz SET txtQuestion = '$this->txtQuestion' WHERE txtId = '$param'";
        $db->query($sql_query);
    }

    public function updateQueAns($param) {
        $db = new Config();
        $sql_query = "UPDATE "._DB_PREFIX."quiz_ans SET txtAnswer       = '$this->txtAnswer',
                                                        txtOptionOne    = '$this->txtOptionOne',
                                                        txtOptionTwo    = '$this->txtOptionTwo',
                                                        txtOptionThree  = '$this->txtOptionThree',
                                                        txtOptionFour   = '$this->txtOptionFour'
                                                    WHERE txtQuizId = '$param'";
        $db->query($sql_query);
    }

    public function getQuizDetails($mode,$param) {
        $db = new Config();
        if ($mode == "all") {
            $query = $db->select("*");
            $query .= $db->from(_DB_PREFIX."quiz");
            // $query .= $db->where("txtStatus = 1");
        }
        if ($mode == "edit") {
            $query = "SELECT "._DB_PREFIX."quiz.txtId,"._DB_PREFIX."quiz.txtQuestion,"._DB_PREFIX."quiz_ans.txtAnswer,
                             "._DB_PREFIX."quiz_ans.txtOptionOne,"._DB_PREFIX."quiz_ans.txtOptionTwo,
                             "._DB_PREFIX."quiz_ans.txtOptionThree,"._DB_PREFIX."quiz_ans.txtOptionFour
                     FROM "._DB_PREFIX."quiz
                     LEFT JOIN "._DB_PREFIX."quiz_ans
                        ON "._DB_PREFIX."quiz.txtId = "._DB_PREFIX."quiz_ans.txtQuizId
                     WHERE "._DB_PREFIX."quiz.txtId = '$param' ";
        }
        if ($mode == "trash") {
            $query = $db->select("*");
            $query .= $db->from(_DB_PREFIX."quiz");
            $query .= $db->where("txtStatus = 0");
            $query .= $db->orderby("txtId");
        }
        $db->query($query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getQuestionPreview($param) {
        $db = new Config();
        $query = "SELECT "._DB_PREFIX."quiz.txtQuestion,"._DB_PREFIX."quiz_ans.txtAnswer,
                         "._DB_PREFIX."quiz_ans.txtOptionOne,"._DB_PREFIX."quiz_ans.txtOptionTwo,
                         "._DB_PREFIX."quiz_ans.txtOptionThree,"._DB_PREFIX."quiz_ans.txtOptionFour
                 FROM "._DB_PREFIX."quiz
                 LEFT JOIN "._DB_PREFIX."quiz_ans
                    ON "._DB_PREFIX."quiz.txtId = "._DB_PREFIX."quiz_ans.txtQuizId
                 WHERE "._DB_PREFIX."quiz.txtId = '$param' ";
        $db->query($query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getApplications($mode,$param) {
        $db = new Config();
        if ($mode == "all") {
            $query = $db->select("*");
            $query .= $db->from(_DB_PREFIX."appl_form");
            $query .= $db->where("txtStatus = 1");
        }
        if ($mode == "trash") {
            $query = $db->select("*");
            $query .= $db->from(_DB_PREFIX."appl_form");
            $query .= $db->where("txtStatus = 0");
        }
        $db->query($query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getApplicationsPreview($param) {
        $db = new Config();
        $query = $db->select("*");
        $query .= $db->from(_DB_PREFIX."appl_form");
        $query .= $db->where("txtId = '$param'");
        $db->query($query);
        $collection = array();
        while ($rows = $db->fetchAssoc()) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function disableQuestion($param) {
        $db = new Config();
        $sql_quiz = $db->query("UPDATE "._DB_PREFIX."quiz SET txtStatus = 0 WHERE txtId = '$param';");
        $sql_quiz_ans = $db->query("UPDATE "._DB_PREFIX."quiz_ans SET txtStatus = 0 WHERE txtQuizId = '$param';");
    }

    public function enableQuestion($param) {
        $db = new Config();
        $sql_quiz = $db->query("UPDATE "._DB_PREFIX."quiz SET txtStatus = 1 WHERE txtId = '$param';");
        $sql_quiz_ans = $db->query("UPDATE "._DB_PREFIX."quiz_ans SET txtStatus = 1 WHERE txtQuizId = '$param';");
    }

    public function deleteQuestion($param) {
        $db = new Config();
        $sql_quiz = $db->query("DELETE FROM "._DB_PREFIX."quiz WHERE txtId = '$param';");
        $sql_quiz_ans = $db->query("DELETE FROM "._DB_PREFIX."quiz_ans WHERE txtQuizId = '$param';");
    }

    public function trashApplication($param) {
        $db = new Config();
        $query = "UPDATE "._DB_PREFIX."appl_form SET txtStatus = '0' WHERE txtId = '$param'";
        $db->query($query);
    }

    public function enableApplication($param) {
        $db = new Config();
        $query = "UPDATE "._DB_PREFIX."appl_form SET txtStatus = '1' WHERE txtId = '$param'";
        $db->query($query);
    }

    public function deleteApplication($param) {
        $db = new Config();
        $query = "DELETE FROM "._DB_PREFIX."appl_form WHERE txtId = '$param'";
        $db->query($query);
    }

}

$objQuiz = new Quiz();

?>