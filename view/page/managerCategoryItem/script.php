<script>
document.addEventListener('DOMContentLoaded', function() {
  
    const editButtons = document.querySelectorAll('.edit-button');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryItemId = this.getAttribute('data-id');
            const categoryItemName = this.getAttribute('data-name');
            const categoryItemImage = this.getAttribute('data-image');
            // Cập nhật thông tin vào modal
            document.getElementById('categoryItemId').value = categoryItemId;
            document.getElementById('categoryItemName').value = categoryItemName;
            document.getElementById('currentImage').src = categoryItemImage ? 'asset/image/category_item/' +  categoryItemImage : '';

            // Hiển thị modal
            $('#editCategoryItemModal').modal('show');
           
        });
    });
});
</script>