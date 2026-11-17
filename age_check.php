<?php
$message = "";
$is_authorized = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $age = intval($_POST['age'] ?? 0);

    if ($age < 18) {
        $is_authorized = false;
        $message = "Hello " . $name . ", you are not authorized to visit the site";
    } else {
        $is_authorized = true;
        $message = "Welcome " . $name . " to this site";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Age Verification</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 60px; }
        .container { max-width: 400px; margin: auto; padding: 25px; border: 1px solid #ccc; border-radius: 8px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 94%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 18px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .result { text-align: center; padding: 20px; border-radius: 6px; }
        .denied { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .allowed { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        a { display: inline-block; margin-top: 15px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($is_authorized === null): ?>
            <h2>User Verification</h2>
            <form method="POST" action="">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" min="1" max="120" placeholder="Enter your age" required>

                <button type="submit">Submit</button>
            </form>
        <?php else: ?>
            <div class="result <?php echo $is_authorized ? 'allowed' : 'denied'; ?>">
                <h3><?php echo $message; ?></h3>
            </div>
            <div style="text-align: center;">
                <a href="age_check.php">Go Back</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
