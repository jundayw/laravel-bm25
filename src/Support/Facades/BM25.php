<?php

namespace Jundayw\LaravelBM25\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Traits\Macroable;
use Jundayw\LaravelBM25\Contracts\BM25 as BM25Contract;
use Jundayw\LaravelBM25\Support\Factories\BM25 as BM25Factory;
use Jundayw\LaravelBM25\Support\Relative;

/**
 * @method static float score(float $idf, float $tf, float $L)
 * @method static float weight(string $keyword, array $docs)
 * @method static float keyword(string $keyword, string $doc, array $docs, float $idf = null)
 * @method static float keywords(array $keywords, string $doc, array $docs, array $idfMap = [])
 * @method static Relative map(array $keywords, array $docs, array $idfMap = [])
 * @method static BM25Factory setK(float $k)
 * @method static BM25Factory setB(float $b)
 *
 * @method static void macro($name, $macro)
 * @method static void mixin($mixin, $replace = true)
 * @method static bool hasMacro($name)
 * @method static void flushMacros()
 *
 * @see BM25Factory
 * @see Macroable
 */
class BM25 extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BM25Contract::class;
    }
}
