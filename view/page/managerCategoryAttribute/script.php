<script>
document.addEventListener('DOMContentLoaded', function() {
  
    const editButtons = document.querySelectorAll('.edit-button');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryAttId = this.getAttribute('data-id');
            const categoryAttName = this.getAttribute('data-name');
            // Cập nhật thông tin vào modal
            document.getElementById('categoryAttId').value = categoryAttId;
            document.getElementById('categoryAttName').value = categoryAttName;

            // Hiển thị modal
            $('#editcategoryAttributeModal').modal('show');
           
        });
    });
});
</script>