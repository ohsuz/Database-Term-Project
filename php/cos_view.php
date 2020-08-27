<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("cos_id", $_GET)) {
    $cos_id = $_GET["cos_id"];
    $query = "select * from cosmetics natural join company where cos_id = $cos_id";
    $res = mysqli_query($conn, $query);
    $cosmetics = mysqli_fetch_assoc($res);
    if (!$cosmetics) {
        msg("화장품이 존재하지 않습니다.");
    }
}

?>

<table border="1" bordercolor="gray" width="980" height="100%" cellspacing="0" cellpadding="30" align="center">
        <tr>
        <td>
        <h2>화장품 정보 상세 보기</h2>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="cos_id"> 화장품 코드</label>
            <input style="background:rgb(251, 239, 243); width:50px;"readonly disabled type="text" id="cos_id" name="cos_id" value="<?= $cosmetics['cos_id'] ?>"/>
        </p>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="cos_name"> 화장품 이름</label>
            <input style="background:rgb(251, 239, 243); width:150px;"readonly disabled type="text" id="cos_name" name="cos_name" value="<?= $cosmetics['cos_name'] ?>"/>
        </p>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="company_name"> 회사</label>
            <input style="background:rgb(251, 239, 243); width:140px;"readonly disabled type="text" id="company_name" name="company_name" value="<?= $cosmetics['company_name'] ?>"/>
        </p>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="cos_type"> 유형</label>
            <input style="background:rgb(251, 239, 243); width:100px;"readonly disabled type="text" id="cos_type" name="cos_type" value="<?= $cosmetics['cos_type'] ?>"/>
        </p>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="cos_price"> 가격</label>
            <input style="background:rgb(251, 239, 243); width:50px;"readonly disabled type="text" id="cos_price" name="cos_price" value="<?= $cosmetics['cos_price'] ?>"/>
        </p>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="cos_score"> 점수</label>
            <input style="background:rgb(251, 239, 243); width:50px;"readonly disabled type="text" id="cos_score" name="cos_score" value="<?= $cosmetics['cos_score'] ?>"/>
        </p><br>

        </td>
        </tr>
</table>

<?php include ("footer.php"); ?>
