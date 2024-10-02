<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Brand</title>
</head>

<body>
    <h2>Add Brand</h2>
    <form action="../actions/add_brand_action.php" method="POST">
        <label for="brand_name">Brand Name:</label>
        <input type="text" name="brand_name" required><br><br>
        <input type="submit" value="Add Brand">
    </form>
</body>

</html>