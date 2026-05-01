<?php
require_once 'includes/db_connect.inc';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$species = trim($_POST['species'] ?? '');
$breed = trim($_POST['breed'] ?? '');
$ageYears = (int) ($_POST['age_years'] ?? 0);
$ageMonths = (int) ($_POST['age_months'] ?? 0);
$gender = trim($_POST['gender'] ?? 'Unknown');
$size = trim($_POST['size'] ?? 'Medium');
$description = trim($_POST['description'] ?? '');
$healthInfo = trim($_POST['health_info'] ?? '');
$adoptionFee = (float) ($_POST['adoption_fee'] ?? 0);
$status = trim($_POST['status'] ?? 'Available');
$imagePath = '';

if ($name === '' || $species === '' || $description === '') {
    exit('Name, species and description are required.');
}

if ($ageYears < 0 || $ageMonths < 0 || $ageMonths > 11 || $adoptionFee < 0) {
    exit('Invalid age or adoption fee.');
}

if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    exit('Please upload a valid pet image.');
}

$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$originalName = $_FILES['image']['name'];
$extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

if (!in_array($extension, $allowedExtensions, true)) {
    exit('Invalid image file type.');
}

$uploadDir = 'assets/images/pets/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$imagePath = uniqid('pet_', true) . '.' . $extension;
$destination = $uploadDir . $imagePath;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
    exit('Image upload failed.');
}

$sql = "INSERT INTO pets
        (name, species, breed, age_years, age_months, gender, size, description, health_info, image_path, adoption_fee, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    exit('Database statement failed.');
}

$stmt->bind_param(
    'sssiisssssds',
    $name,
    $species,
    $breed,
    $ageYears,
    $ageMonths,
    $gender,
    $size,
    $description,
    $healthInfo,
    $imagePath,
    $adoptionFee,
    $status
);

$stmt->execute();
$stmt->close();

header('Location: pets.php');
exit;
?>