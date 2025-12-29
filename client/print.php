<?php
session_start();
include 'db/conn.php';
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM quotationlist WHERE quotation_id = '$id'");
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
$clieintid = $data['Clientid'];
$ClienNAmeID = $data['ClienNAmeID'];
$clieintidsql = mysqli_query($conn, "SELECT * FROM clientlist WHERE cid = '$clieintid'");
$VJC = mysqli_query($conn, "SELECT * FROM contact_person WHERE id = '$ClienNAmeID'");
$clientfetch = mysqli_fetch_array($clieintidsql);
$clientfDFetch = mysqli_fetch_array($VJC);
$output .= '
<table width="100%">
<tr>
    <td width="50%"><strong style="font-size:16px">'.$clientfetch['companyName'].'</strong></td>
    <td width="50%" align="left" style="background:#ADD8E6;font-size:14px;">Quotation :'.$data['quotation_gen_id'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date :'.$data['cdate'].'</td>
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
        <p style="font-size:14px;margin-top:-14px;"><b>Quotation Validity: </b> : One Month</p>
    </td>
</tr>
<br>
<tr>
    <td colspan="2">
        <p style="font-size:14px;margin-top:-4px;"><b>Dear Sir/Madam, </b> <br><b>Kind Attn: </b> Mr. / Miss . '.$clientfDFetch['name'].'<br><b>Subject: </b>  . '.$data['Subject'].'<br><b>Reference: </b>  . '.$data['Reference'].'<br></p>
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

$sprodusql = mysqli_query($conn, "SELECT * FROM quotationlistproduct WHERE quotation_id = '$id'");
$counter = 1;
$towigst = 0;
$togs = 0;
foreach($sprodusql as $sprodusqlfetch) {
    $prossl = $sprodusqlfetch['prodcut_id'];  // Corrected product_id reference
    $proQuanty = $sprodusqlfetch['quantity'];
    $poPric = $sprodusqlfetch['product_price'];
    $discountPric = $sprodusqlfetch['discountPrice'];
    $totalWithoutgst = $poPric * $proQuanty;
    $discountPrice = $totalWithoutgst - $discountPric;

    $totalGSTs = ($discountPrice * 18) / 100;
    $towigst = $towigst + $discountPrice;
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
        <td><p style="font-size:14px;" align="center">'.$discountPric.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$totalGSTs.'</p></td>
        <td><p style="font-size:14px;" align="center">'.$totalWithoutgst.'</p></td>
    </tr>';
}
$gs = ($towigst * 18) / 100;
$thdk = $towigst + $gs;
$csgst = $gs / 2;

$output .= '</table>
<table width="100%" style="margin-top:10px;">

<b>Item Rate Wise Tax Summary</b>
<tr>
<td width="50%">
<table width="100%" border="1">

<tr>

<th style="font-size:13px;" width="20%">GST</th>
<th style="font-size:13px;" width="20%">Amount ()</th>
<th style="font-size:13px;" width="20%">CGST</th>
<th style="font-size:13px;" width="20%">SGST</th>
<th style="font-size:13px;" width="20%">IGST</th>
</tr>
<tr>
<td align="center">18%</td>
<td align="center">'.$towigst.'</td>
<td align="center">'.$csgst.'</td>
<td align="center">'.$csgst.'</td>
<td align="center">00.00</td>
</tr>
<tr>
<td align="center"><b>Total</b></td>
<td align="center"><b>'.$towigst.'</b></td>
<td align="center"><b>'.$csgst.'</b></td>
<td align="center"><b>'.$csgst.'</b></td>
<td align="center"><b>00.00</b></td>
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


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<table width="100%" style="margin-top:25px;">



<tr>
<table width="100%" border="1">
<tr>
<td colspan="2"><span style="font-size:13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TERMS & CONDITIONS :</span></td>
</tr>
';
$ticid = $data['tc'];

    $tc_id = $dfgterms['tc_id'];
    $termSsql = mysqli_query($conn, "select * from quotationlisttc where quotation_id = '$id'");
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
