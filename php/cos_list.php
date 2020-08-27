<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>

<style type="text/css">
	table{
		text-align:center;
	}
	button {padding: 5px; color: gray; font-family: "Jeju Gothic"; background-color: white; font-size: 10pt; height: 25px; border-color:#ffe5f3; border-radius:5px;}
</style>

<table border="1" bordercolor="gray" width="980" height="100%" cellspacing="0" cellpadding="30" align="center">
        <tr>
        <td>
        <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from cosmetics natural join company order by cos_id";
    
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  "select * from cosmetics natural join company where cos_name like '%$search_keyword%' or company_name like '%$search_keyword%'";
    }
    
    
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

	<table bordercolor="gray" border="1" width="900"  cellspacing="0" cellpadding="0" align="center">
        <thead>
        <tr>
            <th width="7%" height="40">No.</th>
            <th width="20%">이름</th>
            <th width="23%">회사</th>
            <th width="15%">유형</th>
            <th width="13%">가격</th>
            <th width="10%">점수</th>
            <th width="12%">기능</th>
        </tr>
        </thead>
        
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td height='40'>{$row_index}</td>";
            echo "<td><a href='cos_view.php?cos_id={$row['cos_id']}'>{$row['cos_name']}</a></td>";
            echo "<td>{$row['company_name']}</td>";
            echo "<td>{$row['cos_type']}</td>";
            echo "<td>{$row['cos_price']}원</td>";
            echo "<td>{$row['cos_score']}점</td>";
            echo "<td width='17%'>
                 <button button onclick='javascript:modifyConfirm({$row['cos_id']},{$row['confirm_code']})' class='button primary small'>수정</button>
                 <button onclick='javascript:deleteConfirm({$row['cos_id']},{$row['confirm_code']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <br><br><br>
    <table bordercolor="gray" border="0" width="900"  cellspacing="0" cellpadding="0" align="center">
    	<tr>
    		<td>
    			<form action="cos_list.php" method="post">
	            	찾으시는 화장품이 있나요? <input type="text" name="search_keyword" placeholder="화장품 이름 검색">
	            </form>
    		</td>
    	</tr>
    </table>

    <script>
        function deleteConfirm(cos_id,confirm_code) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
            	var code;
            	code=prompt("글을 작성할 때 입력하신 확인 코드를 입력해주세요","");
            	if(code==confirm_code){
            		window.location = "cos_delete.php?cos_id=" + cos_id;
            	}else{
            		alert("확인코드가 틀렸습니다. 다시 시도해주세요.");
            	}
            }else{   //취소
                return;
            }
        }
        function modifyConfirm(cos_id,confirm_code) {
            	var code;
            	code=prompt("글을 작성할 때 입력하신 확인 코드를 입력해주세요","");
            	if(code==confirm_code){
            		window.location = "cos_form.php?cos_id=" + cos_id;
            	}else{
            		alert("확인코드가 틀렸습니다. 다시 시도해주세요.");
            	}
        }
    </script>

        </td>
        </tr>
</table>

<?php include ("footer.php"); ?>
