<html>
<head>
	<meta charset="UTF-8">
	<title>feud</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$('.reveal').live( "click", function() {
		 	$.post("do.php?a="+$(this).attr('class'), { num: $(this).attr('num')} );
		 });
		$('.resetactive').live( "click", function() {
		 	$.post("do.php?a="+$(this).attr('class'), { num: $(this).attr('num')} );
		});
		$('.makeactive').live( "click", function() {
		 	$.post( "do.php?a="+$(this).attr('class'), { num: $(this).attr('num')}, function( data ) {
		 		$('.activeQuestion').html(data);
		 	});
		});
		$('.XXX').click(function() {
			$.post( "do.php?a=xxx", { num: $(this).attr('num')} );
    	});
		$( "#submitQuestionForm" ).submit(function( event ) {
			//alert( "I said not working yet!" );
			var url = "do.php?a=submitquestion"; // the script where you handle the form input.
			$.ajax({
				type: "POST",
				url: url,
				data: $("#submitQuestionForm").serialize(), // serializes the form's elements.
				success: function(data){
					//alert(data); // show response from the php script.

				
					$(".questionsBox").append('<div><input type="checkbox" class="qd" name="qd[]" value="'+data+'"><button class="makeactive" num="'+data+'">make active</button>'+$('.questionText').val()+'</div>');
					$('#submitQuestionForm').trigger("reset");

				}
			});
			return false; // avoid to execute the actual submit of the form.
			event.preventDefault(); // again, to stop from submitting.
		});
		$("#removeQuestion").live("click",function(){
		 	$.ajax({
				type: "POST",
				url: "do.php?a=removeQuestion",
				data: $('.qd:checked').serialize(), // serializes the form's elements.
				success: function(data){
					//alert(data); // show response from the php script.
					//$(".questionsBox").append('<div><input type="checkbox" class="qd" name="qd[]" value="'+data+'"><button class="makeactive" num="'+data+'">make active</button>'+$('.questionText').val()+'</div>');
					//$('#submitQuestionForm').trigger("reset");
					$('.qd:checked').each(function() {
						$(this).parent().remove();
					});
				}
			});
 		});
	});
	</script>
	<style>
	.activeQuestion{
		-webkit-box-shadow: 4px 4px 5px 0px rgba(194,194,194,1);
		-moz-box-shadow: 4px 4px 5px 0px rgba(194,194,194,1);
		box-shadow: 4px 4px 5px 0px rgba(194,194,194,1);
		width: 500px;
		background-color: #f7f7f7;
		padding: 5px;
		margin: 0 auto;
		height: 215px;
	}
		.addQuestion{
		-webkit-box-shadow: 4px 4px 5px 0px rgba(194,194,194,1);
		-moz-box-shadow: 4px 4px 5px 0px rgba(194,194,194,1);
		box-shadow: 4px 4px 5px 0px rgba(194,194,194,1);
		width: 300px;
		background-color: #f7f7f7;
		padding: 5px;
		/*margin: 10px auto;*/
		margin: 10px 0;
		height: 100%;
	}
		.questionsBox, .XXXBox{
		-webkit-box-shadow: 4px 4px 5px 0px rgba(194,194,194,1);
		-moz-box-shadow: 4px 4px 5px 0px rgba(194,194,194,1);
		box-shadow: 4px 4px 5px 0px rgba(194,194,194,1);
		width: auto;
		background-color: #f7f7f7;
		padding: 5px;
		margin: 10px 25px;
	}
	h3{
		margin: 0;
	}
	.cText{
		width:55px;
	}
	</style>
</head>
<body>
<?
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
$sql = 'SELECT * FROM questions WHERE id = ?';
$stmt = $db->prepare($sql);
if($stmt === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $db->errno . ' ' . $db->error, E_USER_ERROR);
}
 
$activeid = $row['questionid'];
 
$stmt->bind_param('i', $activeid);
 
/* Execute statement */
$stmt->execute();
$res = $stmt->get_result();
$activerow = $res->fetch_array(MYSQLI_ASSOC);
echo "<div class='activeQuestion'><h3>Current Question</h3>";
echo $activerow['question'];
for($i=1; $i<=8;$i++){
	if($activerow[$i] !=""){
		$things = explode("{|}", $activerow[$i]);
	echo '<div><button class="reveal" num="'.$i.'">FLIP #'.$i.'</button>'.$things[0]."(".$things[1].")</div>";
}
}
echo "<div><button class=\"resetactive\">Reset all</button></div>";
echo"</div>";
?>
<div>
<div class="addQuestion" style="float:left;">
	<h3>Add Question</h3>
	<form id="submitQuestionForm" action="null.php" method="post">
	<input type="text" name="q" class="questionText" placeholder='put the question here'><br/>
<input type="text" name="1" class="aText" placeholder='answer 1 here(blank if none)'><input type="text" name="c1" class="cText" placeholder='count'><br/>
<input type="text" name="2" class="aText" placeholder='answer 2 here(blank if none)'><input type="text" name="c2" class="cText" placeholder='count'><br/>
<input type="text" name="3" class="aText" placeholder='answer 3 here(blank if none)'><input type="text" name="c3" class="cText" placeholder='count'><br/>
<input type="text" name="4" class="aText" placeholder='answer 4 here(blank if none)'><input type="text" name="c4" class="cText" placeholder='count'><br/>
<input type="text" name="5" class="aText" placeholder='answer 5 here(blank if none)'><input type="text" name="c5" class="cText" placeholder='count'><br/>
<input type="text" name="6" class="aText" placeholder='answer 6 here(blank if none)'><input type="text" name="c6" class="cText" placeholder='count'><br/>
<input type="text" name="7" class="aText" placeholder='answer 7 here(blank if none)'><input type="text" name="c7" class="cText" placeholder='count'><br/>
<input type="text" name="8" class="aText" placeholder='answer 8 here(blank if none)'><input type="text" name="c8" class="cText" placeholder='count'><br/>
<button class="submitQuestion">Submit Question</button>
</form>

</div>
<div class="XXXBox">
<h3>Buzzers</h3>
<button class="XXX" num="1">X</button><button class="XXX" num="2">XX</button><button class="XXX" num="3">XXX</button>
</div>

<div class="questionsBox">
<h3>Questions</h3>
<button id="removeQuestion">Remove checked</button>
<?

$sql = <<<SQL
    SELECT *
    FROM `questions`
    LIMIT 50
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
while($row = $result->fetch_assoc()){
	echo '<div><input type="checkbox" class="qd" name="qd[]" value="'.$row['id'].'"><button class="makeactive" num="'.$row['id'].'">make active</button>'.$row['question']."</div>";
}

?>
</div>
</div>
todo:
<ul>
<li>text resizing needs to be tweaked... think this is fixed, hard to be sure</li>
<li>add basic security... maybe</li>
</ul>
</body>
</html>