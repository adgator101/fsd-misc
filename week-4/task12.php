<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JSON Reading Exercise</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; }
        h2 { color: #007bff; }
        .product { background: #fff; padding: 12px; margin-bottom: 12px; border-radius: 4px; border: 1px solid #ddd; }
        .product-name { font-weight: bold; color: #333; }
        .product-price { color: #28a745; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>JSON Reading Exercise (Do Not Write Anything)</h2>
    
    <?php
    $jsonFile = __DIR__ . '/products.json';
    
    if (file_exists($jsonFile)) {
        $jsonContent = file_get_contents($jsonFile);
        $products = json_decode($jsonContent, true);
        
        if ($products && is_array($products)) {
            echo "<h3>Products List:</h3>";
            foreach ($products as $product) {
    ?>
                <div class="product">
                    <div class="product-name">Product: <?php echo htmlspecialchars($product['name']); ?></div>
                    <div class="product-price">Price: Rs. <?php echo htmlspecialchars($product['price']); ?></div>
                </div>
    <?php
            }
        } else {
            echo "<div class='error'>Error decoding JSON!</div>";
        }
    } else {
        echo "<div class='error'>products.json file not found!</div>";
    }
    ?>
</body>
</html>
