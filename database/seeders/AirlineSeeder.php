<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AirlineSeeder extends Seeder
{
    public function run(): void
    {
        Airline::create([
            'name' => 'Alaska Airlines',
            'icao' => 'ASA',
            'slug' => 'alaska-airlines',
            'web_url' => 'https://careers.alaskaair.com/'
        ]);
        
        Airline::create([
            'name' => 'Allegiant Air',
            'icao' => 'AAY',
            'slug' => 'allegiant-air',
            'web_url' => 'https://www.allegiantair.com/careers'
        ]);
        
        Airline::create([
            'name' => 'American Airlines',
            'icao' => 'AAL',
            'slug' => 'american-airlines',
            'web_url' => 'https://jobs.aa.com/'
        ]);
        
        Airline::create([
            'name' => 'Atlas Air',
            'icao' => 'GTI',
            'slug' => 'atlas-air',
            'web_url' => 'https://www.atlasairworldwide.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'Delta Air Lines',
            'icao' => 'DAL',
            'slug' => 'delta-air-lines',
            'web_url' => 'https://www.deltajobs.net/'
        ]);
        
        Airline::create([
            'name' => 'FedEx Express',
            'icao' => 'FDX',
            'slug' => 'fedex-express',
            'web_url' => 'https://careers.fedex.com/express'
        ]);
        
        Airline::create([
            'name' => 'Frontier Airlines',
            'icao' => 'FFT',
            'slug' => 'frontier-airlines',
            'web_url' => 'https://flyfrontier.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'Hawaiian Airlines',
            'icao' => 'HAL',
            'slug' => 'hawaiian-airlines',
            'web_url' => 'https://www.hawaiianairlines.com/corporate/careers'
        ]);
        
        Airline::create([
            'name' => 'JetBlue Airways',
            'icao' => 'JBU',
            'slug' => 'jetblue-airways',
            'web_url' => 'https://careers.jetblue.com/'
        ]);
        
        Airline::create([
            'name' => 'Southwest Airlines',
            'icao' => 'SWA',
            'slug' => 'southwest-airlines',
            'web_url' => 'https://careers.southwestair.com/'
        ]);
        
        Airline::create([
            'name' => 'Spirit Airlines',
            'icao' => 'NKS',
            'slug' => 'spirit-airlines',
            'web_url' => 'https://www.spirit.com/careers'
        ]);
        
        Airline::create([
            'name' => 'Sun Country Airlines',
            'icao' => 'SCX',
            'slug' => 'sun-country-airlines',
            'web_url' => 'https://suncountryairlines.atsondemand.com/'
        ]);
        
        Airline::create([
            'name' => 'United Airlines',
            'icao' => 'UAL',
            'slug' => 'united-airlines',
            'web_url' => 'https://careers.united.com/'
        ]);
        
        Airline::create([
            'name' => 'UPS Airlines',
            'icao' => 'UPS',
            'slug' => 'ups-airlines',
            'web_url' => 'https://www.jobs-ups.com/'
        ]);
        
        Airline::create([
            'name' => 'Ameriflight',
            'icao' => 'AMF',
            'slug' => 'ameriflight',
            'web_url' => 'https://www.ameriflight.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'Cape Air',
            'icao' => 'KAP',
            'slug' => 'cape-air',
            'web_url' => 'https://www.capeair.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'CommutAir',
            'icao' => 'UCA',
            'slug' => 'commutair',
            'web_url' => 'https://www.flycommutair.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'Empire Airlines',
            'icao' => 'CFS',
            'slug' => 'empire-airlines',
            'web_url' => 'https://www.empireairlines.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'Endeavor Air',
            'icao' => 'EDV',
            'slug' => 'endeavor-air',
            'web_url' => 'https://www.endeavorair.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'Envoy Air',
            'icao' => 'ENY',
            'slug' => 'envoy-air',
            'web_url' => 'https://www.envoyair.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'GoJet Airlines',
            'icao' => 'GJS',
            'slug' => 'gojet-airlines',
            'web_url' => 'https://www.gojetairlines.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'Horizon Air',
            'icao' => 'QXE',
            'slug' => 'horizon-air',
            'web_url' => 'https://horizonair.jobs/'
        ]);
        
        Airline::create([
            'name' => 'Mesa Airlines',
            'icao' => 'ASH',
            'slug' => 'mesa-airlines',
            'web_url' => 'https://www.mesa-air.com/careers/'
        ]);
        
        Airline::create([
            'name' => 'Republic Airways',
            'icao' => 'RPA',
            'slug' => 'republic-airways',
            'web_url' => 'https://www.rjetcareers.com/'
        ]);
        
        Airline::create([
            'name' => 'SkyWest Airlines',
            'icao' => 'SKW',
            'slug' => 'skywest-airlines',
            'web_url' => 'https://www.skywest.com/skywest-airline-jobs/'
        ]);        
    }
}
