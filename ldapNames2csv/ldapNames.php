<?php

	$server = "ldap://******";
	$port = 389;
	$dn = "o=******";
	$filecsv = fopen("ldapEntries.csv","w") or die ("Unable to open file!");



#$ucn = "Theodoropoulos Alexandros";
//array of names for ucn values
	$file = @fopen("names.txt", "r") or die("Unable to open names file!");
	if ($file) {
		$array = explode("\n", file_get_contents('names.txt'));
		foreach ($array as $ucn) {
			#echo $ucn;
			$filter = '(cn='.trim($ucn).')';

			$conn = ldap_connect($server, $port) or die ("true");
			ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);
			if ($conn) {
				$bnd = ldap_bind($conn, $dn) or die ("LDAP error");
				if ($bnd) {
					$result = ldap_search($conn, $dn ,$filter);

						$first_entry = ldap_first_entry($conn, $result);
						#print_r($first_entry);
						if ($first_entry!=false){
							//if (1 == 1 ){
							$udn = ldap_get_dn($conn, $first_entry) or die ("LDAP error");
							$attrs = ldap_get_attributes($conn, $first_entry);

							#print_r($attrs);

							//get username
							$username= ldap_get_values($conn, $first_entry, "uid");
							$username = $username[0];

							//get engineer's mail info
							$userMail = ldap_get_values($conn, $first_entry, "mail");
							$userMail = $userMail[0];

							//cn
							$cn = ldap_get_values($conn, $first_entry, "cn");
							$cn= $cn[0];

							//get user's employeeID  employeeNumber:
							$employeeID = ldap_get_values($conn, $first_entry, "employeeNumber");
							$employeeID = $employeeID[0];


							//pass values for authentication
							#echo "<br/>"."\nCN"."__________".$cn;
							#echo "<br/>"."\nusername"."__________".$username;
							#echo "<br/>"."\nuserMail"."__________".$userMail;
							#echo "<br/>"."\nemployeeID"."__________".$employeeID;
							$line = $cn.','.$username.','.$userMail.','.$employeeID;
							echo $line;
							fputcsv($filecsv,explode(',',$line));
				}else{
					$ucn=trim($ucn);
					$line = $ucn.",ERROR IN NAME";
					echo $line;
					fputcsv($filecsv,explode(',',$line));
				}

				}// if binded
			} //conn

} //foreach

} else { echo "noFile"; }//file
?>
