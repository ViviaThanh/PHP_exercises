
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách Sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-3">

<h2>Danh sách Sinh viên</h2>

<?php
// Lớp People
class People {
    protected $name;
    protected $dob;
    protected $gender;

    public function __construct($name, $dob, $gender) {
        $this->name = $name;
        $this->dob = $dob;
        $this->gender = $gender;
    }
}

// Lớp Student kế thừa từ People
class Student extends People {
    private $studentId;
    private $major;

    public function __construct($name, $dob, $gender, $studentId, $major) {
        parent::__construct($name, $dob, $gender);
        $this->studentId = $studentId;
        $this->major = $major;
    }

    public function getInfo() {
        return [
            'id' => $this->studentId,
            'name' => $this->name,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'major' => $this->major
        ];
    }
}

// Tạo danh sách 10 sinh viên
$students = [

    new Student("Nguyễn Văn An", "2003-01-10", "Nam", "SV001", "CNTT"),
    new Student("Trần Thị Bích", "2002-05-21", "Nữ", "SV002", "Kế Toán"),
    new Student("Lê Minh Cường", "2003-07-30", "Nam", "SV003", "Marketing"),
    new Student("Phạm Thị Duyên", "2002-09-14", "Nữ", "SV004", "CNTT"),
    new Student("Hoàng Văn Đức", "2003-02-12", "Nam", "SV005", "Cơ Khí"),
    new Student("Đỗ Thị Phương", "2002-11-05", "Nữ", "SV006", "Thiết Kế"),
    new Student("Vũ Văn Giang", "2003-04-18", "Nam", "SV007", "Du Lịch"),
    new Student("Bùi Thị Hạnh", "2002-03-25", "Nữ", "SV008", "Kinh Doanh"),
    new Student("Đặng Văn Phúc", "2003-06-22", "Nam", "SV009", "CNTT"),
    new Student("Phan Thị Khánh", "2002-08-15", "Nữ", "SV010", "Y Tế")
];
?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
    <tr>
        <th>No</th>
        <th>Mã SV</th>
        <th>Họ Tên</th>
        <th>Ngày Sinh</th>
        <th>Giới Tính</th>
        <th>Ngành Học</th>
    </tr>
    </thead>
    <tbody>
    <?php 
    $i = 1;
    foreach ($students as $student) {
        $info = $student->getInfo();
        echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>".$info['id']."</td>";
        echo "<td>".$info['name']."</td>";
        echo "<td>".$info['dob']."</td>";
        echo "<td>".$info['gender']."</td>";
        echo "<td>".$info['major']."</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

</body>
</html>