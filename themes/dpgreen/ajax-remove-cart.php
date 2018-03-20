<?php 
session_start();
if($_POST["action"] == "remove"){  
              foreach($_SESSION["shopping_cart"] as $keys => $values)  
              {  
                if($values["product_id"] == $_POST["product_id"])  
                {  
                  unset($_SESSION["shopping_cart"][$keys]);  
                  $message = '<label class="text-success">Product Removed</label>';  
                }  
              }  
            }  
?>