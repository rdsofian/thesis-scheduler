<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportTemporary extends Model
{
    protected $fillable = [
        'day_name', 'date', 'time', 'room', 'code', 'name', 'faculty', 'lecturer',
        'chairman', 'vice_chairman'];
}
