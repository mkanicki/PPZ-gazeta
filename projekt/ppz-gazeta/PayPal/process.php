<?php

include_once("config.php");
include_once("paypal.class.php");
include_once "classes/Conn.php";


if($_POST) //Post Data received from product list page.
{
    session_start();
	//Mainly we need 4 variables from an item, Item Name, Item Price, Item Number and Item Quantity.
	$ItemName = $_POST["itemname"]; //Item Name
	$ItemPrice = $_POST["itemprice"]; //Item Price
	$ItemNumber = $_POST["itemnumber"]; //Item Number
        $ItemPath = $_POST["itempath"]; //Item Path
	$ItemTotalPrice = ($ItemPrice); //(Item Price x Quantity = Total) Get total amount of product; 

	//Data to be sent to paypal
	$padata = 	'&CURRENCYCODE='.urlencode($PayPalCurrencyCode).
				'&PAYMENTACTION=Sale'.
				'&ALLOWNOTE=1'.
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
				'&PAYMENTREQUEST_0_AMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice). 
				'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
				'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
				'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
				'&AMT='.urlencode($ItemTotalPrice).				
				'&RETURNURL='.urlencode($PayPalReturnURL ).
				'&CANCELURL='.urlencode($PayPalCancelURL);	
		
		//We need to execute the "SetExpressCheckOut" method to obtain paypal token
		$paypal= new MyPayPal();
		$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
		
		//Respond according to message we receive from Paypal
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
		{
					
				// If successful set some session variable we need later when user is redirected back to page from paypal. 
				$_SESSION['itemprice'] =  $ItemPrice;
				$_SESSION['totalamount'] = $ItemTotalPrice;
				$_SESSION['itemName'] =  $ItemName;
				$_SESSION['itemNo'] =  $ItemNumber;
                                $_SESSION['itemPath'] =  $ItemPath;
				
				if($PayPalMode=='sandbox')
				{
					$paypalmode 	=	'.sandbox';
				}
				else
				{
					$paypalmode 	=	'';
				}
				//Redirect user to PayPal store with Token received.
			 	$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
				header('Location: '.$paypalurl);
			 
		}else{
			//Show error message
			echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
			echo '<pre>';
			print_r($httpParsedResponseAr);
			echo '</pre>';
		}

}

