<?php
	session_start();
	
	//za Report post-a
	if(isset($_POST["idReportPost"]))
	{
		$idReportPost = $_POST["idReportPost"];
		$idReporter = $_SESSION["id_user"];
		$reportedPostTime = mktime();
		
		include("konekcija.php");
		
		$q_UpdateReportPost = "insert into reported_posts values ('', $idReportPost, $idReporter, $reportedPostTime, 'issued')";
		$res_UpdateReportPost = mysql_query($q_UpdateReportPost, $konekcija) or die("Greska upit UpdateReportPost!");
		
		mysql_close($konekcija);
	}
	//za Request Sticky
	if(isset($_POST["idSticky"]))
	{
		$idSticky = $_POST["idSticky"];
		
		include("konekcija.php");
		
		$q_InsertSticky = "insert into request_sticky values ('', $idSticky, 'requested')";
		$res_InsertSticky = mysql_query($q_InsertSticky, $konekcija) or die("Greska upit InsertSticky!");
		
		mysql_close($konekcija);
	}
	//za Report thread-a
	if(isset($_POST["idReportThread"]))
	{
		$idReportThread = $_POST["idReportThread"];
		$idReporter = $_SESSION["id_user"];
		$reportedThreadTime = mktime();
		
		include("konekcija.php");
		
		$q_UpdateReportThread= "insert into reported_threads values ('', $idReportThread, $idReporter, $reportedThreadTime, 'issued')";
		$res_UpdateReportThread= mysql_query($q_UpdateReportThread, $konekcija) or die("Greska upit UpdateReportThread!");
		
		mysql_close($konekcija);
	}
	
	//za Like
	if(isset($_POST["postid"]))
	{
		$reply = "";
		$idPost = $_POST["postid"];
		
		if(isset($_SESSION["id_user"]))
		{
			$idUser = $_SESSION["id_user"];
			
			include("konekcija.php");
			
			$q_Voted = "select exists (select * from likes where id_post = $idPost and id_user = $idUser)";
			$res_Voted = mysql_query($q_Voted, $konekcija) or die("Greska upit Voted!");
			
			$result = mysql_result($res_Voted, 0);
			
			if($result == 1)
			{
				//glasao
				$q_UpdateLikes = "update posts set likes = likes - 1 where id_post = $idPost";
				$res_UpdateLikes = mysql_query($q_UpdateLikes, $konekcija) or die ("Greska upit UpdateLikes!");
				
				$q_InsertLike = "delete from likes where id_post = $idPost and id_user = $idUser";
				$res_InsertLike = mysql_query($q_InsertLike, $konekcija) or die("Greska upit InsertLike!");
				
				$reply = "glasao";
			}
			else
			{
				//nije glasao
				$q_UpdateLikes = "update posts set likes = likes + 1 where id_post = $idPost";
				$res_UpdateLikes = mysql_query($q_UpdateLikes, $konekcija) or die ("Greska upit UpdateLikes!");
				
				$q_InsertLike = "insert into likes values ($idPost, $idUser)";
				$res_InsertLike = mysql_query($q_InsertLike, $konekcija) or die("Greska upit InsertLike!");
				
				$reply = "uspelo glasanje";
			}
			mysql_close($konekcija);
		}
		else
		{
			$reply = "nije logovan";
		}
		echo json_encode($reply);
	}
	else
	{
		if(!isset($_SESSION["id_user"]))
		{
			$direct="login";
			echo json_encode($direct);
		}
		else
		{
			$direct="post-form";
			echo json_encode($direct);
		}
	}
	
	//za Disable user
	if(isset($_POST["idDisableUser"]))
	{
		$idDisableUser = $_POST["idDisableUser"];
		
		include("konekcija.php");
		
		$q_DisableUser = "update users u set u.state = 'disabled' where u.id_user = $idDisableUser";
		$res_DisableUser = mysql_query($q_DisableUser, $konekcija) or die("Greska upit DisableUser!");
		
		mysql_close($konekcija);
	}
	//dashboard actions
	if(isset($_POST["type"]))
	{
		$type = $_POST["type"];
		$idType = $_POST["idType"];
		$action = $_POST["action"];
		
		$emptyPost = "<b>This post was removed because it breaches the forum code of conduct!</b>";
		
		if($_POST["idReport"] != 0)
		{
			//jeste Report
			$idReport = $_POST["idReport"];
			include("konekcija.php");
			
			if($type == "thread")
			{
				if($action == "lock")
				{
					$q_LockReportThread = "update reported_threads rt set rt.status = 'locked' where rt.id_report = $idReport";
					$res_LockReportThread = mysql_query($q_LockReportThread, $konekcija) or die("Greska upit LockReportThread!");
					
					if($res_LockReportThread)
					{
						$q_LockReportThreadTable= "update threads t set t.status = 'locked' where t.id_thread = $idType";
						$res_LockReportThreadTable = mysql_query($q_LockReportThreadTable, $konekcija) or die("Greska upit LockReportThreadTable!");
					}
				}
				else if($action == "delete")
				{
					$q_DeleteReportThread = "update reported_threads rt set rt.status = 'deleted' where rt.id_report = $idReport";
					$res_DeleteReportThread = mysql_query($q_DeleteReportThread, $konekcija) or die("Greska upit DeleteReportThread!");
					
					if($res_DeleteReportThread)
					{
						$q_DeleteReportThreadTable= "update threads t set t.status = 'deleted' where t.id_thread = $idType";
						$res_DeleteReportThreadTable = mysql_query($q_DeleteReportThreadTable, $konekcija) or die("Greska upit DeleteReportThreadTable!");
					}
				}
				else if($action == "dismiss")
				{
					$q_DismissReportThread = "update reported_threads rt set rt.status ='dismissed' where rt.id_report = $idReport";
					$res_DismissReportThread = mysql_query($q_DismissReportThread, $konekcija) or die("Greska upit DismissReportThread!");
					
					if($res_DismissReportThread)
					{
						$q_DismissReportThreadTable = "update threads t set t.status = 'active' where t.id_thread = $idType";
						$res_DismissReportThreadTable = mysql_query($q_DismissReportThreadTable, $konekcija) or die("Greska upit DismissReportThreadTable!");
					}
				}
			}
			if($type == "post")
			{
				if($action == "empty")
				{
					$q_EmptyPostReport = "update reported_posts rp set rp.status = 'emptied' where rp.id_report = $idReport";
					$res_EmptyPostReport = mysql_query($q_EmptyPostReport, $konekcija) or die("Greska upit EmptyPostReport!");
					
					if($res_EmptyPostReport)
					{
						$q_EmptyPostReportTable = "update posts p set p.tekst = '$emptyPost' where p.id_post = $idType";
						$res_EmptyPostReportTable = mysql_query($q_EmptyPostReportTable, $konekcija) or die("Greska upit EmptyPostReportTable!");
					}
				}
				else if($action == "delete")
				{
					$q_DeletePostReport = "update reported_posts rp set rp.status = 'deleted' where rp.id_report = $idReport";
					$res_DeletePostReport = mysql_query($q_DeletePostReport, $konekcija) or die("Greska upit DeletePostReport!");
					
					if($res_DeletePostReport)
					{
						$q_DeletePostReportTable = "delete from posts where id_post = $idType";
						$res_DeletePostReportTable = mysql_query($q_DeletePostReportTable, $konekcija) or die("Greska upit DeletePostReportTable!");
					}
				}
				else if($action == "dismiss")
				{
					$q_DismissPostReport = "update reported_posts rp set rp.status = 'dismissed' where rp.id_report = $idReport";
					$res_DismissPostReport = mysql_query($q_DismissPostReport, $konekcija) or die("Greska upit DismissPostReport");
				}
			}
			mysql_close($konekcija);
		}
		else
		{
			//nije Report
			include("konekcija.php");
			
			if($type == "thread")
			{
				if($action == "lock")
				{
					$q_LockThread = "update threads t set t.status = 'locked' where t.id_thread = $idType";
					$res_LockThread = mysql_query($q_LockThread, $konekcija) or die("Greska upit LockThread!");
				}
				else if($action == "delete")
				{
					$q_DeleteThread = "update threads t set t.status = 'deleted' where t.id_thread = $idType";
					$res_DeleteThread = mysql_query($q_DeleteThread, $konekcija) or die("Greska upit DeleteThread!");
				}
			}
			if($type == "post")
			{
				if($action == "empty")
				{
					$q_EmptyPost = "update posts p set p.tekst = '$emptyPost' where p.id_post = $idType";
					$res_EmptyPost = mysql_query($q_EmptyPost, $konekcija) or die("Greska upit EmptyPost!");
				}
				else if($action == "delete")
				{
					$q_DeletePost = "delete from posts where id_post = $idType";
					$res_DeletePost = mysql_query($q_DeletePost, $konekcija) or die("Greska upit DeletePost".mysql_error());
				}
			}
			mysql_close($konekcija);
		}
	}
	//za Sticky: allow/dont allow
	if(isset($_POST["requestType"]))
	{
		$requestType = $_POST["requestType"];
		$requestId = $_POST["requestId"];
		
		if($requestType == "allow")
		{
			include("konekcija.php");
			
			$q_UpdateRequest = "update request_sticky rs set rs.status = 'allow' where rs.id_sticky = $requestId";
			$res_UpdateRequest = mysql_query($q_UpdateRequest, $konekcija) or die("Greska upit UpdateRequest!".mysql_error());
			
			if($res_UpdateRequest)
			{
				$requestThreadId = $_POST["requestThreadId"];
				
				$q_UpdateRequestThread = "update threads t set t.sticky = 1 where t.id_thread = $requestThreadId";
				$res_UpdateRequestThread = mysql_query($q_UpdateRequestThread, $konekcija) or die("Greska upit UpdateRequestThread!".mysql_error());
			}
			mysql_close($konekcija);
		}
		else if($requestType == "no")
		{
			include("konekcija.php");
			
			$q_UpdateRequest = "update request_sticky rs set rs.status = 'no' where rs.id_sticky = $requestId";
			$res_UpdateRequest = mysql_query($q_UpdateRequest, $konekcija) or die("Greska upit UpdateRequest".mysql_error());
			
			mysql_close($konekcija);
		}
	}
?>