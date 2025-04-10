<?php

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sdkconsultoria\WhatsappCloudApi\Lib\Message\BussinessProfile;

class WabaPhone extends Model
{
    use HasFactory;

    protected $table = 'waba_phones';

    protected $fillable = [
        'created_by',
        'updated_by',
        'waba_id',
        'address',
        'description',
        'vertical',
        'about',
        'email',
        'websites',
        'profile_picture_url',
        'messaging_product',
        'name',
        'code_verification_status',
        'display_phone_number',
        'phone_number_clean',
        'quality_rating',
        'phone_id',
        'pin',
        'status',
    ];

    public static function savePhones(array $phones, $wabaId): void
    {
        foreach ($phones['data'] as $phone) {
            $waba = Waba::where('waba_id', $wabaId)->first();
            $wabaPhone = WabaPhone::where('phone_id', $phone['id'])->first();

            if (! $wabaPhone) {
                $wabaPhone = new WabaPhone();
                $wabaPhone->phone_id = $phone['id'];
                $wabaPhone->waba_id = $waba->id;
            }

            $wabaPhone->name = $phone['verified_name'];
            $wabaPhone->display_phone_number = $phone['display_phone_number'];
            $wabaPhone->quality_rating = $phone['quality_rating'];
            $wabaPhone->phone_number_clean = str_replace(['-', ' ', '+'], '', $phone['display_phone_number']);
            $wabaPhone->save();

            try {
                resolve(BussinessProfile::class)->process($phone['id']);
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
            }

        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function waba()
    {
        return $this->belongsTo(Waba::class);
    }
}
