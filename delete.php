<?php
// Security check - verify ID is numeric
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$xml = simplexml_load_file("students.xml");
$id = $_GET['id'];
$uploadDir = "uploads/";

$index = 0;
foreach ($xml->student as $student) {
    if ((string)$student->id === $id) {
        // Delete the image file if it exists and is in uploads directory
        $imagePath = (string)$student->profile_picture;
        if (file_exists($imagePath) && strpos($imagePath, $uploadDir) === 0) {
            unlink($imagePath);
        }

        unset($xml->student[$index]);
        break;
    }
    $index++;
}

// Save with error handling
if (!$xml->asXML("students.xml")) {
    die("Error: Could not delete student.");
}

header("Location: students.php");
exit();
?>