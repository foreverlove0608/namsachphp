<?php
session_start();
if($_POST["action"] == "quantity_change") {  
              foreach($_SESSION["shopping_cart"] as $keys => $values)  
              {  
                if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                {  
                  $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["quantity"];  
                }  
              }  
            }
?>