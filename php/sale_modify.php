<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$sale_id = $_POST['sale_id'];
$title = $_POST['title'];
$info = $_POST['info'];
$company_id = $_POST['company_id'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "update sale set company_id='$company_id', title = '$title', info = '$info' where sale_id = $sale_id");

if(!$ret)
{
	mysqli_query($conn, "rollback"); // 세일 정보 수정 query 수행 실패. 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // 세일 정보 수정 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=sale_list.php'>";
}

?>

