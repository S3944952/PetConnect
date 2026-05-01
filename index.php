<?php
$pageTitle = 'Home | PetConnect';
require_once 'includes/db_connect.inc';
require_once 'includes/header.inc';
require_once 'includes/nav.inc';

$sql = "SELECT pet_id, name, species, breed, image_path, adoption_fee, created_at
        FROM pets
        ORDER BY created_at DESC
        LIMIT 4";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<main>
  <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/images/banner1.jpg" class="d-block w-100 hero-img" alt="Happy pets">
        <div class="carousel-caption d-none d-md-block">
          <h1>Find Your Perfect Pet</h1>
          <p>Give a loving animal a forever home.</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/images/banner2.jpg" class="d-block w-100 hero-img" alt="Dog waiting for adoption">
      </div>

      <div class="carousel-item">
        <img src="assets/images/banner3.jpg" class="d-block w-100 hero-img" alt="Cat waiting for adoption">
      </div>

      <div class="carousel-item">
        <img src="assets/images/banner4.jpg" class="d-block w-100 hero-img" alt="Small pet waiting for adoption">
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous slide">
      <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next slide">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <section class="container my-5">
    <h2 class="mb-4">Latest Pets</h2>

    <div class="row g-4">
      <?php while ($pet = $result->fetch_assoc()) : ?>
        <div class="col-12 col-sm-6 col-lg-3">
          <article class="card h-100">
            <img src="assets/images/pets/<?php echo htmlspecialchars($pet['image_path']); ?>"
                 class="card-img-top"
                 alt="<?php echo htmlspecialchars($pet['name']); ?>">

            <div class="card-body">
              <h3 class="card-title h5"><?php echo htmlspecialchars($pet['name']); ?></h3>

              <p class="card-text text-muted">
                <?php echo htmlspecialchars($pet['species']); ?> &middot;
                <?php echo htmlspecialchars($pet['breed']); ?>
              </p>

              <p><strong>$<?php echo number_format($pet['adoption_fee'], 2); ?></strong></p>

              <a href="details.php?id=<?php echo urlencode($pet['pet_id']); ?>" class="btn btn-primary btn-sm">
                View Details
              </a>
            </div>
          </article>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php
$stmt->close();
require_once 'includes/footer.inc';
?>