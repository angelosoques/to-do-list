<?php

namespace App\Constants;

class TaskConstants {

    const TO_DO = 'to_do';
    const IN_PROGRESS = 'in_progress';
    const COMPLETED = 'completed';
    const DELETED = 'deleted';

    public static function getValues()
    {
        return [
            self::TO_DO,
            self::IN_PROGRESS,
            self::COMPLETED,
            self::DELETED
        ];
    }
}