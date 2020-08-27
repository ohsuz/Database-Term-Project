<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("rev_id", $_GET)) {
    $rev_id = $_GET["rev_id"];
    $query = "select * from review natural join cosmetics where rev_id = $rev_id";
    $res = mysqli_query($conn, $query);
    $review = mysqli_fetch_assoc($res);
    if (!$review) {
        msg("리뷰가 존재하지 않습니다.");
    }
}

?>

<table border="1" bordercolor="gray" width="980" height="100%" cellspacing="0" cellpadding="30" align="center">
        <tr>
        <td>
        <h2>리뷰 상세 보기</h2>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="rev_id"> 리뷰 코드</label>
            <input style="background:rgb(251, 239, 243); width:50px;" readonly disabled type="text" id="rev_id" name="rev_id" value="<?= $review['rev_id'] ?>"/>
        </p>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="cos_name"> 리뷰한 화장품</label>
            <input style="background:rgb(251, 239, 243); width:150px;" readonly disabled type="text" id="cos_name" name="cos_name" value="<?= $review['cos_name'] ?>"/>
        </p>
        <p>
            <img src="images/heart.png" width="17" height="15"/><label for="rev_title"> 제목</label>
            <input style="background:rgb(251, 239, 243); width:150px;" readonly disabled type="text" id="rev_title" name="rev_title" value="<?= $review['rev_title'] ?>"/>
        </p>
        <img src="images/heart.png" width="17" height="15"/><label for="rev_detail"> 내용</label>
        <p>
        	<textarea style="background:rgb(251, 239, 243);" readonly cols="50" rows="5" id="rev_detail" name="rev_detail" disabled><?= $review['rev_detail'] ?></textarea>
        </p><br>

        </td>
        </tr>
</table>

<?php include ("footer.php"); ?>