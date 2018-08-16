<?php

$query = " SELECT * from posts ";
$result = mysqli_query($conn,$query);

$total_posts = mysqli_num_rows($result);
$total_pages = ceil($total_posts / $per_page  );

echo " <a  id='pagination_a' href='home.php?page=1'> First Page </a>";
for ($i=1; $i<=$total_pages;$i++) {
    echo "<a id='pagination_a' href='home.php?page=$i'> $i </a>";
}
echo " <a id='pagination_a' href='home.php?page=$total_pages'> Last Page </a>";

?>