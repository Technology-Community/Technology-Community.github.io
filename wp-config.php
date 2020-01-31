<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'db_devkingnnt' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'gBH?O *8?Lp+]MW04y]~{pE@Gf} lhwXDeq|tSmW4g`fHu3HFUqkB28bkPHtCVmj' );
define( 'SECURE_AUTH_KEY',  'w&:P+F5Mgo*lc8VJ2OA9{:fuS8-@|*!N`KnU;#M:0@yB}LgY9`)w@>auuqUH*m-(' );
define( 'LOGGED_IN_KEY',    'e7lJWvQC7W|6`_t!5>HZsd.S;NQ4U`lg;8SI1^JTFT!#j^)zMRwLnXY:UyI|2} t' );
define( 'NONCE_KEY',        'W ZT^S`}Ai7oEH+i7`MP+4#FP$E_CKZAaQu++9^GBTc#S/Pq%(wK,&aP_%i@eAYz' );
define( 'AUTH_SALT',        '8hL.ob$i!*L{9y.19o2)Q-6~:.Z:AkYO|!EJByak@?_^<5 tj:$?*K:.%&Sy-!, ' );
define( 'SECURE_AUTH_SALT', '!_M4|}llP4[-`aj(jcw$~Oa-OgxB:wWdBJd`FbuF2~`E;u;6K?}3:ya3w_!TTAH}' );
define( 'LOGGED_IN_SALT',   'Mj*v}.2NW,kn<YT)Cv 6ucoYu[C%hC2N0XXUb[oI j1H=Y:wmcWdhGo*HHf+Vi(P' );
define( 'NONCE_SALT',       'k(eWjWDjwiaN0 {-kv@//Ktg(0}woD8I~MTm EKd|hj^M#M7e[DThopPIP|xuT6n' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
