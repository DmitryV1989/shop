<?

function p($text) {
	echo "<pre style=\"white-space: pre-wrap; background:#fafafa;padding:10px;margin:10px 0;\">";
	print_r($text);
	echo "</pre>";
}

$arCatalog = [
	1 => [
		'id'    	 => 1,
		'name' 		 => 'Блюдо TRAMONTINA 64510/610-TR, прямоугольное с крышкой для холодных закусок',
		'price'      => 2390,
		'descr'      => 'test1',
		'active'     => 1,
		'created_at' => '3.12.2022',
		'cat_id' 	 => 8
	],
	2 => [
		'id'=>2,
		'name'=>'Тарелка суповая LUMINARC J0765, 20 см, стекло',
		'price'=>399,
		'descr'=>'test2',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	3 => [
		'id'=>3,
		'name'=>'Тарелка суповая LUMINARC Q7486, 21 см, стекло',
		'price'=>289,
		'descr'=>'test3',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	4 => [
		'id'=>4,
		'name'=>'Тарелка суповая FIORETTA Springtime TDP632, 21,5 см, фарфор',
		'price'=>649,
		'descr'=>'test4',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	5 => [
		'id'=>5,
		'name'=>'Тарелка суповая DOMENIK Peonia DM9711, 21 см, фарфор',
		'price'=>449,
		'descr'=>'test5',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	6 => [
		'id'=>6,
		'name'=>'Тарелка суповая DOMENIK Laguna DM6002, 21 см, керамика',
		'price'=>349,
		'descr'=>'test6',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	7 => [
		'id'=>7,
		'name'=>'Тарелка суповая FIORETTA TDP082, 23 см, фарфор',
		'price'=>479,
		'descr'=>'test7',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	8 => [
		'id'=>8,
		'name'=>'Тарелка суповая FIORETTA TDP605, 21,5 см, фарфор',
		'price'=>519,
		'descr'=>'test8',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	9 => [
		'id'=>9,
		'name'=>'Тарелка суповая DOMENIK DM9741, 23 см, фарфор',
		'price'=>649,
		'descr'=>'test9',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	10 => [
		'id'=>10,
		'name'=>'Тарелка суповая LUMINARC Q6878, 20 см, стекло',
		'price'=>199,
		'descr'=>'test10',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	11 => [
		'id'=>11,
		'name'=>'Тарелка суповая LUMINARC Q1309, 18 см, стекло',
		'price'=>205,
		'descr'=>'test11',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	],
	12 => [
		'id'=>12,
		'name'=>'Тарелка суповая LUMINARC Q6013, 20 см, стекло',
		'price'=>339,
		'descr'=>'test12',
		'active'=>1,
		'created_at'=>'3.12.2022',
		'cat_id'=>8
	]

];

$arCategories = [
	[
		'id'=>1,
		'name'=>'Детская посуда',
		'active'=>1,
		'created_at'=>'3.12.2022'
	],
	[
		'id'=>2,
		'name'=>'Пластиковая посуда',
		'active'=>1,
		'created_at'=>'3.12.2022'
	],
	[
		'id'=>3,
		'name'=>'Посуда для напитков',
		'active'=>1,
		'created_at'=>'3.12.2022'
	],
	[
		'id'=>4,
		'name'=>'Посуда для чая и кофе',
		'active'=>1,
		'created_at'=>'3.12.2022'
	],
	[
		'id'=>5,
		'name'=>'Прочие предметы сервировки',
		'active'=>1,
		'created_at'=>'3.12.2022'
	],
	[
		'id'=>6,
		'name'=>'Сервизы',
		'active'=>1,
		'created_at'=>'3.12.2022'
	],
	[
		'id'=>7,
		'name'=>'Столовые приборы',
		'active'=>1,
		'created_at'=>'3.12.2022'
	],
	[
		'id'=>8,
		'name'=>'Тарелки',
		'active'=>1,
		'created_at'=>'3.12.2022'
	],
	[
		'id'=>9,
		'name'=>'Чашки и кружки',
		'active'=>1,
		'created_at'=>'3.12.2022'
	]
	
];


?>