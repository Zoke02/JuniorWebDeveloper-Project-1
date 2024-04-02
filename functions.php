<?php

$categories = array("Purchasing", "Gastronomy", "Graphic Design", "IT", "Pharma/Health", "Accounting" , "Sales");

function insert_categories($categories_row) {
    foreach ($categories_row as $index => $categorie) {
        echo '<div class="categories" >';
        echo "<a href='' class='categorie'>{$categorie}</a>";
        echo '</div>';
    }
}