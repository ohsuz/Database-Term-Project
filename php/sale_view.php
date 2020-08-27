<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("sale_id", $_GET)) {
    $sale_id = $_GET["sale_id"];
    $query = "select * from sale natural join company where sale_id = $sale_id";
    $res = mysqli_query($conn, $query);
    $sale = mysqli_fetch_assoc($res);
    if (!$sale) {
        msg("세일 정보가 존재하지 않습니다.");
    }
}

?>

<table border="1" bordercolor="gray" width="980" height="100%" cellspacing="0" cellpadding="30" align="center">
        <tr>
        <td>
        <h2>세일 정보 상세 보기</h2>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="sale_id"> 세일 정보 코드</label>
            <input style="background:rgb(251, 239, 243); width:50px;" readonly disabled type="text" id="sale_id" name="sale_id" value="<?= $sale['sale_id'] ?>"/>
        </p>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="title"> 제목</label>
            <input style="background:rgb(251, 239, 243);width:150px;" readonly disabled type="text" id="title" name="title" value="<?= $sale['title'] ?>"/>
        </p>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="company_name"> 회사</label>
            <input style="background:rgb(251, 239, 243);width:140px;" readonly disabled type="text" id="company_name" name="company_name" value="<?= $sale['company_name'] ?>"/>
        </p>
        <img src="images/heart.png" width="17" height="15"/><label for="info"> 내용</label>
        <p>
        	<textarea style="background:rgb(251, 239, 243);" readonly cols="50" rows="5" id="info" name="info" disabled><?= $sale['info'] ?></textarea>
        </p><br>

        </td>
        </tr>
</table>

<?php include ("footer.php"); ?>
