<?php



        namespace Models;
        use Contracts\UserStorageInterface;
        use Controllers\SignupController;
        use Controllers\LoginController;
        use PDO;


        class UserStorage implements UserStorageInterface{

            protected $db;
            protected $statement;
            protected $boolUser;
            protected $boolEmail;
            public $bool=false;
            public $adminbool=false;
            public function __construct(PDO $db)
            {
                $this->db=$db;

            }
            public function StoreUsers($user)
            {

                $items=$this->db->prepare("
                SELECT * FROM users
                ");
                $items->setFetchMode(PDO::FETCH_CLASS, User::class);
                $items->execute();
                $result=$items->fetchAll();



                foreach($result as $item)
                {


                    if($item->username==$user->getUsername())
                    {

                        $this->boolUser=true;
                    }
                    if($item->email==$user->getEmail())
                    {

                        $this->boolEmail=true;
                    }
                    if($this->boolUser===true || $this->boolEmail===true)
                    {
                        if($this->boolUser===true)
                        {
                            echo 'Username already in use.';
                            echo '<br>';

                        }
                        if($this->boolEmail===true)
                        {
                            echo 'Email already in use.';
                        }
                        die();
                   }


                }

                    $statement=$this->db->prepare("

                    INSERT INTO users (username, password, first_name, last_name, email)
                    VALUES (:username, :password, :first_name, :last_name, :email)
                ");

                    $hashed=password_hash($user->getPassword(),PASSWORD_DEFAULT);
                    var_dump($hashed);
                    $statement->execute([

                        'username' => $user->getUsername(),
                        'password' => $hashed,
                        'first_name' => $user->getFirstName(),
                        'last_name' => $user->getLastName(),
                        'email' => $user->getEmail(),

                    ]);




            }

            public function authentication($user)
            {
                $user->getUsername();
                $statement = $this->db->prepare("
                SELECT username,password,role FROM users 
                ");
                $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
                $statement->execute();
                $items = $statement->fetchAll();
                $correctpass=false;
                $userexists=false;
                foreach ($items as $item) {

                    if($item->username == $user->getUsername())
                    {
                        $userexists=true;
                    }
                    if(password_verify($user->getPassword(),$item->password)==true)
                    {
                        $correctpass=true;
                    }
                    if (($item->username == $user->getUsername()) && password_verify($user->getPassword(),$item->password)==true) {

                        $correctpass=true;
                        $userexists=true;

                        if ($item->role==='admin')
                        {
                            echo 'You are logged in as admin';
                            $this->adminbool=true;
                            $_SESSION['username']= $user->getUsername();

                        }

                        else if($item->role==='user')
                        {
                            echo 'You are now logged in';
                            $this->bool = true;
                            $_SESSION['username']= $user->getUsername();

                        }
                    }
                    var_dump(password_verify($user->getPassword(),$item->password));
                }
                if ($userexists==false)
                {
                    echo 'User does not exist.';
                }
                if($userexists==true && $correctpass==false)
                {
                    echo 'Wrong password.';
                }



            }

            public function getUserBool()
            {
                return $this->bool;
            }
            public function getAdminBool()
            {
                return $this->adminbool;

            }
            public function all()
            {
                $statement=$this->db->prepare("

                    SELECT * FROM users
                    ");
                $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
                $statement->execute();
                return $statement->fetchAll();

            }

        }

?>
