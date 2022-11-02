<?php if ( ! defined('BASEPATH')) exit ('No direct script  allow'); 

function getUrlContent($url) {
       
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return ($httpcode>=200 && $httpcode<300) ? $data : false;
  }

	function fillBrackets($variableData) {
					
				if ($variableData) {
							
						 	return '('.$variableData.')';
				} else {
						
							return $variableData;
				}
				
				$string = 	word_limiter($string, 50);	
				
				return $string;
				
				/*
				
				Function Input 	: PRK || ESS || The Educators School|| Any String & Numeric Value
				Function Output	: (PKR) || (ESS) || (The Educators Schol)
				
				*/
	}
	
	function removeAllSpacesFromString($string) {
					
					$string = preg_replace('/\s+/', '', $string);	
					return $string;
					
					/*
						Function Input 	:   92 0 3 3 3 4 5 2 5 1 1 6 || W AQ AS || WAQAS ALI || WAQAS
						Function Output	:   920334525116 || WAQAS || WAQASALI || WAQAS				
			  		*/	
	}
	
	function cleanSringFromDashes($string) {
   				
					$string = str_replace(["-", "–"], '', $string);

					return $string;
   
   		 /*
						Function Input 	:   111-000-111 | waqas-Ali 
						Function Output	:   111000111 | waqasali			
		 */	
			 
	}
	
	function cleanSringFromBrackets($string) {
   				
					$string =  str_replace(array( '(', ')' ), '', $string);

					return $string;
   
   		 /*
						Function Input 	:   (03314100202) || (0331)4100202 || 
						Function Output	:   03314100202 || 3314100202			
		 */	
			 
	}
	
	function convertAllCharactersUppercase($string) {
				
				$string = strtoupper($string);	
				
				return $string;
				
				/*
				
				Function Input 	: computer | COMPUTER | cOMPuTER | 
				Function Output	: COMPUTER | COMPUTER | COMPUTER
				
		  */
	}
	
	function convertAllCharactersLowercase($string) {
				
				$string = strtolower($string);	
				
				return $string;
				
				/*
				
				Function Input 	: Computer | COMPUTER | cOMPuTER | 
				Function Output	: computer | computer | computer
				
		  */
	}
	
	function convertFirstCharacterUppercase($string) {
				
				if ($string) {
							
						$string			= strtolower($string);
						$string 			= ucwords($string);	
						
						return $string;
				
				} else {
						
						return NULL;
					
				}
		
			/*
				
				Function Input 	: computer | COMPUTER | cOMPUTER | 
				Function Output	: Computer | Computer | Computer
				
		  */
	}
	
	function convertNumberToWords($number) {

					  $hyphen      		= ' ';
					  $conjunction 		= ' and ';
					  $separator   		= ', ';
					  $negative    			= 'negative ';
					  $decimal     			= ' point ';
    				  
					  $dictionary  = array (
														0                   => 'zero',
														1                   => 'one',
														2                   => 'two',
														3                   => 'three',
														4                   => 'four',
														5                   => 'five',
														6                   => 'six',
														7                   => 'seven',
														8                   => 'eight',
														9                   => 'nine',
														10                  => 'ten',
														11                  => 'eleven',
														12                  => 'twelve',
														13                  => 'thirteen',
														14                  => 'fourteen',
														15                  => 'fifteen',
														16                  => 'sixteen',
														17                  => 'seventeen',
														18                  => 'eighteen',
														19                  => 'nineteen',
														20                  => 'twenty',
														30                  => 'thirty',
														40                  => 'fourty',
														50                  => 'fifty',
														60                  => 'sixty',
														70                  => 'seventy',
														80                  => 'eighty',
														90                  => 'ninety',
														100                 => 'hundred',
														1000                => 'thousand',
														1000000             => 'million',
														1000000000          => 'billion',
														1000000000000       => 'trillion',
														1000000000000000    => 'quadrillion',
														1000000000000000000 => 'quintillion'
													);

    			if (!is_numeric($number)) {
        				
						return false;
    			}

    			if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
       				
					 // overflow
        			trigger_error(
            							'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            							 E_USER_WARNING
        								);
       				 return false;
    			 }

    			if ($number < 0) {
        				
						return $negative . convertNumberToWords(abs($number));
   	 			}

    			$string = $fraction = null;

    			if (strpos($number, '.') !== false) {
        				
						list($number, $fraction) = explode('.', $number);
    			}

    			switch (true) {
        				
						case $number < 21:
            			
							$string = $dictionary[$number];
            			
						break;
        
					  case $number < 100:
						  
						  $tens 			  = ((int) ($number / 10)) * 10;
						  $units 	 		  = $number % 10;
						  $string 		      = $dictionary[$tens];
						  
						  if ($units) {
							 
							  $string .= $hyphen . $dictionary[$units];
						  }
						  
						  break;
						  
					  case $number < 1000:
						  	
							$hundreds  	= $number / 100;
						  	$remainder 	= $number % 100;
						    $string 			= $dictionary[$hundreds] . ' ' . $dictionary[100];
						  	
							if ($remainder) {
								
								  $string .= $conjunction . convertNumberToWords($remainder);
						    }
							
						  break;
						  
					  default:
						  
						  $baseUnit 			= pow(1000, floor(log($number, 1000)));
						  $numBaseUnits 	    = (int) ($number / $baseUnit);
						  $remainder 			= $number % $baseUnit;
						  $string 				= convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
						  
						  if ($remainder) {
							 
							  $string .= $remainder < 100 ? $conjunction : $separator;
							  $string .= convertNumberToWords($remainder);
						  }
						  
						  break;
   			 }

			if (null !== $fraction && is_numeric($fraction)) {
			   
				$string .= $decimal;
				$words = array();
			   
				foreach (str_split((string) $fraction) as $number) {
					
					  $words[] = $dictionary[$number];
				}
				
				$string .= implode(' ', $words);
			}
		
			return $string;
	}
	
	function convertAmountToWords($number) {
		
  		 $no 		= round($number);
		 $point = '';
		   if ($number > 0) {
			   $point 	= round($number - $no, 2) * 100;
		   }
   		 $hundred 	= null;
   		 $digits_1  = strlen($no);
   		 $i 		= 0;
 		
		 $str 		= array();
   		 $words 	= array('0' => '', '1' => 'One', '2' => 'Two',
    						'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    						'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
							'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
							'13' => 'Thirteen', '14' => 'Fourteen',
							'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
							'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
							'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
							'60' => 'Sixty', '70' => 'Seventy',
							'80' => 'Eighty', '90' => 'Ninety');
   							
		$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   		
		while ($i < $digits_1) {
     		
			$divider = ($i == 2) ? 10 : 100;
     		$number  = floor($no % $divider);
     		$no 	 = floor($no / $divider);
    		
			$i += ($divider == 10) ? 1 : 2;
     		
			if ($number > 0) { //for remove error of index in nagative
				$plural  = (($counter = count($str)) && $number > 9) ? 's' : null;
        		$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
       			$str []  = ($number < 21) ? $words[$number] ." " . $digits[$counter] . $plural . " " . $hundred : $words[floor($number / 10) * 10]. " " . $words[$number % 10] . " ". $digits[$counter] . $plural . " " . $hundred;
    		
			 } else $str[] = null;
  			 }
 			
			 $str 	 = array_reverse($str);
  			 $result = implode('', $str);
  			 $points = '';//($point) ? "." . $words[$point / 10] . " " .$words[$point = $point % 10] : '';
			 return $result . "Rupees".$points;
	
	}
	
	function numberToOrdinalWord($num) {
			
			$first_word 		=  array('eth','First','Second','Third','Fouth','Fifth','Sixth','Seventh','Eighth','Ninth','Tenth','Elevents','Twelfth','Thirteenth','Fourteenth','Fifteenth','Sixteenth','Seventeenth','Eighteenth','Nineteenth','Twentieth');
			$second_word 	=	array('','','Twenty','Thirty','Forty','Fifty');

			if($num <= 20)
				
				return $first_word[$num];

			$first_num		 	= substr($num,-1,1);
			$second_num 	= substr($num,-2,1);

			return $string 	= str_replace('y-eth','ieth',$second_word[$second_num].'-'.$first_word[$first_num]);
	}
	
	function ordinal($number) {
   				
				 $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    				
					if ((($number % 100) >= 11) && (($number%100) <= 13))
        				
						return $number. 'th';
    				else
        				
						return $number. $ends[$number % 10];
	 }
	
	function leadingZeroBeforeSingleDigitNumber($number) {
				
				$num_padded = sprintf("%02d", $number);
				return $num_padded; // returns 04	
				
				/*
				
				Function Input 	: 0   | 1   | 2   | 10 
				Function Output	: 00 | 01 | 02 | 10
				
		  */ 
	}
	
	function formattingNumberWithLeadingZeros($number) {
						
					return	str_pad($number, 5, '0', STR_PAD_LEFT); 		
		  /*
				
				Function Input 	: 1,2,3
				Function Output	: 00000001,00000002,00000003
				
		 */
	
	}
	
	function mathRound($number) {
				
					$round = round($number);	
					
					return $round;
					
		   /*
				
				Function Input 	: 5.3,5.5,5.6
				Function Output	: 5,5,6
				
		 */
	}
	
	function cleanDecimals($number) {
				
					if ($number) {
							
							$number = (int)$number;	
					}
					
					return $number;
					
		   /*
				
				Function Input 	: 25000.00, 15000.00
				Function Output	: 25000 | 15000
				
		 */
	}
	
	function cleanStringLastComma($string) {
		 
		 return rtrim($string, ", ");
		 
		 /*
				
				Function Input 	: Computer,Science,Music,
				Function Output	: Computer,Science,Music
				
		 */
		 
	}
	
	function calculationOfPercents($x,$y) {
			
			$percent = $x/$y;
			
			 $percentFriendly = mathRound($percent * 100);
				
			$percentFriendly = $percentFriendly;
			
			return $percentFriendly;
			
			/*
				Function Input 	: 10/1000,15/100 (Found Results/ Total Results)
				Function Output	: 15,20,50,
				
		 */
	}
	
	function concatPercentSign($string) {
		
			if ($string) {
					
				return 	$string. '%';		
			
			} else {
				
				return $string;
			}
			
			/*
				Function Input 	: 10,20,25,30
				Function Output	: 10%,20%,25%
				
		 */
	}
	
	function strAfter($string, $substring) {
  					
					$pos = strpos($string, $substring);
  							
							if ($pos === false) {
  									
									 return $string;
							
							} else {  
   									
									return(substr($string, $pos+strlen($substring)));
							}
				/*
				
				Function Input 	: [Shadow Color] || (Hello World) || _Any String_ 
				Function Output	: Shadow] || Hello World || Any String_
				
				*/
	   }
	   
    function strBefore($string, $substring) {
						
						$pos = strpos($string, $substring);
						
						if ($pos === false) {
								
								 return $string;
						} else {  
						 		
								return(substr($string, 0, $pos));
						}
						
				/*
				
				Function Input 	: [Shadow Color] || (Hello World) || _Any String_ 
				Function Output	: [Shadow || (Hello World || _Any String
				
				*/
	} 
	
	function cleanNumberStartingZero($number) {
		
				$number = ltrim($number, '0');	
				
				return $number;
				
				/*
					Function Input 	:   01 | 05 | 10
					Function Output	:   1 | 5 | 10				
			  */	
	}
	
	function cleanPhonePlusSign($phone) {
		
				$find 	 = array("+"," ");
				$replace = array('','');
				$phone   = str_replace($find,$replace,$phone);
				
				$phone = cleanPhoneStartingZero($phone);
				return $phone;
				
				/*
				
					Function Input 	: +9203334525116 || ++9233314525116 
					Function Output	:   9203334525116 ||     9233314525116
				
				*/
	}
	
	function cleanPhoneStartingZero($phone) {
				
				$phone = ltrim($phone, '92');
				$phone = ltrim($phone, '0');	
				
				return $phone;
				
				/*
				
					Function Input 	:   9203334525116
					Function Output	:   03334525116				
			  */	
	}
	
	function encodeString($string) {
					
				$string = 	base64_encode($string);
				return $string;
	}
	
	function decodeString($string) {
					
				$string = 	base64_decode($string);
				return $string;
	}
	
	function convertStrToTime($dateTime) {
					
					if ($dateTime) {
								
								return strtotime($dateTime);	
					
					} else {
								return;	
					}
					
				/*
				
				Function Input 	: 10 June 2016 | 10/10/2016 | 05.12.2015
				Function Output	: 101155558 | 54515551515 | 1414114141
				
				*/
	}
	
	
	function dateMonthDayYear2Digits($dateInput) {
					
			$result = date('m/d/Y',$dateInput);  
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: 10/01/13 (month, day and year(2 digits))
				
			*/
						
	}
	
	function dateMonthDayYear($dateInput) {
					
			$result = date('m/d/Y',$dateInput);    
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: 01/01/2013 (month, day and year)
				
			*/
						
	}
	
	function dateFourDigitYearMonthDayWithSlashes($dateInput) {
					
			$result = date('Y/m/d',$dateInput);   
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: 2013/10/01  (Four digit year, month and day with slashes)
				
			*/
	}
	
	function dateYearMonthDayWithDashes($dateInput) {
					
			$result = date('Y-m-d',$dateInput);   
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: 2013-03-31  (Year, month and day with dashes)
				
			*/
						
	}
	
	function dateDayMonthFourDigitYearWithDots($dateInput) {
					
			$result = date('d.m.Y',$dateInput);
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: 10.01.2013   (Day, month and four digit year, with dots)
				
			*/
						
	}
	
	function dateDayMonthFourDigitYearWithDashes($dateInput) {
					
			$result = date('d-m-Y',$dateInput);
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: 10-01-2013   (Day, month and four digit year, with dashes)
				
			*/
						
	}
	
	function dateDayTextualMonthYear($dateInput) {
					
			$result   =  date('d M Y',$dateInput); 
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: 04 October 2013   (Day, textual month and year)
				
			*/
						
	}
	
	function dateTextualMonthDayYear($dateInput) {
					
			$result   =   date('M jS, Y',$dateInput);  
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: July 1st, 2008   (Textual month, day and year)
				
			*/
						
	}
	
	function dateMonthAbbreviationDayYear($dateInput) {
					
			$result   =   date('M-d-Y',$dateInput);   
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: Apr-17-2012   (Month abbreviation, day and year)
				
			*/
						
	}
	
	function dateYearMonthAbbreviationDay($dateInput) {
					
			$result   =  date('Y-M-d',$dateInput);     
			return $result;
			/*
				Function Input 	: 1465364869 (Date Converted Strtotime Format)
				Function Output	: 2013-Dec-22  (Year, month abbreviation and day)
				
			*/
						
	}

	 function emailSend($from=null, $to=null, $subject=null, $cc=null, $message=null, $repolyTo=null) { 
		$CIH = & get_instance();
		$from_email = $from;  
		$to_email = $to; 
		$config = array(
		   'protocol' => 'smtp',
		   'smtp_host' => 'ssl://smtp.gmail.com',
		   'smtp_port' => 465,
		   'smtp_user' => $from_email,
		   'smtp_pass' => 'Pak!stan',
		   'smtp_timeout'=> 20,
		   'mailtype'  => 'html',
		   'charset' => 'iso-8859-1',
		   'wordwrap' => TRUE
	   );
		  
		//Load email library 
		$CIH->load->library('email'); 

		$CIH->email->initialize($config);
	    $CIH->email->set_mailtype("html");
	    $CIH->email->set_newline("\r\n");
  
		$CIH->email->from($from_email, 'EMS'); 
		$CIH->email->to($to_email);
		$CIH->email->cc($cc);
		$CIH->email->reply_to($repolyTo);
		$CIH->email->subject($subject);
		$CIH->email->message(nl2br($message)); 

		//Send mail 
		if($CIH->email->send()) {
	   		echo 'Email send susccess';
		} else { 
			echo 'Email send error';
			show_error($CIH->email->print_debugger());   
		}
	} 
	
	
?>