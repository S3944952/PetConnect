<?php
$pageTitle = 'All Pets | PetConnect';
require_once 'includes/db_connect.inc';
require_once 'includes/header.inc';
require_once 'includes/nav.inc';

$sql = "SELECT pet_id, name, species, breed, age_years, age_months, status, adoption_fee
        FROM pets
        ORDER BY name ASC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<main class="container my-4">
  <h1 class="mb-4">Browse Pets</h1>

  <div class="row g-4">
    <div class="col-12 col-md-4">
      <img src="assets/images/pets-banner.jpg" class="img-fluid rounded shadow" alt="Group of pets">
    </div>

    <div class="col-12 col-md-8">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Name</th>
              <th>Species</th>
              <th>Breed</th>
              <th>Age</th>
              <th>Status</th>
              <th>Fee</th>
            </tr>
          </thead>

          <tbody>
            <?php while ($pet = $result->fetch_assoc()) : ?>
              <tr>
                <td>
                  <a href="details.php?id=<?php echo urlencode($pet['pet_id']); ?>">
                    <?php echo htmlspecialchars($pet['name']); ?>
                  </a>
                </td>
                <td><?php echo htmlspecialchars($pet['species']); ?></td>
                <td><?php echo htmlspecialchars($pet['breed']); ?></td>
                <td><?php echo (int) $pet['age_years']; ?>y <?php echo (int) $pet['age_months']; ?>m</td>
                <td><?php echo htmlspecialchars($pet['status']); ?></td>
                <td>$<?php echo number_format($pet['adoption_fee'], 2); ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<?php
$stmt->close();
require_once 'includes/footer.inc';
?>