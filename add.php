<?php
$pageTitle = 'Add a Pet | PetConnect';
require_once 'includes/header.inc';
require_once 'includes/nav.inc';
?>

<main class="container my-4">
  <h1 class="mb-4">Add a New Pet</h1>

  <form action="process_add.php" method="post" enctype="multipart/form-data" id="addPetForm">
    <div class="mb-3">
      <label for="name" class="form-label fw-bold">Pet Name *</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="species" class="form-label fw-bold">Species *</label>
      <select name="species" id="species" class="form-select" required>
        <option value="">Choose a species</option>
        <option value="Dog">Dog</option>
        <option value="Cat">Cat</option>
        <option value="Bird">Bird</option>
        <option value="Rabbit">Rabbit</option>
        <option value="Other">Other</option>
      </select>
    </div>

    <div class="row">
      <div class="col-12 col-md-4 mb-3">
        <label for="breed" class="form-label fw-bold">Breed</label>
        <input type="text" name="breed" id="breed" class="form-control">
      </div>

      <div class="col-12 col-md-4 mb-3">
        <label for="age_years" class="form-label fw-bold">Age Years</label>
        <input type="number" name="age_years" id="age_years" class="form-control" min="0" value="0">
      </div>

      <div class="col-12 col-md-4 mb-3">
        <label for="age_months" class="form-label fw-bold">Age Months</label>
        <input type="number" name="age_months" id="age_months" class="form-control" min="0" max="11" value="0">
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-md-4 mb-3">
        <label for="gender" class="form-label fw-bold">Gender</label>
        <select name="gender" id="gender" class="form-select">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Unknown">Unknown</option>
        </select>
      </div>

      <div class="col-12 col-md-4 mb-3">
        <label for="size" class="form-label fw-bold">Size</label>
        <select name="size" id="size" class="form-select">
          <option value="Small">Small</option>
          <option value="Medium">Medium</option>
          <option value="Large">Large</option>
          <option value="Extra Large">Extra Large</option>
        </select>
      </div>

      <div class="col-12 col-md-4 mb-3">
        <label for="status" class="form-label fw-bold">Status</label>
        <select name="status" id="status" class="form-select">
          <option value="Available">Available</option>
          <option value="Pending">Pending</option>
          <option value="Adopted">Adopted</option>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label fw-bold">Description *</label>
      <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="health_info" class="form-label fw-bold">Health Information</label>
      <textarea name="health_info" id="health_info" class="form-control" rows="2"></textarea>
    </div>

    <div class="mb-3">
      <label for="adoption_fee" class="form-label fw-bold">Adoption Fee ($)</label>
      <input type="number" name="adoption_fee" id="adoption_fee" class="form-control" min="0" step="0.01" value="0">
    </div>

    <div class="mb-3">
      <label for="imageInput" class="form-label fw-bold">Pet Photo *</label>
      <input type="file" name="image" id="imageInput" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp" required>
      <div id="imagePreview"></div>
    </div>

    <button type="submit" class="btn btn-primary btn-lg">
      <span class="material-icons align-middle">add_circle</span>
      Add Pet
    </button>
  </form>
</main>

<?php require_once 'includes/footer.inc'; ?>