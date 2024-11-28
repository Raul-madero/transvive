<?php 
$host = "dpg-csr5lf1u0jms73cis3s0-a.oregon-postgres.render.com"; /* Host name */
$user = "rmadero"; /* User */
$password = "M6WeJ17g7uV3EsuLM1Ifjnt11HHf5i6y"; /* Password */
$dbname = "transvive_piv3"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
?>