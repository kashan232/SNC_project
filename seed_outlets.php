<?php
$outlets = [
    ['name' => 'Latifabad Unit 7', 'address' => 'Shop no. 4, Civic Center Old Passport Building Opp Allied Bank, Hyderabad', 'status' => 'active'],
    ['name' => 'Haider Chowk', 'address' => 'Shop # 1307/02 Haider Bux Jatoi Building Near Bata Shop, Hyderabad', 'status' => 'active'],
    ['name' => 'Wadhu Wah', 'address' => 'Shop no. 12 Rani Arcade, Wadhu Wah Road Near Summit Bank Qasimabad, Hyderabad', 'status' => 'active'],
    ['name' => 'Main Qasimabad', 'address' => 'Shop no. 8, 9 Saim Luxury Apartment Opp Total Petrol Pump Qasimabad, Hyderabad', 'status' => 'active'],
    ['name' => 'Saddar', 'address' => 'Shop no. 63, Adjacent CBH Cant Saddar Opp Garrison, Hyderabad', 'status' => 'active'],
    ['name' => 'Latifabad Unit 9', 'address' => 'Main Airport Road Near Saira Clinic Latifabad Number 9, Hyderabad', 'status' => 'active'],
    ['name' => 'Hirabad', 'address' => 'Building A/2585 Ward A, Opposite Tower Market Jail Road, Hirabad, Hyderabad', 'status' => 'active'],
    ['name' => 'Autobahn', 'address' => 'Main Autobahn beside Dawood Super Market, Hyderabad', 'status' => 'active']
];

foreach ($outlets as $outlet) {
    \App\Models\Outlet::create($outlet);
}
echo "Outlets seeded!";
