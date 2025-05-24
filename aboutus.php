<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
    <style>
        :root {
            --green-deep: #537D5D;
            --green-soft: #73946B;
            --green-light: #9EBC8A;
            --cream: #D2D0A0;
            --white: #ffffff;
            --gray-light: #f8f8f8;
            --text-dark: #2f2f2f;
            --text-medium: #555;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, var(--cream), var(--white));
            color: var(--text-dark);
            margin: 0;
            padding-top: 70px;
        }

        h1, h2 {
            text-align: center;
            color: var(--green-deep);
            margin-bottom: 20px;
        }

        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            padding: 0 20px;
            max-width: 900px;
            margin: 0 auto 40px auto;
        }

        .student-card {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid var(--green-light);
        }

        .student-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 20px rgba(83, 125, 93, 0.2);
            border-color: var(--green-soft);
        }

        .student-card img {
            width: 100%;
            height: 220px;
            object-fit: contain;
            background-color: var(--cream);
            border-radius: 8px;
            margin-bottom: 15px;
            border: 3px solid var(--green-deep);
            box-sizing: border-box;
        }

        .student-card strong {
            display: block;
            font-size: 1.2rem;
            color: var(--green-deep);
            margin-bottom: 8px;
        }

        .student-card div {
            margin: 4px 0;
            font-size: 15px;
            color: var(--text-medium);
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<h1>About Us</h1>

<div class="student-grid">
    <div class="student-card">
        <img src="ced.jpg">
        <strong>Cedric Dela Torre</strong>
        <div>Course: Information Technology</div>
        <div>Year Level/Section: 3B-G2</div>
        <div>Adviser: Mr. Smith</div>
        <div>School Year: 2024–2025</div>
    </div>
    <div class="student-card">
        <img src="kurt.jpg">
        <strong>Kurt Rafael</strong>
        <div>Course: Information Technology</div>
        <div>Year Level/Section: 3B-G2</div>
        <div>Adviser: Mr. Smith</div>
        <div>School Year: 2024–2025</div>
    </div>
</div>

</body>
</html>
