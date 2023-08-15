<?php
    session_start();
    include_once "config.php";
    $productname = mysqli_real_escape_string($conn, $_POST['productname']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    if(isset($_FILES['image'])){
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
                    
        $img_explode = explode('.',$img_name);
        $img_ext = end($img_explode);
    
        $extensions = ["jpeg", "png", "jpg"];
        if(in_array($img_ext, $extensions) === true){
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if(in_array($img_type, $types) === true){
                $time = time();
                $new_img_name = $time.$img_name;
                if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                    $ran_id = rand(time(), 100000000);
                    $insert_query = mysqli_query($conn, "INSERT INTO products (product_id, product_name, img, details) VALUES ({$ran_id}, '{$productname}', '{$new_img_name}', '{$details}')");
                    if($insert_query){
                        $select_sql2 = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '{$ran_id}'");
                        if(mysqli_num_rows($select_sql2) > 0){
                        $result = mysqli_fetch_assoc($select_sql2);
                        // $_SESSION['unique_id'] = $result['unique_id'];
                        echo "success";
                        }else{
                            echo "Ad couldn't be uploaded!";
                            }
                        }else{
                        echo "Something went wrong. Please try again!";
                        }
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
    }else{
        echo "All input fields are required!";
    }
?>