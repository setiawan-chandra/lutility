<?php

namespace Kastanaz\Lutility\Enums;

/**
 * Progress Status
 */
enum ProgressStatusEnum: int
{
    case Running = 0;
    case Completed = 1;
    case Failed = 2;
}
