<?php
/**
* 
*/
class Pages
{
    
    function __construct(){
        # code...
    }

    public function setDetails($arr_appl){
        $this->txtFirstName         = $arr_appl["txtFirstName"];
        $this->txtLastName          = $arr_appl["txtLastName"];
        $this->txtMailingAddr       = $arr_appl["txtMailingAddr"];
        $this->txtAppartment        = $arr_appl["txtAppartment"];
        $this->txtCity              = $arr_appl["txtCity"];
        $this->txtState             = $arr_appl["txtState"];
        $this->txtZipcode           = $arr_appl["txtZipcode"];
        $this->txtWorkExp           = $arr_appl["txtWorkExp"];
        $this->txtPaidCleaning      = $arr_appl["txtPaidCleaning"];
        $this->txtHearAbout         = $arr_appl["txtHearAbout"];
        $this->txtEligibleToWork    = $arr_appl["txtEligibleToWork"];
        $this->txtTshirtPreference  = $arr_appl["txtTshirtPreference"];
        $this->txtTshirtSize        = $arr_appl["txtTshirtSize"];
        $this->txtAgreeTerms        = $arr_appl["txtAgreeTerms"];
    }

    public function insertApplication(){
        $db = new Config();
        $sql_query = "INSERT INTO "._DB_PREFIX."appl_form(
                                                            txtFirstName,
                                                            txtLastName,
                                                            txtMailingAddr,
                                                            txtAppartment,
                                                            txtCity,
                                                            txtState,
                                                            txtZipcode,
                                                            txtWorkExp,
                                                            txtPaidCleaning,
                                                            txtHearAbout,
                                                            txtEligibleToWork,
                                                            txtTshirtPreference,
                                                            txtTshirtSize,
                                                            txtAgreeTerms,
                                                            txtStatus
                                                  )VALUES(
                                                            '$this->txtFirstName',
                                                            '$this->txtLastName',
                                                            '$this->txtMailingAddr',
                                                            '$this->txtAppartment',
                                                            '$this->txtCity',
                                                            '$this->txtState',
                                                            '$this->txtZipcode',
                                                            '$this->txtWorkExp',
                                                            '$this->txtPaidCleaning',
                                                            '$this->txtHearAbout',
                                                            '$this->txtEligibleToWork',
                                                            '$this->txtTshirtPreference',
                                                            '$this->txtTshirtSize',
                                                            '$this->txtAgreeTerms',
                                                            '1'
                                                         )";
        $db->query($sql_query);
    }

    public function getWelcomeDetails(){
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."pages";
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getPageContent(){
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."pages";
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getContactDetails(){
        $db = new Config();
        $sql_query = "SELECT * FROM "._DB_PREFIX."contact_details";
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }

    public function getQuiz(){
        $db = new Config();
        $sql_query = "SELECT "._DB_PREFIX."quiz.txtQuestion, "._DB_PREFIX."quiz_ans.*
                      FROM "._DB_PREFIX."quiz
                      RIGHT JOIN "._DB_PREFIX."quiz_ans
                          ON "._DB_PREFIX."quiz.txtId = "._DB_PREFIX."quiz_ans.txtQuizId
                      WHERE "._DB_PREFIX."quiz.txtStatus = 1
                      ORDER BY "._DB_PREFIX."quiz.txtId DESC";
        $result = $db->query($sql_query);
        $collection = array();
        while ($rows = $db->fetchAssoc($result)) {
            array_push($collection, $rows);
        }
        return $collection;
    }
}

$objPage = new Pages();

?>