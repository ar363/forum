<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Spatie\Tags\HasTags;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use HasTags;

    protected $fillable = ['title', 'body', 'tags',
        'created_by', 'category_id'];

    protected $with = ['author'];
    protected $withCount = ['comments'];

    protected $appends = ['last_activity', 'participants'];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getLastActivityAttribute()
    {
        $latestComment = $this->hasOne(Comment::class)->latestOfMany()->limit(1);

        if ($latestComment->exists()) {
            return $latestComment->select('created_at')->get()->toArray()[0]['created_at'];
        } else {
            return $this->created_at;
        }
    }

    public function getParticipantsAttribute()
    {
        $createById = $this->created_by;

        $participants = $this->comments()
            ->select(DB::raw('created_by, count(*) as cnt'))
            ->groupBy('created_by')
            ->where('created_by', '<>', $createById)
            ->orderBy('cnt', 'desc')
            ->get();


        return [
            'most_part' => collect($participants->toArray())
                ->map(function ($val) {
                        return User::find(collect($val)['created_by']);
                    }
                )->take(3)->all(),
            'total_count' => count($participants),
        ];
    }
}
