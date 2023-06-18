<?php

namespace App\Enums;

interface BookingStatus {
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancel';
}
