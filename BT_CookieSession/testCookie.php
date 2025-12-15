<?php
/* cookies 
    kích thước nhỏ 4KB 
    lưu ttin ng dùng trên web 
    đặc điểm 
    lưu trên mt cá nhân bởi trình duyệt 
    cáu trúc:
    cặp [key => value] + time hết hạn, tên miền 
    quản lý cookies 
    */
    setcookie('username', 'Nguyễn Văn A',
		[			
			'expires' => time() + 3600,  //Có giá trị trong 1 giờ
			'path' => "/BT_file",
			'secure' => true,
			'httponly' => true,
		]); 
    if (isset($_COOKIE['username']))
	{
		echo "Xin chào bạn " . htmlspecialchars($_COOKIE['username']);		
	}
	else
	{
		echo "Không có cookies!";
	}   
  //Hủy cookies
/*
	setcookie('username', '', time() - 3600, "/myweb"); //Có giá trị trong 1 giờ
	
	if (isset($_COOKIE['username']))
	{
		echo "Xin chào bạn " . htmlspecialchars($_COOKIE['username']);		
	}
	else
	{
		echo "Không có cookies!";
	}
*/

?>