<?php
header("Content-Type: text/html; charset=utf-8");

// Трейти для спільних методів
trait Showable {
    public function show() {
        echo "<p>Area: " . $this->area . "</p>";
        echo "<p>Population: " . $this->population . "</p>";
        echo "<p>Language: " . $this->language . "</p>";
        echo "<p>Capital: " . $this->getCapital() . "</p>";
    }
}


abstract class Country {
    protected $area;
    protected $population;
    protected $language;
    private $capital;

    use Showable; // Використання трейту

    public function __construct($area, $population, $language, $capital) {
        $this->area = $area;
        $this->population = $population;
        $this->language = $language;
        $this->capital = $capital;
    }

    private function getCapital() {
        return $this->capital;
    }

    public static function show_objects($countries) {
        foreach ($countries as $country) {
            $country->show();
        }
    }
}

// Конкретні класи для країн
class BalticCountry extends Country {
    public function __construct($area, $population, $language, $capital) {
        parent::__construct($area, $population, $language, $capital);
    }
}

class ScandinavianCountry extends Country {
    public function __construct($area, $population, $language, $capital) {
        parent::__construct($area, $population, $language, $capital);
    }
}

// Інтерфейс для фабрики країн
interface CountryFactory {
    public function createCountry($area, $population, $language, $capital): Country;
}

// Конкретні фабрики для країн
class BalticCountryFactory implements CountryFactory {
    public function createCountry($area, $population, $language, $capital): Country {
        return new BalticCountry($area, $population, $language, $capital);
    }
}

class ScandinavianCountryFactory implements CountryFactory {
    public function createCountry($area, $population, $language, $capital): Country {
        return new ScandinavianCountry($area, $population, $language, $capital);
    }
}


$balticFactory = new BalticCountryFactory();
$scandinavianFactory = new ScandinavianCountryFactory();

$countries = [];


$countries[] = $balticFactory->createCountry("45 339 км²", "1,349 мільйона", "Естонська", "Таллінн");
$countries[] = $balticFactory->createCountry("64 589 км²", "1,895 мільйона", "Латиська", "Рига");
$countries[] = $scandinavianFactory->createCountry("450 295 км²", "10,2 мільйона", "Шведська", "Стокгольм");
$countries[] = $scandinavianFactory->createCountry("323 802 км²", "5,5 мільйона", "Норвезька", "Осло");

// Метод для виведення масиву об'єктів
Country::show_objects($countries);

// Видалення об'єктів
unset($countries);

?>
