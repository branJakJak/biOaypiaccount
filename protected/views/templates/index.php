<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head profile="http://selenium-ide.openqa.org/profiles/test-case">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="selenium.base" href="https://www.bestvoipreselling.com/signup" />
<title>index</title>
</head>
<body>
<table cellpadding="1" cellspacing="1" border="1">
<thead>
<tr><td rowspan="1" colspan="3">index</td></tr>
</thead><tbody>
<tr>
	<td>open</td>
	<td>/signup</td>
	<td></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[companyname]</td>
	<td><?php echo $company_name ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[companysite]</td>
	<td><?php echo $company_website ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[contactperson]</td>
	<td><?php echo $contact_person ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[username]</td>
	<td><?php echo $username ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[password]</td>
	<td><?php echo $password ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[password2]</td>
	<td><?php echo $password ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[street]</td>
	<td><?php echo $street ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[housenr]</td>
	<td><?php echo $house_number ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[postcode]</td>
	<td><?php echo $post_code ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[city]</td>
	<td><?php echo $city ?></td>
</tr>
<tr>
	<td>select</td>
	<td>id=country</td>
	<td>label=<?php echo $country ?></td>
</tr>
<tr>
	<td>type</td>
	<td>id=signup[email_address]</td>
	<td><?php echo $email_address ?></td>
</tr>
<tr>
	<td>select</td>
	<td>id=country</td>
	<td>label=<?php echo $country ?></td>
</tr>

</tbody></table>
</body>
</html>
