<?php

namespace Jundayw\LaravelBM25\Contracts;

interface BM25
{
    /**
     * 计算相关值
     *
     * @param float $idf 关键词的逆文档频率
     * @param float $tf 关键词在文档中的词频
     * @param float $L 当前文档长度/平均文档长度
     * @return float
     */
    public function score(float $idf, float $tf, float $L): float;

    /**
     * IDF weight
     *
     * @param string $keyword
     * @param array $docs
     * @return float
     */
    public function weight(string $keyword, array $docs): float;

    /**
     * 计算 关键词 在文档中的相关度
     *
     * @param string $keyword 关键词
     * @param string $doc 关键词所在文档的全文
     * @param array $docs 所有文档集
     * @param float|null $idf 关键词的逆文档频率
     * @return float
     */
    public function keyword(string $keyword, string $doc, array $docs, float $idf = null): float;

    /**
     * 计算 关键词 在文档中的相关度
     *
     * @param array $keywords 关键词
     * @param string $doc 关键词所在文档的全文
     * @param array $docs 所有文档集
     * @param array $idfMap idf字典表
     * @return float
     */
    public function keywords(array $keywords, string $doc, array $docs, array $idfMap = []): float;
}
