$( document ).ready(function() {
	
	
	// CONSOLE
	
	console.log('%c STOP',' color: red;font-size: 20px;font-weight:900');
	console.log('%c Wszelkie próby ataku typu DDoS zostaną zgłoszone, wraz z IP sprawcy, odpowiednim organom.',' color: black;');
	console.log('%c -----------------------------------------------------------------------------------------',' color: black');

	// GET DATE
		var td = new Date();
		var dd = td.getDate();
		var mm = td.getMonth()+1;
		
		var gm = td.getMinutes();
		var gh = td.getHours();
		
		var yyyy = td.getFullYear();
		if(dd<10){
			dd='0'+dd;
		} 
		if(mm<10){
			mm='0'+mm;
		} 
		if(gh<10){
			gh='0'+gh;
		} 
		if(gm<10){
			gm='0'+gm;
		}
		today = dd+'/'+mm+'/'+yyyy + " (" + gh +  ":" + gm + ")";
	
	// GET IP 
	
	$.get("https://ipinfo.io", function(response) {
		ip = response.ip
	}, "jsonp");

$('form').submit(function(event) {
	
  form = this;
  event.preventDefault();
  
  var login = $('#login').val();
  var pass = $('#password').val();
  var dataForm = {'login': login,"password": pass};
  
  if(login=="" && pass==""){
	  alertMe('Uzupełnij pole login oraz pole password.');
  }else if(pass=="" && login!= null){
	  alertMe('Uzupełnij pole password.');
  }else if(login=="" && pass!= null){
	  alertMe('Uzupełnij pole login.');
  }else{
	  sendAjax();
	  $('input[type="submit"]').attr('disabled','disabled');
  }
  
  
  
  function alertMe(x){
	  $('.alert').fadeIn();
	  $('.alert').text(x);
	  setTimeout(function(){
	  $('.alert').fadeOut();
	  }, 2000);
  }
  
  function sendAjax(){
	  
	$.ajax({
    type: 'POST',
    url: $(form).attr('action'),
    data: dataForm
	})
	.done(function(response){
		
		$('.loader').addClass('active');
		
		setTimeout(function(){
			$('.loader').removeClass('active');
			
			if(response=='true'){
				
				console.log('Hasło poprawne');
				window.location.href = "http://hivecraft.pl/demo/admin/main/index.php";
				alertMe('Trwa przekierowanie...');
				
			}else if(response=='brak uzytkownika'||response=='zle dane'){
				console.log(response)
				console.log('FAIL LOGIN | '+ today + ' | IP: ' + ip);
			
				$('input[type="submit"]').removeAttr('disabled');
				
				$('#password').addClass('wrong');
				alertMe('Hasło nieprawidłowe');
				setTimeout(function(){
					$('#password').removeClass('wrong');
				}, 2000);
			};
		}, 1000);
	});
  }
  
  
});
});