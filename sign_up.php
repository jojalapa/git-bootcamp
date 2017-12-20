<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DEV SVn Update</title>
</head>

<body>
<table width="431" height="256" border="1" align="center">
<tr>
      <td><p align="center">Verify Yourself to Update SVN.</p>
        <form id="sign_up_form" name="sign_up_form" method="post" action="svnupdate.php">
          <table width="308" border="0" align="center" cellspacing="15">
            <tr>
              <td width="62" align="right"><label>username:</label>&nbsp;</td>
              <td width="174"><input name="txtusername" type="text" id="txtusername" /></td>
            </tr>
            <tr>
              <td align="right"><label>password:</label>&nbsp;</td>
              <td><input type="password" name="txtpassword" id="txtpassword" /></td>
            </tr>
		<?php
		if ( isset($_GET['project_name']) )
		        {
	              		echo '<tr><td colspan="2" align="center">';
        	      		$project = $_GET['project_name'];
        	      		$branch = $_GET['branch'];
        	      		echo $branch;
				echo '<input type="hidden" name="txtproject" value='.$project.'>';
				echo '<input type="hidden" name="txtbranch" value='.$branch.'>';
				echo '</td></tr>';
		        }
		?>
        <?php
			if ( isset($_GET['login_form']) )
			{
				$project = $_GET['project'];
				$branch = $_GET['branch'];
				$login_form = $_GET['login_form'];
				echo '<tr><td colspan="2" align="center">';
				if ($login_form == 1)
				{
					echo '<label>You are not the Authorized for SVN Update. Please Try with Authorized username and password.</label>';
					echo '<input type="hidden" name="txtproject" value='.$project.'>';
				}
				if ($login_form == 2)
				{
					echo '<label>Please provide username and password for git pull.</label>';
					echo '<input type="hidden" name="txtproject" value='.$project.'>';
					echo '<input type="hidden" name="txtbranch" value='.$branch.'>';
					echo '</td></tr>';
				}
			}
		?>
	</table>
          <p align="center">
            <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" />
          </p>
</form></td>
</tr>
</table>
</body>
</html>
