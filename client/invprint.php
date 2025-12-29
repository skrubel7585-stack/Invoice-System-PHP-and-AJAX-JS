<?php
session_start();
include 'db/conn.php';
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM invList WHERE invid = '$id'");
$data = mysqli_fetch_array($sql);


$output = '
<table width="100%" style="margin-top:-40;">
  <tr>
  <td width="30%" align="right"><img src="https://creativewebhub.com/sr/Quatation/WhatsApp_Image_2024-12-28_at_22.26.59_21e819bf-removebg-preview.png" style="width:100%;"></td>
    <td width="70%">
        <h3>Gujarat Industrial (Safety & Health Consultancy)</h3>
        <p style="font-size:15px;">TF-46, Samanvays Status, Atladara padra Road, Altadara, Vadodara, Gujarat-390012<br>
        Mobile: 9979607065&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: gishc2024@gmail.com <br>
        SELLER GSTIN: 24AESPG5263K1Z5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </p>
    </td>
    
  </tr>
</table>
<hr style="margin-top:-10;">
';

// Fetch client details
$clieintid = $data['clientid'];
$ClienNAmeID = $data['clientNameId'];
$clieintidsql = mysqli_query($conn, "SELECT * FROM clientlist WHERE cid = '$clieintid'");
$VJC = mysqli_query($conn, "SELECT * FROM contact_person WHERE id = '$ClienNAmeID'");
$clientfetch = mysqli_fetch_array($clieintidsql);
$clientfDFetch = mysqli_fetch_array($VJC);
$output .= '
<table width="100%">
<tr>
    <td width="50%"><strong style="font-size:16px">'.$clientfetch['companyName'].'</strong></td>
    <td width="50%" align="left" style="background:#ADD8E6;font-size:14px;">Invoice :'.$data['inv_genId'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date :'.$data['invdate'].'</td>
</tr><br>
<tr>
    <td width="50%"><strong style="font-size:15px;">Site Address,</strong><p style="font-size:14px;margin-top:-2px;">';
    if($data['SiTeAddress'] == 0){
        $output .=''.$clientfetch['Address'].'';
    }else{
        $output .=''.$data['SiTeAddress'].'';
    }
    
    
    $output .='</p><br><strong style="font-size:15px;">Bill To,</strong><p style="font-size:14px;">'.$clientfetch['Address'].'</p></td>
    <td width="50%">
        <p style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PAN: </b>'.$clientfetch['panNumber'].'</p>
        <p style="font-size:14px;margin-top:-10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>GSTIN: </b>'.$clientfetch['clientGst'].'</p>
        <p style="font-size:14px;margin-top:-10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Contact Person: </b>Mr. / Miss '.$clientfDFetch['name'].'</p>
        <p style="font-size:14px;margin-top:-10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Mobile: </b>'.$clientfDFetch['phone'].'</p>
        <p style="font-size:14px;margin-top:-10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Email: </b>'.$clientfDFetch['email'].'</p>
    </td>
</tr>
<tr>
    <td colspan="2">
        <p style="font-size:14px;margin-top:-14px;"><b>Invoice Validity: </b> : One Month</p>
    </td>
</tr>
<br>
<tr>
    <td colspan="2">
        <p style="font-size:14px;margin-top:-4px;"><b>Dear Sir/Madam, </b> <br><b>Kind Attn: </b> Mr. / Miss . '.$clientfDFetch['name'].'<br><b>Subject: </b>  . '.$data['subject'].'<br><b>Reference: </b>  . '.$data['reference'].'<br></p>
    </td>
</tr>
</table>
';

// Start product table
$output .= '
<table width="100%" border="1">
<tr>
    <th width="5%" style="font-size:14px;">SL.No.</th>
    <th width="40%" style="font-size:14px;">Item with description</th>
    <th width="10%" style="font-size:14px;">HSN/SAC</th>
    <th width="5%" style="font-size:14px;">Qty</th>
    <th width="10%" style="font-size:14px;">Unit</th>
    <th width="10%" style="font-size:14px;">Rate</th>
    <th width="10%" style="font-size:14px;">Discount</th>
    <th width="10%" style="font-size:14px;">GST</th>
    <th width="10%" style="font-size:14px;">Amount</th>
</tr>';

