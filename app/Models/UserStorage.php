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

                $items = $this->db->prepare("
                SELECT * FROM users
                ");
                $items->setFetchMode(PDO::FETCH_CLASS, User::class);
                $items->execute();
                $result = $items->fetchAll();


                foreach ($result as $item) {


                    if ($item->username == $user->getUsername()) {

                        $this->boolUser = true;
                    }
                    if ($item->email == $user->getEmail()) {

                        $this->boolEmail = true;
                    }
                    if ($this->boolUser === true || $this->boolEmail === true) {
                        if ($this->boolUser === true) {
                            echo 'Username already in use.';
                            echo '<br>';

                        }
                        if ($this->boolEmail === true) {
                            echo 'Email already in use.';
                        }
                        die();
                    }


                }
            }
                 public function StoreAdmin($admin)
            {

                $items=$this->db->prepare("
                SELECT * FROM users
                ");
                $items->setFetchMode(PDO::FETCH_CLASS, User::class);
                $items->execute();
                $result=$items->fetchAll();



                foreach($result as $item)
                {


                    if($item->username==$admin->getUsername())
                    {

                        $this->boolUser=true;
                    }
                    if($item->email==$admin->getEmail())
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

                    INSERT INTO users (username, password, first_name, last_name, email,role)
                    VALUES (:username, :password, :first_name, :last_name, :email,:role)
                ");

                    $hashed=password_hash($admin->getPassword(),PASSWORD_DEFAULT);
                    var_dump($hashed);
                    $statement->execute([

                        'username' => $admin->getUsername(),
                        'password' => $hashed,
                        'first_name' => $admin->getFirstName(),
                        'last_name' => $admin->getLastName(),
                        'email' => $admin->getEmail(),
                        'role'=>'admin'
                    ]);
                    header('location: /AddNewAdmin ');
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

                    if (($item->username == $user->getUsername()) && password_verify($user->getPassword(),$item->password)==true) {

                        $correctpass=true;
                        $userexists=true;

                        if ($item->role==='admin' || $item->role==='head admin')
                        {
                            $this->adminbool=true;
                            if(!isset($_SESSION['user']) && !isset($_SESSION['logged']))
                            {
                                $_SESSION['user']= $user->getUsername();
                                $_SESSION['role']=$item->role;
                                $_SESSION['logged']='You must logout first';
                                header('location: /Home');

                            }

                        }

                        if($item->role==='user')
                        {
                            $this->bool = true;
                            if(!isset($_SESSION['user']) && !isset($_SESSION['logged']))
                            {
                                $_SESSION['user']= $user->getUsername();
                                $_SESSION['role']='user';
                                $_SESSION['logged']='You must logout first';
                                header('location: /Home');

                            }
                        }
                    }
                }
                if ($userexists==false)
                {
                    $_SESSION['error']='User does not exist.';
                    header('location: /login');

                }
                if($userexists==true && $correctpass==false)
                {
                    $_SESSION['error']='Wrong password.';
                    header('location: /login');

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
