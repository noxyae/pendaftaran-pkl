document.getElementById('LoginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form submit

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Logika untuk memeriksa akun terdaftar
    const registeredUsers = ['email1@example.com', 'email2@example.com']; // Contoh data user terdaftar

    if (!registeredUsers.includes(email)) {
        showNotification('Akun belum terdaftar.');
    } else {
        document.getElementById('notification').textContent = '';
        // Tambahkan logika untuk login di sini
        document.getElementById('LoginForm').submit(); // Submit form jika terdaftar
    }
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