<?php

namespace Jundayw\LaravelBM25\Support;

class Relative
{
    protected array $ranks = [];

    public function __construct(array $ranks = [])
    {
        $this->ranks = $ranks;
    }

    /**
     * 获取相对相关度
     *
     * @return array
     */
    public function argsort(): array
    {
        return array_map(function($rank) {
            return $rank / $this->max();
        }, $this->getRanks());
    }

    /**
     * 相关度平均值
     *
     * @return float
     */
    public function average(): float
    {
        if ($length = count($this->getRanks())) {
            return array_sum($this->getRanks()) / $length;
        }
        return array_sum($this->getRanks());
    }

    /**
     * 相关度最大值
     *
     * @return float
     */
    public function max(): float
    {
        return max($this->getRanks());
    }

    /**
     * 相关度最小值
     *
     * @return float
     */
    public function min(): float
    {
        return min($this->getRanks());
    }

    /**
     * @return array
     */
    public function getRanks(): array
    {
        return $this->ranks;
    }

}
