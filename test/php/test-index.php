<?php

	// Import connections file
	require '../../sql_connections.php';
	
	// Get register number and department
	$regNum = (int)$_POST['regnumber'];
	$dept = $_POST['department'];

	// Create array to store correct answers
	$correct_answers = array();
	$count = 0;

	// Establish database connectoon
	$conn = getConn();

	// Declare random seed
	$seed = ($regNum % 10);

	// Retrieve correct answers for quants questions
	$sql_stmt = "SELECT CorrectOpt FROM questions WHERE QuestionTopic = 'QUANTITATIVE ABILITY' ORDER BY rand($seed) LIMIT 10";
	$stmt = $conn->query($sql_stmt);
	$quants = $stmt->fetchAll();

	// Retrieve correct answers for verbal questions
	$sql_stmt = "SELECT CorrectOpt FROM questions WHERE QuestionTopic = 'VERBAL ABILITY' ORDER BY rand($seed) LIMIT 10";
	$stmt = $conn->query($sql_stmt);
	$verbal = $stmt->fetchAll();
	
	// Retrieve correct answers for programming questions
	$sql_stmt = "SELECT CorrectOpt FROM questions WHERE QuestionTopic= 'PROGRAMMING' ORDER BY rand($seed) LIMIT 10";
	$stmt = $conn->query($sql_stmt);
	$programming = $stmt->fetchAll();

	// Retrieve correct answers for core questions
	$sql_stmt = "SELECT CorrectOpt FROM questions WHERE CoreDept = :CoreDept ORDER BY rand($seed)";
	$stmt = $conn->prepare($sql_stmt);
	$stmt->execute([":CoreDept" => $dept]);
	$core = $stmt->fetchAll();

	$results = array_merge($quants, $verbal, $programming, $core);

	// Create a key-value based array to store the correct option for the corresponding question number
	foreach($results as $row) {
		$correct_answers[$count] = $row['CorrectOpt'];
		$count += 1;
	}

	$count = 0;
	$no_of_questions = count($correct_answers);

	$correct = 0;
	$section_scores = array (0, 0, 0, 0);

	for($count = 0; $count < $no_of_questions; $count += 1) {
	
		$question_count = $count + 1;
		$user_answer = !empty($_POST["question$question_count"]) ? $_POST["question$question_count"] : "";

		if($correct_answers[$count] == $user_answer){
			$correct += 1;

			if($count < 10) {
				$section_scores[0] += 1;
			}
			else if($count < 20) {
				$section_scores[1] += 1;
			}
			else if($count < 30) {
				$section_scores[2] += 1;
			}
			else if($count < 50) {
				$section_scores[3] += 1;
			}
		}

	}

	$sql_query = "INSERT INTO scores(reg_no, sec_1, sec_2, sec_3, sec_4, total) VALUES(:reg_no,:sec_1,:sec_2,:sec_3,:sec_4,:total)";
	$stmt      = $conn->prepare($sql_query);
	$stmt->execute([
		':reg_no' => $regNum,
		':sec_1' => $section_scores[0],
		':sec_2' => $section_scores[1],
		':sec_3' => $section_scores[2],
		':sec_4' => $section_scores[3],
		':total' => $correct,
	]);

	$alert_message  = "Your submission has been successfully recorded!\\n";
	$alert_message .= "Your score is as follows:\\n\\n";
	$alert_message .= "Section 1 (Quantitative Ability) : $section_scores[0]/20\\n";
	$alert_message .= "Section 2 (Verbal Reasoning) : $section_scores[1]/10\\n";
	$alert_message .= "Section 3 (Programming) : $section_scores[2]/10\\n";
	$alert_message .= "Section 4 (Core Knowledge) : $section_scores[3]/10\\n";
	$alert_message .= "Your total score is $correct/50! A detailed report will be made available to you soon. Thank you!";

	echo "<script>alert('$alert_message')</script>;";
	echo "<script>window.location.href='../../login/index.html'</script>;";
?>