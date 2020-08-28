<?php



        namespace Models;
        use Contracts\UserStorageInterface;
        use Controllers\SignupController;
        use Controllers\LoginController;
        use PDO;

        class UserStorage implements UserStorageInterface{

            protected $db;
            protected $statement;
            protected $bool;
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
                    var_dump($item);

                    if($item->username==$user->getUsername())
                    {

                        $boolUser=true;
                    }
                    echo '<br>';
                    if($item->email==$user->getEmail())
                    {

                        $boolEmail=true;
                    }
                    if($boolUser===true || $boolEmail===true)
                    {
                        if($boolUser===true)
                        {
                            echo 'Username already in use.';
                            echo '<br>';
                        }
                        if($boolEmail===true)
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

                    $statement->execute([

                        'username' => $user->getUsername(),
                        'password' => $user->getPassword(),
                        'first_name' => $user->getFirstName(),
                        'last_name' => $user->getLastName(),
                        'email' => $user->getEmail(),

                    ]);



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

            public function authentication($user)
            {
                $user->getUsername();
                $user->getPassword();
                $statement=$this->db->prepare("
                SELECT username, password FROM users
                ");
                $statement->setFetchMode(PDO::FETCH_CLASS,User::class);
                $statement->execute();
                $items=$statement->fetchAll();
                var_dump($items);
                $this->bool=false;
                foreach ($items as $item)
                {
                    if(($item->username==$user->getUsername()) && ($item->password==$user->getPassword()) )
                    {
                        $this->bool=true;
                        break;
                    }

                }


            }

            public function getAuth()
            {
                return $this->bool;

            }



        }

?>
