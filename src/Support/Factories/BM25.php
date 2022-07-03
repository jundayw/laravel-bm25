<?php

namespace Jundayw\LaravelBM25\Support\Factories;

use Illuminate\Support\Traits\Macroable;
use Jundayw\LaravelBM25\Contracts\BM25 as BM25Contract;
use Jundayw\LaravelBM25\Support\Relative;

abstract class BM25 implements BM25Contract
{
    use Macroable;

    // 常量k，用来限制TF值的增长极限 默认1.2
    protected float $k = 1.2;
    // b是一个常数，它的作用是规定L对评分的影响有多大
    // 如果把b设置为0，则L完全失去对评分的影响力。
    // b的值越大，L对总评分的影响力越大。
    protected float $b = 0.75;

    public function __construct(float $k = 1.2, float $b = 0.75)
    {
        $this->k = $k;
        $this->b = $b;
    }

    /**
     * 计算相关值
     *
     * @param float $idf 关键词的逆文档频率
     * @param float $tf 关键词在文档中的词频
     * @param float $L 当前文档长度/平均文档长度
     * @return float
     */
    abstract public function score(float $idf, float $tf, float $L): float;

    /**
     * IDF weight
     *
     * @param string $keyword
     * @param array $docs
     * @return float
     */
    abstract public function weight(string $keyword, array $docs): float;

    /**
     * 计算 关键词 在文档中的相关度
     *
     * @param string $keyword 关键词
     * @param string $doc 关键词所在文档的全文
     * @param array $docs 所有文档集
     * @param float|null $idf 关键词的逆文档频率
     * @return float
     */
    public function keyword(string $keyword, string $doc, array $docs, float $idf = null): float
    {
        if (is_null($idf)) {
            $idf = $this->weight($keyword, $docs);
        }
        $tf = mb_substr_count($doc, $keyword) * mb_strlen($keyword) / mb_strlen($doc);
        $L  = mb_strlen($doc) / array_sum(array_map(function($doc) {
                return mb_strlen($doc);
            }, $docs)) * count($docs);
        return $this->score($idf, $tf, $L);
    }

    /**
     * 计算 关键词 在文档中的相关度
     *
     * @param array $keywords 关键词
     * @param string $doc 关键词所在文档的全文
     * @param array $docs 所有文档集
     * @param array $idfMap idf字典表
     * @return float
     */
    public function keywords(array $keywords, string $doc, array $docs, array $idfMap = []): float
    {
        return array_sum(array_map(function($keyword) use ($doc, $docs, $idfMap) {
            return $this->keyword($keyword, $doc, $docs, $idfMap[$keyword] ?? null);
        }, $keywords));
    }

    /**
     * 计算 关键词 在文档集中的相关度
     *
     * @param array $keywords 关键词
     * @param array $docs 所有文档集
     * @param array $idfMap idf字典表
     * @return Relative
     */
    public function map(array $keywords, array $docs, array $idfMap = []): Relative
    {
        $ranks = array_map(function($doc) use ($keywords, $docs, $idfMap) {
            return $this->keywords($keywords, $doc, $docs, $idfMap);
        }, $docs);
        return new Relative($ranks);
    }

    /**
     * @param float $k
     * @return BM25
     */
    public function setK(float $k): BM25
    {
        $this->k = $k;
        return $this;
    }

    /**
     * @param float $b
     * @return BM25
     */
    public function setB(float $b): BM25
    {
        $this->b = $b;
        return $this;
    }

}
