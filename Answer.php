<!DOCTYPE html>

<html lang="en">
<head>
  <title>Question By Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

















<!-- 
Ini buat css file nya
-->
<style type="text/css">
 #header{
  background-color: #888;
  max-width: 100%;
  height: 5%;
  opacity: 0.8;
 }
 ul li{
  list-style-type: none;
  display: inline;
  font-size: 20px;
  padding: 10px;
  color: #fff;

 }
#LogOut{
  padding-left: 80%;
  position: fixed;
  cursor: pointer;
}

 .form-group{
  max-width: 40%;
 }

 form{
  padding: 10px;
 }

 form input{
  padding : 10px;
  width: 50%;
  margin: 10px;
 }
table{
  width: 300px;
}
 table tr{
    width: 300px;
 }

 #SubmitQuestion{
  width: 20%;
 }

 #finishButton{
  float: right;
  width: 100px;
 }


 #QuestionInserted{
  position: absolute;
  margin-top: 42%;
  margin-left: 90%;
 }

#lulus{
	display: none;
}

#tidakLulus{
	display: none;
}
</style>



<script type="text/javascript">
//ini buat log out pen
$(document).ready(function(){


  $('#LogOut').click(function(){
      console.log("test clicked admin this");
      window.location = 'index.html';
    });


});
</script>



<body>

<div id="header">
	<div id="Cacad">
	<ul>
	 <li><a>Home</a></li>
    <li><a>Faq</a></l1>
    <li id="LogOut">LogOut</li>
	</ul>
</div>
</div>


<?php include_once("connect.php");
?>
<?php
  $reg = strip_tags(@$_POST['reg']);
  $char = 'a';
  $Question      = strip_tags(@$_POST['Question']);
  $AnswerChoice1 = strip_tags(@$_POST['AnswerChoice1']);
  $AnswerChoice2 = strip_tags(@$_POST['AnswerChoice2']);
  $AnswerChoice3 = strip_tags(@$_POST['AnswerChoice3']);
  $AnswerChoice4 = strip_tags(@$_POST['AnswerChoice4']);
  $CorrectAnswer = strip_tags(@$_POST['CorrectAnswer']);
  $i = 1;
  $emailquery = mysql_query("SELECT * FROM question");
  $numberRows = mysql_num_rows($emailquery);
  echo"<script>
  	$(document).ready(function(){
  		console.log('numberwow: '+$numberRows);		
  	});
  </script>";
  echo "<form action='result.php' method='GET' id='formQuestion'>";
  $KeyAnswer ="";
   while($row = mysql_fetch_assoc($emailquery)){
	        echo "Question $i: ".$row["Question"]. "<br><br>";
	        $answer1 = $row["Answer1"];
	        $answer2 = $row["Answer2"];
	        $answer3 = $row["Answer3"];
	        $answer4 = $row["Answer4"];
	        $key 	 = $row["KeyAnswer"];
	        
	        echo "<input type='radio' name='option$char' value='$answer1'>".$row["Answer1"]. "<br>";
	        echo "<input type='radio' name='option$char' value='$answer2'>".$row["Answer2"]. "<br>";
	        echo "<input type='radio' name='option$char' value='$answer3'>".$row["Answer3"]. "<br>";
	        echo "<input type='radio' name='option$char' value='$answer4'>".$row["Answer4"]. "<br>";
	        $KeyAnswer.="-".$key;
	        $i++;
	        $char++;
	        echo "<br><br>";
  }
  			
			echo "	<script type='text/javascript'>
			var myOption = false;
			var character = 'a';

			function initValue() {
   				myOption = document.forms[0].optiona[3].checked
			}
 			function fullName(form,string) {
 	 			var first = 'a';
 	 			var answersInt =[];
 	 			var answerString = [];
 	 			var myAnswers = [];

 				for(var j = 0 ; j < 5 ; j++){
    			for (var i = 0; i < 4; i++) {
       			 if (form.optiona[i].checked && j == 0) {
           			 break;
        		}

        		if (form.optionb[i].checked && j == 1) {
           			 break;
        		}

        		if (form.optionc[i].checked && j == 2) {
           			 break;
        		}

        		if (form.optiond[i].checked && j == 3) {
           			 break;
        		}

        		if (form.optione[i].checked && j == 4) {
           			 break;
        		}

    			}
    			if(j == 0 ){
       		 		myAnswers.push(form.optiona[i].value);
       			}else if(j == 1){
       				myAnswers.push(form.optionb[i].value);
       			}else if(j == 2){
       				myAnswers.push(form.optionc[i].value);
       			}else if(j == 3){
       				myAnswers.push(form.optiond[i].value);
       			}else if(j == 4){
       				myAnswers.push(form.optione[i].value);
       			}
       		 character++;
    		}

  			//processing key answers
  			var AnswersKey = '$KeyAnswer';
  			for(var i = 0 ; i < AnswersKey.length ; i++){
  				if(AnswersKey.charAt(i) == '-') answersInt.push(i);
  			}

  			for(var i = 0 ; i < answersInt.length ; i++){
  				answerString.push(AnswersKey.substring(answersInt[i]+1,answersInt[i+1]));
  			}
  				console.log('Real Answer: '+answerString);
  				console.log('My Answer: '+myAnswers);
				//processing your answer
				var correctness = 0;
				for(var i = 0 ; i < 5 ; i++){	
					if(answerString[i].localeCompare(myAnswers[i]) == 0){
						correctness++;
					}
				}
				console.log('correctness'+correctness);
				if(correctness >= 2){
					document.getElementById('lulus').style.display = 'block';
					document.getElementById('score2').innerHTML = correctness;
				}else{
					document.getElementById('tidakLulus').style.display = 'block';
					document.getElementById('score1').innerHTML = correctness;
				}
				document.getElementById('correctness').innerHTML = correctness;
				document.getElementById('formQuestion').style.display = 'none';
				document.getElementById('header').style.display = 'none';
				
				
			}
			function setShemp(setting) {
			    myOption = setting
			}
			function exitMsg() {
			    if (myOption) {
			        alert('You like My Option?');
			    }
			}
			</script>";  
			
  			echo "<input type='button' id='AnswerButton' value='Submit' onClick='fullName(this.form)'>";

  	      	echo "</form>";


	?>

