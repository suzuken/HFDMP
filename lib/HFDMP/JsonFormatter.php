<?php

namespace HFDMP;

class JsonFormatter implements \Monolog\Formatter\FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format(array $record)
    {
        return json_encode($record) . "\n";
    }

    /**
     * {@inheritdoc}
     */
    public function formatBatch(array $records)
    {
        return json_encode($records) . "\n";
    }
}
