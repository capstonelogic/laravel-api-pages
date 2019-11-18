<?php
namespace CapstoneLogic\Pages\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CapstoneLogic\Auth\Model\User;

class Status extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        $this->table = config('capstonelogic.pages.db_prefix') . 'page_statuses';
        parent::__construct($attributes);
    }
}
