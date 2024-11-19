<script>
    window.addEventListener("scroll", function() {
        const backToTop = document.getElementById("backToTop");
        if (window.scrollY > 200) {
            backToTop.classList.add("show");
        } else {
            backToTop.classList.remove("show");
        }
    });

    document.getElementById("backToTop").addEventListener("click", function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
</script>