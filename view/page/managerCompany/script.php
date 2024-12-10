<script>
document.addEventListener('DOMContentLoaded', function() {
  
    const editButtons = document.querySelectorAll('.edit-button');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const companyId = this.getAttribute('data-id');
            const companyName = this.getAttribute('data-name');
            // Cập nhật thông tin vào modal
            document.getElementById('companyId').value = companyId;
            document.getElementById('companyName').value = companyName;

            // Hiển thị modal
            $('#editCompanyModal').modal('show');
           
        });
    });
});
</script>