<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Brands</title>
    <link rel="stylesheet" href="../css/brand-style.css"> <!-- Link to external CSS file -->
</head>

<body>

    <div class="container">
        <h1>Manage Brands</h1>

        <!-- Add Brand Section -->
        <div class="form-section">
            <h2>Add Brand</h2>
            <form action="../actions/add_brand_action.php" method="POST">
                <input type="text" name="brand" id="brand" placeholder="Enter brand name" class="input-field">
                <button type="submit" class="submit-btn">Add brand</button>
            </form>
        </div>

        <!-- Delete Brand Section -->
        <div class="container">
            <h2>Delete Brand</h2>
            <form action="../actions/delete_brand_action.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this brand?');">
                <select name="brand_id" id="brand_id" class="input-field">
                    <?php if (!empty($brands)) : ?>
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="">No brands available</option>
                    <?php endif; ?>
                </select>
                <button type="submit" class="delete-btn">Delete brand</button>
            </form>
        </div>

    </div>

</body>

</html>