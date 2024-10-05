<?php
header("Content-Type: text/html; charset=utf-8");



interface CarFactory
{
    public function createBus(): Bus;
    public function createPassengerCar(): PassengerCar;
    public function createTruck(): Truck;
}

// Абстрактні класи Автобусу, Вантажівки та Легкового автомобіля
abstract class Bus 
{
    protected $brand;
    
    public function __construct($brand) {
        $this->brand = $brand;
    }

    public function getInfo() {
        return "Bus: $this->brand";
    }
}

abstract class Truck 
{
    protected $brand;
    
    public function __construct($brand) {
        $this->brand = $brand;
    }

    public function getInfo() {
        return "Truck: $this->brand";
    }
}

abstract class PassengerCar
{
    protected $brand;
    
    public function __construct($brand) {
        $this->brand = $brand;
    }

    public function getInfo() {
        return "PassengerCar: $this->brand";
    }
}



class UA_Car_Factory implements CarFactory
{
    public function createBus(): Bus {
        return new UABus('Bogdan');
    }
    public function createPassengerCar(): PassengerCar {
        return new UAPassengerCar('ZAZ');
    }

    public function createTruck(): Truck {
        return new UATruck('Volodymyr'); 
    }
}
class Foreign_Car_Factory implements CarFactory 
{
    public function createBus(): Bus {
        return new ForeignBus('Mercedes');
    }

    public function createPassengerCar(): PassengerCar {
        return new ForeignPassengerCar('BMW'); 
    }

    public function createTruck(): Truck {
        return new ForeignTruck('Volvo'); 
    }

}

Class UABus extends Bus {};
Class UATruck extends Truck {};
Class UAPassengerCar extends PassengerCar {};

Class ForeignBus extends Bus {};
Class ForeignTruck extends Truck {};
Class ForeignPassengerCar extends PassengerCar {};


function createCarPark(CarFactory $factory, $carNum, $truckNum, $busNum) {
    $cars = [];
    
    for ($i = 0; $i < $carNum; $i++) {
        $cars[] = $factory->createPassengerCar();
    }

    for ($i = 0; $i < $truckNum; $i++) {
        $cars[] = $factory->createTruck();
    }

    for ($i = 0; $i < $busNum; $i++) {
        $cars[] = $factory->createBus();
    }

    return $cars;
}

// Зчитування конфігураційного файлу
$config = parse_ini_file('config.ini');
$factoryType = $config['factory'];
$carNum = (int)$config['carNum'];
$truckNum = (int)$config['truckNum'];
$busNum = (int)$config['busNum'];

// if-else вітчизняна чи зарубіжна фабрика
$factory = ($factoryType === 'ua') ? new UA_Car_Factory() : new Foreign_Car_Factory();

$carPark = createCarPark($factory, $carNum, $truckNum, $busNum);

// Виведення інформації про автомобілі
foreach ($carPark as $vehicle) {
    echo $vehicle->getInfo() . "<br>";
}
?>