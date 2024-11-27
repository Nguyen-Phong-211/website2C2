<script>
    function toggleFields() {
        var subcategory = document.getElementById('subcategory').value;
        var productFields = document.getElementById('productFields');
        if (subcategory) {
            productFields.style.display = 'block';
        } else {
            productFields.style.display = 'none';
        }
    }

    const images = document.querySelectorAll(".banner-image");

    let index = 0;

    function slideImages() {
        index++;

        if (index >= images.length) {
            index = 0;
        }

        images.forEach((img, i) => {
            img.style.transform = `translateX(-${index * 100}%)`;
        });
    }

    setInterval(slideImages, 3000);
</script>