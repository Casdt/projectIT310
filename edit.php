<?php
$id = $_GET['id'];
$xml = simplexml_load_file("students.xml");
$student = null;

foreach ($xml->student as $s) {
    if ((string)$s->id === $id) {
        $student = $s;
        break;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        :root {
            --green-deep: #537d5d;
            --green-soft: #73946b;
            --green-light: #9ebc8a;
            --beige: #d2d0a0;
            --white: #ffffff;
            --gray-light: #f5f5f5;
            --text-dark: #202124;
            --text-medium: #5f6368;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--gray-light);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .edit-form-container {
            background: var(--white);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 500px;
            border: 1px solid #e0e0e0;
        }

        h1 {
            color: var(--green-deep);
            text-align: center;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-medium);
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--green-light);
            box-shadow: 0 0 0 3px rgba(158, 188, 138, 0.3);
        }

        .current-photo {
            text-align: center;
            margin: 20px 0;
        }

        .current-photo img {
            border-radius: 8px;
            border: 3px solid var(--green-light);
            max-width: 200px;
        }

        button[type="submit"] {
            background-color: var(--green-deep);
            color: var(--white);
            border: none;
            padding: 14px 22px;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(83, 125, 93, 0.1);
        }

        button[type="submit"]:hover {
            background-color: var(--green-soft);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(83, 125, 93, 0.2);
        }

        button[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 3px 8px rgba(83, 125, 93, 0.2);
        }

        .back-link {
            display: inline-block;
            background-color: var(--green-deep);
            color: var(--white);
            text-align: center;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: background 0.3s, transform 0.2s;
            margin-top: 20px;
            width: 100%;
        }

        .back-link:hover {
            background-color: var(--green-soft);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
<?php if ($student): ?>
    <div class="edit-form-container">
        <h1>Edit Student</h1>
        <form action="update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $student->id ?>">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($student->name) ?>" required>
            </div>

            <div class="current-photo">
                <label>Current Photo</label><br>
                <img src="<?= $student->profile_picture ?>" alt="Current Photo">
            </div>

            <div class="form-group">
                <label>Change Photo</label>
                <input type="file" name="profile_picture" accept="image/*">
            </div>

            <div class="form-group">
                <label>Course</label>
                <input type="text" name="course" value="<?= htmlspecialchars($student->course) ?>" required>
            </div>

            <div class="form-group">
                <label>Year Level</label>
                <input type="text" name="year_level" value="<?= htmlspecialchars($student->year_level) ?>" required>
            </div>

            <div class="form-group">
                <label>Section</label>
                <input type="text" name="section" value="<?= htmlspecialchars($student->section) ?>" required>
            </div>

            <div class="form-group">
                <label>Adviser</label>
                <input type="text" name="adviser" value="<?= htmlspecialchars($student->adviser) ?>" required>
            </div>

            <div class="form-group">
                <label>School Year</label>
                <input type="text" name="school_year" value="<?= htmlspecialchars($student->school_year) ?>" required>
            </div>

            <button type="submit">Update Student</button>
        </form>

        <form action="index.php" method="get" style="margin-top: 15px;">
    <button type="submit" class="button-secondary">Back to Student List</button>
</form>

    </div>
<?php else: ?>
    <div class="edit-form-container">
        <h1>Student Not Found</h1>
        <p>The requested student could not be found.</p>
        <a href="index.php" class="back-link">Back to Student List</a>
    </div>
<?php endif; ?>
</body>
</html>