//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
if(isset($_GET["token"]) && isset($_GET["PayerID"]))
{
    
	//we will be using these two variables to execute the "DoExpressCheckoutPayment"
	//Note: we haven't received any payment yet.
	
	$token = $_GET["token"];
	$playerid = $_GET["PayerID"];
	
	//get session variables
	$ItemPrice 	       = $_SESSION['itemprice'];
	$ItemTotalPrice        = $_SESSION['totalamount'];
	$ItemName 	       = $_SESSION['itemName'];
	$ItemNumber 	       = $_SESSION['itemNo'];
        $ItemPath              = $_SESSION['itemPath'];
	
	$padata = 	'&TOKEN='.urlencode($token).
						'&PAYERID='.urlencode($playerid).
						'&PAYMENTACTION='.urlencode("SALE").
						'&AMT='.urlencode($ItemTotalPrice).
						'&CURRENCYCODE='.urlencode($PayPalCurrencyCode);
	
	//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
	$paypal= new MyPayPal();
	$httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
	
        $tab = '<table id="tabela_platnosci" style=" margin-left:330px">';
	//Check if everything went ok..
	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
	{
			
            			$tab .= '<tr><td style="text-align:center;"><b>ID transakcji:</b> '.urldecode($httpParsedResponseAr["TRANSACTIONID"]).'</td></tr>';
			
				/*
				//Sometimes Payment are kept pending even when transaction is complete. 
				//May be because of Currency change, or user choose to review each payment etc.
				//hence we need to notify user about it and ask him manually approve the transiction
				*/
				
				if('Completed' == $httpParsedResponseAr["PAYMENTSTATUS"])
				{
					$tab .= '<tr>
                                                    <td style="text-align:center;">
                                                        <span style="color:green;"><b>P³atnoœæ zrealizowana!</b></span><br/>
                                                        <span> Zakupiony artyku³ zosta³ wys³any na adres:</span><br/>
                                                        <span style="color:green;">'.$_SESSION['email_uzytkownika'].'</span>
                                                    </td>
                                                 </tr>';
                                      //email-----
                                        include_once('classes/phpmailer/class.phpmailer.php');
                                            $mail = new PHPMailer();
                                            $mail->SetLanguage("pl", "classes/phpmailer/language/");
                                            $mail->CharSet = "UTF-8";
                                            $mail->IsSMTP();
                                            $mail->Host = "ssl://smtp.wit.edu.pl";
                                            $mail->SMTPAuth = true;
                                            $mail->Port = 465;
                                            $mail->Username = "kosciesz";
                                            $mail->Password = "Ahref01";
                                            $mail->AddAddress($_SESSION['email_uzytkownika']);
                                            $mail->SetFrom('D.Kosciesza@wit.edu.pl', 'Internetowe wydanie gazety');
                                            $mail->Subject = 'Internetowe wydanie gazety';
                                            $mail->AddEmbeddedImage('images/logo.png', 'mylogo');
                                            $mail->CharSet = "UTF-8";
                                            $mail->IsHTML(true);
                                            $tresc = "  <html>
                                                        <head>			
                                        		<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">

                                                	</head>
                                                        <body>
                                                        <div style=\"width:100%; height:200px; background: lavender; border: 3px dotted green;\">
                                                            <table style=\"margin-left:auto; margin-right:auto;\">
                                                              <tr><td> <img src='cid:mylogo' alt=\"Logo\" height=\"60\" width=\"100%\"/> <td></tr>
                                                              <tr><td style=\"color: #191970;\"><h3><br/>Dziekujemy za skorzystanie z naszych uslug.<h3></td></tr>
                                                              <tr style=\"padding-left:25px;\"><td>  Zakupiony artykul nr: <b>".$ItemNumber."</b> znajduje sie w zalaczniku.<br/><br/></td></tr>
                                                              <tr style=\"padding-left:25px;\"><td>  Zyczymy przyjemnej lektury ;)<td></tr>
                                                            </table>
                                                        </div>
                                                        </body>
                                                        </html>
                                                     ";
                                            $mail->Body = $tresc;
                                               $name = substr($ItemPath,  strripos($ItemPath,'/')+1, strlen($ItemPath));        
                                            $mail->AddAttachment($ItemPath, $name);
                                            $mail->Send();
                                      //-----------  
                                        // header('Content-disposition: attachment; filename=yourFile.pdf');
                                      // header('Content-type: application/pdf');
                                      //  readfile(''.$ItemPath.'');
                                        
                                       // $tab .= '<tr><td style="text-align:center;"><b> <a href="'.$ItemPath.'">Download document (PDF)</a> </b></td></tr>';
                                        
                                }
				elseif('Pending' == $httpParsedResponseAr["PAYMENTSTATUS"])
				{
					$tab .= '<tr><td style="color:red; text-align:center;"><b>Transakcja zrealizowana, lecz p³atnoœæ  nie jest rozstrzygniêta! Mo¿esz autoryzowaæ p³atnoœæ na stronie: <a target="_new" href="http://www.paypal.com">Paypal</a></b></td></tr>';
				}
			

			

				$transactionID = urlencode($httpParsedResponseAr["TRANSACTIONID"]);
				$nvpStr = "&TRANSACTIONID=".$transactionID;
				$paypal= new MyPayPal();
				$httpParsedResponseAr = $paypal->PPHttpPost('GetTransactionDetails', $nvpStr, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

				if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
			
                             //	#### SAVE BUYER INFORMATION IN DATABASE ###
                                     $_conn = new Conn();
                                     $_conn->delete('koszyk', 'idArtykul', $ItemNumber); 
                                     
                                         // update lista pobran
                                      $sql = "SELECT LiczbaPobran
                                                 FROM artykul 
                                                 WHERE idArtykul=".$ItemNumber."";
                       
                                  $ret = $_conn->fetchRow($sql);
                                     $wyn = intval($ret[0]) + 1;
                                          $d = array(
                                            'LiczbaPobran'   => $wyn,
                                         );
                                  $_conn->update('artykul', $d, "idArtykul='".$ItemNumber."'");
                                  //------------------------------------------------------------
                                        // dodaj zamowienie
                                               $zam = array(
                                                  'Cena'          => $ItemTotalPrice,
                                                  'idUzytkownik'  => $_SESSION['id_uzytkownika']
                                               );
                                         $idZam = $_conn->insert('zamowienie', $zam);
                                         
                                         
                                              $sz = array(
                                                  'idArtykul'          => $ItemNumber,
                                                  'idZamowienie'       => $idZam,
                                                  'Cena'               => $ItemPrice
                                               );
                                         $_conn->insert('szczegoly_zam', $sz);
                                  //------------------------------------------------------------
                                         // jesli to byl zlaczony pdf
                                        // to usun go z tabeli artykuly i z serwera
                                        // update liczbe elementow
                                       $sql = "SELECT a.idArtykul
                                                FROM artykul a LEFT JOIN koszyk k
                                                ON  a.idArtykul  = k.idArtykul
                                                WHERE  a.idWlasciciel IS NOT NULL";
                                       $idJoin = $_conn->fetchRow($sql);
                                 //--------------------------------------
                                        $sql2 = "SELECT a.Sciezka
                                                FROM artykul a LEFT JOIN koszyk k
                                                ON  a.idArtykul  = k.idArtykul
                                                WHERE  a.idWlasciciel IS NOT NULL";
                                       $PathRemove = $_conn->fetchRow($sql2);
                                       
                                        if($idJoin[0]){
                                               $_conn->delete('szczegoly_zam', 'idZamowienie', $idZam." and idArtykul=".$ItemNumber."");
                                               $_conn->delete('artykul', 'idArtykul', $idJoin[0]);                    
                                        }
                                        if($PathRemove[0]) unlink($PathRemove[0]);
					
				} else  {
				  $tab .= '<tr><td style="text-align:center; color:red"><b>GetTransactionDetails failed:</b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</td></tr>';
					//echo '<pre>';
					//print_r($httpParsedResponseAr);
					//echo '</pre>';

				}
	
	}else{
		$tab .= '<tr><td style="text-align:center; color:red"><b>Error:</b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</td></tr>';
			//echo '<pre>';
			//print_r($httpParsedResponseAr);
			//echo '</pre>';
	}
        
     $tab .= '</table>';
    $_SESSION['platnosc'] =  $tab;
}
?>
