<?php session_start(); ?>

fetch('../html/header.html')    // Load the header dynamically
    .then(response => response.text())
    .then(data => {
        document.getElementById('header-placeholder').innerHTML = data;

        const greeting = document.getElementById("greeting");
        const session_name = <?php echo json_encode($_SESSION['user_name'] ?? null); ?>;
        const name = session_name != null ? session_name : "אורח";
        greeting.textContent = `שלום ${name}`;

        const session_id = <?php echo json_encode($_SESSION['user_id'] ?? null); ?>;
        if (session_id != null && session_id == 0) {
            fetch('../html/navAdmin.html')
                .then(response2 => response2.text())
                .then(data2 => {
                    document.getElementById('header-placeholder').innerHTML += data2;
            });
        }

        if (session_name != null) {
            const login = document.getElementById("login");
            login.href = '../php/logout.php';
            login.title = 'התנתק';
        }
    });
