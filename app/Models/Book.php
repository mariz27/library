<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'barcode', 'quantity', 'available_quantity', 'accession_no', 'call_no', 'supplier',
        'date_received', 'date_collated', 'date_stamped', 'date_accessioned', 'date_catalogued',
        'date_labeled', 'date_tagging', 'date_book_pocket', 'date_book_card', 'date_collation_slip', 'date_cover'
    ];
    
    protected $dates = [
        'date_received', 'date_collated', 'date_stamped', 'date_accessioned', 'date_catalogued',
        'date_labeled', 'date_tagging', 'date_book_pocket', 'date_book_card', 'date_collation_slip', 'date_cover'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    
    public function getProcessingCompletionPercentage()
    {
        $checklistFields = [
            'date_received', 'date_collated', 'date_stamped', 'date_accessioned',
            'date_catalogued', 'date_labeled', 'date_tagging', 'date_book_pocket',
            'date_book_card', 'date_collation_slip', 'date_cover'
        ];
        
        $completedSteps = 0;
        foreach ($checklistFields as $field) {
            if ($this->$field) $completedSteps++;
        }
        
        $totalSteps = count($checklistFields);
        return ($totalSteps > 0) ? round(($completedSteps / $totalSteps) * 100) : 0;
    }
    
    public function isReadyForBorrowing()
    {
        return $this->getProcessingCompletionPercentage() >= 90;
    }
}