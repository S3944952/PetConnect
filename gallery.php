<?php
$pageTitle = 'Gallery | PetConnect';
require_once 'includes/db_connect.inc';
require_once 'includes/header.inc';
require_once 'includes/nav.inc';

$sql = "SELECT pet_id, name, image_path, status
        FROM pets
        ORDER BY name ASC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<main class="container my-4">
  <h1 class="mb-3">Pet Gallery</h1>

  <div class="mb-4">
    <button type="button" class="btn btn-primary me-2 mb-2 filter-btn" data-status="all">All</button>
    <button type="button" class="btn btn-success me-2 mb-2 filter-btn" data-status="Available">Available</button>
    <button type="button" class="btn btn-warning me-2 mb-2 filter-btn" data-status="Pending">Pending</button>
    <button type="button" class="btn btn-secondary mb-2 filter-btn" data-status="Adopted">Adopted</button>
  </div>

  <div class="row g-3" id="galleryGrid">
    <?php while ($pet = $result->fetch_assoc()) : ?>
      <div class="col-6 col-md-4 col-lg-3 gallery-item" data-status="<?php echo htmlspecialchars($pet['status']); ?>">
        <img src="assets/images/pets/<?php echo htmlspecialchars($pet['image_path']); ?>"
             class="img-fluid gallery-img"
             alt="<?php echo htmlspecialchars($pet['name']); ?>"
             data-pet-name="<?php echo htmlspecialchars($pet['name']); ?>"
             data-pet-link="details.php?id=<?php echo urlencode($pet['pet_id']); ?>">

        <p class="text-center mt-2 mb-0">
          <a href="details.php?id=<?php echo urlencode($pet['pet_id']); ?>">
            <?php echo htmlspecialchars($pet['name']); ?>
          </a>
        </p>
      </div>
    <?php endwhile; ?>
  </div>
</main>

<div class="modal fade" id="petModal" tabindex="-1" aria-labelledby="modalPetName" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title h5" id="modalPetName"></h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <img src="" id="modalImg" class="img-fluid" alt="">
      </div>

      <div class="modal-footer">
        <a href="#" id="modalLink" class="btn btn-primary">View Full Details</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
$stmt->close();
require_once 'includes/footer.inc';
?>