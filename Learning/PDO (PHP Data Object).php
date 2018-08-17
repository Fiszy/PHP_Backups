// Connection

$conn = new sqli('localhost','root','','localdb');
$conn2 = new PDO("mysql:host=localhost;dbname=phpblog;",'root','');

1. Secure;
2. Deal with 12 Databases;

try {
    connection ($conn yahan likhna hai);
    echo " Connection Created Successfully! ";
} catch (PDOExeption $e){
    echo " Error: ".$e->getMessage();
}

======================================================

// SELECT Query

$Select = $conn->query("SELECT * from cart");
$Select->setFetchMode(PDO:: FETCH_ASSOC);
while($row = $Select->fetch()) {
    echo $row['email'];
}

$Select = $conn->query("SELECT * from cart");
$Select->setFetchMode(PDO:: FETCH_OBJ);
while($row = $Select->fetch()) {
    echo $row->email;
}

$Select = $conn->prepare("SELECT * from cart");
$Select->setFetchMode(PDO:: FETCH_OBJ);
$Select->execute();
while($row = $Select->fetch()) {
    echo $row->email;
}

// Insert

$email = "admin@gmail.com";

$insert = $conn->prepare("INSERT into admin (email) values (?,?)");
$insert->bindParam(':email',$email);
$insert->execute();

$insert = $conn->prepare("INSERT into admin (email) values (:email,:pass)");
$insert->bindParam(':email',$email);
$insert->execute();

// UPDATE Query

$update = $conn->prepare("UPDATE admin set email = 'k@yahoo.com' where id='1'");
$update->execute();
echo $update->rowCount().'Records Updated';

// DELETE Query

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO:ERRMODE_EXCEPTION);

$delete = $conn->prepare("DELETE from admin where id='1'");
$delete->exec($delete);
echo "REcord Deleted";



=======================================================

 $db = new PDO('mysql:host=localhost;db_name=pdo','root','');

class car{
    public $a;
    public $b;
    public function myname(){
        echo "";
    }
}
$obj = new car();
$obj->myname();


=================================
$file = fopen('myfile.txt','w');
$text= "Hi Talha here!";
fwrite($file,$text);

date('D/M/d/Y - h:m:s');
mt_rand(); // by default 9 number digits
mt_rand(100,1000);
md5();