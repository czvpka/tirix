$( document ).ready(function() {

	// Item editor
	$(function(){
	  
	  var cleave = new Cleave('#i-price', {
	    delimiter: '.',
	    numeral: true,
	    prefix: '$'
	  });

	  $('.removetag').click(function(){
	      $(this).parent().remove();
	  });
	  
	  var tag_editor = $('.item-editor #i-commands');
	  var tags = $('.item-editor .tags');
	  var tag = $('.item-editor .tag');
	  
	  tag_editor.keypress(function (e) {
	      if (e.which == 13 || e.which == 44) {
	        var last = tag_editor.val().replace(/,/g , '');
	        if(tag_editor.val()!==""){
		        setTimeout(function(){
		        	tag_editor.val('');
		        	createTag(last);
		        }, 100);
	        }
	      }
	  });
	  
	  function createTag(x){
	    tags.append('<div class="tag"><span class="command">/'+ x +'</span><div class="removetag fa fa-times"></div></div>');
	    
	    $('.removetag').click(function(){
	      $(this).parent().remove();
	    });
	  }
	})

	//Set the correct height
	var categories = 0;
	$('.side-box nav.categories ul li').each(function(i) {
	  categories++;
	});
	$('.side-box').css('max-height', 120 + (categories * 46));
	
	
	$('.categories ul li').click(function() {
		 $('.content .top .selected').hide();
		 $('.name-box').show();
		var t = $(this);
		$('.categories ul li a').each(function(){
			$(this).removeClass('active');
		})
			t.children().addClass('active');
	});
		
		
	function checkAmount(){
		var amount = $('.list .active').length;
		
		if(amount===0){
		  $('.content .top .selected').hide();
		  $('.name-box').show();
		}else{
		  $('.name-box').hide();
		  $('.selected #amount').text(amount);
		  $('.content .top .selected').show();
		}
	}

		  function gooo(){
			$('.list .items .item').addClass('ready');
				$('.list .items .item .checkbox').each(function(){
					$(this).click(function(){
					var t = $(this).parent();
					if (t.hasClass('active')==0) {
					  // on select
					  t.addClass('active');
					  checkAmount();
					  t.addClass('ready');
					  t.children('.checkbox').children('.check').append('<div class="fa fa-check"></div>');
					}else {
					  // on select out
					  t.removeClass('active');
					  checkAmount();
					  t.children('.checkbox').children('.check').children('.fa').remove();
					}
				});
				});
			}

			setInterval(function(){ 

			$('.list .items .item').each(function(){
				if($(this).hasClass('ready')==0){
					gooo();
				}
			})

			}, 100);
	
			
	
	$('.cat-link').click(function() {
		var cat = $(this).attr('data-rank');
		var dataForm = { 'cat': cat };
		$.ajax({
			type: 'POST',
			url: 'ajax/getItems.php',
			data: dataForm
		})
		.done(function(response){
			
			if(response=='blad') {
				return;
			} else if(response=='brak') {
				return;
			} else if( response!=='brak' && response!=='blad' ) {
				$('ul.items').html(response);
			}
		});
	});


	$('#updateitem').click(function(){

		var cmds = "";
		var id = $('#i-id').val();
		var name = $('#i-name').val();
		var sdesc = $('#i-desc-short').val();
		var desc = tinyMCE.activeEditor.getContent();
		var cat = $('#i-category').val();
		var price = $('#i-price').val().substring(1);
		

		$('.tags .tag .command').each(function(){

			var x = $(this).text();
			cmds = cmds + x + ",";


		})

		var dataForm = { 'id': id, 'name': name, 'sdesc': sdesc, 'desc': desc, 'cat': cat, 'price': price, 'cmds': cmds.slice(0, -1) }

		$.ajax({
			type: 'POST',
			url: 'http://hivecraft.pl/demo/admin/main/ajax/updateItem.php',
			data: dataForm
		})
		.done(function(response){
			if(response=='blad query'){
				alertify.delay(3000);
				alertify.logPosition("top right");
				alertify.error("An error ocurred. Please try again later!");
			} else if(response=='brak posta'){
				alertify.delay(3000);
				alertify.logPosition("top right");
				alertify.error("An error ocurred. Save item again!");
			} else if(response=='zaktualizowano'){
				alertify.delay(3000);
				alertify.logPosition("top right");
				alertify.success("Successfully saved item!");
				setTimeout(function(){
					window.location.href='index.php?page=items';
				}, 2500);
			} else {
				alertify.delay(3000);
				alertify.logPosition("top right");
				alertify.error("Undefinied error ocurred. Please try again later!");
			}
			console.log(response);
		});

	});	
});