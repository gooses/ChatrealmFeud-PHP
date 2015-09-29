<?

// create json of active question



require_once 'config.php';
$db = new mysqli($mysqlconfig->host, $mysqlconfig->username, $mysqlconfig->password, $mysqlconfig->tablename);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}


//see current active  question.

$sql = <<<SQL
    SELECT *
    FROM `active`
    WHERE `id` = 1 
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
$row = $result->fetch_assoc();



if($_GET['qid'] == $row['questionid']){
	unset($row['id']);
	unset($row['questionid']);
    echo json_encode($row);
    die();//if current active is the same as stored js stop here.

}else{
	//$statment = $db->prepare("SELECT id FROM questions WHERE id = ?");
	/*
	$statment = $db->prepare("SELECT id FROM questions WHERE id = 1");
	$qid = 2;

	$statement->bind_param('s', $qid);
	$statement->bind_result($result);
	$statement->fetch();
	echo $result;
	*/
	$sql = 'SELECT * FROM questions WHERE id = ?';
 
/* Prepare statement */
$stmt = $db->prepare($sql);
if($stmt === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $db->errno . ' ' . $db->error, E_USER_ERROR);
}
 
$category_id = $row['questionid'];

 
/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
$stmt->bind_param('i', $category_id);
 
/* Execute statement */
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_array(MYSQLI_ASSOC);
  
$questionArray = array();
 foreach ($row as $key => $value) {
 	if($key != 'id' && $key !='question'){
 		$things = explode("{|}", $value);
 		$questionArray[$key] = array("answer"=>$things[0], "_count" =>$things[1]);
 	}
 }

//die($things[0]);

}
//echo json_encode(array($row));
echo json_encode(array('id'=>$row['id'],'question'=>$row['question'],'answers'=>$questionArray));





?>