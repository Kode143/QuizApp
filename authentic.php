<?php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['access_token'])) {
  // Rest of your authenticate.php code
  // ... (fetching, validating, and redirecting based on access token)
  // Retrieve the access token from the query string
$accessToken = $_GET['access_token'];

// Initialize cURL session
$ch = curl_init('https://graph.facebook.com/v13.0/me?fields=id,email&access_token=' . $accessToken);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session and get response
$response = curl_exec($ch);

// Close cURL session
curl_close($ch);

// Parse the JSON response
$data = json_decode($response, true);

// Check if the response contains user data
if (isset($data['id']) && isset($data['email'])) {
  // User data is valid, proceed with user authentication
  // Implement your own user authentication logic here

  // For example, you could create a session for the authenticated user
  session_start();
  $_SESSION['user_id'] = $data['id'];
  $_SESSION['user_email'] = $data['email'];

  // Redirect the user to the quiz page or dashboard
  header('Location: quiz.html');
  exit;
} else {
  // Invalid access token or user data, redirect back to login page
  header('Location: login.html');
  exit;
}
?>

}
?>

