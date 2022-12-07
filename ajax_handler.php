
<?php
require_once "./functions/getters.php";

# HANDLE SEARCH PRODUCT IF PRODUCT SEARCH QUERY IS SET 
if(isset($_GET["product_sq"])){

    # TURN SEARCH QUERY TO LOWER CASE FOR BETTER MATCH
    $search_q = strtolower($_GET["product_sq"]); 

    if($search_q !== ""){
        # GET ALL THE PRODUCTS
        $products = getProductsByNameKey($search_q);

        if($products->num_rows > 0){
            header("Content-type: text/json");

            # DEFINE AN ARRAY
            $suggestion = array(); 

            while($product = $products->fetch_assoc()){
                # ADD IMPORTANT INFO OF A PRODUCT TO THE SUGGESTIONS ARRAY
                $suggestion[] = array(
                    "product_id" => $product["product_id"],
                    "image" => $product["image"],
                    "name" => $product["name"]
                );
            }

            # SEND A JSON ENCODED
            echo json_encode($suggestion);
        }else{
            echo "No Suggestions";
        }
    }else{
        echo "No Suggestions";
    }
}


