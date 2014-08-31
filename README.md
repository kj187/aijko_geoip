# TYPO3 GeoIp Service
This TYPO3 extension based on MaxMind’s databases. But it is possible to switch to any other service.
If you have some questions, please contact me <julian.kleinhans@aijko.com>

## Use another service 
If you don`t want to use MaxMind, you can use any other service. All what you need is a own ClientRepository which provides the Client Model. You can switch the Repository with the following typoscript

```typoscript
	config.tx_extbase {
		objects {
			Aijko\AijkoGeoip\Domain\Repository\ClientRepositoryInterface {
				className = Aijko\Ip2Location\Domain\Repository\ClientRepository
			}
		}
	}
```

Your new ClientRepository must implement the ClientRepositoryInterface and it must provide the findByClientIp method which returns a new Client model.

```php
class ClientRepository implements \Aijko\AijkoGeoip\Domain\Repository\ClientRepositoryInterface {

    /**
	 * @param string $clientIp
	 * @return \Aijko\AijkoGeoip\Domain\Model\Client|NULL
	 */
	public function findByClientIp($clientIp) {
	    // your stuff
	}

}
```

## Installation
### Via GIT
```ssh
cd [yourProjectDirectory]/typo3conf/ext
git clone git@bitbucket.org:aijko/aijko_geoip.git
```

Now you must activate the extension in the extension manager. In the extension configuration you must define the absolute path to the MaxMind’s database file.

The last thing is to include the static typoscript file. Thats it!

## Usage in other PHP files
Get the client object

```php
$client = GeneralUtility::makeInstance('Aijko\\AijkoGeoip\\Service\\Client');
```

If you are working locally you must fake a public IP. This is possible with a constructor argument.

```php
$client = GeneralUtility::makeInstance('Aijko\\AijkoGeoip\\Service\\Client', '128.101.101.101');
```

Now you are able to get some information from your client. But please note, if you are using the free MaxMind database version, it is possible that you dont get all information because the free version is not so accurate like the non-free.

```php
// Client
$ip = $client->getIp();
$latitude = $client->getLatitude();
$longitude = $client->getLongitude();

// City 
$cityName = $client->getCity()->getName();
$mostSpecificSubdivisionCityName = $client->getCity()->getMostSpecificSubdivisionName();
$zip = $client->getCity()->getZip();

// Country 
$countryName = $client->getCountry()->getName();
$countryTranslations =  = $client->getCountry()->getTranslations();
$isoCode = $client->getCountry()->getIsoCode();
$currency = $client->getCountry()->getCurrency();

// Contintent
$continentCode = $client->getContinent()->getCode();
$continentName = $client->getContinent()->getName();
```

The currency is part of the EXT:static_info_tables. The default currency is USD.

### JSON & AJAX
You can get the whole client data as JSON string, so you can do any magic with javascript in the frontend. Define the AJAX url

```typoscript
page {
	headerData {
		100 < plugin.tx_aijkogeoip.clientMetaUrl
	}
}
```

This typoscript snippet provides a new javascript variable with the link which provides the json output. 
The result is:

```html
<script>
    var clientMetaDataUrl = "http://yourDomain.com/subpage/?type=99874563214"
</script>
```

Use this URI in your AJAX request. The result is a JSON string which includes all client information

Example output
```
{"city":{"name":"Ratingen","mostSpecificSubdivisionName":"Ratingen","zip":"40887"},"country":{"name":"Germany","translations":{"de":"Deutschland","en":"Germany","es":"Alemania","fr":"Allemagne","ja":"ドイツ連邦共和国","pt-BR":"Alemanha","ru":"Германия","zh-CN":"德国"},"isoCode":"DE","currency":"EUR"},"continent":{"code":"EU","name":"Europe"},"latitude":51,"longitude":9,"ip":"128.101.101.101"}
```

The same as above, if you are working locally you must fake a public IP. In this case you can do it with this typoscript

```typoscript
geoIpServiceClientJson {
	10 {
		clientIp = 128.101.101.101
	}
}
```

## Use MaxMind (default)

### Requirements
* PHP >= 5.3.1
* Maxminds database file

You can use the free GeoLite2 database version or the non-free version, this is a more accurate one. The next section could help you to find the right database for you. And yes, you dont need the apache module. You need only a database file. 

### Databases
#### GeoLite2 free database
GeoLite2 databases are free IP geolocation databases comparable to, but less accurate than, MaxMind’s GeoIP2 databases. GeoLite2 databases are updated on the first Tuesday of each month. You can download a Country and a City version which includes the countries. http://dev.maxmind.com/geoip/geoip2/geolite2/


### GeoIP2
#### City database
Determine the country, subdivisions, city, postal code, latitude, and longitude associated with IPv4 and IPv6 addresses worldwide. The GeoIP2 City database is a more accurate version of the free GeoLite2 City database.
https://www.maxmind.com/en/city

#### Country database
Determine an Internet visitor's country based on their IP address. The GeoIP2 Country database is a more accurate version of the free GeoLite2 Country database.
https://www.maxmind.com/en/country

### Updating Downloadable Databases
You can use the GeoIP Update program to automatically update your GeoIP databases.
http://dev.maxmind.com/geoip/geoipupdate/

### Resources
* http://maxmind.github.io/GeoIP2-php/
* http://dev.maxmind.com/geoip/geoip2/geolite2/
* https://www.maxmind.com/en/geolocation_landing
* https://github.com/maxmind/GeoIP2-php
* https://packagist.org/packages/geoip2/geoip2
* https://www.maxmind.com/en/geoip-demo

### License
#### GeoLite2 Free Downloadable Databases License
The GeoLite2 databases are distributed under the [Creative Commons Attribution-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-sa/3.0/). The attribution requirement may be met by including the following in all advertising and documentation mentioning features of or use of this database:

```
 This product includes GeoLite2 data created by MaxMind, available from
 <a href="http://www.maxmind.com">http://www.maxmind.com</a>.
```
 
## Copyright notice
All rights reserved (c) 2014 AIJKO GmbH <info@aijko.com>