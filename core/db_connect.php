<?
 define("CONFIG", ["DB"=>[
	"server"=>"localhost",
	"user"=>"root",
	"password"=>"",
	"name"=>"shop"
	]
]);
$sqlConnect = mysqli_connect(CONFIG['DB']['server'],'root','','shop');
mysqli_set_charset($sqlConnect,'utf8');


// подправить

?>