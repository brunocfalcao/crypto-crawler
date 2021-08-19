<?php

namespace Nidavellir\CryptoCrawler;

class CryptoCrawler
{
    public static function __callStatic($method, $args)
    {
        return CryptoCrawlerService::new()->{$method}(...$args);
    }
}

class CryptoCrawlerService
{
    protected $data = [];
    protected $pipeline = null;

    public function __construct()
    {
    }

    public static function new(...$args)
    {
        return new self(...$args);
    }

    /**
     * Sets the crawline pipeline that should be used to crawl data.
     *
     * @param  string $class Pipeline class
     *
     * @return \Nidavellir\CryptoCrawler\CryptoCrawlerService
     */
    public function onPipeline(string $pipeline)
    {
        $this->pipeline = $pipeline;

        return $this;
    }

    public function crawl()
    {
        app(\Illuminate\Pipeline\Pipeline::class)
            ->send($this->data())
            ->through((new ($this->pipeline))())
            ->thenReturn();
    }

    /**
     * Sets a data path attribute in the $this->data attribute.
     * Uses the data_set() helper, so you can make like
     * $this->set('name.surname', 'Falcao');.
     *
     * @param string $path
     * @param string $value
     */
    public function set(string $path, string $value)
    {
        data_set($this->data, $path, $value);

        return $this;
    }

    /**
     * Returns the data token to be used in the pipeline.
     *
     * @return stdClass
     */
    private function data()
    {
        return (object) $this->data;
    }
}
