<?php
header("Content-Type: text/html; charset=utf-8");

// Базовий клас Country
class Country {
    public $area;
    public $population;
    public $language;
    private $capital;

    public function __construct(string $area, string $population, string $language, string $capital) {
        $this->area = $area;
        $this->population = $population;
        $this->language = $language;
        $this->capital = $capital;
    }

    public function show(): void {
        echo "<p>Area: " . $this->area . "</p>";
        echo "<p>Population: " . $this->population . "</p>";
        echo "<p>Language: " . $this->language . "</p>";
        echo "<p>Capital: " . $this->capital . "</p>";
    }
}

// Підклас для країн Прибалтики
class BalticCountry extends Country {
}

// Підклас для країн Скандинавії
class ScandinavianCountry extends Country {
}


class CountryFactory {
    public static function createCountry(string $region, string $area, string $population, string $language, string $capital): Country {
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
try {
    $estonia = CountryFactory::createCountry('Baltic', '45,339 km²', '1,349 мільйона', 'Естонська', 'Таллінн');
    $latvia = CountryFactory::createCountry('Baltic', '64,589 km²', '1,895 мільйона', 'Латиська', 'Рига');
    $sweden = CountryFactory::createCountry('Scandinavian', '450,295 km²', '10,2 мільйона', 'Шведська', 'Стокгольм');

    // Виведення інформації про країни
    $estonia->show();
    $latvia->show();
    $sweden->show();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
