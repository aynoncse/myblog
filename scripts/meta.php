<?php
                if (isset($_GET['pageid'])) {
                    $pid    = $_GET['pageid'];

                    $query  = "SELECT * FROM page WHERE id = '$pid'";
                    $pages  = $db->selectData($query);
                    if ($pages) {
                        $page = mysqli_fetch_array($pages);
                    }?>
                    <title><?php echo $page['name'].' | '.TITLE;?></title>
            <?php } else if (isset($_GET['id'])) {
                    $pid    = $_GET['id'];

                    $query  = "SELECT * FROM post WHERE id = '$pid'";
                    $posts  = $db->selectData($query);
                    if ($posts) {
                        $post = mysqli_fetch_array($posts);
                    ?>

                    <title><?php echo $post['title'].' | '.TITLE;?></title>
            <?php }}

            else{ ?>
                    <title><?php echo $fm->title().' | '.TITLE;?></title>
            <?php    }
            ?>
            
        <title><?php echo TITLE;?></title>
        <meta name="description" content="Computer Science & Technology">
	<?php
		if (isset($_GET['id'])){
			$keywordid 	= $_GET['id'];

            $query  = "SELECT * FROM post WHERE id = '$keywordid'";
            $keywords  = $db->selectData($query);
            if ($keywords) {
            	$keywords = mysqli_fetch_array($keywords);
    ?>
    	<meta name="keywords" content="<?php echo $keywords['tags'];?>">
    <?php
            }}
        	else {
    ?>
    	<meta name="keywords" content="<?php echo KEYWORDS;?>">
    <?php
        	}
	?>
		
		<meta name="author" content="Md Aynon">