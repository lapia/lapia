<?php
include_once  'sqlconnect.php';
class EditUsers{
		
	private $resource;
	private $idtable;
	private $euser;
	private $db;
		
	public function EditUsers($quantity=10){
			
		$this->InitComponent();
		
		if(!isset($_POST['euser'])){
			$this->euser['quantity']=$quantity;
			$this->ShowUsers($this->euser['quantity']);
			$_SESSION['euser']=$this->euser;
		}
		else if($_POST['euser'] == 0) 
		{
			$this->euser=$_SESSION['euser'];
			$this->ShowUsers($this->euser['quantity']);
		}
		else if($_POST['euser'] == 1)
		{			
			$this->euser=$_SESSION['euser'];
			$this->ShowEditGroup();
		}
		else if($_POST['euser'] == 2)
		{
			$this->action();
		}
			
	}
	private function InitComponent()
	{
		if(isset($_SESSION['SQLSETTINGS']))
		{
				$row=$_SESSION['SQLSETTINGS'];
				$this->db= new SqlConnect($row['host'],$row['user'],$row['password'],$row['dbname']);
				$this->db->connectToDb();
				$this->resource= &$this->db->getResource();
		}
		else
		{
				echo 'err class AdminForm: not set $_SESSION[\'SQLSETTINGS\']';
				echo "<br> example setings \$_SESSION['SQLSETTINGS']=array('host'=>'url','user'=>'root','password'=>'password','dbname'=>'dbmane');";
				return NULL;
		}
	}
	private function ShowUsers($number)
	{
			
		$quantity=NULL;
		$query="SELECT *, (SELECT COUNT(*) FROM registereduser) AS quantity FROM registereduser";
		//echo $query;
		$result=mysql_query($query,$this->resource);
		
		$form=NULL;
		//begin form
		$form.= "<form action='".$_SERVER['PHP_SELF']."' method='post' name='euser'>";
		//header and firs line
		$form.= "<table  cellpadding=\"0\" cellspacing=\"0\"class=\"showuser\">";
		$form.= "<tbody>";
		$form.= "<tr class=\"ttheader\"><th rowspan='2'>Id</th><th rowspan='2'>Email Address</th><th rowspan='2'>Address</th><th rowspan='2'>Contact Person</th><th rowspan='2'>Organization</th><th rowspan='2'>Password</th><th rowspan='2'>Phone</th><th rowspan='2'>Confirmation code</th><th colspan='3'>Edit</th></tr>";
		$form.= "<tr class=\"ttheader\"><th>Edit</td><th>Delete</th><th>Select</th></tr>";
		//body table
		//.bcolor .color
		$i=1;	
		while ($row = mysql_fetch_assoc($result)) {
    		$id= 		$row["idRegistereduser"]; 
    		$email= 	$row["RegisteredEmailaddress"];
    		$address= 	$row["Address"];
    		$person= 	$row["Contactperson"];
    		$oname=		$row["Organizationname"];
    		$pass= 		$row["password"];
    		$phone=		$row["phone"];
    		$code= 		$row["confirmationcode"];
			
    		$code? $code : $code="&nbsp"; 
    		
    		
			if(($i%2) == 0) $form.="\n<tr class=\"tcolor\">\n";
			else $form.="\n<tr class=\"tbcolor\">\n";
    		$form.="<td>$id</td><td>$email</td><td>$address</td><td>$person</td><td>$oname</td><td>$pass</td><td>$phone</td><td>$code</td><td><button type='submit'  name='action' value='edit $id'>edit</td><td><button type='submit'  name='action' value='delete $id'>del</td><td><input type='checkbox' name='select $id'></td></tr>";
			$i++;
		}
		//body table
		$form.= "</tbody>";
		$form.= "</table>";
		//finish table
		//send elements
		$form.="<button type='submit'  name='action' value='group_delete'>Delete</button>";
		$form.="<button type='submit'  name='action' value='group_edit'>Edit</button>";
		$form.="<input type='hidden' name='euser' value='1'>";
		$form.="</form>";
		//edn form
		echo $form;
			
		mysql_free_result($result);
		
	}
	private function ShowEditGroup()
	{
		$action=NULL;
		$idarray=array();
		$testquery=$query='SELECT * FROM registereduser WHERE';
		
		if(($_POST['action'] == 'group_delete') || ($_POST['action'] == 'group_edit') )
		{
			foreach($_POST as $post=>$wartosc)
			{
				if( ($post == 'action') || ($post == 'euser')) continue;
				
				$value=explode('_',$post);
				$query.=" idRegistereduser=$value[1] or";
			}
			if($testquery == $query)
			{
				$form=NULL;
				$form='<p> Not selected any rows';
				$form.= "<form action='".$_SERVER['PHP_SELF']."' method='post' name='euser'>";
				$form.="<input type='hidden' name='euser' value='0'>";
				$form.="<button type='submit'  name='action' value='return'>Return to select users</button>";
				$form.="</form>";
				echo $form;
				return -1; //not selected any line
			}
			$query=rtrim($query,'or');
			$action=$_POST['action'];
		}
		else
		{
			$action=explode(" ",$_POST['action']);
			//if(($_POST['action'] == $action[1])|| ($_POST['action'] == ))
			$query.=" idRegistereduser=$action[1]";	
		}
		//echo '<p>'. $query;
		$result=mysql_query($query,$this->resource);
		
		$form=NULL;
		$form= "<form action='".$_SERVER['PHP_SELF']."' method='post' name='euser'>";

		$i=0;
		while ($row = mysql_fetch_assoc($result))
		{
			$i++;
			
			$id= 		$row["idRegistereduser"]; 
    		$email= 	$row["RegisteredEmailaddress"];
    		$address= 	$row["Address"];
    		$person= 	$row["Contactperson"];
    		$oname=		$row["Organizationname"];
    		$pass= 		$row["password"];
    		$phone=		$row["phone"];
    		$code= 		$row["confirmationcode"];
    		
    		$form.=" 
    		<TABLE class=\"esingleuser\">
			<TR>
			<TD ><LABEL for='userid' ><EM>User id</EM></LABEL></TD>
			<TD><INPUT type='text' name='userid $i' id='userid' value='$id' readonly='readonly'></TD>
			</TR>
			<TR>
				<TD><LABEL for='email'><EM>Email Address</EM></LABEL></TD>
				<TD><INPUT type='text' name='email $i' id='email' value='$email'></TD>
			</TR>
			<TR>
				<TD><LABEL for='addres'><EM>Address</EM></LABEL></TD>
				<TD><INPUT type='text' name='addres $i' id='addres' value='$address'></TD>
				</TR>
			<TR>
				<TD><LABEL for='person'><EM>Contact Person</EM></LABEL></TD>
				<TD><INPUT type='text' name='person $i' id='person' value='$person'></TD>
			</TR>
			<TR>
				<TD><LABEL for='oname'><EM>Organization</EM></LABEL></TD>
				<TD><INPUT type='text' name='oname $i' id='oname' value='$oname'></TD>
			</TR>
			<TR>
				<TD><LABEL for='pass'><EM>Password</EM></LABEL></TD>
				<TD><INPUT type='text' name='pass $i' id='pass' value='$pass'></TD>
			</TR>
			<TR>
				<TD><LABEL for='fname'><EM>Phone</EM></LABEL></TD>
				<TD><INPUT type='text' name='phone $i' id='phone' value='$phone'></TD>
			</TR>
			<TR>
				<TD><LABEL for='code'><EM>Confirmation Code &nbsp</EM></LABEL></TD>
				<TD><INPUT type='text' name='code $i' id='code' value='$code'></TD>
			</TR>
    		</TABLE>";
    		
    			
    			if(($action[0] == 'edit') || ($action == 'group_edit')) $form.="<button type='submit'  name='action' value='edit'>Edit</button>";
				else $form.="<button type='submit'  name='action' value='delete'>Delete</button>";
    		
		}
		$form.="<input type='hidden' name='euser' value='2'>";
		if(!is_array($action))
		{
			$form.='<p>';
			if(($action[0] == 'edit') || ($action == 'group_edit')) $form.="<button type='submit'  name='action' value='edit'>Edit all</button>";
			else $form.="<button type='submit'  name='action' value='delete'>Delete all</button>";
		}
		$form.="<button type='submit'  name='action' value='return'>Return to select users</button>";
		$form.="</form>";

		
		echo $form;
		
		mysql_free_result($result);
	}
	private function action()
	{
		
		$this->euser=$_SESSION['euser'];
		if($_POST['action'] != 'return')
			for($i=1;isset($_POST["userid_$i"]);$i++)
			{
				$id= 		$_POST["userid_$i"]; 
	    		
	    		if($_POST['action'] == 'edit')
	    		{		
	    			
	    			$email= 	$_POST["email_$i"];
	    			$address= 	$_POST["addres_$i"];
	    			$person= 	$_POST["person_$i"];
	    			$oname=		$_POST["oname_$i"];
	    			$pass= 		$_POST["pass_$i"];
	    			$phone=		$_POST["phone_$i"];
	    			$code= 		$_POST["code_$i"];
	    			//UPDATE example SET age='22' WHERE age='21
	    			$query="UPDATE registereduser SET RegisteredEmailaddress='$email', Address='$address' ,Contactperson='$person', Organizationname='$oname', password='$pass', phone='$phone', confirmationcode='$code' WHERE idRegistereduser='$id'"; 
				//	echo "<p>".$query."</p>";
					$result=mysql_query($query,$this->resource);
					if($result == false) echo "<p><font color='red'>error user nr $id not update</font>";
	    		}
	    		else if($_POST['action'] == 'delete')
	    		{
	    			$query="DELETE FROM registereduser WHERE idRegistereduser='$id'";
	    			echo "<h3>$query</h3>";
	    			$result=mysql_query($query,$this->resource);
					if($result == false) echo "<p><font color='red'>error user nr $id not delete</font>";
	    		}
    		
			}
		
		$this->ShowUsers($this->euser['quantity']);
	}
}
?>