$sprodusql = mysqli_query($conn, "SELECT * FROM invProduct WHERE inv_ID = '$id'");
$counter = 1;
$towigst = 0;
$togs = 0;
foreach($sprodusql as $sprodusqlfetch) {
    $prossl = $sprodusqlfetch['product_ID'];  // Corrected product_id reference
    $proQuanty = $sprodusqlfetch['quantity'];
    $poPric = $sprodusqlfetch['product_Price'];
    $discount = $sprodusqlfetch['discountPrice'];
    $totalWithoutgst = $poPric * $proQuanty;
    
    $discountA = $totalWithoutgst - $discount;
    

    $totalGSTs = ($discountA * 18) / 100;
    $towigst = $towigst + $discountA;
    $prosq = mysqli_query($conn, "SELECT * FROM productlist WHERE product_id = '$prossl'");
    $profetch = mysqli_fetch_array($prosq);

	$prName = $profetch['productName'];
	$prNameDse = $profetch['note'];
	$hsnSACNumber = $profetch['hsnSACNumber'];
	$unit = $profetch['unit'];
	$productRate = $profetch['productRate'];
	$gstamount = $profetch['gstamount'];
	$note = $sprodusqlfetch['description'];
	$Totalamount = $productRate + $gstamount;

    $output .= '
    <tr>
        <td><p style="font-size:14px;" align="center">'.$counter++.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$prName. '&nbsp;&nbsp;'.$prNameDse.'&nbsp;&nbsp;'.$note.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$hsnSACNumber.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$proQuanty.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$unit.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$poPric.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$discount.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$totalGSTs.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$discountA.'</p></td>
    </tr>';
}
$gs = ($towigst * 18) / 100;
$thdk = $towigst + $gs;
$csgst = $gs / 2;

$output .= '</table>
<table width="100%" style="margin-top:10px;">


<tr>
<td width="50%">
<table width="100%">

<tr>


</tr>
<tr>

</tr>
<tr>

</tr>
</table>
</td>
<td width="50%">
<table width="100%" border="1">
<tr>
<td width="50%" align="right"><b style="font-size:15px;">Total Amount</b></td>
<td width="50%" align="center">'.$towigst.'</td>
</tr>
<tr>
<td width="50%" align="right"><b style="font-size:15px;">CGST</b></td>
<td width="50%" align="center">'.$csgst.'</td>
</tr>
<tr>
<td width="50%" align="right"><b style="font-size:15px;">SGST</b></td>
<td width="50%" align="center">'.$csgst.'</td>
</tr>
<tr>
<td width="50%" align="right"><b style="font-size:15px;">Total Amount</b></td>
<td width="50%" align="center">'.$thdk.'</td>
</tr>
</table>
</td>
</tr>
</table>




<table width="100%" style="margin-top:25px;">



<tr>
<table width="100%" border="1">
<tr>
<td colspan="2"><span style="font-size:13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TERMS & CONDITIONS :</span></td>
</tr>
';
$ticid = $data['tc'];

    $tc_id = $dfgterms['tc_id'];
    $termSsql = mysqli_query($conn, "select * from invTC where invlist_ID = '$id'");
    foreach($termSsql as $sdfa){
        $tCID = $sdfa['tc_id'];
        $GDF = mysqli_query($conn,"select * from termsandconditionlist where tc_id = '$tCID'");
        $GDFt = mysqli_fetch_array($GDF);
        
        $tc = mysqli_query($conn,"select * from terms where tc_idd = '$tCID'");
    
    
    $termsCONDI = $GDFt['termANDcondition'];
    $tcTTitle = $GDFt['termANDconditionTitle'];
$output .='

<tr>
<td  colspan="2"><span style="font-size:13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tcTTitle.'
 :</span></td>
</tr>
';
$IDCOunter = 1;

foreach($tc as $tcdat){
$tccccc = $tcdat['tc'];
    
    $output .='
    <tr>
<td width="5%" align="center">'.$IDCOunter++.'</td>
<td ><span style="font-size:13px;">&nbsp;'.$tccccc.'</span></td>
</tr>
';
}

}
$output .='
</table>';
$output .='
</table>
</tr>
</table>
<table width="100%" style="margin-top:80px;">
<tr>
<td width="50%"></td>
<td width="50%" align="center"><hr>Signature</td>
</tr>
</table>
<br><br><br><br>
<table width="100%" style="margin-top:80px;" border="1">
<tr>
<td colspan="2" align="center">BILL SUBMISSION DETAILS</td>
</tr>
<tr>
<td width="50%">Date</td>
<td width="50%" align="center"></td>
</tr>
<tr>
<td width="50%">Submitted By</td>
<td width="50%" align="center"></td>
</tr>
<tr>
<td width="50%">Department</td>
<td width="50%" align="center"></td>
</tr>
<tr>
<td width="50%">Received By</td>
<td width="50%" align="center"></td>
</tr>
<tr>
<td width="50%">Mobile Number
</td>
<td width="50%" align="center"></td>
</tr>
<tr>
<td width="50%">Sign/Stamp
</td>
<td width="50%" align="center"></td>
</tr>
<tr>
<td width="50%">Payment Remark</td>
<td width="50%" align="center"></td>
</tr>
</table>
';

// Create PDF
$invoiceFileName = 'Quatation'.$data['quotation_gen_id'].'.pdf';
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->set_option('isRemoteEnabled', true);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));

?>
