<?php
header("Content-Type: text/html; charset=utf-8");

// Базовий клас Country
class Country {
    public $area;
    public $population;
    public $language;
    private $capital;

    public function __construct($area, $population, $language, $capital) {
        $this->area = $area;
        $this->population = $population;
        $this->language = $language;
        $this->capital = $capital;
    }

    public function show() {
        echo "<p>Area: " . $this->area . "</p>";
        echo "<p>Population: " . $this->population . "</p>";
        echo "<p>Language: " . $this->language . "</p>";
        echo "<p>Capital: " . $this->capital . "</p>";
    }
}

// Підклас для країн Прибалтики
class BalticCountry extends Country {
    public function __construct($area, $population, $language, $capital) {
        parent::__construct($area, $population, $language, $capital);
    }
}

// Підклас для країн Скандинавії
class ScandinavianCountry extends Country {
    public function __construct($area, $population, $language, $capital) {
        parent::__construct($area, $population, $language, $capital);
    }
}

// Фабрика для створення об'єктів країн
class CountryFactory {
    public static function createCountry($region, $area, $population, $language, $capital) {
        switch ($region) {
            case 'Baltic':
                return new BalticCountry($area, $population, $language, $capital);
            case 'Scandinavian':
                return new ScandinavianCountry($area, $population, $language, $capital);
            default:
                throw new Exception("Unknown region: $region");
        }
    }
}

// Створення країн за допомогою фабрики
$estonia = CountryFactory::createCountry('Baltic', '45,339 km²', '1,349 мільйона', 'Естонська', 'Таллінн');
$latvia = CountryFactory::createCountry('Baltic', '64,589 km²', '1,895 мільйона', 'Латиська', 'Рига');
$sweden = CountryFactory::createCountry('Scandinavian', '450,295 km²', '10,2 мільйона', 'Шведська', 'Стокгольм');

// Виведення інформації про країни
$estonia->show();
$latvia->show();
$sweden->show();

?>
