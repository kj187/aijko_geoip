# TYPO3 GeoIp Service
based on MaxMind’s databases

## Requirements
* PHP 5.3 >
* Maxminds database file

You can use the free GeoLite2 database version or the non-free version, this is a more accurate one. The next section could help you to find the right database for you. And yes, you dont need the apache module. You need only a database file.

## Databases
## GeoLite2 free database
GeoLite2 databases are free IP geolocation databases comparable to, but less accurate than, MaxMind’s GeoIP2 databases. GeoLite2 databases are updated on the first Tuesday of each month. You can download a Country and a City version which includes the countries. http://dev.maxmind.com/geoip/geoip2/geolite2/


## GeoIP2
### City database
Determine the country, subdivisions, city, postal code, latitude, and longitude associated with IPv4 and IPv6 addresses worldwide. The GeoIP2 City database is a more accurate version of the free GeoLite2 City database.
https://www.maxmind.com/en/city

### Country database
Determine an Internet visitor's country based on their IP address. The GeoIP2 Country database is a more accurate version of the free GeoLite2 Country database.
https://www.maxmind.com/en/country

## Updating Downloadable Databases
You can use the GeoIP Update program to automatically update your GeoIP databases.
http://dev.maxmind.com/geoip/geoipupdate/

## Installation
### Via GIT
```ssh
cd [yourProjectDirectory]/typo3conf/ext
git clone git clone git@bitbucket.org:aijko/aijko_geoip.git
```

Now you must activate the extension in the extension manager. In the extension configuration you must define the absolute path to the MaxMind’s database file.

## Usage
### JSON
Get the whole client data as JSON, so you can do some magic with javascript in the frontend for example

```php
$client = new \Aijko\AijkoGeoip\Service\Client();
```

## Resources
* http://maxmind.github.io/GeoIP2-php/
* http://dev.maxmind.com/geoip/geoip2/geolite2/
* https://www.maxmind.com/en/geolocation_landing
* https://github.com/maxmind/GeoIP2-php
* https://packagist.org/packages/geoip2/geoip2
* https://www.maxmind.com/en/geoip-demo

## License
### GeoLite2 Free Downloadable Databases License
The GeoLite2 databases are distributed under the [Creative Commons Attribution-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-sa/3.0/). The attribution requirement may be met by including the following in all advertising and documentation mentioning features of or use of this database:

```
 This product includes GeoLite2 data created by MaxMind, available from
 <a href="http://www.maxmind.com">http://www.maxmind.com</a>.
```

## Copyright notice
All rights reserved (c) 2014 AIJKO GmbH <info@aijko.com>