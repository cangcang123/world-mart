<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use App\Jobs\LogsUserActionWorker;

/**
 * Class UserActionHandler
 * @package App\Logging
 */
class UserActionHandler extends AbstractProcessingHandler
{
    /**
     * UserActionHandler constructor.
     * @param int $level
     * @param bool $bubble
     */
    public function __construct($level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->level = $level;
    }

    /**
     * @param array $record
     */
    protected function write(array $record): void
    {
        //dd($record);
        dispatch(new LogsUserActionWorker(
            $record['context'][0],
            $record['context'][1],
            $record['context'][2],
            $record['context'][3],
            $record['context'][4],
            $record['context'][5],
            $record['context'][6],
            $record['context'][7],
            $record['context'][8]
        ));
    }
}
