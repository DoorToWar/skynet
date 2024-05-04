<?php
class BracketDeleter {

    private string $destination = '';

    private array $brackets = [
        '(' => ')',
        '<' => '>',
        '{' => '}',
        '[' => ']',
    ];

    public function __construct(private string $source) {
    }

    public function process() {
        $this->destination = $this->source;
        # Цикл по всем видам скобок из массива 
        foreach ($this->brackets as $open => $close) {
            while (true) {
                # Первое вхождение открывающей скобки.
                $start = strpos($this->destination, $open);

                # Последнее вхождение закрывающей скобки.
                $end = strrpos($this->destination, $close);
    
                // Если не найдена открывающая или закрывающая, то переход к следующему виду скобок.
                if ($start === false || $end === false) {
                    break;
                }
    
                // Проверка, находится ли закрывающая скобка после открывающей.
                if ($end > $start) {
                    # Замена подстроки между двумя скобками на ''
                    $this->destination = substr_replace($this->destination, '', $start, $end - $start + 1);
                } else {
                    break;
                }
            }
        }
    }
    public function getResult(): string {
        return $this->destination;
    }


}

$test_string = new BracketDeleter ("[]<>{}()");
$test_string->process ();
echo "<br>".$test_string->getResult();
