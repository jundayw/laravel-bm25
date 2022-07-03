# 安装方法

命令行下, 执行 composer 命令安装:

````
composer require jundayw/laravel-bm25
````

# 示例

````php
$docs     = [
    '深圳保障房计划给出最新公租房、安居房消息！没房的赶紧来看！',
    '在深圳，有多少人每个月最大的一笔支出就是房租。所以大家都挺关心公租房消息的，毕竟公租房能让房租这笔支出少一些又或者是期待安居房能让自己有点买房的机会。',
    '深圳的保障房工作近几年进展就很不错。从最初的廉租房、公租房、经济适用住房，发展到今天的公租房、安居房和人才住房。',
    '保障群体从最初的户籍低收入家庭，扩展到现在的户籍中低收入家庭、人才家庭，以及为城市提供基本公共服务的公交司机、环卫工人和先进制造业职工等群体',
    '保障群体从最初的户籍低收入家庭，扩展到现在的户籍中低收入家庭、人才家庭，以及为城市提供基本公共服务的公交司机、环卫工人和先进制造业职工等群体',
    '好消息，新版租房合同来袭，在深圳租房的你有福了！',
];
$keywords = ['租房', '深圳'];
$bm25     = new BM25(1.2, 0.75);
foreach ($docs as $doc) {
    dump(current($keywords) . '-bm25计算：' . $bm25->keyword(current($keywords), $doc, $docs));
}
dump('--------------keyword--------------');
foreach ($docs as $doc) {
    dump(last($keywords) . '-bm25计算：' . $bm25->keyword(last($keywords), $doc, $docs));
}
dump('--------------keyword--------------');
foreach ($docs as $doc) {
    dump(join(',', $keywords) . '-bm25计算：' . $bm25->keywords($keywords, $doc, $docs));
}
dump('--------------keywords--------------');
dd([
    $bm25->map($keywords, $docs)->getRanks(),
    $bm25->map($keywords, $docs)->argsort(),
]);
````
