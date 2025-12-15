<?php 
$target_dir = "upload/";

if (isset($_FILES["fileupload"])) {

    $filename = $_FILES["fileupload"]["name"];
    $filename = html_entity_decode($filename, ENT_QUOTES, 'UTF-8'); // Giữ đúng UTF-8
    $filename = trim($filename);

    $file_path = $target_dir . $filename;
    $file_size = $_FILES["fileupload"]["size"];
    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $allow_file_type = ["jpg", "pdf", "docx", "txt", "xlsx", "pptx",'exe'];

    if (in_array($file_ext, $allow_file_type)) {
        if (file_exists($file_path)) {
            echo "file đã tồn tại <br>";
        } else if ($file_size > 5000000) {
            echo "kích thước file quá lớn";
        } else {
            if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $file_path)) {
                echo "Upload thành công!<br>";
                echo "Tên file lưu trên server: $filename<br>";
            } else {
                echo "Lỗi khi upload file!";
            }
        }
    } else {
        echo "Định dạng file không được phép!";
    }
} else {
    echo "Chưa chọn file!";
}

echo "<br><a href='testupfile.html'>Quay lại</a>";
?>
