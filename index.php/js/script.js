$(document).ready(function(){

	// var keyword = document.getElementById('keyword');
	// keyword.addEventListener('keyup', function(){
	// 	console.log('ok');
	// });

	//event ketika keyword ditulis
	$('#keyword').on('keyup', function(){
		$('#cointainer').load('ajax/mahasiswa.php?keyword=' + $('keyword').val());
	});

});