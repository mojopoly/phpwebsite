<?php 
include("inc/data.php");
include("inc/functions.php");

if(isset($_GET["id"])) { 
    $id = $_GET(["id"]);
    if (isset($catalog[$id])) {
        $item = $catalog[$id];
    }
}
if(!isset($item)) {//if item id doesnt exist in the conditional above, we will redirect using header function below
    header("location:catalog.php");
    exit;//this makes sure nothing else is proccesses while the redirect is hapenning
}
//we moved below 2 variables to make sure redirect isn't interrupted    
$pageTitle = $item["title"];
$section = null; //we define it here so we can dynamically add it to each page to be underlined

include("inc/header.php"); ?>

<div class="section page">
    <div class="wrapper">
        <div class= "media-picture">
            <span><img src="<?php echo $item["img"];?>" alt="<?php echo $item["title"]; ?>"/></span>
        </div>
    </div>
</div>


