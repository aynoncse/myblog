</div>
	<div class="footersection template clear">
		<div class="footermenu clear">
			<ul>
				<li><a href="index.php">Home</a></li>
				<?php
                    $query  = "SELECT * FROM page";
                    $pages  = $db->selectData($query);
                    if ($pages) {
                        $i=0;
                        while ($page = $pages->fetch_assoc()) {
                ?>
                <li><a href="page.php?pageid=<?php echo $page['id'];?>"><?php echo $page['name'];?></a></li>
                <?php } }?>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
<?php
	$query = "SELECT * FROM footer WHERE id = 1";
	$result = $db->selectData($query);
    if ($result){
        $foot = mysqli_fetch_array($result);
    }
?>
		<p>&copy;<?php echo $foot['note'].' '.date('Y').'.';?> All Right Reserved</p>
		<p><?php echo $foot['devtext'];?></p>
	</div>
</div>	
	<div class="fixedicon clear">
<?php
	$query = "SELECT * FROM social WHERE id = 1";
	$result = $db->selectData($query);
    if ($result){
        $social = mysqli_fetch_array($result);
    }
?>
		<a target="_blank" href="<?php echo $social['fb'];?>"><img src="images/icons/fb.png" alt="Facebok"/></a>
		<a target="_blank" href="<?php echo $social['tw'];?>"><img src="images/icons/twt.png" alt="Twitter"/></a>
		<a target="_blank" href="<?php echo $social['ln'];?>"><img src="images/icons/li.png" alt="Linked In"/></a>
		<a target="_blank" href="<?php echo $social['gp'];?>"><img src="images/icons/gp.png" alt="Google Plus"/></a>
	</div>
	<script>
		(function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();	a=s.createElement(o),	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,"script","https://www.google-analytics.com/analytics.js","ga");
		ga("create","UA-xxxxxxxx-x",'auto');
		ga("send","pageview");
	</script>
	<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>