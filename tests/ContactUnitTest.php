<?php

namespace App\Tests;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;
use DateTime;

class ContactUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $contact = new Contact();
        $date = new DateTime();

        $contact->setEmail('true@test.com')
            ->setNom('nom')
            ->setMessage('message')
            ->setCreatedAt($date)
            ->setIsSent(true);

        $this->assertTrue($contact->getEmail() === 'true@test.com');
        $this->assertTrue($contact->getNom() === 'nom');
        $this->assertTrue($contact->getIsSent() === true);
        $this->assertTrue($contact->getMessage() === 'message');
        $this->assertTrue($contact->getCreatedAt() === $date);

    }
    public function testIsFalse()
    {
        $contact = new Contact();
        $date = new DateTime();

        $contact->setEmail('true@test.com')
            ->setNom('nom')
            ->setMessage('message')
            ->setCreatedAt($date)
            ->setIsSent(true);

        $this->assertFalse($contact->getEmail() === 'false@test.com');
        $this->assertFalse($contact->getNom() === 'false');
        $this->assertFalse($contact->getIsSent() === false);
        $this->assertFalse($contact->getMessage() === 'false');
        $this->assertFalse($contact->getCreatedAt() === new DateTime());

    }

    public function testIsEmpty()
    {
        $contact = new Contact();


        $this->assertEmpty($contact->getEmail());
        $this->assertEmpty($contact->getNom());
        $this->assertEmpty($contact->getMessage());
        $this->assertEmpty($contact->getCreatedAt());
        $this->assertEmpty($contact->getIsSent());
        $this->assertEmpty($contact->getId());

    }
}
