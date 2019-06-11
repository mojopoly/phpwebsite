<?php
function get_item_html($id, $item) {
    $output = "<li><a href='#'><img src='" 
    . $item["img"] . "' alt='" . $item["title"] 
    . "' />" 
    . "<p>View Details</p>" . "</a></li>"; 
    return $output;
}
function array_category($catalog, $category) {
    $output = array();
    foreach($catalog as $id => $item) {
        if($category == null OR strtolower($category) == strtolower($item["category"])) {
            $sort = $item["title"]; //sort be title
            $sort = ltrim($sort, "The ");
            $sort = ltrim($sort, "A ");
            $sort = ltrim($sort, "An ");
            $output[$id] = $sort;
        }
    }
    asort($output);
    //var_dump(array_keys($output));
    return array_keys($output);//return array KEYS since we will need to loop thru keys to find title, img, etc
}
?>