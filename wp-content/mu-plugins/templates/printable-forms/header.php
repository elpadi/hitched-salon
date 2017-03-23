<!doctype html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<style>
			body { font-size: 16px; line-height: 24px; }
			h1 { margin: 1em auto 2em; }
			p, table { page-break-inside: avoid; }
			input, label { vertical-align: middle; }
			input { font-size: 16px; height: 30px; line-height: 30px; } 
			label { white-space: nowrap; }
			div > label { line-height: 50px; }
			textarea { width: 100%; min-height: 200px; }
			form td {
					border-right: 1px solid black;
					border-bottom: 1px solid black;
					padding: 12px 5px 12px;
			}
			form table {
					width: 100%;
					border-collapse: collapse;
					margin-bottom: 2.5em;
			}
			input[type="text"], input[type="email"], input[type="tel"], input[type="date"] { border: 1px solid black; padding-left: 0.5em; }
			input[name*="initials"] { text-transform: uppercase; }
			input[value=""] { width: 2em; }
		</style>
	</head>
	<body>
		<h1><?php echo $title; ?></h1>
