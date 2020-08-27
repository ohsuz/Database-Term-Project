<!DOCTYPE html>
<html lang='ko'>
<link rel="stylesheet" href="style.css">

<head>
    <title>GetSUZbEAUTy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<script>
        function view1(opt){
            if(opt){
                spec1.style.display="block";
            }
            else{
                spec1.style.display="none";
            }
        }
        function insertConfirm() {
            	var code;
            	code=prompt("세일 정보는 관리자만 입력 가능합니다. 관리자 코드를 입력해주세요","");
            	if(code==1004){
            		window.location = "sale_form.php";
            	}else{
            		alert("코드가 틀렸습니다. 관리자가 아니라면 접근하지 마세요-.-!");
            	}
        }
</script>
<style>
	    body {background: white; background-image:url('images/background.gif'); background-size:100%;background-repeat: repeat-y; background-attachment: fixed;
    font-family: "Jeju Gothic";}
</style>
<body align="center">
	<br><br><br><br><a href="index.php"><img src="images/대체언제.png"/></a>
<table bordercolor="gray" border="1" width="980" height="70" cellspacing="0" cellpadding="0" align="center">
	<tr align="center">
		<td width="20%"><a href="cos_list.php"><span onmouseover="this.style.color='#e18ab7'" onmouseout="this.style.color='black'">GetBEAUTY!</span></a></td>
		<td width="20%"><a href="rev_list.php"><span onmouseover="this.style.color='#e18ab7'" onmouseout="this.style.color='black'">REVIEW</span></a></td>
		<td width="15%"><a href="sale_list.php"><span onmouseover="this.style.color='#e18ab7'" onmouseout="this.style.color='black'">SALE</span></a></td>
		<td width="10%"><a href="best_list.php" title=" 화장품 베스트"><span onmouseover="this.style.color='#e18ab7'" onmouseout="this.style.color='black'">BEST</span></a></td>
		<td width="16%" onmouseover="this.style.color='#e18ab7'" onmouseout="this.style.color='black'">
            <div style="float:middle; color:black;" onmouseover="view1(true)">REGISTER</div>
            <div onmouseover="view1(true)" onmouseout="view1(false)" id="spec1" style="position:relative; z-index:1; left:0px; top:0px; display:none">
                <div style="position:absolute; width:136px; top:20px; z-index:1; background:rgba(255, 255, 255, 0.555); border:0px; line-height:1em; padding:10px 10px;">
                <br><div onmouseover="this.style.color='#e18ab7'" onmouseout="this.style.color='black'"><a href="cos_form.php">COSMETICS</a></div><br><br>
                <div><a href="rev_form.php">REVIEW</a></div><br><br>
                <div style="color:black;"onclick='javascript:insertConfirm()'>SALE</div><br>
                </div>
            </div>
        </td>
		<td><a href="thanks_to.php" title="땡스투"><span onmouseover="this.style.color='#e18ab7'" onmouseout="this.style.color='black'">THANKS TO</span></a></td>
	</tr>
</table>
