<?php
	ini_set("display_errors", "1");
	require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
?>
<section class='content'>
	<div class='top'>
		<div class='name-box'>
			<span>Items</span>
		</div>
		<div class='selected'>
          <span>Selected items:</span>
          <span id='amount'>0</span>
        </div>
		<div class='options' id='options' title='Options'>
			<svg viewBox='0 0 60 60' x='0px' xmlns='http://www.w3.org/2000/svg' y='0px'>
				<path d='M30,16c4.411,0,8-3.589,8-8s-3.589-8-8-8s-8,3.589-8,8S25.589,16,30,16z'></path>
				<path d='M30,44c-4.411,0-8,3.589-8,8s3.589,8,8,8s8-3.589,8-8S34.411,44,30,44z'></path>
				<path d='M30,22c-4.411,0-8,3.589-8,8s3.589,8,8,8s8-3.589,8-8S34.411,22,30,22z'></path>
			</svg>
		</div>
	</div>
	<div class='list'>
		<ul class='items'>
			<?php
				$query = "SELECT * FROM items";
				$result = $dbc->query($query);
				while($row = $result->fetch_array()) {
			?>
					<li class='item'>
						<div class='checkbox'>
							<div class='check'></div>
						</div>
						<div class='edit'>
							<a href='index.php?page=edit&id=<?php echo $row['id']; ?>'>
								<span class='fa fa-pencil'></span>
							</a>
						</div>
						<div class='preview'></div>
						<div class='description'>
							<div class='price'>$<?php echo number_format($row['price'],2,'.',','); ?></div>
							<div class='title'><?php echo $row['name']; ?></div>
							<p><?php echo $row['short_desc']; ?></p>
						</div>
					</li>
			<?php
				}
			?>
		</ul>
	</div>
</section>
<section class='side-box'>
	<nav class='categories'>
		<ul>
		<?php
			$query = "SELECT * FROM categories";
			$result = $dbc->query($query);
			while($row = $result->fetch_array()) {
		?>
				<li>
					<a class='cat-link <?php if($row['default']==1){echo'active';} ?>' title='<?php echo $row['display']; ?>' data-rank='<?php echo $row['name']; ?>'>
						<span><?php echo $row['display']; ?></span>
						<div class='icon'></div>
					</a>
				</li>
		<?php
			}
		?>
		</ul>
	</nav>
</section>