<?php

namespace App\EventSubscriber;

use App\Entity\Blogpost;
use App\Entity\Peinture;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.

        return [
            BeforeEntityPersistedEvent::class => ['setBlogPostSlugAndDateAndUser'],
        ];
    }

    public function setBlogPostSlugAndDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        switch($entity){
            case $entity instanceof Blogpost:
            $now = new DateTime('now');
            $entity->setCreatedAt($now);
            $user = $this->security->getUser();
            $entity->setUser($user);
            break;

            case $entity instanceof Peinture:
            $now = new DateTime('now');
            $entity->setCreatedAt($now);
            $user = $this->security->getUser();
            $entity->setUser($user);
            break;

        }
            return;

    }

}
