<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Support\Carbon;


/**
 * Class Role
 *
 * @property int|null $id
 * @property string|null $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */

class Role extends SpatieRole
{
    const ROLE = [
        'ADMIN' => 'ADMIN',
        'USER' => 'USER',
    ];

    use HasFactory;
}
