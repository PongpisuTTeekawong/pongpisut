<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../assets/images/favicon.png">
<title>Invoice</title>
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Sarabun:200');
body {
  margin: 0;
  padding: 0;
  background-color: #FAFAFA;
  font-family: 'Sarabun', sans-serif;
  font-size:14px;
}

* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.page {
  width: 21cm;
  min-height: 29.7cm;
  padding: 0.5cm;
  margin: 1cm auto;
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}



@page {
  size: A4;
  margin: 0;
}

@media print {
  .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }
}
.box{ /* ชื่อคลาสต้องตรงกับ <img class="circle"... */

    border: 1px solid #000; /* เส้นขอบขนาด 3px solid: เส้น #fff:โค้ดสีขาว */
   border-radius: 20px;
	width:90%;
	height:150px;
}
.B {
	font-weight: bold;
}
</style>
</head>

<body onload="window.print()">
<div class="book">
		<?php include "include/connect.php"; 
		$id =$_GET['invoice'];
		
		
		$sql = "SELECT * FROM `sln_member` WHERE member_id='$id'";
	
		//$sql = "SELECT * FROM  `sln_invoice` inner join sln_member WHERE sln_invoice.member_id=sln_member.member_id && member_payment='1'";
		$ex = mysql_query($sql);
		while ($rs = mysql_fetch_array($ex)){?>

  <div class="page">
  	<table width="100%" height="1073" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <th height="344" valign="top" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td width="54%" align="left" bgcolor="#FFFFFF" scope="col"><img src="photo/sln-logo.jpg" width="273" height="98" /></td>
            <td width="46%" align="right" valign="top" bgcolor="#FFFFFF"></td>
          </tr>
          <tr>
            <td align="center">
            <div class="box">
            
            <h5>ใบแจ้งค่าใช้บริการอินเตอร์เน็ต</h5>
            <b><?=$rs['member_name_surname'];?></b><br/>
            <?=$rs['member_address'];?> ต.<?=$rs['member_sub_district'];?> อ.<?=$rs['member_district'];?> จ.<?=$rs['member_province'];?> <?=$rs['member_postcode'];?>
            </div>
            </td>
            <td align="right" valign="top"><table width="95%" border="0" cellspacing="2" cellpadding="5">
              <tr>
                <td width="56%" scope="col">เลขที่ลูกค้า</td>
                <td width="44%" scope="col"><?=$rs['member_id'];?></td>
              </tr>
              <tr>
                <td>วันที่จัดทำใบแจ้งค่าใช้บริการ </td>
                <td><?php echo date("d-m-Y");?></td>
              </tr>
              <tr>
                <td height="88" colspan="2" align="center">
               <img alt="testing" width="160px" src="barcode.php?text=<?=$rs['member_id'];?>" />
                </td>
                </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td height="45" colspan="2" align="center" valign="bottom">
              <h5>( ห้างหุ้นส่วนจํากัด ชัวร์ลิ้งค์เน็ทเวิร์ค 387/3 หมู่ที่ 8 ต.ปัว อ.ปัว จ.น่าน 55120 &nbsp;&nbsp; โทร 081-2878955 )</h5>
            </td>
            </tr>
        </table></th>
      </tr>
      <tr>
        <td height="212" align="left" valign="top" scope="col">
        -<br />
        <table width="100%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <th height="56" scope="col"><strong>เลขที่ใบแจ้งค่าบริการ</strong></th>
            <th scope="col"><strong>ค่าใช้บริการประจำเดือน</strong></th>
            <th scope="col"><strong>ค่าบริการ</strong></th>
          </tr>
        
		
		<?php 
		$id=$rs['member_id'];
		
			$sql1 = "SELECT * FROM  `sln_invoice` WHERE member_id='$id' && invoice_status='0'";
			$ex1 = mysql_query($sql1);
			$total = 0;
		while ($rs1 = mysql_fetch_array($ex1)){?>
          <tr>
            <td height="41" align="center">#<?=$rs1['invoice_id'];?></td>
            <td align="center"><?=$rs1['invoice_date'];?></td>
            <td align="center">
            <?php $total = $total + $rs1["package_price"];?>
			<?=$rs1['package_price'];?></td>
            <?php } ?>
          </tr>
          <tr>
            <td height="26" colspan="2" align="right">รวมชำระค่าบริการ (บาท)&nbsp;</td>
            <td align="center">
            
            <?php
			 echo $total ;
			
			?>
            
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="472" align="center" valign="top" scope="col"><table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="32" colspan="2" align="center"><h4>ชำระเงินได้ที่ ร้านเฮือนปัวมินิมาร์ท (ติดกับตลาดสดเทศบาล2 ข้างต้นโพธิ์)</h4></td>
              <td width="0%">&nbsp;</td>
              <td width="45%" align="center"><h4>ชำระผ่านพร้อมเพย์ หรือโอนผ่านเลขบัญชีธนาคาร<font color="red">*</font></h4></td>
            </tr>
            <tr>
              <td height="197" colspan="2" align="center" valign="top"><img src="photo/pua.JPG" width="399" height="180" /></td>
              <td>&nbsp;</td>
              <td align="center" valign="top"><img src="photo/pay.jpg" width="173" height="180" /></td>
            </tr>
            <tr>
              <td height="16" colspan="4" align="center" style="color:red;"><b>* ชำระผ่านพร้อมเพย์ หรือโอนผ่านเลขบัญชีธนาคาร กรุณายืนยันการชำระผ่านทาง Line ด้วยทุกครั้ง เพื่อเป็นหลักฐานการชำระเงิน</b></td>
            </tr>
            <tr>
              <td width="20%" align="center" valign="top"><img src="photo/line.jpg" width="81" height="81" /></td>
              <td width="35%" valign="top"><span class="B">LINE ID :</span> 0812878955<br />
                <span class="B">FB : </span>หจก.ชัวร์ ลิ้งค์ เน็ทเวิร์ค <br />
              <span class="B">โทรศัพท์ :</span> 0812878955<br />
              <br /></td>
              <td>&nbsp;</td>
              <td valign="top"><span class="B">020-2-37687-528</span> ธนาคารออมสิน<br />
                <span class="B">980-6-29006-2</span> ธนาคารกรุงไทย<br />
                <span class="B">406-2-62177-3</span> ธนาคารไทยพาณิชย์
                </p>
              <p class="B">ชื่อบัญชี นายกิตติ ไชยวงศ์ </p></td>
            </tr>
            <tr>
              <td height="16" colspan="4" align="left" valign="top">* โอนผ่านธนาคารก่อนวันที่ 5 ของเดือน ลด 10 บาท (ตัวอย่างเช่น ยอดเงิน 400 บาท จ่ายเพียง 390 บาท)</td>
            </tr>
          </table>
          </td>
      </tr>
	</table>
  </div>
 <?php } ?>
</div>

</body>
</html>