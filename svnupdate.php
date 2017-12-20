<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DEV SVN Update</title>
</head>

<body>
	<?php
		$txtusername = $_POST['txtusername'];
		$txtpassword = $_POST['txtpassword'];
		$txtproject  = $_POST['txtproject'];
		$txtbranch   = $_POST['txtbranch'];

		

		$path_dir = "../justis/";
		
		//if ( strcmp($report,'svn: Authentication error from server: Username not found ') == 0)
		if( $txtpassword && $txtusername )
		{
			chdir($path_dir);
			chdir('.');
			
			$gitrepourl = shell_exec('"C:\Program Files\Git\bin\git.exe" config --get remote.origin.url');
			

			$gitrepo = substr($gitrepourl,7);
			$auth = 'http://' . $txtusername . ':' . $txtpassword . '@' . $gitrepo;


			#echo $gitrepo;
			#echo $auth;
			#die;
			#$report = shell_exec ("2>&1 git pull --username=$txtusername --password=$txtpassword --non-interactive");
			$current_branch = shell_exec('"C:\Program Files\Git\bin\git.exe" branch ');
			
			$branch_switch = '';

			if($txtbranch !== $current_branch){
				
				$gitstatus 	   = shell_exec('"C:\Program Files\Git\bin\git.exe" status' );
				$branch_switch = shell_exec('"C:\Program Files\Git\bin\git.exe" checkout -f dev');
					
			}
			
			
			$report = shell_exec ('2>&1 "C:\Program Files\Git\bin\git.exe" pull $auth '.$txtbranch);
			$error_num = strcmp($report,'svn: Authentication error from server: Username not found ');
			if ( strlen($report) == 58)
			{
				echo "<script language='javascript'> document.location='sign_up.php?login_form=1&branch=$txtbranch&project=$txtproject'; </script>";
			}
			else
			{
				if($txtbranch !== $current_branch){
					$branch_switch = exec("git checkout ".$current_branch);
				}
				echo '<form id="form1" name="form1" method="post" action="">
						<textarea name="txtArea" id="txtArea" cols="25" rows="5" >'.$branch_switch .' '.$report .' '.$cmd.'</textarea>
						
					</form>';
				echo "<script language='javascript'> 
				opener.document.index_form.txtArea.value = document.form1.txtArea.value;
				
				window.close();                 
              </script>";
			}
		}
		else
		{
			echo "<script language='javascript'> document.location='sign_up.php?login_form=2&branch=$txtbranch&project=$txtproject'; </script>";
		}
	?>
	
</body>
</html>
