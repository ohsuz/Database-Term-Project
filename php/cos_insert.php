<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$cos_name = $_POST['cos_name'];
$cos_type = $_POST['cos_type'];
$company_id = $_POST['company_id'];
$cos_price = $_POST['cos_price'];
$cos_score = $_POST['cos_score'];
$confirm_code = $_POST['confirm_code'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$sql="insert into cosmetics (cos_name, cos_type, company_id, cos_price, cos_score, confirm_code) values('$cos_name','$cos_type','$company_id','$cos_price','$cos_score','$confirm_code')";

$ret = mysqli_query($conn, $sql);

if(!$ret)
{
	mysqli_query($conn, "rollback"); // 화장품 등록 query 수행 실패. 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	if($cos_score>=8){
		$ret2 = mysqli_query($conn, "insert into best(cos_name) values('$cos_name')");
		if(!$ret2){
			mysqli_query($conn, "rollback"); // 베스트 화장품 등록 query 수행 실패. 수행 전으로 rollback
    		msg('Query Error : '.mysqli_error($conn));
		}else{
			// 베스트 화장품 등록 query 수행 성공
		}
	}
	mysqli_query($conn, "commit"); // 화장품 등록 query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=cos_list.php'>";
}
?>

