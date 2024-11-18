document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');

    tooltipTriggerList.forEach(function(tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const swiper = new Swiper('#brand-category-carousel', {
        loop: true, 
        slidesPerView: 'auto',
        autoplay: {
            delay: 3000, 
            disableOnInteraction: false, 
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});
// Registration product
// document.getElementById('imageUpload').addEventListener('change', function(event) {
//     const previewContainer = document.getElementById('imagePreview');
//     previewContainer.innerHTML = '';
//     Array.from(event.target.files).forEach(file => {
//         const img = document.createElement('img');
//         img.src = URL.createObjectURL(file);
//         img.classList.add('preview-item');
//         img.style.width = '100px'; // Set width for preview
//         img.style.height = 'auto';
//         previewContainer.appendChild(img);
//     });
// });

// document.getElementById('videoUpload').addEventListener('change', function(event) {
//     const previewContainer = document.getElementById('videoPreview');
//     previewContainer.innerHTML = '';
//     const file = event.target.files[0];
//     if (file) {
//         const video = document.createElement('video');
//         video.src = URL.createObjectURL(file);
//         video.controls = true;
//         video.classList.add('preview-item');
//         video.style.width = '200px'; // Set width for preview
//         previewContainer.appendChild(video);
//     }
// });

// Display form by category
// document.addEventListener('DOMContentLoaded', function() {
//     document.getElementById('category').addEventListener('change', function() {
//         var electronicsFields = document.getElementById('electronicsFields');
//         var bookFields = document.getElementById('bookFields');
        
//         if (this.value === 'do-dien-tu') {
//             electronicsFields.style.display = 'block';
//             bookFields.style.display = 'none';
//         } else if (this.value === 'sach') {
//             electronicsFields.style.display = 'none';
//             bookFields.style.display = 'block';
//         } else {
//             electronicsFields.style.display = 'none';
//             bookFields.style.display = 'none';
//         }
//     });
// });
// // page puchaseOrder, set tab

// // Page Setting
// document.getElementById('imageUpload').addEventListener('change', function(event) {
//     const previewContainer = document.getElementById('imagePreview');
//     previewContainer.innerHTML = ''; // Xóa hình ảnh cũ
//     Array.from(event.target.files).forEach(file => {
//         const img = document.createElement('img');
//         img.src = URL.createObjectURL(file); // Tạo URL cho hình ảnh
//         img.classList.add('preview-item'); // Thêm lớp cho hình ảnh
//         img.style.width = '100px'; // Đặt chiều rộng cho hình ảnh
//         img.style.height = 'auto'; // Giữ tỷ lệ cho hình ảnh
//         img.style.marginRight = '10px'; // Khoảng cách giữa các hình ảnh
//         previewContainer.appendChild(img); // Thêm hình ảnh vào container
//     });
// });