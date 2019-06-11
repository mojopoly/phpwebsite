<?php 
include("inc/data.php");
include("inc/functions.php");
$pageTitle = "Full Catalog";
$section = null; //we define it here so we can dynamically add it to each page to be underlined

if(isset($_GET["cat"])) { //add thie line to make sure when no cat slug is added to URL, no "notice" error is shown
    if($_GET["cat"] == "books") {
        $pageTitle = "Books";
        $section = "books";
    } else if($_GET["cat"] == "movies") {
        $pageTitle = "Movies";
        $section = "movies";
    } else if($_GET["cat"] == "music") {
        $pageTitle = "Music";
        $section = "music";
    }
}
include("inc/header.php"); ?>

<div class= "section catalog page">
    <div class="wrapper">
        <h1><?php 
        if($section != null){
          echo "<a href='catalog.php'>Full Catalog</a> &gt; "; 
        } echo $pageTitle ?></h1>
        <ul class="items">
        <?php 
            $categories = array_category($catalog, $section); //this function to sort by section
            ?>
            <?php foreach($categories as $id){
                echo get_item_html($id, $catalog[$id]);
            }?>
        </ul>
    </div>
</div>

<?php include("inc/footer.php"); ?>
