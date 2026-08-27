<?php

$errors = [];
$success = "";

$first_name = "";
$middle_name = "";
$last_name = "";
$age = "";
$gender = "";
$email = "";
$address = "";
$contact_number = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first_name = trim($_POST["first_name"]);
    $middle_name = trim($_POST["middle_name"]);
    $last_name = trim($_POST["last_name"]);
    $age = trim($_POST["age"]);
    $gender = $_POST["gender"] ?? "";
    $email = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $contact_number = trim($_POST["contact_number"]);

    // Validation
    if (empty($first_name)) {
        $errors[] = "First Name is required.";
    }

    if (empty($last_name)) {
        $errors[] = "Last Name is required.";
    }

    if (!filter_var($age, FILTER_VALIDATE_INT) || $age < 1 || $age > 120) {
        $errors[] = "Please enter a valid age.";
    }

    if (empty($gender)) {
        $errors[] = "Please select a gender.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email.";
    }

    if (empty($address)) {
        $errors[] = "Address is required.";
    }

    if (!preg_match("/^[0-9+\-\s]{7,20}$/", $contact_number)) {
        $errors[] = "Please enter a valid contact number.";
    }

    if (empty($errors)) {
        $success = "Registration successful!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Output #1</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>PHP Output #1</h1>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <div>• <?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>First Name</label>
        <input
            type="text"
            name="first_name"
            value="<?= htmlspecialchars($first_name) ?>"
            required
        >

        <label>Middle Name</label>
        <input
            type="text"
            name="middle_name"
            value="<?= htmlspecialchars($middle_name) ?>"
        >

        <label>Last Name</label>
        <input
            type="text"
            name="last_name"
            value="<?= htmlspecialchars($last_name) ?>"
            required
        >

        <label>Age</label>
        <input
            type="number"
            name="age"
            min="1"
            max="120"
            value="<?= htmlspecialchars($age) ?>"
            required
        >

        <label>Gender</label>
        <select name="gender" required>
            <option value="">-- Select Gender --</option>
            <option value="Male" <?= $gender === "Male" ? "selected" : "" ?>>
                Male
            </option>
            <option value="Female" <?= $gender === "Female" ? "selected" : "" ?>>
                Female
            </option>
            <option value="Other" <?= $gender === "Other" ? "selected" : "" ?>>
                Other
            </option>
        </select>

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="<?= htmlspecialchars($email) ?>"
            required
        >

        <label>Address</label>
        <textarea
            name="address"
            rows="3"
            required
        ><?= htmlspecialchars($address) ?></textarea>

        <label>Contact Number</label>
        <input
            type="tel"
            name="contact_number"
            value="<?= htmlspecialchars($contact_number) ?>"
            required
        >

        <button type="submit">
            Submit
        </button>

    </form>

</div>

</body>
</html>