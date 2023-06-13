<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Chat.
 *
 * @property int                                                                $id
 * @property \Illuminate\Support\Carbon|null                                    $created_at
 * @property \Illuminate\Support\Carbon|null                                    $updated_at
 * @property int                                                                $user1_id
 * @property int                                                                $user2_id
 * @property string                                                             $start_date
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Message> $messages
 * @property int|null                                                           $messages_count
 * @property \App\Models\User                                                   $user1
 * @property \App\Models\User                                                   $user2
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUser1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUser2Id($value)
 *
 * @mixin \Eloquent
 */
class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user1_id',
        'user2_id',
        'start_date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Message>
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Chat>
     */
    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Chat>
     */
    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function getOtherUser(User $user): User
    {
        if ($this->user1_id === $user->id) {
            return $this->user2;
        }

        return $this->user1;
    }
}
