const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Create a MySQL connection pool
const pool = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: '123@tabish',
    database: 'tabish',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// Use body-parser middleware to parse JSON requests
app.use(bodyParser.json());

// Define a route to handle signup requests
app.post('/signup', (req, res) => {
    const { firstName, lastName, email, password, phoneNumber, age, gender } = req.body;

    // Perform database insertion
    pool.query(
        'INSERT INTO users (first_name, last_name, email, password, phone_number, age, gender) VALUES (?, ?, ?, ?, ?, ?, ?)',
        [firstName, lastName, email, password, phoneNumber, age, gender],
        (error, results) => {
            if (error) {
                console.error(error);
                res.status(500).json({ error: 'Internal Server Error' });
            } else {
                res.json({ success: true, message: 'User signed up successfully' });
            }
        }
    );
});

// Start the server
app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
