<?php include 'config.php';  //include config
// set dynamic title
$db = new Database();
$db->select('options','site_title',null,null,null,null);
$result = $db->getResult();

if(!empty($result)){ 
    $title = $result[0]['site_title']; 
}else{ 
    $title = "Payment failed";
}
// include header 
include 'header.php'; ?>
<div class="product-section popular-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head">Payment failed. Try again?</h2>
                <div class="popular-carousel owl-carousel owl-theme">
                	<a class="btn btn-sm btn-success pull-right" href="cart.php">Take me back</a>
                </div>
            </div>
        </div>
    </div>
</div>