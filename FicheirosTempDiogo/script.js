document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("modal");
    const confirmBtn = document.getElementById("confirm-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    let deleteTarget = null;

    window.confirmDelete = function(button) {
        deleteTarget = button.closest("tr");
        modal.style.display = "flex";
    };

    confirmBtn.addEventListener("click", function() {
        if (deleteTarget) {
            deleteTarget.remove();
            deleteTarget = null;
        }
        modal.style.display = "none";
    });

    cancelBtn.addEventListener("click", function() {
        modal.style.display = "none";
        deleteTarget = null;
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    function setActiveLink() {
        const links = document.querySelectorAll('nav ul li a');
        links.forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    setActiveLink();
});