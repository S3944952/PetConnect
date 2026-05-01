document.addEventListener('DOMContentLoaded', function () {
    var filterButtons = document.querySelectorAll('.filter-btn');
    var galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var selectedStatus = button.getAttribute('data-status');

            galleryItems.forEach(function (item) {
                var petStatus = item.getAttribute('data-status');

                if (selectedStatus === 'all' || petStatus === selectedStatus) {
                    item.classList.remove('d-none');
                } else {
                    item.classList.add('d-none');
                }
            });
        });
    });

    var galleryImages = document.querySelectorAll('.gallery-img');

    galleryImages.forEach(function (image) {
        image.addEventListener('click', function () {
            var petName = image.getAttribute('data-pet-name');
            var petLink = image.getAttribute('data-pet-link');

            document.getElementById('modalImg').src = image.src;
            document.getElementById('modalImg').alt = petName;
            document.getElementById('modalPetName').textContent = petName;
            document.getElementById('modalLink').href = petLink;

            var modal = new bootstrap.Modal(document.getElementById('petModal'));
            modal.show();
        });
    });

    var imageInput = document.getElementById('imageInput');

    if (imageInput) {
        imageInput.addEventListener('change', function () {
            var allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            var file = imageInput.files[0];
            var preview = document.getElementById('imagePreview');

            if (!file) {
                preview.innerHTML = '';
                return;
            }

            var extension = file.name.split('.').pop().toLowerCase();

            if (allowed.indexOf(extension) === -1) {
                alert('Invalid file type. Please upload jpg, jpeg, png, gif or webp.');
                imageInput.value = '';
                preview.innerHTML = '';
                return;
            }

            var reader = new FileReader();

            reader.onload = function (event) {
                preview.innerHTML = '<img src="' + event.target.result + '" alt="Selected pet image preview">';
            };

            reader.readAsDataURL(file);
        });
    }
});