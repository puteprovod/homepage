<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResizedImage extends Model
{
    const SAVED_DAYS = 3; // COUNT OF DAYS WHILE IMAGES SAVED

    public static function clearOldEntries () {
        $currentTime = Carbon::now();
        $expiryTime = $currentTime->subDays(self::SAVED_DAYS)->toDateTimeString();
        $entries = DB::table('resized_images')
            ->select('id','token','created_at')
            ->where('created_at','<',$expiryTime)
            ->groupBy('token')
            ->get();
        foreach ($entries as $entry) {
            $token = $entry->token;
            Storage::disk('public')->deleteDirectory('ResizedImages/' . $token);
            Storage::disk('public')->deleteDirectory('ResizedImages/Previews/' . $token);
            Storage::disk('public')->delete('ResizedImages/' . $token.'.json');
        }
        $entries = ResizedImage::All()->where('created_at','<',$expiryTime);
        foreach ($entries as $entry){
            ResizedImage::destroy($entry->id);
        }
    }

    protected $table = 'resized_images';
    protected $guarded = [];
    use HasFactory;
}
