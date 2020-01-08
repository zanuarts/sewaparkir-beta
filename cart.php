<!DOCTYPE html>
<head>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>
    <?php 
    // Start the session
    session_start();
    require 'config.php';
    require 'item.php';

    if(isset($_GET['id']) && !isset($_POST['update']))  { 
        $sql = "SELECT * FROM tempatparkir WHERE id=".$_GET['id'];
        $result = mysqli_query($mysqli, $sql);
        $product = mysqli_fetch_object($result); 
        $item = new Item();
        $item->id = $product->id;
        $item->nama = $product->nama;
        $item->harga = $product->harga;
        $iteminstock = $product->quantity;
        $item->quantity = 1;
        // Check product is existing in cart
        $index = -1;
        $cart = unserialize(serialize($_SESSION['cart'])); // set $cart as an array, unserialize() converts a string into array
        for($i=0; $i<count($cart);$i++)
            if ($cart[$i]->id == $_GET['id']){
                $index = $i;
                break;
            }
            if($index == -1) 
                $_SESSION['cart'][] = $item; // $_SESSION['cart']: set $cart as session variable
            else {
                
                if (($cart[$index]->quantity) < $iteminstock)
                    $cart[$index]->quantity ++;
                    $_SESSION['cart'] = $cart;
            }
    }
    // Delete product in cart
    if(isset($_GET['index']) && !isset($_POST['update'])) {
        $cart = unserialize(serialize($_SESSION['cart']));
        unset($cart[$_GET['index']]);
        $cart = array_values($cart);
        $_SESSION['cart'] = $cart;
    }
    // Update quantity in cart
    if(isset($_POST['update'])) {
    $arrQuantity = $_POST['quantity'];
    $cart = unserialize(serialize($_SESSION['cart']));
    for($i=0; $i<count($cart);$i++) {
        $cart[$i]->quantity = $arrQuantity[$i];
    }
    $_SESSION['cart'] = $cart;
    }
    ?>
    <div class="container">
        <h2> Items in your cart: </h2> 
        <!-- <form class="form-control" method="POST"> -->
        <table class="table" id="t01" method="POST">
        <tr>
            <th>Option</th>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            
            <th>Total</th>
        </tr>
        <?php 
            $cart = unserialize(serialize($_SESSION['cart']));
            $s = 0;
            $index = 0;
            for($i=0; $i<count($cart); $i++){
                $s += $cart[$i]->harga * $cart[$i]->quantity;
        ?>	
        <tr>
                <td><a href="cart.php?index=<?php echo $index; ?>" onclick="return confirm('Are you sure?')" >Delete</a> </td>
                <td> <?php echo $cart[$i]->id; ?> </td>
                <td> <?php echo $cart[$i]->nama; ?> </td>
                <td>Rp. <?php echo $cart[$i]->harga; ?> </td>
                <td> <input type="number" min="1" value="<?php echo $cart[$i]->quantity; ?>" name="quantity[]"> </td>  
                <td> Rp.<?php echo $cart[$i]->harga * $cart[$i]->quantity; ?> </td> 
        </tr>
            <?php 
                $index++;
            } ?>
            <tr>
                <td colspan="5" style="text-align:right; font-weight:bold">Sum 
                <input id="saveimg" type="image" src="images/save.png" name="update" alt="Save Button">
                <input type="hidden" name="update">
                </td>
                <td> Rp.<?php echo $s; ?> </td>
            </tr>
        </table>
        <!-- </form> -->
        
        <a href="index.php">Continue Shopping</a> | <a href="checkout.php">Checkout</a>
        <?php 
        if(isset($_GET["id"]) || isset($_GET["index"])){
        header('Location: cart.php');
        } 
        ?>
    
    </div>

    
</body>
</html>
