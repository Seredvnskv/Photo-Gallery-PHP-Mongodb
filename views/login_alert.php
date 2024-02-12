<?php if (isset($_SESSION['login_success'])): ?>
<script>
    window.onload = function() {
        var alert = document.createElement("div");
        alert.textContent = "Login successful!";
        alert.style.position = "fixed";
        alert.style.top = "20%";
        alert.style.left = "50%";
        alert.style.transform = "translateX(-50%)";
        alert.style.backgroundColor = "lightgreen";
        alert.style.padding = "10px 20px";
        alert.style.borderRadius = "5px";
        alert.style.boxShadow = "0 2px 4px rgba(0, 0, 0, 0.3)";
        document.body.appendChild(alert);

        setTimeout(function() {
            alert.style.display = "none";
        }, 1000);
    }
</script>
<?php 
    unset($_SESSION['login_success']);
endif; 
?>