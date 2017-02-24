<?php

namespace AppBundle\Security;

use AppBundle\Entity\Realty;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class RealtorVoter extends Voter {

    // these strings are just invented: you can use anything
   
    const EDIT = 'edit';

    protected function supports($attribute, $subject) {
        // if the attribute isn't one we support, return false
        if ($attribute  !== self::EDIT) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject[0] instanceof Realty) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        return $user === $subject[0]->getAgent();

        throw new \LogicException('This code should not be reached!');
    }

 
}
