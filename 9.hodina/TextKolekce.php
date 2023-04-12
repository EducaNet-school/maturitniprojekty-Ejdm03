<?php
class Human
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class HumanCollection implements \Countable, \Iterator, \ArrayAccess
{
    private array $values = [];
    private int $position = 0;

    public function __construct(array $values = [])
    {
        foreach ($values as $value) {
            $this->offsetSet("", $value);
        }
    }

    public function count(): int
    {
        return count($this->values);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function current(): Human
    {
        return $this->values[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function valid(): bool
    {
        return isset($this->values[$this->position]);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset): Human
    {
        return $this->values[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof Human) {
            throw new \InvalidArgumentException('Hodnota musi být instance Human');
        }
        if (empty($offset)) {
            $this->values[] = $value;
        } else {
            $this->values[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->values[$offset]);
    }
}

$humans = [
    new Human("John"),
    new Human("Jane"),
    new Human("Jack"),
];

$humanCollection = new HumanCollection($humans);
foreach ($humanCollection as $human) {
    echo $human->getName() . " ";
}
?>