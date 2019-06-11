<?php 
$pageTitile = "Personal Media Library"; // in order for this variable to be obeyed in below include, we need to define it BEFORE include
$section = null;
include("inc/header.php"); 
include("inc/functions.php");
include("inc/data.php");
?>

		<div class="section catalog random">

			<div class="wrapper">

				<h2>May we suggest something?</h2>

				<ul class="items">
				<?php 
				$random = array_rand($catalog, 4);
				?>
				<?php foreach($random as $id){
                	echo get_item_html($id, $catalog[$id]);
            	}?>
							
				</ul>

			</div>

		</div>

	</div><!-- end content -->

	<?php include("inc/footer.php"); ?>