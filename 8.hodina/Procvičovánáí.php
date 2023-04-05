<?php
class Student {
    public $id;
    public $name;
    public $note;
    public $delitelnost;

    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->note = "";
        $this->delitelnost = "";
    }

    function fillNotes() {
        if ($this->id % 3 == 0 && $this->id % 5 == 0) {
            $this->note = "EDUCANET";
            $this->delitelnost = "Dělitelné 3 a 5";
        } elseif ($this->id % 3 == 0) {
            $this->note = "EDUCA";
            $this->delitelnost = "Dělitelné 3";
        } elseif ($this->id % 5 == 0) {
            $this->note = "NET";
            $this->delitelnost = "Dělitelné 5";
        }
    }
}

$students = array(
    new Student(1, "Alice"),
    new Student(2, "Bob"),
    new Student(3, "Charlie"),
    new Student(4, "David"),
    new Student(5, "Eve"),
    new Student(6, "Vašek"),
    new Student(7, "Gertruda"),
    new Student(8, "Honza"),
    new Student(9, "Isabela"),
    new Student(10, "Jack"),
    new Student(11, "Franta"),
    new Student(12, "Jožka"),
    new Student(13,"Alice"),
    new Student(14,"Matilda"),
    new Student (15,"Eržika")
);

echo "<html><head><style>";
echo "table {border-collapse: collapse; width: 100%;}";
echo "th, td {padding: 8px; text-align: left; border: 1px solid black;}";
echo "th {background-color: #ccc;}";
echo "tr:nth-child(even) {background-color: #f2f2f2;}";
echo "table {border-radius: 10px; overflow: hidden;}";
echo "</style></head><body><table>";
echo "<tr><th>ID</th><th>Name</th><th>Text</th><th>Dělitelnost</th></tr>";
foreach ($students as $student) {
    try {
        foreach ($students as $other_student) {
            if ($student !== $other_student && $student->id == $other_student->id) {
                throw new Exception("Více uživatelů se stejným id : " . $student->id . ", " . $student->name . ", " . $other_student->name);
            }
        }
        $student->fillNotes();
        echo "<tr><td>" . $student->id . "</td><td>" . $student->name . "</td><td>" . $student->note . "</td><td>" . $student->delitelnost . "</td></tr>";
    } catch (Exception $e) {
        echo "<tr><td colspan='4'>Chyba: " . $e->getMessage() . "</td></tr>";
    }
}
echo "</table></body></html>";
?>
