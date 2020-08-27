<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "cos_insert.php";

if (array_key_exists("cos_id", $_GET)) {
    $cos_id = $_GET["cos_id"];
    $query =  "select * from cosmetics natural left outer join best where cos_id = $cos_id";
    $res = mysqli_query($conn, $query);
    $cosmetics = mysqli_fetch_array($res);
    if(!$cosmetics) {
        msg("화장품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "cos_modify.php";
}

$company = array();

$query = "select * from company";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $company[$row['company_id']] = $row['company_name'];
}
?>

<table border="1" bordercolor="gray" width="980" height="100%" cellspacing="0" cellpadding="30" align="center">
        <tr>
        <td>
        <form name="cos_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="cos_id" value="<?=$cosmetics['cos_id']?>"/>
            <h2>화장품 정보 <?=$mode?></h2>
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="company_id"> 회사</label>
                <select name="company_id" id="company_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($company as $id => $name) {
                            if($id == $cosmetics['company_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="cos_name"> 이름</label>
                <input type="text" placeholder="화장품 이름" id="cos_name" name="cos_name" value="<?=$cosmetics['cos_name']?>"/>
            </p>
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="cos_type"> 유형</label>
                <input type="text" placeholder="화장품 유형" id="cos_type" name="cos_type" value="<?=$cosmetics['cos_type']?>"/>
            </p>
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="cos_price"> 가격</label>
                <input type="number" placeholder="화장품 가격" id="cos_price" name="cos_price" step="1000" value="<?=$cosmetics['cos_price']?>" />
            </p>
            <script>
            var action="<? echo $action;?>";
            
            if(action=="cos_insert.php"){
            	document.write('<p><img src="images/heart.png" width="17" height="15"/><label for="cos_score"> 점수(10점 만점)</label><input type="range" placeholder="정수로 입력" id="cos_score" name="cos_score" min="0" max="10" value="<?=$cosmetics['cos_score']?>" /></p><h5>※  점수는 추후에 수정이 불가능하오니 신중히 입력해주시길 바랍니다.</h5>');
            }
            </script>
           
            <p>
                <img src="images/heart.png" width="17" height="15"/><label for="confirm_code"> 확인 코드(추후 수정, 삭제 시 필요합니다)</label>
                <input type="text" placeholder="생일 6글자 ex) 981201" id="confirm_code" name="confirm_code" value="<?=$cosmetics['confirm_code']?>"/>
            </p><br>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("company_id").value == "-1") {
                        alert ("제조사를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("cos_name").value == "") {
                        alert ("화장품 명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("cos_type").value == "") {
                        alert ("화장품 유형을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("cos_price").value == "") {
                        alert ("가격을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("cos_start").value == "") {
                        alert ("별점을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("confirm_code").value == "") {
                        alert ("확인코드를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
        	
        </td>
        </tr>
</table>

<?php include ("footer.php"); ?>