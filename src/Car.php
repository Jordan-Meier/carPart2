<?php
class Car
{
    private $make_model;
    private $price;
    private $miles;
    private $photo;

    function __construct($car_model, $car_miles, $car_price, $car_photo)
    {
        $this->make_model = $car_model;
        $this->price = $car_price;
        $this->miles = $car_miles;
        $this->photo = $car_photo;
    }


    function setPrice($new_price)
    {
        $float_price = (float) $new_price;
        if ($float_price != 0) {
            $this->price = $float_price;
        }
        else {
            $this->price = $new_price;
        }
    }

    function getPrice()
    {
        return $this->price;
    }

    function setModel($new_make_model)
    {
        $this->make_model = $new_make_model;
    }

    function getModel()
    {
        return $this->make_model;
    }

    function setMiles($new_miles)
    {
        $this->miles = $new_miles;
    }

    function getMiles ()
    {
        return $this->miles;
    }

    function setPhoto($new_photo)
    {
        $this->photo = $new_photo;
    }

    function getPhoto ()
    {
        return $this->photo;
    }

    function worthBuying($max_price, $max_miles)
    {
        return ($this->price <= ($max_price + 500) && $this->miles <= $max_miles);
    }
}

?>
