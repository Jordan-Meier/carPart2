<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    $app = new Silex\Application();


    $app->get("/", function() {
            return "
            <!DOCTYPE html>
            <html>
                <head>
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
                    <title>Find a Car</title>
                </head>
                <body>
                    <div class='container'>
                        <h1>Find a Car!</h1>
                        <form action='/view_cars'>
                            <div class='form-group'>
                                <label for='price'>Enter Maximum Price:</label>
                                <input id='price' name='price' class='form-control' type='number'>
                            </div>
                            <div class='form-group'>
                                <label for='mileage'>Enter Maximum Mileage:</label>
                                <input id='mileage' name='mileage' class='form-control' type='number'>
                            </div>
                            <button type='submit' class='btn-success'>Submit</button>
                        </form>
                    </div>
                </body>
            </html>
            ";
    });

    $app->get("/view_cars", function() {
        $honda = new Car("1999 Honda CRV", 90000, 6000, "img/honda.jpg");
        $tesla = new Car("2014 Tesla Model S", 5000, 35000, "img/tesla.jpg");
        $nissan = new Car("2013 Nissan Leaf", 8000, 20000, "img/leaf.jpg");
        $toyota = new Car("2009 Toyota Prius", 20000, 15000, "img/toyota.jpg");
        $toyota->setPrice("$12000");

        $cars = array($honda, $tesla, $nissan, $toyota);

        $cars_matching_search = array();
        foreach ($cars as $car) {
            if ($car->worthBuying(($_GET["price"]), ($_GET["mileage"]))) {
                array_push($cars_matching_search, $car);
            }
        }

        $output = "";
        if(empty($cars_matching_search)) {
            echo "your search parameters did not return any results";
        }
        foreach ($cars_matching_search as $car) {
            $output = $output . "<div class='row'>
                <div class='col-md-6'>
                    <p>Price: " . $car->getPrice() . "</p>
                    <p>Model: " . $car->getModel() . "</p>
                    <p>Miles: " . $car->getMiles() . "</p>
                </div>
                <div class='col-md-6'>
                    <img src=" . $car->getPhoto() . ">
                </div>
                ";
        }
        return $output;
    });


    return $app;
?>
