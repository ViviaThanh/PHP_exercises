<!doctype html>
<html>
    <head>
        <meta  lang = "vi" charset = "UTF-8">
        <title> OOP PHP</title>
        <link href ="css/bootstrap.min.css" rel = "stylesheet" type = "text/css">
    </head>
<body>
    <h2> Lập trình hướng đối tượng PHP </h2>
    <?php
    class Student
    {
        // properties
        private $name;
        private $age;
        private $gender;
        // dùng cấu tử 
        public function __construct($name,$age,$gender){
            $this -> name = $name;
            $this -> age = $age;
            $this -> gender = $gender;
        }

        // phương thức
        public function setName($name){
            $this -> name = $name;

        }
        public function getName(){
            return $this->name;
        }
        public function setAge($age){
            $this -> age = $age;

        }
        public function getAge(){
            return $this->age;
        }
        public function setGender($gender){
            $this -> gender = $gender;

        }
        public function getGender(){
            return $this->gender;
        }
         public function printStudent ()
         {
            echo "Name: ". $this->name . "<br>" ;
            echo "Age: ". $this->age . "<br>";
            echo "Gender: ". $this->gender . "<br>";
        }

    }
    // use class 
    $student1 = new Student("Phạm Ngọc Thạch",21,"Nam"); 
    $student2 = new Student("Kiều Thanh Trúc",21,"Nữ"); 
    $student3 = new Student("Lê Đức Duy",20,"Nam"); 

    // tạo mảng 
    $students = array ($student1,$student2,$student3);
    foreach ($students as $student){
    $student->printStudent();  
    echo "<br>";
}
?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Gender</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $i = 1; // đánh số thứ tự
        foreach ($students as $student){
            echo "<tr>";
            echo "<th scope='row'>".$i++."</th>";
            echo "<td>".$student->getName()."</td>";
            echo "<td>".$student->getAge()."</td>";
            echo "<td>".$student->getGender()."</td>";
            echo "</tr>";
        }
    ?>
  </tbody>
</table>

<script src = "js/bootstrap.min.js"> </script>
</body>
</html>
