test
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Grafi Offshore Test GIT PULL</title>
<style type="text/css">
textarea {
  overflow: auto;
  border: none;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	var branch;
	var project;
	$(document).ready(function(){
		$('.branch').change(function(){
			branch = $(this).val();
			project = $(this).attr('data');
			console.log($(this).val(),$(this).attr('data'));
			setUrl(project,branch)
		});

	});

	function setUrl(project,branch){
		return window.open('sign_up.php?branch='+branch+'&project_name='+project,'NW','width=450,height=275');
	}

</script>
</head>

<body>
<h2>Click on PULL for git pull of project from GIT server to grafioffshorenepal.com.</h2>
<form id="index_form" name="index_form" method="post" action="sign_up.php">
<?php

function getBranches()
	    {
	        $branches = shell_exec('"C:\Program Files\Git\bin\git.exe" branch');
	        $branches = explode("\n", $branches);
	        $branches = array_filter(preg_replace('/[\*\s]/', '', $branches));

	        if (empty($branches)) {
	            return $branches;
	        }

	        // Since we've stripped whitespace, the result "* (no branch)"
	        // that is displayed in detached HEAD state becomes "(nobranch)".
	        if ($branches[0] === "(nobranch)") {
	            $branches = array_slice($branches, 1);
	        }

	        return $branches;
	    }
function getCurrentBranch()
    {
        $branches = exec('"C:\Program Files\Git\bin\git.exe" branch');
        $branches = explode("\n", $branches);

        foreach ($branches as $branch) {
            if ($branch[0] === '*') {
                if ($branch === '* (no branch)') {
                    return NULL;
                }

                return substr($branch, 2);
            }
        }
    }
$actual_link = $_SERVER['HTTP_HOST'];
$subdomain= explode('.',$actual_link);
//echo $subdomain[0];
	
	$list = 1;
	
	if ($handle = opendir ('../justis/'))
	{
		echo '<table width="1080" border="0">
			<tr bgcolor="red">
				<td width=100>Project Name</td>
				<td width=450>Document Root </td>
				<td width=100>Project Type </td>
				<td width=100>Last Revision No.</td>
				<td width=100>Update Branch</td>
			</tr>';
		
/*if ( $dir == $subdomain[0])
{*/
			$path_dir = "../justis/";
			$dir = readdir($handle);

				
				chdir ($path_dir);
			
				if(is_dir(".git"))
				{
					$project[$list] = $dir;
					$path[$list] = $path_dir;
					if (is_file("wp-config.php"))
					{
						$project_type[$list] = "WordPress";
					}
					else
					{
						$project_type[$list] = "CMS";
					}
					$svn_revision[$list] = shell_exec('"C:\Program Files\Git\bin\git.exe" rev-list --count HEAD');
					$current_branch[$list] = shell_exec('"C:\Program Files\Git\bin\git.exe" branch ');
					$branches = getBranches();
					if ( ($list%2) == 0 )
					{
					echo '	<tr bgcolor="#00FF33">
							<td width=100><a href="http://gitlocal.justis.ch" target="_blank">gitlocal.justis.ch</a></td>
							<td width=450>'.$path[$list].'</td>
							<td width=100>'.$project_type[$list].'</td>
							<td width=100>'.$svn_revision[$list].'</td>
							<td width=100>
								<select class="branch" data="'.$project[$list].'">';
									foreach ($branches as $value) {
										if($value == $current_branch[$list]){
											echo "<option selected>".$value.'</option>';
										}else{
											echo "<option>".$value.'</option>';	
										}
										
									}
							echo '</select>';
							if(count($branches)<=1){
								echo '<a href="javascript:;" onclick="javascript:setUrl(\''.$project[$list].'\',\''.$current_branch[$list].'\')">Update</a>';
							}
							echo '</td>
						</tr>';
					}
					else
					{
					echo '	<tr bgcolor="#33CCFF">
							<td width=100><a href=""http://gitlocal.justis.ch" target="_blank">gitlocal.justis.ch</a></td>
							<td width=450>'.$path[$list].'</td>
							<td width=100>'.$project_type[$list].'</td>
							<td width=100>'.$svn_revision[$list].'</td>
							<td width=100>
								<select class="branch" data="'.$project[$list].'">';
									foreach ($branches as $value) {
										if($value == $current_branch[$list]){
											echo "<option selected>".$value.'</option>';
										}else{
											echo "<option>".$value.'</option>';	
										}
										
									}
							echo '</select>';
							if(count($branches)<=1){
								echo '<a href="javascript:;" onclick="javascript:setUrl(\''.$project[$list].'\',\''.$current_branch[$list].'\')">Update</a>';
							}
							echo '</td>
						</tr>';
					}
					$list++;
				}
			
		
/*}*/
		echo '</table>';
	closedir($handle);
	}

?>
<br />
<br />
<textarea name="txtArea" id="txtArea" cols="122" rows="10" readonly="readonly" ></textarea>
</form>

</body>
</html>
