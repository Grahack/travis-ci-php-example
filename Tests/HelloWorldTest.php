<?php

class HelloWorldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PDO
     */
    private $pdo;

    public function setUp()
    {
        $this->pdo = new PDO($GLOBALS['db_dsn'], $GLOBALS['db_username'], $GLOBALS['db_password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->query("CREATE TABLE hello (what VARCHAR(50) NOT NULL)");
        $this->pdo->query("CREATE TABLE `personnages`
(`id` 			smallint(5) 	not null 	auto_increment,
 `nom` 			varchar(50) 	COLLATE latin1_general_ci	not null,
 `puissance` 	int,
 `degats` 		int,
 `experience` 	int,
 `niveau` 		int,
 PRIMARY KEY    (`id`)
 );");

        $this->pdo->query("INSERT into personnages ( `nom`, `puissance`, `degats`, `experience`, `niveau`)
VALUES
 ('Roi', 		80,0,50, 13),
 ('Reine', 		50,0,50, 12),
 ('Fou', 		20,0,20, 11),
 ('Tour', 		20,0,50, 10),
 ('Combattant', 80,0,50, 9),
 ('Soldat', 	50,0,20, 8),
 ('Garde', 		50,0,20, 7),
 ('Fantassin', 	50,0,20, 6),
 ('Alerte', 	20,0,50, 5),
 ('Déesse', 	20,0,80,4),
 ('Amazone', 	20,0,50, 3)
;");
    }

    public function tearDown()
    {
        $this->pdo->query("DROP TABLE hello");
    }

    public function testHelloWorld()
    {
        $helloWorld = new HelloWorld($this->pdo);

        $this->assertEquals('Hello World', $helloWorld->hello());
    }

    public function testHello()
    {
        $helloWorld = new HelloWorld($this->pdo);

        $this->assertEquals('Hello Bar', $helloWorld->hello('Bar'));
    }

    public function testWhat()
    {
        $helloWorld = new HelloWorld($this->pdo);

        $this->assertFalse($helloWorld->what());

        $helloWorld->hello('Bar');

        $this->assertEquals('Bar', $helloWorld->what());
    }
}

