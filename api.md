# Travel Diary API

Simple RESTful API service for synchronization of traveling diaries between mobile application and database server.

[![Apiary Documentation](https://img.shields.io/badge/Apiary-Documented-blue.svg)](http://docs.traveldiaryapi.apiary.io/)


[![GitHub stars](https://img.shields.io/github/stars/badges/shields.svg?style=social&label=Star)](https://github.com/MTAA-FIIT/TravelDiary-Api)

## Database diagram

![Image of Yaktocat](https://github.com/MTAA-FIIT/TravelDiary-Api/raw/master/docs/EER_v1.png)

## Mockups

![Image of Yaktocat](https://github.com/MTAA-FIIT/TravelDiary-Api/raw/master/docs/Mockups_v1.jpg)

## Credentials

 - [Barbora Čelesová](xcelesova@stuba.sk)
 - [Jakub Dubec](xdubec@stuba.sk)

## Enums [/enums]

### List all enums [GET]

+ Response 200 (application/json)

        {
            "statuses":
            [
                {
                    "code": "IN_PROGRESS",
                    "description": "Trip is in progress"
                }
            ],
            "trip_types":
            [
                {
                    "code": "CAMPING",
                    "description": "A new camping record"
                }
            ]
        }

## Trips Collection [/trips]

### List all trips [GET]

+ Response 200 (application/json)

        [
            {
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644",
                "name": "Norway 2015",
                "destination": "Trolltunga, Odda, Norway",
                "description": "An low-cost hitchhiking trip through the Scandinavia and the Baltic states.",
                "start_date": "2015-07-7",
                "estimated_arrival": "2015-08-01",
                "created_at": "2016-02-28T12:48:15+00:00",
                "updated_at": null
            }
        ]

### Create a New Trip [POST]

+ Request (application/json)

    + Attributes

        + id: `565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644` (required, string) - Generated identificator for trip SHA256(<TIMESTAMP>:TRIP:<DEVICE_UUID>)
        + name: `Norway 2015` (required, string) - Name of the trip
        + destination: `Trolltunga, Odda, Norway` (required, string) - Destination of trip
        + description: `A low-cost hitchhiking trip through the Scandinavia and the Baltic states.` (required, string) - Description of trip
        + start_date: `2015-07-12` (required, string) - Start date of trip in format Y-m-d
        + estimated_arrival: `2015-08-04` (required, string) - Estimated arrival date in format Y-m-d
        + status: `PLANNED` (required, TripStatusEnum) - Status of trip

+ Response 201 (application/json)

    + Headers

            Location: /trips/565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644

    + Body

            {
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644",
                "name": "Norway 2015",
                "destination": "Trolltunga, Odda, Norway",
                "description": "An low-cost hitchhiking trip through the Scandinavia and the Baltic states.",
                "start_date": "2015-07-7",
                "status": "PLANNED"
            }

+ Response 400 (application/json)

    + Body

            {
                "message": "Invalid input!",
                "invalid_fields": [ 'updaated_at' ]
            }

+ Response 500 (application/json)

    + Body

            {
                "message": "User friendly message describing error",
            }

## Trip [/trips/{trip_id}]

+ Parameters
    + trip_id: `565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644` (string) - ID of the trip in form of SHA256 hash

### View a Trip detail [GET]

+ Response 200 (application/json)

    + Body

            {
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644",
                "name": "Norway 2015",
                "destination": "Trolltunga, Odda, Norway",
                "description": "An low-cost hitchhiking trip through the Scandinavia and the Baltic states.",
                "start_date": "2015-07-7",
                "estimated_arrival": "2015-08-01",
                "created_at": "2016-02-28T12:48:15+00:00",
                "updated_at": null
            }

### Update a Trip detail [PUT]

+ Request (application/json)

    + Attributes

        + name: `Norway 2015` (optional, string) - Name of the trip
        + destination: `Trolltunga, Odda, Norway` (optional, string) - Destination of trip
        + description: `A low-cost hitchhiking trip through the Scandinavia and the Baltic states.` (optional, string) - Description of trip
        + start_date: `2015-07-12` (optional, string) - Start date of trip in format Y-m-d
        + estimated_arrival: `2015-08-04` (optional, string) - Estimated arrival date in format Y-m-d
        + status: `PLANNED` (optional, TripStatusEnum) - Status of trip

+ Response 201 (application/json)

    + Headers

            Location: /trips/565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644

    + Body

            {
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644",
                "name": "Norway 2015",
                "destination": "Trolltunga, Odda, Norway",
                "description": "An low-cost hitchhiking trip through the Scandinavia and the Baltic states.",
                "start_date": "2015-07-7",
                "status": "PLANNED",
                "records":
                [
                    {
                        "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644",
                        "type": "CAMPING",
                        "day": "2016-03-02"
                    }
                ]
            }

+ Response 400 (application/json)

    + Body

            {
                "message": "Invalid input!",
                "invalid_fields": [ 'updaated_at' ]
            }

+ Response 404 (application/json)

            {
                "message": "Not found!",
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644"
            }

+ Response 500 (application/json)

    + Body

            {
                    "message": "User friendly message describing error",
            }

### Delete trip [DELETE]

+ Response 204

+ Response 404 (application/json)

    + Body

            {
                "message": "Not found!",
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644"
            }

+ Response 500 (application/json)

    + Body

            {
                "message": "User friendly message describing error",
            }

## Trip Records Collection [/trips/{trip_id}/records]

+ Parameters
    + trip_id: `565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644` (string) - ID of the trip in form of SHA256 hash

### Create trip record [POST]
+ Request (application/json)

    + Attributes

        + id: `565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644` (required, string) - Generated identificator for trip record: SHA256(<TIMESTAMP>:RECORD:<DEVICE_UUID>)
        + type: `CAMPING` (required, RecordTypeEnum) - Type of record
        + day: `2016-03-02` (required, string) - Day of the trip
        + description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis arcu egestas neque porttitor fringilla. ` (required, string) - Message
        + coordinates: (optional, Coordinates) - Current location
        + photos: (optional, array[Photo]) - Array of photos

+ Response 201 (application/json)

    + Headers

            Location: /trips/565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644/records/565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644

    + Body

            {
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644",
                "type": "CAMPING",
                "day": "2016-03-02",
                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis arcu egestas neque porttitor fringilla.",
                "coordinates":
                {
                    "latitude": 48.158564899999995,
                    "longitude": 17.064523299999998,
                    "altitude": 320
                },
                "photos":
                [
                    {
                        "data": "..."
                    },
                    {
                        "data": "..."
                    }
                ]
            }

+ Response 400 (application/json)

    + Body

            {
                "message": "Invalid input!",
                "invalid_fields": [ 'cordinates', 'status' ]
            }

+ Response 500 (application/json)

    + Body

            {
                "message": "Unable to save record. Please try it later."
            }

## Trip record detail [/trips/{trip_id}/records/{record_id}]

+ Parameters
    + trip_id: `565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644` (string) - ID of the trip in form of SHA256 hash
    + record_id: `565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644` (string) - ID of the trip record in form of SHA256 hash

### Get trip record details [GET]

+ Response 200 (application/json)

    + Body

            {
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644",
                "type": "CAMPING",
                "day": "2016-03-02",
                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis arcu egestas neque porttitor fringilla.",
                "coordinates":
                {
                    "latitude": 48.158564899999995,
                    "longitude": 17.064523299999998,
                    "altitude": 320
                },
                "photos":
                [
                    {
                        "data": "..."
                    },
                    {
                        "data": "..."
                    }
                ]
            }

+ Response 404 (application/json)

    + Body

            {
                "message": "Trip record not found!",
            }


### Update trip record [PUT]

+ Request (application/json)

    + Attributes

        + type: `CAMPING` (optional, RecordTypeEnum) - Type of record
        + day: `2016-03-02` (optional, string) - Day of the trip
        + description: `Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis arcu egestas neque porttitor fringilla. ` (optional, string) - Message
        + coordinates: (optional, Coordinates) - Current location
        + photos: (optional, array[Photo]) - Array of photos

+ Response 201 (application/json)

    + Headers

            Location: /trips/565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644/records/565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644

    + Body

            {
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644",
                "type": "CAMPING",
                "day": "2016-03-02",
                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis arcu egestas neque porttitor fringilla.",
                "coordinates":
                {
                    "latitude": 48.158564899999995,
                    "longitude": 17.064523299999998,
                    "altitude": 320
                },
                "photos":
                [
                    {
                        "data": "..."
                    },
                    {
                        "data": "..."
                    }
                ]
            }

+ Response 400 (application/json)

    + Body

            {
                "message": "Invalid input!",
                "invalid_fields": [ 'cordinates', 'status' ]
            }

+ Response 404 (application/json)

    + Body

            {
                "message": "Trip record not found!"
            }

+ Response 500 (application/json)

    + Body

            {
                "message": "Unable to update trip record. Please try it later."
            }

### Delete trip [DELETE]

+ Response 204

+ Response 404 (application/json)

        + Body

            {
                "message": "Not found!",
                "id": "565d93b922bfeb48dde3252605548e5e91a6ad0c1ee479e178a465425e673644"
            }

+ Response 500 (application/json)

        + Body

            {
                "message": "User friendly message describing error",
            }

## Status [/status]

Application is testing server by calling this endpoint.

### Get stats [GET]

+ Response 200 (application/json)

            {
                "stats": {
                    "trips": 10,
                    "records": 145
                },
                "proccessed_in": 1.0245,
                "timestamp": 1456960832
            }

# Data Structures

## TripStatusEnum (enum[string])
    - `PLANNED`
    - `IN_PROGRESS`
    - `CANCELED`
    - `FINISHED`

## RecordTypeEnum (enum[string])
    - `CAMPING`
    - `BIVOUAC`
    - `HOTEL`
    - `ACTIVITY`
    - `UPDATE`
    - `CHECK_IN`
    - `NOTE`

## Coordinates (object)
    - latitute (required, number)
    - longitude (required, number)
    - altitude (optional, number)

## Photo (object)
    - data (required, string) - BASE64 of image
