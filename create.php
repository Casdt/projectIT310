<?php
// Security improvements and file validation
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$maxFileSize = 2 * 1024 * 1024; // 2MB

$xml = simplexml_load_file("students.xml") or die("Failed to load XML.");
$id = count($xml->student) > 0 ? (int)$xml->student[count($xml->student)-1]->id + 1 : 1;

// File upload handling with validation
$uploadDir = "uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$filename = basename($_FILES["profile_picture"]["name"]);
$fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
$uploadFile = $uploadDir . uniqid() . '.' . $fileExtension;

// Validate file
if (!in_array($fileExtension, $allowedExtensions)) {
    die("Error: Only JPG, JPEG, PNG & GIF files are allowed.");
}

if ($_FILES["profile_picture"]["size"] > $maxFileSize) {
    die("Error: File is too large. Maximum size is 2MB.");
}

if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadFile)) {
    die("Error: There was an error uploading your file.");
}

// Sanitize input data
$name = htmlspecialchars($_POST['name']);
$course = htmlspecialchars($_POST['course']);
$year_level = htmlspecialchars($_POST['year_level']);
$section = htmlspecialchars($_POST['section']);
$adviser = htmlspecialchars($_POST['adviser']);
$school_year = htmlspecialchars($_POST['school_year']);

// Add new student
$newStudent = $xml->addChild("student");
$newStudent->addChild("id", $id);
$newStudent->addChild("name", $name);
$newStudent->addChild("profile_picture", $uploadFile);
$newStudent->addChild("course", $course);
$newStudent->addChild("year_level", $year_level);
$newStudent->addChild("section", $section);
$newStudent->addChild("adviser", $adviser);
$newStudent->addChild("school_year", $school_year);

// Save with error handling
if (!$xml->asXML("students.xml")) {
    unlink($uploadFile); // Remove uploaded file if XML save fails
    die("Error: Could not save student data.");
}

header("Location: index.php");
exit();
?>