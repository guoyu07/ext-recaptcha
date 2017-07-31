<?php

namespace Notadd\FileManager\Models;

use Baum\Node;
use Carbon\Carbon;

class Category extends Node
{
    protected $table = 'file_categories';

    // 'parent_id' column name
    protected $parentColumn = 'parent_id';

    // 'lft' column name
    protected $leftColumn = 'lft';

    // 'rgt' column name
    protected $rightColumn = 'rgt';

    // 'depth' column name
    protected $depthColumn = 'depth';


    // guard attributes from mass-assignment
    protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        Carbon::setLocale('zh');
    }

    public function detail()
    {
        return $this->belongsTo('Notadd\Cloud\Models\Detail','detail_id');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}
