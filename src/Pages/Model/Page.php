<?php
namespace CapstoneLogic\Pages\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CapstoneLogic\Auth\Model\User;

class Page extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status_id',
        'title',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        $this->table = config('capstonelogic.pages.db_prefix') . 'pages';
        parent::__construct($attributes);
    }

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function status() {
        return $this->belongsTo(Status::class)->withTrashed();
    }
}
