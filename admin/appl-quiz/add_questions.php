<?php
session_start();
ob_start();

$uid   = $_SESSION["txtId"];
$uname = $_SESSION["txtUsername"];
//--------------------------------------------------------------------------
// *** remote file inclusion, check for strange characters in $_GET keys
// *** all keys with "/", "\", ":" or "%-0-0" are blocked, so it becomes virtually impossible
// *** to inject other pages or websites
foreach($_GET as $get_key => $get_value) {
    if(is_string($get_value) && ((preg_match("/\//", $get_value)) || (preg_match("/\[\\\]/", $get_value)) || (preg_match("/:/", $get_value)) || (preg_match("/%00/", $get_value)))){
        if(isset($_GET[$get_key])) unset($_GET[$get_key]);
        die("A hacking attempt has been detected. For security reasons, we're blocking any code execution.");
    }
}

require_once (dirname(dirname(__DIR__)).'/inc/config.inc.php');
include_once (dirname(dirname(__DIR__)).'/inc/function.inc.php');
$_SESSION['page_title'] = "Add Question | "._PANEL_NAME." :: "._SITE_NAME;
$db = new Config(); 
if(empty($_SESSION["txtId"]) && empty($_SESSION["txtUsername"])){
   header("location:"._SITE_URL."/admin/");
}

?>

<?php include dirname(__DIR__).'/include/header.php' ?>

    <?php include dirname(__DIR__).'/include/left_menu.php' ?>

    <div class="col-md-9">
        <div class="col-lg-4"><h4><strong>ADD QUESTION</strong></h4></div>

        <div class="col-lg-6">
            <div id="succ-resp" style="display:none"></div>
        </div>

        <form name="frmAddQuestion" id="frmAddQuestion" method="post">
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-10">
                <div class="form-group">
                    <label>Quiz Question&nbsp;<span class="err">*</span></label>
                    <input type="text" id="txtQuestion" class="form-control input-md" name="txtQuestion" placeholder="Enter Question">
                </div>
            </div>
                        
            <div class="col-md-12">&nbsp;</div>

            <div class="col-md-10">
                <!-- <div class="form-group">
                    <label for="option-one">Options</label>
                    <input type="text" id="txtOptionOne" class="form-control input-md" name="txtOptionOne" placeholder="Option One required">
                    <br>
                    <input type="text" id="txtOptionTwo" class="form-control input-md" name="txtOptionTwo" placeholder="Option Two required">
                    <br>
                    <input type="text" id="txtOptionThree" class="form-control input-md" name="txtOptionThree" placeholder="Option Three">
                    <br>
                    <input type="text" id="txtOptionFour" class="form-control input-md" name="txtOptionFour" placeholder="Option Four">
                </div> -->

                <div class="form-group">
                    <label for="option-one">Options</label>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" id="rdoCorrectOne" name="rdoCorrect">
                            <input type="text" id="txtOptionOne" class="form-control input-md" name="txtOptionOne" placeholder="Option One">
                        </label>
                    </div>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" id="rdoCorrectTwo" name="rdoCorrect">
                            <input type="text" id="txtOptionTwo" class="form-control input-md" name="txtOptionTwo" placeholder="Option Two">
                        </label>
                    </div>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" id="rdoCorrectThree" name="rdoCorrect">
                            <input type="text" id="txtOptionThree" class="form-control input-md" name="txtOptionThree" placeholder="Option Three">
                        </label>
                    </div>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" id="rdoCorrectFour" name="rdoCorrect">
                            <input type="text" id="txtOptionFour" class="form-control input-md" name="txtOptionFour" placeholder="Option Four">
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">&nbsp;</div>

            <div class="col-md-10">
                <div class="form-group">
                    <label>Correct Answer&nbsp;<span class="err">*</span></label>
                    <input type="text" id="txtAnswer" class="form-control input-md" name="txtAnswer" placeholder="Correct Answer" readonly="">
                </div>
            </div>

            <div class="col-md-12 extract-div">
                <div class="col-md-6">
                    <div class="form-group">
                        <button type="button" class="btn btn-md btn-primary" name="btnCreateQuize" id="btnCreateQuize">
                            <span style="display:none" id="ques_loading"></span>&nbsp;Add Question
                        </button>
                    </div>
                </div>
                <div class="col-md-6 open-up-msg">
                    <div class="form-group">
                        <div id="page-success" style="display: none">
                            Question has been added successfully.
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php include dirname(__DIR__).'/include/footer.php' ?>