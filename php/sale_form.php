<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "sale_insert.php";

if (array_key_exists("sale_id", $_GET)) {
    $sale_id = $_GET["sale_id"];
    $query =  "select * from sale where sale_id = $sale_id";
    $res = mysqli_query($conn, $query);
    $sale = mysqli_fetch_array($res);
    if(!$sale) {
        msg("세일 정보가  존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "sale_modify.php";
}

$company = array();

$query = "select * from company";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $company[$row['company_id']] = $row['company_name'];
}
?>

<style type="text/css">
	table{
	}
</style>

<table border="1" bordercolor="gray" width="980" height="100%" cellspacing="0" cellpadding="30" align="center">
        <tr>
        <td>
        <form name="sale_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="sale_id" value="<?=$sale['sale_id']?>"/>
            <h2>세일 정보 <?=$mode?></h2>
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="company_id"> 회사</label>
                <select name="company_id" id="company_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($company as $id => $name) {
                            if($id == $sale['company_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="title"> 제목</label>
                <input type="text" placeholder="제목" id="title" name="title" value="<?=$sale['title']?>"/>
            </p>
            <img src="images/heart.png" width="17" height="15"/><label for="info"> 내용</label>
            <p>
                <textarea cols="50" rows="5" placeholder="내용" id="info" name="info"><?=$sale['info']?></textarea>
            </p><br>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("company_id").value == "-1") {
                        alert ("회사를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("info").value == "") {
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