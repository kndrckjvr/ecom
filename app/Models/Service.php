<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public const DEFAULT_SERVICES = [
        [
            'name' => 'House Construction',
            'location' => 'Manila',
            'user_id' => 'Ace & Hammer Builders',
            'description' => 'Ace & Hammer Builders is a construction company that delivers high quality, reliable construction services for governmental establishments. In addition, we have broad expertise with commercial clients.'
        ],
        [
            'name' => 'House Construction',
            'location' => 'Manila',
            'user_id' => 'Center Circle Design-Build',
            'description' => 'Center Circle Design-Build is an army of construction professionals, tradesmen and support staff. Our team has expertise in residential, commercial and industrial construction and the ability to deliver any scale of construction project.'
        ],


        [
            'name' => 'House Repair',
            'location' => 'Manila',
            'user_id' => 'Big Sky Home Repair',
            'description' => 'We are a licensed home repair contractor, fully insured, and experienced in renovations, making us the perfect choice to work on your home.'
        ],
        [
            'name' => 'House Repair',
            'location' => 'Manila',
            'user_id' => 'Just Right Home',
            'description' => 'Just Right Home Repairs’ mission is to provide knowledgeable, convenient, and reasonably-priced handyman service.'
        ],


        [
            'name' => 'House Repainting',
            'location' => 'Manila',
            'user_id' => 'Comfort in Color',
            'description' => 'Comfort in Color will provide top-quality interior and exterior residential and commercial painting services. The company will seek to provide these services in the most timely manner and with an ongoing comprehensive quality control program to provide 100% customer satisfaction.'
        ],
        [
            'name' => 'House Repainting',
            'location' => 'Manila',
            'user_id' => 'Brush Up My Home',
            'description' => 'Brush Up My Home offers a full line of services primarily focused on interior and exterior residential and commercial painting. The firm also provides such services as drywall plastering, acoustical ceilings, pressure washing, and others.'
        ],


        [
            'name' => 'House Moving Services',
            'location' => 'Manila',
            'user_id' => 'Life-Home Movers',
            'description' => 'Life-Home movers assure that they do not just move the contents of your previous house. All appliances and decorations are properly handled ensuring that nothing will be left and damaged in order to keep the memories and home vibes stay until your next home.'
        ],
        [
            'name' => 'House Moving Services',
            'location' => 'Manila',
            'user_id' => 'Two men and a Truck',
            'description' => 'Two men and a Truck has well experienced personnels and various vehicle sizes that will fit all the content of your house if you wish to move to another location. They provide service from picking up the items to installation to the new home.'
        ],


        [
            'name' => 'House Plumbing Services',
            'location' => 'Manila',
            'user_id' => 'Puso Septic and Plumbing',
            'description' => 'Puso Septic and plumbing has well-trained plumbers that can fix any plumbing concerns. They also have the materials that can extract the contents of the septic tank whenever there’s already a need.'
        ],
        [
            'name' => 'House Plumbing Services',
            'location' => 'Manila',
            'user_id' => 'Hardcore Plumber',
            'description' => 'Hardcore plumbers ensures that all the leakage in the house are stopped. They also provide plumbing plans and estimation for those who plan to build their new home.'
        ],


        [
            'name' => 'Garden Landscaping',
            'location' => 'Manila',
            'user_id' => 'Lawn Fairy',
            'description' => 'Lawn fairy makes a boring, plain, and blank garden into a magical place. Whatever garden size it may be, lawn fairy artists and gardeners can definitely turn it into an eye catcher and stress reliever place in your house.'
        ],
        [
            'name' => 'Garden Landscaping',
            'location' => 'Manila',
            'user_id' => 'Epic Gardening',
            'description' => 'Epic Gardening specializes in landscape architecture. They provide well-planned designs that could turn vacant lawn space to the favorite anytime ‘meryenda’ location in your house.'
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'location',
        'description',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
