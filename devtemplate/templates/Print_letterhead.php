<?php


function print_letterhead()
{

$compDetails = sql("SELECT `fo_Name`, `fo_Logo`, `fo_Address`, `fo_City`, `fo_Region`, `fo_PostalCode`, `fo_Country`, `fo_Phone_1`, `fo_Email`  from `membership_company` limit 1", $eo);
while ($row = db_fetch_array($compDetails)) {
		$comp_name		= $row[0];
		$comp_logo		= $row[1];
		$comp_addressLn1	= $row[2];
		$comp_city		= $row[3];
		$comp_region	= $row[4];
		$comp_postalCode = $row[5];
		$comp_country	= $row[6];
		$comp_phone		= $row[7];
		$comp_email		= $row[8];
};


$letterhead = <<<HTML
<table id="printOnly" style="border-bottom:2px solid;width:100%;margin-bottom:-130px">
	<tr>
		<td style="padding:40px !important;width:60%">
			<img height="100" src="images/$comp_logo">
		</td>
		<td>
			<table>
				<tr>
					<td colspan="2">
						<b>
							<h4>
								$comp_name
							</h4>
						</b>
					</td>
				</tr>
				<tr>
					<td style="padding-right:10px">
						<i class="glyphicon glyphicon-envelope"></i>
					</td>
					<td style="border-left:1px solid red;padding-left:10px">
						$comp_addressLn1,
						<br />
						$comp_city, $comp_postalCode, $comp_region, $comp_country
					</td>
				</tr>
				<tr>
					<td style="padding-right:10px">
						<i class="glyphicon glyphicon-send"></i>
					</td>
					<td style="border-left:1px solid green;padding-left:10px;">
						$comp_email
					</td>
				</tr>
				<tr>
					<td style="padding-right:10px">
						<i class="glyphicon glyphicon-earphone"></i>
					</td>
					<td style="border-left:1px solid blue;padding-left:10px;">
						$comp_phone
					</td>
				</tr>

			</table>
		</td>
	</tr>
</table>

HTML;

return $letterhead;
}

?>

