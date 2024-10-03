<?php
// Include the controller that retrieves the brands
include_once '../controllers/brand_controller.php';

// Get all the brands
$brands = viewBrandsController();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Brands</title>
    <link rel="stylesheet" href="../css/view-brands-style.css"> <!-- Link to external CSS file -->
</head>

<body>

    <div class="container">
        <h1>Brands</h1>
        <table class="brand-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($brands)) : ?>
                    <?php foreach ($brands as $brand) : ?>
                        <tr>
                            <td><?php echo $brand['brand_id']; ?></td>
                            <td><?php echo $brand['brand_name']; ?></td>
                            <td>
                                <form action="../actions/delete_brand_action.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                    <input type="hidden" name="brand_id" value="<?php echo $brand['brand_id']; ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">No brands available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>