<div id="correctness">
</div>
<div id="tidakLulus">
	<style type="text/css">
#header{
  position: fixed;
  top:0;
  background-color: #ff9900;
  width: 100%;
  height: 100px;
  padding-top: 10px;
  border-bottom: 2px solid #cbcbcb;
 }
 #mulaibutton{
  max-width: 33%;
  vertical-align: text-top;
  margin-top: 100px;
 }
#mulaiTest{
  width: 85%;
  padding-top: 5px;
}
 .form-group{
   	max-width: 40%;
 }
</style>

<div id="header" style="text-align:center">
    <h1 style="color:white; font-family:calibri; font-style:italic; letter-spacing:1.5px">
      TES TEORI SIM
    </h1>
</div>

<center>
<div style="width:70%; margin-top:150px">
  <h2 style="margin-top:50px; font-family:calibri; letter-spacing:1.5px">
    Anda medapatkan skor <b id="score1"></b> dari total skor maksimum <b>5</b> dan dinyatakan <b>TIDAK LULUS</b>. Skor minimum untuk lulus ujian teori adalah <b>2</b>.
  </h2>
  <h2 style="margin-top:50px; font-family:calibri; letter-spacing:1.5px">
    Diharapkan untuk segera mendaftar ke slot waktu lain. Terima kasih.
  </h2>
</div>
</center>

<center>
  <div id="mulaibutton">
    <button class="btn btn-lg btn-primary btn-block" id="mulaiTest" onclick = login() style="font-family:calibri; letter-spacing:1.5px">
    LANJUT
    </button>
  </div>
</center>
</div>
<div id="lulus">
	<style type="text/css">
#header{
  position: fixed;
  top:0;
  background-color: #ff9900;
  width: 100%;
  height: 80px;
  padding-top: 10px;
  border-bottom: 2px solid #cbcbcb;
 }
 #mulaibutton{
  max-width: 33%;
  vertical-align: text-top;
  margin-top: 100px;
 }
#mulaiTest{
  width: 85%;
  padding-top: 5px;
}
 .form-group{
   	max-width: 40%;
 }

 #formQuestion{
 	padding-top: 100px;
 }

#AnswerButton{
	width: 100px;
}

</style>

<div id="header" style="text-align:center">
    <h1 style="color:white; font-family:calibri; font-style:italic; letter-spacing:1.5px">
      TES TEORI SIM
    </h1>
</div>


<center>
<div style="width:70%; margin-top:150px">
  <h2 style="margin-top:50px; font-family:calibri; letter-spacing:1.5px">
    Selamat anda dinyatakan <b>LULUS</b> dengan skor <b id="score2"></b> dari total skor maksimum <b>5</b>. Silahkan pergi ke
  </h2>
  <h1 style="margin-top:50px; font-family:calibri; letter-spacing:1.5px; color:#ff6203">
    <b>BILIK PRAKTIK 3</b>
  </h1>
  <h2 style="margin-top:50px; font-family:calibri; letter-spacing:1.5px">
    untuk pendaftaran tes praktik. Terima kasih.
  </h2>
</div>
</center>
<center>
  <div id="mulaibutton">
    <button class="btn btn-lg btn-primary btn-block" id="mulaiTest" onclick = login() style="font-family:calibri; letter-spacing:1.5px">
    LANJUT
    </button>
  </div>
</center>
</div>
</body>
</html>
