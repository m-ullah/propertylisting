## Property feed parser
- routes are defined in `RouteServiceProvider.php`
- request are routed to corresponding controller i.e `GetPropertiesController.php`
- each change action is converted into a command and passed along to a `command bus` system, a `command handler` is responsible to process the command.
- it's a one way journey for a `command`, `controller` accepts request and acknowledges that, `command handler` writes log or sends message upon completion.
- on the other hand a query is rather a simple process, `controller` uses `repository` to retrieve data
- `PDOServiceProvider.php` handles db connection, this needs more work, due to time constraint, mock data is used for report query.
- repositories i.e. `PropertyRepository.php` is used as data model
- sqlite database is used for caching proerty data locally, running sync command more than once is safe
- to run the app run this command from project folder. `php -S 127.0.0.1:8055 -t src`
- some unit tests are added (more @ToDO) `src/vendor/bin/phpunit ./tests/`

#### Strategy #### 
This service is designed keeping in mind Microservices architecture.  

* Structured for Hexagonal Architecture
* Used commandbus system and facade patterns
* CQRS to separate command (write) and query (read)
* SOLID & DRY is the way

Tests:
* Unit testing with PHPUnit


#### Usage #### 
* commandline interface for syncing property database
`php src/console.php worker:sync-property`
 

* HTTP GET `property/list?limit=&sort=` accepts query params [`limit` & `sort`]

returns http 200 success code with json response i.e:
 
`[
     {
         "id": "380743",
         "url": "https://www.spotahome.com/london/for-rent:rooms/380743",
         "title": "Room to rent in 6-bedroom apartment in Camden",
         "type": "for rent",
         "content": "**The easy choice**\n\n_Because I want to pack my bags and move straight in._\n\n**Will I like it here?**\n\nWe think so\n\nAre you looking for a spacious room in an enviable location? Lots of rooms means lots of new friends. Get social!\n\n**Really? Tell me more...**\n\nYou will love the setup here. It’s a stylish apartment with all the basics and a generous kitchen and dining area. Round up the troops and get cooking. There’s no better way to make friends than with food.\n\nWe think this apartment is ideal for sociable individuals looking for a location to match their fun-loving lifestyle. Camden is a happening spot, close to late night music venues, authentic eateries, and lush green public parks.\n\n**Your top 3 reasons to rent here:**\n\n- The bedrooms are nicely furnished and spacious.\n- The modern kitchen. What's your speciality?\n- The Regent's Park is just a short stroll away.\n\n**But you need to know this…**\n\n- The apartment is located on the 2nd floor and there is no elevator – get in a free leg workout every day.\n\n**Your Home-checker, Kamil, said:**\n\n_\"This apartment has spacious rooms and is in a great location. The underground is only a 6-minute walk away.”_\n\n**Help me make up my mind…**\n\nThis is a spacious 2nd floor, 6-bedroom apartment on Clarence Gardens, London. It boasts spacious bedrooms, a fully equipped kitchen, and a cosy dining area.\n\nThis property is ideal for sociable individuals. You’ll be in a lively neighborhood, with great nightlife, authentic restaurants, and iconic spots like The Regent's Park close by.",
         "price": "715",
         "property_type": "apartment",
         "foreclosure": "0",
         "address": "Clarence Gardens",
         "city": "London",
         "country": "Uk",
         "latitude": "51.52787166",
         "longitude": "-0.14310179999994",
         "agency": "spotahome",
         "floor_area": "0",
         "rooms": "6",
         "pictures": {
             "picture": [
                 {
                     "picture_url": "https://d1052pu3rm1xk9.cloudfront.net/fsosw_960_540_verified_ur_6_50/2d2bf170c88708a534e6bcf39bf79730b2936cceb68942ba9e82f535.jpg",
                     "picture_title": "Bedroom 4"
                 },
                 {
                     "picture_url": "https://d1052pu3rm1xk9.cloudfront.net/fsosw_960_540_verified_ur_6_50/83536f6b85c9bee8a3ce7ad76c67637f04a4fc2b59b07ce703d13a3f.jpg",
                     "picture_title": "Bedroom 4"
                 },
                 {
                     "picture_url": "https://d1052pu3rm1xk9.cloudfront.net/fsosw_960_540_verified_ur_6_50/24352aa488c53959af959e2040b063c32e126722c3c03fc25b2a33c0.jpg",
                     "picture_title": "Bedroom 4"
                 }
             ]
         },
         "date": "02/12/2019",
         "by_owner": "0",
         "is_furnished": "1",
         "air_conditioning": "0",
         "equipped_kitchen": "1",
         "terrace_balcony": "0",
         "smoking_allowed": "0",
         "washing_machine": "1",
         "dryer": "0",
         "dishwasher": "0",
         "oven": "1",
         "tv": "0",
         "min_stay": "90",
         "rent_type": "shared_room",
         "max_stay": "0",
         "number_rooms": "6",
         "number_bathrooms": "1",
         "booking_period": {
             "booking_start": "2019-12-02",
             "booking_end": "2100-01-01"
         }
    }
 ]`

* UI for listing property i.e. `http://127.0.0.1:8055/ui/property.html`

 #### Improvements #### 
* property data is being fetched from a file as live feed wasn't active 
* Property Model is not in use
* seperation of RW model if necessary
* need more unit tests
