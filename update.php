<?php
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$maxFileSize = 2 * 1024 * 1024; // 2MB
$uploadDir = "uploads/";

$xml = simplexml_load_file("students.xml");
$id = $_POST['id'];

foreach ($xml->student as $s) {
    if ((string)$s->id === $id) {
        // Sanitize all text inputs
        $s->name = htmlspecialchars($_POST['name']);
        $s->course = htmlspecialchars($_POST['course']);
        $s->year_level = htmlspecialchars($_POST['year_level']);
        $s->section = htmlspecialchars($_POST['section']);
        $s->adviser = htmlspecialchars($_POST['adviser']);
        $s->school_year = htmlspecialchars($_POST['school_year']);

        // 🔓 Store password as plain text if new one is provided
        if (!empty($_POST['password'])) {
            $s->password = htmlspecialchars($_POST['password']);
        }

        // Handle profile picture upload
        if (!empty($_FILES["profile_picture"]["name"])) {
            $filename = basename($_FILES["profile_picture"]["name"]);
            $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (!in_array($fileExtension, $allowedExtensions)) {
                die("Error: Only JPG, JPEG, PNG & GIF files are allowed.");
            }
            
            if ($_FILES["profile_picture"]["size"] > $maxFileSize) {
                die("Error: File is too large. Maximum size is 2MB.");
            }
            
            $newFilename = $uploadDir . uniqid() . '.' . $fileExtension;
            
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $newFilename)) {
                // Delete old picture if it exists and is in uploads directory
                $oldFile = (string)$s->profile_picture;
                if (file_exists($oldFile) && strpos($oldFile, $uploadDir) === 0) {
                    unlink($oldFile);
                }
                $s->profile_picture = $newFilename;
            }
        }

        break;
    }
}

// Save and redirect
if (!$xml->asXML("students.xml")) {
    die("Error: Could not update student data.");
}

header("Location: students.php");
exit();
?>
