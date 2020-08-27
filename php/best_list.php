<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>

<table border="1" bordercolor="gray" width="980" height="100%" cellspacing="0" cellpadding="30" align="center">
        <tr>
        <td>
        <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from best natural join cosmetics natural join company order by best_id";
    
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

	<table bordercolor="gray" border="1" width="900"  cellspacing="0" cellpadding="0" align="center">
        <thead>
        <tr>
            <th width="15%" height="40">No.</th>
            <th width="35%">이름</th>
            <th width="25%">회사</th>
            <th width="25%">점수</th>
        </tr>
        </thead>
        
        <tbody align="center">
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td height='40'>{$row_index}</td>";
            echo "<td><a href='cos_view.php?cos_id={$row['cos_id']}'>{$row['cos_name']}</a></td>";
            echo "<td>{$row['company_name']}</td>";
            echo "<td>{$row['cos_score']}</td>";
            echo "</tr>";
        	
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</table>

<?php include ("footer.php"); ?>
