<?php
	ini_set("display_errors", "1");
	require $_SERVER['DOCUMENT_ROOT']."/demo/config.php";
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		die($dbc->error."[$query]");
	}
	$query = "SELECT * FROM items WHERE id = '$id'";
	if(!$result = $dbc->query($query)) {
		die($dbc->error."[$query]");
	}
	if($result->num_rows > 0) {
		$row = $result->fetch_array();
		$name = $row['name'];
		$sdesc = $row['short_desc'];
		$desc = $row['description'];
		$cat = $row['category'];
		$price = $row['price'];
		$commands = $row['commands'];
		$blad = NULL;
	} else {
		echo "<script>window.location.href='http://hivecraft.pl/demo/admin/main/index.php?page=items';</script>";
	}
?>
<section class='content'>
	<div class='top'>
		<div class='name-box'>
			<span>Item Editor</span>
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
			<ul class='dropdown' for='options' style='display:none'>
				<li id='select'>Select all</li>
				<li id='remove'>Remove</li>
				<li id='remove'>Add</li>
			</ul>
		</div>
     </div>
     <div class='item-editor'>
		<div class='row'>
			<input id='i-id' name='id' type='hidden' value='<?php echo $_GET['id']; ?>'>
			<input id='i-name' name='name' placeholder='Item name' type='text' value='<?php echo $name; ?>'>
        </div>
        <div class='row'>
			<input id='i-desc-short' name='sdesc' placeholder='Short item description' type='text' value='<?php echo $sdesc; ?>'>
        </div>
        <div class='row'>
			<textarea id='i-desc' name='desc' placeholder='Description' type='text'><?php echo $desc; ?></textarea>
        </div>
        <div class='row'>
			<select id='i-category' name='category' type='text'>
				<option disabled='disabled'>Select category</option>
				<?php
					$querycat = "SELECT * FROM categories";
					if(!$resultcat = $dbc->query($querycat)) {
						die($dbc->error."[$querycat]");
					}
					while($rowcat = $resultcat->fetch_array()) {
				?>
				<option value='<?php echo $rowcat['name']; ?>' <?php if($cat==$rowcat['name']){ echo "selected='selected'"; } ?>><?php echo $rowcat['display']; ?></option>
				<?php
					}
				?>
			</select>
			<input id='i-price' name='price' maxlength='12' placeholder='price' type='text' value='<?php echo $price; ?>'>
        </div>
        <div class='row'>
			<div class='alert'>
				<p>If u going to add some commands to your item you can use field below. E.g. /give [nick] 1 10</p>
				<p>When you finish writing the command use a comma or Enter to add the next one.</p>
			</div>
			<div class='wrap'>
				<input disabled='disabled' id='i-commands-prefix' value='/'>
				<input id='i-commands' placeholder='Commands' type='text'>
			</div>
        </div>
        <div class='row'>
			<div class='tags'>
			<?php
				$commands_alt = explode(',', $commands);
				if(!$commands==NULL) {
					foreach($commands_alt as $comm) {
			?>
				<div class="tag">
					<span class="command"><?php echo $comm; ?></span>
					<div class="removetag fa fa-times"></div>
				</div>
			<?php
					}
				}
			?>
			</div>
        </div>
        <div class='row'>
			<input id="updateitem" class='green-btn' type='submit' value='Save'>
        </div>
    </div>
</section>