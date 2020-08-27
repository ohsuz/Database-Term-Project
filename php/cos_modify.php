<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$cos_id = $_POST['cos_id'];
$cos_name = $_POST['cos_name'];
$cos_type = $_POST['cos_type'];
$company_id = $_POST['company_id'];
$cos_price = $_POST['cos_price'];
$confirm_code = $_POST['confirm_code'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "update cosmetics set cos_name = '$cos_name', cos_type = '$cos_type', company_id = $company_id, cos_price = $cos_price, confirm_code='$confirm_code' where cos_id = $cos_id");


if(!$ret)
{
	mysqli_query($conn, "rollback"); // 화장품 수정 query 수행 실패. 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); // 화장품 수정 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=cos_list.php'>";
}

?>

