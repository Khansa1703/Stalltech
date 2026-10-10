<?php

use App\Models\User;

function rupiah(int|float|null $value): string
{
    return 'Rp ' . number_format((float) $value, 0, ',', '.');
}

function UserOwnerId(): int
{
    return (int) User::where('role', 'owner')->value('id');
}
