<?php
//   Establish database connection
$data = mysqli_connect('localhost', 'root', '', 'arduino');

// Check if the connection was successful
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initial query to fetch all distinct categories
$getCategories = "SELECT DISTINCT category FROM product";
$categoriesResult = mysqli_query($data, $getCategories);

// Check if the initial query for categories was successful
if (!$categoriesResult) {
    die("Query failed: " . mysqli_error($data));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  
    <div class="container-product">
        <div class="bar">
            <form method="GET" action="tree.php">
                <?php
                // Add a button for all categories
                ?>
                <button type="submit" name="category" value="all">All</button>
                <?php

                // Create buttons dynamically for each category
                while ($categoryRow = mysqli_fetch_assoc($categoriesResult)) {
                    $category = $categoryRow['category'];
                    ?>
                    <button type="submit" name="category" value="<?= $category ?>"><?= $category ?></button>
                    <?php
                }
                ?>
            </form>
        </div>

        <div class="productse">
            <?php
            
            // Check if a specific category is selected
            if (isset($_GET['category'])) {
                // If a category is selected, filter the results based on the category
                $selectedCategory = mysqli_real_escape_string($data, $_GET['category']);

                if ($selectedCategory == 'all') {
                   
                    $get = "SELECT * FROM product";
                   



                }
                 else {
                    // Display products based on the selected category
                    $get = "SELECT * FROM product WHERE category LIKE '%$selectedCategory%'";
                }

                $ballFiltered = mysqli_query($data, $get);

                // Check if the filtered query was successful
                if (!$ballFiltered) {
                    die("Query failed: " . mysqli_error($data));
                }

                // Display products based on the selected category or all categories
                while ($fechFiltered = mysqli_fetch_assoc($ballFiltered)) {
                    ?>
                    <div style = "height:200px;
                      width: 30%;
                      background-image: url('<?= $fechFiltered['img'] ?>');
                      background-position: center;
                      background-repeat: no-repeat;
                      background-size: cover;
                      ">
                       
                        <h1><?= $fechFiltered['name'] ?></h1>
                        <p><?= $fechFiltered['price'] ?></p>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <style>
     .container-product{
    height:100vh;
    width: 100%;
    display: flex;
    flex-direction: row;


}
.bar{
    height: 100%;
    width: 30%;
    background-color: aqua;
    display: flex;
    flex-direction:column;
    align-items: center;
}
button{
    height: 30px;
    width: 95%;
    font-size: 20px;
    margin-top: 20px;
}
.productse{
  height:100vh;
  width: 100%;
  background-color: blue;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  

}

    </style>
</body>
</html>
