<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$rev_id = $_POST['rev_id'];
$cos_name = $_POST['cos_name'];
$rev_detail = $_POST['rev_detail'];
$rev_title = $_POST['rev_title'];
$rev_code = $_POST['rev_code'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "update review set cos_name = '$cos_name', rev_detail = '$rev_detail', rev_title = '$rev_title', rev_code = $rev_code where rev_id = $rev_id");

if(!$ret)
{
	mysqli_query($conn, "rollback"); // 리뷰 수정 query 수행 실패. 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // 리뷰 수정 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=rev_list.php'>";
}

?>

