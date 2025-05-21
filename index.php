<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>

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
    padding: 20px;
    margin: 0;
}

h1, h2 {
    text-align: center;
    color: var(--green-deep);
    margin-bottom: 20px;
}

form {
    max-width: 500px;
    margin: 0 auto 40px auto;
    background-color: var(--white);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    border: 1px solid var(--green-light);
}

form input, form button {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
}

form input:focus {
    outline: none;
    border-color: var(--green-soft);
    box-shadow: 0 0 0 3px #9ebc8a55;
}

form button {
    background-color: var(--green-deep);
    color: var(--white);
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
}

form button:hover {
    background-color: var(--green-soft);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(83, 125, 93, 0.3);
}

.student-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
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

.student-card .actions {
    margin-top: 12px;
    display: flex;
    justify-content: center;
    gap: 10px;
}

.student-card .actions a {
    background-color: var(--green-deep);
    color: var(--white);
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.3s ease;
}

.student-card .actions a:hover {
    background-color: var(--green-soft);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .student-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 500px) {
    .student-grid {
        grid-template-columns: 1fr;
    }
}


    </style>
</head>
<body>

    <h1>Add Student</h1>

    <form action="create.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="file" name="profile_picture" accept="image/*" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="text" name="year_level" placeholder="Year Level" required>
        <input type="text" name="section" placeholder="Section" required>
        <input type="text" name="adviser" placeholder="Adviser" required>
        <input type="text" name="school_year" placeholder="School Year" required>
        <button type="submit">Add Student</button>
    </form>

    <h2>Student List</h2>

    <div class="student-grid">
        <?php
        $xml = simplexml_load_file("students.xml") or die("Failed to load XML.");
        foreach ($xml->student as $student) {
            echo "<div class='student-card'>";
            echo "<img src='{$student->profile_picture}' alt='Profile'>";
            echo "<strong> {$student->name}</strong>";
            echo "<div>Course: {$student->course}</div>";
            echo "<div>Year Level/Section: {$student->year_level}{$student->section}</div>";
            echo "<div>Adviser: {$student->adviser}</div>";
            echo "<div>School Year: {$student->school_year}</div>";
            echo "<div class='actions'>";
            echo "<a href='edit.php?id={$student->id}' class='edit'>Edit</a>";
            echo "<a href='delete.php?id={$student->id}' class='delete'>Delete</a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>
