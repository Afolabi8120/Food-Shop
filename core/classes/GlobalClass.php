<?php

	class GlobalClass {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

		public function validateInput($var){
			$var = htmlspecialchars($var);
			$var = trim($var);
			$var = stripcslashes($var);
			return $var;
		}

		// to delete data from a table 
		public function delete($table,$column,$id){
        	$stmt = $this->pdo->prepare("DELETE FROM `$table` WHERE `$column` = '$id' ");
        	$stmt->execute();

			return true;
        }

		// to delete all data from a table 
		public function deleteAll($table){
        	$stmt = $this->pdo->prepare("DELETE FROM `$table`");
        	$stmt->execute();

			return true;
        }

		// to insert data into the table 
		public function create($table, $fields = array()) {
            // remove the , from the key values in the fields(i.e the values input into databse)
            $columns = implode(',', array_keys($fields));
            $values = ':'.implode(', :', array_keys($fields));
            $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
            if($stmt = $this->pdo->prepare($sql)) {
                foreach($fields as $key => $data) {
                    $stmt->bindValue(`:`.$key, $data);
                }
                $stmt->execute();
                return $this->pdo->lastInsertId();
            }
        }

		// to check if a value exist in a column
		public function checkIfExist($table,$column,$value){
        	$stmt = $this->pdo->prepare("SELECT `$column` FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

		// login function
		public function login($value){
        	$stmt = $this->pdo->prepare("SELECT * FROM `tbluser` WHERE `username` = '$value'");
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

		// to fetch all data in a table
		public function select($table){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table`");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

		// to fetch all data in a table
		public function selectStore($table){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table`");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		// update
		public function update($table, $id, $fields = array()) {
            $columns = '';
            $i = 1;

            foreach($fields as $name => $value) {
                $columns .= "`{$name}` = :{$name}";
                if($i < count($fields)) {
                    $columns .= ', ';
                }
                $i++;
            }
            $sql = "UPDATE {$table} SET {$columns} WHERE `id` = {$id}";
            if($stmt = $this->pdo->prepare($sql)) {
                foreach($fields as $key => $value) {
                    $stmt->bindValue(':'.$key, $value);
                }
                $stmt -> execute();
            }
        }

		// to fetch all data in a table using one condition
		public function selectByOne($table,$column,$value){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ORDER BY id ASC ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

		// to fetch all data in a table using two condition
		public function selectByTwoCondUsingAnd($table,$column,$value,$column2,$value2){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' AND `$column2` = '$value2'  ");
        	$stmt->execute();
			$stmt->fetch(PDO::FETCH_OBJ);

			return true;
        }

		// add to cart
		public function insertToCart($user_id,$food_id,$qty,$price,$total){

			$stmt = $this->pdo->prepare("SELECT * FROM `tblorder` WHERE `user_id` = '$user_id' AND `food_id` = '$food_id' AND order_number = '0' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":food_id", $food_id, PDO::PARAM_INT);
        	$stmt->execute();
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$count = $stmt->rowCount();

			if($count > 0){

				$stmt = $this->pdo->prepare("UPDATE `tblorder` SET qty = qty + '$qty', total = (qty * price)  WHERE user_id = :user_id AND food_id = :food_id ");
				$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
				$stmt->bindParam(":food_id", $food_id, PDO::PARAM_INT);
				$stmt->execute();

			}else {

				$stmt = $this->pdo->prepare("INSERT INTO tblorder (user_id,food_id,qty,price,total,order_number) VALUES(:user_id,:food_id,:qty,:price,:total,'0')");
				$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
				$stmt->bindParam(":food_id", $food_id, PDO::PARAM_INT);
				$stmt->bindParam(":qty", $qty, PDO::PARAM_INT);
				$stmt->bindParam(":price", $price, PDO::PARAM_STR);
				$stmt->bindParam(":total", $total, PDO::PARAM_STR);
				$stmt->execute();

			}

			return true;
        }

		// to fetch a single data in a table using one condition
		public function selectOne($table,$column,$value){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		// to enable or disable
		public function enableUser($table,$column,$value,$id){
            $stmt = $this->pdo->prepare("UPDATE `$table` SET status = '$value' WHERE id = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

		// to update the qty of the item and total
		public function updateOrderTable($qty,$user_id,$food_id){
            $stmt = $this->pdo->prepare("UPDATE `tblorder` SET qty = qty + '$qty', total = (qty * price)  WHERE user_id = :user_id AND food_id = :food_id ");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":food_id", $food_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

		// this will minus one from the number of available plate in the menu table
		public function removeFromMenuPlate($food_id){
            $stmt = $this->pdo->prepare("UPDATE `tblmenu` SET plate = plate - 1 WHERE id = :food_id ");
			$stmt->bindParam(":food_id", $food_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

		// this will add one to the number of available plate in the menu table
		public function addToMenuPlate($food_id,$qty){
            $stmt = $this->pdo->prepare("UPDATE `tblmenu` SET plate = plate + :qty WHERE id = :food_id ");
			$stmt->bindParam(":food_id", $food_id, PDO::PARAM_INT);
			$stmt->bindParam(":qty", $qty, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

		// this get the numbers of row in a table
		public function selectTotal($table){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table`");
			$stmt->execute();

			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$count = $stmt->rowCount();

			return $count;
		}

		// this get the numbers of row in a table using a single condition
		public function selectCountFrom($table,$column,$value){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ");
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		public function selectTotalFromDesc($table,$column,$value){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ORDER BY `added_date` DESC LIMIT 5");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function selectAll($column,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function loginCheck($table,$value){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `username` = '$value' OR `email` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function fetchByOneID($column,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT `$column` FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function fetchByTwoID($column1,$column2,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT `$column1` FROM `$table` WHERE `$column2` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function updateSession($username,$session){
			$stmt = $this->pdo->prepare("UPDATE tbluser SET session=:session WHERE username = :username ");
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->bindParam(":session", $session, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function getSession($username){
			$stmt = $this->pdo->prepare("SELECT session FROM tbluser WHERE username = :username");
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_OBJ);
		}

		public function getCartNotification($user_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tblorder` WHERE `user_id` = '$user_id' AND order_number = '0' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        	$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		// fetch all user item in cart
		public function fetchUserCart($user_id){
        	$stmt = $this->pdo->prepare("SELECT m.picture,m.name,o.qty,o.price,o.total,o.id,o.user_id,o.order_number,o.food_id,m.description FROM `tblorder` AS o INNER JOIN tblmenu AS m ON o.food_id = m.id WHERE o.user_id = :user_id AND o.order_number = '0' ");
        	$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
			 
        }

		// get total of total item in cart
		public function getCartSum($value){
        	$stmt = $this->pdo->prepare("SELECT SUM(total) FROM `tblorder` WHERE `user_id` = '$value' AND order_number = '0' ");
        	$stmt->execute();
			$total = $stmt->fetch(PDO::FETCH_NUM);
			return $total_income = $total[0];
        }

		// generate order ID
		public function generateOrderID(){
        	$alpha = "abcdefghijklmnopqrstuvwxyz";
            $alphabet = str_shuffle(substr($alpha, 0, 24));
			$alphabet2 = str_shuffle(substr($alphabet, 0,4));
            $rand = rand(1111,9999).time();
            $rand2 = str_shuffle(substr($rand, 0, 4));
            $code = str_shuffle($rand2.$alphabet2);

			return "ORD-".date('Ymd').$code;
        }

		// this will update the user order id in the cart
		public function updateOrderID($user_id,$order_number){
			$stmt = $this->pdo->prepare("UPDATE tblorder SET order_number=:order_number WHERE user_id = :user_id AND order_number = '0' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":order_number", $order_number, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function insertToOrderAddress($user_id,$order_id,$name,$email,$phone,$address,$order_total,$order_date){
			$stmt = $this->pdo->prepare("INSERT INTO tblorderaddress (user_id,order_id,name,email,phone,address,order_total,order_date,status) VALUES(:user_id,:order_id,:name,:email,:phone,:address,:order_total,:order_date,'')");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":order_id", $order_id, PDO::PARAM_STR);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
			$stmt->bindParam(":order_total", $order_total, PDO::PARAM_STR);
			$stmt->bindParam(":order_date", $order_date, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		// this will get all the user order history
		public function fetchUserOrderHistory($user_id){
			$stmt = $this->pdo->prepare("SELECT order_id,order_total,status,order_date FROM tblorderaddress WHERE user_id = :user_id ORDER BY id DESC");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		// fetch all user item in cart for the invoice
		public function fetchInvoice($user_id,$order_number){
        	$stmt = $this->pdo->prepare("SELECT m.picture,m.name,o.qty,o.price,o.total,o.id,o.user_id,o.order_number,o.food_id,m.description FROM `tblorder` AS o INNER JOIN tblmenu AS m ON o.food_id = m.id WHERE o.user_id = :user_id AND o.order_number = :order_number ");
        	$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":order_number", $order_number, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ); 
        }

		public function fetchInvoice2($order_number){
        	$stmt = $this->pdo->prepare("SELECT m.picture,m.name,o.qty,o.price,o.total,o.id,o.user_id,o.order_number,o.food_id,m.description FROM `tblorder` AS o INNER JOIN tblmenu AS m ON o.food_id = m.id WHERE o.order_number = :order_number ");
			$stmt->bindParam(":order_number", $order_number, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ); 
        }

		// this will update order status in the table tblorderaddress
		public function updateOrderStatus($status,$order_number){
			$stmt = $this->pdo->prepare("UPDATE tblorderaddress SET status=:status WHERE order_id = :order_number ");
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":order_number", $order_number, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		// this will insert the data into tbltrackfood
		public function insertToTrackFood($order_id,$remark,$status,$order_date){
			$stmt = $this->pdo->prepare("INSERT INTO tbltrackfood (order_id,remark,status,date) VALUES(:order_id,:remark,:_status,:order_date)");
			$stmt->bindParam(":order_id", $order_id, PDO::PARAM_STR);
			$stmt->bindParam(":remark", $remark, PDO::PARAM_STR);
			$stmt->bindParam(":_status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":order_date", $order_date, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		// get total of total item in cart
		public function getSum($table,$column,$column2,$value){
        	$stmt = $this->pdo->prepare("SELECT SUM(`$column`) FROM `$table` WHERE `$column2` = '$value' ");
        	$stmt->execute();
			$total = $stmt->fetch(PDO::FETCH_NUM);
			return $total_income = $total[0];
        }

		public function getAdminNotification(){
        	$stmt = $this->pdo->prepare("SELECT oa.user_id,oa.order_id,u.surname FROM tblorderaddress AS oa INNER JOIN tbluser AS u ON oa.user_id = u.id WHERE oa.status = ''");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

		public function getTotalPrice($table,$column){
        	$stmt = $this->pdo->prepare("SELECT SUM(`$column`) FROM `$table` ");
        	$stmt->execute();
			$total = $stmt->fetch(PDO::FETCH_NUM);
			return $total_income = $total[0];
        }

        public function getTotalPriceWhere($table,$column,$value){
        	$stmt = $this->pdo->prepare("SELECT SUM(`$column`) FROM `$table` WHERE order_date = '$value' ");
        	$stmt->execute();
			$total = $stmt->fetch(PDO::FETCH_NUM);
			return $total_income = $total[0];
        }

		public function getPendingOrders(){
			$stmt = $this->pdo->prepare("SELECT * FROM `tblorderaddress` WHERE `status` != 'Order Cancel' AND `status` != 'Food Delivered' ");
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}



    }

?>