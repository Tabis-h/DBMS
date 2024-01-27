// admin-login-script.js

function loginAdmin(event) {
    event.preventDefault();
    
    // Basic client-side authentication (replace with server-side logic in a real application)
    var username = document.getElementById('admin').value;
    var password = document.getElementById('admin@123').value;

    // Example: Check if the username and password are valid
    if (username === 'admin' && password === 'password') {
        alert('Admin login successful. Redirecting to Admin Page.');
        // Perform actual redirection to admin page or other admin-related actions
    } else {
        alert('Invalid username or password. Please try again.');
    }
}
