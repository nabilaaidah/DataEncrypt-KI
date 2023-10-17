<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class information extends Model
{
    use HasFactory;

    protected $table = 'information';
    protected $primaryKey = 'id';
    protected $fillable = ['nama',
                            'nik',
                            'dob',
                            'gender',
                            'email',
                            'phone',
                            'address',
                            'geneticDisease',
                            'allergies',
                            'medications',
                            'bloodPressure',
                            'cholesterol',
                            'medicalHistory',
                            'ethnicity',
                            'sexualOrientation',
                            'religion',
                            'languages',
                            'nationality',
                            'politicalAffiliation',
                            'biometricVideo',
                            'biometricData',
                            'eyeColor',
                            'hairColor',
                            'kkDocument',
                            'photo1',
                            'user_id'];
}
