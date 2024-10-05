<?php
header("Content-Type: text/html; charset=utf-8");

// Абстрактний клас Vehicle
abstract class Vehicle {
    protected $country_manufacture;
    protected $brand;
    protected $year;

    public function __construct($country_manufacture, $brand, $year) {
        $this->country_manufacture = $country_manufacture;
        $this->brand = $brand;
        $this->year = $year;
    }

    public function getInfo() {
        return "Country: $this->country_manufacture, Brand: $this->brand, Year: $this->year";
    }
}

// Клас Car
class Car extends Vehicle {
    private $engine;
    private $power;
    private $color;

    public function __construct($country_manufacture, $brand, $year, $engine, $power, $color) {
        parent::__construct($country_manufacture, $brand, $year);
        $this->engine = $engine;
        $this->power = $power;
        $this->color = $color;
    }

    public function getInfo() {
        return parent::getInfo() . ", Engine: $this->engine, Power: $this->power, Color: $this->color";
    }
}

// Клас Bike
class Bike extends Vehicle {
    private $weight;
    private $type;
    private $wheelDiameter;

    public function __construct($country_manufacture, $brand, $year, $weight, $type, $wheelDiameter) {
        parent::__construct($country_manufacture, $brand, $year);
        $this->weight = $weight;
        $this->type = $type;
        $this->wheelDiameter = $wheelDiameter;
    }

    public function getInfo() {
        return parent::getInfo() . ", Weight: $this->weight, Type: $this->type, Wheel Diameter: $this->wheelDiameter";
    }
}

// Клас Motorcycle
class Motorcycle extends Vehicle {
    private $engine;
    private $color;
    private $type;

    public function __construct($country_manufacture, $brand, $year, $engine, $color, $type) {
        parent::__construct($country_manufacture, $brand, $year);
        $this->engine = $engine;
        $this->color = $color;
        $this->type = $type;
    }

    public function getInfo() {
        return parent::getInfo() . ", Engine: $this->engine, Color: $this->color, Type: $this->type";
    }
}

// Фабрика для створення транспортних засобів
class VehicleFactory {
    public static function createVehicle($type, ...$params) {
        switch (strtolower($type)) {
            case 'car':
                return new Car(...$params);
            case 'bike':
                return new Bike(...$params);
            case 'motorcycle':
                return new Motorcycle(...$params);
            default:
                return "Factory cannot create this type of vehicle.";
        }
    }
}

// Приклади використання
$car = VehicleFactory::createVehicle('car', 'Germany', 'BMW', 2020, 'V8', '500 HP', 'Black');
echo $car->getInfo() . "<br>";

$bike = VehicleFactory::createVehicle('bike', 'China', 'Xiaomi', 2021, '10kg', 'Mountain', '26 inches');
echo $bike->getInfo() . "<br>";

$motorcycle = VehicleFactory::createVehicle('motorcycle', 'Japan', 'Yamaha', 2022, '600cc', 'Red', 'Sport');
echo $motorcycle->getInfo() . "<br>";

// Спроба створення невідомого типу транспортного засобу
$unknownVehicle = VehicleFactory::createVehicle('truck', 'USA', 'Ford', 2019);
echo $unknownVehicle; // Повідомлення про помилку

?>
