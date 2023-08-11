<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    
	<link
      href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped:wght@500;600&family=Roboto+Slab:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />

	<!-- SemanticUI CSS -->
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css'/>

	<!-- DataTables SemanticUI CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.semanticui.min.css">

	<!-- FixedHeader CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.semanticui.min.css">

	<!-- SearchBuilder SemanticUI CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.3.0/css/searchBuilder.semanticui.min.css">

	<!-- Responsive CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.semanticui.min.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="../static/css/leaderboard.css">
	
	<title>Leaderboard</title>
	</head>

	<body>
	    <h1 class="ui header">Leaderboard</h1>
		
		<div class="ui container">
			<table class="ui blue celled compact selectable responsive unstackable table" id="scores">
				<thead>
					<tr>
						<th rowspan="2">SNo.</th>
						<th rowspan="2" class="duplifer">Register Num.</th>
						<th rowspan="2">Name</th>
						<th rowspan="2">Dept.</th>
						<th rowspan="2">E-Mail ID</th>
						<th colspan="4">Sections</th>
						<th rowspan="2">Total</th>
						<th rowspan="2">Dept. <br>Rank</th>
						<th rowspan="2">College <br>Rank</th>
						<th rowspan="2">Action</th>
					</tr>
					<tr>
						<th>Quants</th>
						<th>Verbal</th>
						<th>Coding</th>
						<th>Core</th>
					</tr>
				</thead>
			
				<tbdoy>

					<?php 

						require '../sql_connections.php';
						$conn = getConn();

						$query = "SELECT scores.SNO, users.reg_no, users.name, users.dept, users.email, scores.sec_1, scores.sec_2, scores.sec_3, scores.sec_4, scores.total, RANK() OVER (PARTITION BY users.dept ORDER BY scores.total DESC) d_rank, RANK() OVER (ORDER BY scores.total DESC) c_rank FROM scores, users WHERE scores.reg_no = users.reg_no ORDER BY users.reg_no";

						$stmt = $conn->query($query);
						$students = $stmt->fetchAll();

					?>

					<?php foreach($students as $key => $student) : ?>

						<tr>
							<td><?= $key + 1; ?></td>
							<td><?= $student["reg_no"]; ?></td>
							<td><?= $student["name"]; ?></td>
							<td><?= $student["dept"]; ?></td>
							<td><?= $student["email"]; ?></td>
							<td><?= $student["sec_1"]; ?></td>
							<td><?= $student["sec_2"]; ?></td>
							<td><?= $student["sec_3"]; ?></td>
							<td><?= $student["sec_4"]; ?></td>
							<td><?= $student["total"]; ?></td>
							<td><?= $student["d_rank"]; ?></td>
							<td><?= $student["c_rank"]; ?></td>
							<td>
								<form action="delete.php" method="POST">
									<input type="hidden" name="sno" value="<?= $student["SNO"]; ?>">
									<button type="submit" style="background-color: white;border:none;cursor:pointer">
										<i class="icon trash alternate red large"></i>
									</button>
								</form>
							</td>
						</tr>

					<?php endforeach; ?>

				</tbdoy>
			</table>
		</div>

		<footer>
		Copyright &copy; 2022 - 
		<b>FOR</b>um for <b>E</b>conomic <b>S</b>tudies by <b>E</b>ngineers - Designed and Developed by <b>FORESE Tech</b>
		</footer>

	</body>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

	<!-- Duplifier JS -->
	<script src="../static/js/duplifier.js"></script>

	<!-- SemanticUI  JS -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js'></script>

	<!-- DataTables JS -->
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

	<!-- DataTables SemanticUI JS -->
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.semanticui.min.js"></script>

	<!-- FixedHeader JS -->
	<script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>

	<!-- SearchBuilder JS -->
	<script src="https://cdn.datatables.net/searchbuilder/1.3.0/js/dataTables.searchBuilder.min.js"></script>

	<!-- SearchBuilder SemanticUI JS -->
	<script src="https://cdn.datatables.net/searchbuilder/1.3.0/js/searchBuilder.semanticui.min.js"></script>

	<!-- Responsive JS -->
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

	<!-- SemanticUI Resposive JS -->
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.semanticui.min.js"></script>
	
	<!-- Initialize Datatables and Duplifier -->
	<script src="../static/js/leaderboard.js"></script>
</html>
