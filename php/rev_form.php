<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "rev_insert.php";

if (array_key_exists("rev_id", $_GET)) {
    $rev_id = $_GET["rev_id"];
    $query =  "select * from review where rev_id = $rev_id";
    $res = mysqli_query($conn, $query);
    $review = mysqli_fetch_array($res);
    if(!$review) {
        msg("리뷰가  존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "rev_modify.php";
}

$company = array();

$query = "select * from cosmetics";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $cosmetics[$row['cos_id']] = $row['cos_name'];
}
?>

<style type="text/css">
	table{
	}
</style>

<table border="1" bordercolor="gray" width="980" height="100%" cellspacing="0" cellpadding="30" align="center">
        <tr>
        <td>
        <form name="rev_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="rev_id" value="<?=$review['rev_id']?>"/>
            <h2>화장품 리뷰 <?=$mode?></h2>
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="cos_id"> 화장품</label>
                <select name="cos_name" id="cos_name">
                    <option value="-1">리뷰할 화장품을 선택해 주십시오.</option>
                    <?
                        foreach($cosmetics as $name) {
                            if($name == $review['cos_name']){
                                echo "<option value='{$name}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$name}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="rev_title"> 제목</label>
                <input type="text" placeholder="제목" id="rev_title" name="rev_title" value="<?=$review['rev_title']?>"/>
            </p>
            <img src="images/heart.png" width="17" height="15"/><label for="rev_detail"> 내용</label>
            <p>
                <textarea cols="50" rows="5" placeholder="내용" id="rev_detail" name="rev_detail"><?=$review['rev_detail']?></textarea>
            </p>
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="rev_code"> 확인 코드(추후 수정, 삭제 시 필요합니다)</label>
                <input type="text" placeholder="생일 6글자 ex) 981201" id="rev_code" name="rev_code" value="<?=$review['rev_code']?>"/>
            </p>
            <br>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("cos_id").value == "-1") {
                        alert ("화장품을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("rev_title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("rev_detail").value == "") {
                        alert ("내용을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
        	
        </td>
        </tr>
</table>

<?php include ("footer.php"); ?>