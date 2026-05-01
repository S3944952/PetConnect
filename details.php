<?php
$pageTitle = 'Pet Details | PetConnect';
require_once 'includes/db_connect.inc';

$pet = null;

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $petId = (int) $_GET['id'];

    $sql = "SELECT *
            FROM pets
            WHERE pet_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $petId);
    $stmt->execute();

    $result = $stmt->get_result();
    $pet = $result->fetch_assoc();

    $stmt->close();

    if ($pet) {
        $pageTitle = $pet['name'] . ' | PetConnect';
    }
}

require_once 'includes/header.inc';
require_once 'includes/nav.inc';
?>

<main class="container my-4">
  <?php if ($pet) : ?>
    <a href="pets.php" class="btn btn-outline-secondary btn-sm mb-4">&larr; Back to All Pets</a>

    <div class="row g-4">
      <div class="col-12 col-md-5">
        <img src="assets/images/pets/<?php echo htmlspecialchars($pet['image_path']); ?>"
             class="img-fluid rounded shadow"
             alt="<?php echo htmlspecialchars($pet['name']); ?>">
      </div>

      <div class="col-12 col-md-7">
        <h1><?php echo htmlspecialchars($pet['name']); ?></h1>

        <table class="table table-borderless">
          <tr>
            <th class="details-table-heading">Species</th>
            <td><?php echo htmlspecialchars($pet['species']); ?></td>
          </tr>
          <tr>
            <th>Breed</th>
            <td><?php echo htmlspecialchars($pet['breed']); ?></td>
          </tr>
          <tr>
            <th>Age</th>
            <td><?php echo (int) $pet['age_years']; ?> years <?php echo (int) $pet['age_months']; ?> months</td>
          </tr>
          <tr>
            <th>Gender</th>
            <td><?php echo htmlspecialchars($pet['gender']); ?></td>
          </tr>
          <tr>
            <th>Size</th>
            <td><?php echo htmlspecialchars($pet['size']); ?></td>
          </tr>
          <tr>
            <th>Status</th>
            <td><?php echo htmlspecialchars($pet['status']); ?></td>
          </tr>
          <tr>
            <th>Adoption Fee</th>
            <td><strong>$<?php echo number_format($pet['adoption_fee'], 2); ?></strong></td>
          </tr>
        </table>

        <h2 class="h5">About <?php echo htmlspecialchars($pet['name']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($pet['description'])); ?></p>

        <?php if (!empty($pet['health_info'])) : ?>
          <h2 class="h5">Health Information</h2>
          <p><?php echo nl2br(htmlspecialchars($pet['health_info'])); ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php else : ?>
    <div class="alert alert-warning">
      Pet not found. Please return to the pets page and choose a valid pet.
    </div>

    <a href="pets.php" class="btn btn-primary">Back to Pets</a>
  <?php endif; ?>
</main>

<?php require_once 'includes/footer.inc'; ?>