<?php


use InvalidArgumentException;

class User

{

    public int $age;

    public array $favoriteMovies = [];

    public string $name;

    /**

     * @param int $age

     * @param string $name

     */

    public function __construct(int $age, string $name)

    {

        $this->age = $age;

        $this->name = $name;

    }

    public function tellName(): string

    {

        return "My name is " . $this->name . ".";

    }

    public function tellAge(): string

    {

        return "I am " . $this->age . " years old.";

    }

    public function addFavoriteMovie(string $movie): bool

    {

        $this->favoriteMovies[] = $movie;

        return true;

    }

    public function removeFavoriteMovie(string $movie): bool

    {

        if (!in_array($movie, $this->favoriteMovies)) {

            throw new InvalidArgumentException("Unknown movie: " . $movie);

        }

        unset($this->favoriteMovies[array_search($movie, $this->favoriteMovies)]);

        return true;

    }

}



use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase

{

    public function testClassConstructor()

    {

        $user = new User(30, 'Alice');

        $this->assertSame('Alice', $user->name);

        $this->assertSame(30, $user->age);

        $this->assertEmpty($user->favoriteMovies);

    }

    public function testTellName()

    {

        $user = new User(30, 'Alice');

        $this->assertIsString($user->tellName());

        $this->assertStringContainsStringIgnoringCase('Alice', $user->tellName());

    }

    public function testTellAge()

    {

        $user = new User(30, 'Alice');

        $this->assertIsString($user->tellAge());

        $this->assertStringContainsStringIgnoringCase('30', $user->tellAge());

    }

    public function testAddFavoriteMovie()

    {

        $user = new User(30, 'Alice');

        $this->assertTrue($user->addFavoriteMovie('Inception'));

        $this->assertContains('Inception', $user->favoriteMovies);

        $this->assertCount(1, $user->favoriteMovies);

    }

    public function testRemoveFavoriteMovie()

    {

        $user = new User(30, 'Alice');

        $user->addFavoriteMovie('Inception');

        $this->assertTrue($user->removeFavoriteMovie('Inception'));

        $this->assertNotContains('Inception', $user->favoriteMovies);

        $this->assertEmpty($user->favoriteMovies);

    }

}


// declare(strict_types=1);

// namespace TheSoftwareHouse\HowToTest\Tests\Integration\Domain;

// use PHPUnit\Framework\TestCase;

// use TheSoftwareHouse\HowToTest\Domain\Order;

// use TheSoftwareHouse\HowToTest\Domain\Product;

// use TheSoftwareHouse\HowToTest\Domain\Shop;

// class OrderTest extends TestCase

// {

//     public function testShouldAddProductsWithSuccess(): void

//     {

//         // Given

//         $shop = new Shop(“My shop”, new Product(“Apple”, 5), new Product(“Chocolate”, 7), new Product(“Watermelon”, 20));

//         $order = new Order($shop);

//         $chocolate = new Product(‘Chocolate’, 2);

//         // When

//         $order->addProduct($chocolate);

//         // Then

//         self::assertSame($chocolate, $order->getProductByName(‘Chocolate’));

//         self::assertSame(5, $shop->getProductByName(‘Chocolate’)->getQuantity());

//     }

// }