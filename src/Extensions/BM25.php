<?php

namespace Jundayw\LaravelBM25\Extensions;

use Jundayw\LaravelBM25\Support\Factories\BM25 as BM25Factory;

class BM25 extends BM25Factory
{
    /**
     * 计算相关值
     *
     * @param float $idf 关键词的逆文档频率
     * @param float $tf 关键词在文档中的词频
     * @param float $L 当前文档长度/平均文档长度
     * @return float
     */
    public function score(float $idf, float $tf, float $L): float
    {
        return ($idf * ($this->k + 1) * $tf) / ($this->k * (1.0 - $this->b + $this->b * $L) + $tf);
    }

    /**
     * IDF weight
     *
     * @param string $keyword
     * @param array $docs
     * @return float
     */
    public function weight(string $keyword, array $docs): float
    {
        $N = count($docs);
        $q = count(array_filter($docs, function($doc) use ($keyword) {
            return mb_substr_count($doc, $keyword);
        }));
        return log(($N - $q + 0.5) / ($q + 0.5) + 1);
    }
}
