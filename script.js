document.getElementById('LoginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form submit

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Logika untuk memeriksa akun terdaftar
    fetch('check_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.exists) {
            showNotification('Akun belum terdaftar.');
        } else {
            document.getElementById('notification').textContent = '';
            // Submit form jika terdaftar
            document.getElementById('LoginForm').submit(); 
        }
    })
    .catch(error => console.error('Error:', error));
});

// Fungsi untuk menampilkan notifikasi
function showNotification(message) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.display = 'block'; // Tampilkan notifikasi

    // Menghilangkan notifikasi setelah 5 detik
    setTimeout(() => {
        notification.style.display = 'none';
    }, 5000);
}