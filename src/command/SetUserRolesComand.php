<?php

namespace App\Command;

use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SetUserRolesCommand extends Command
{
    protected static $defaultName = 'app:user:set-roles';

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    protected function execute(InputInterface $inputInterface, OutputInterface $output): int
    {
        $user = $this->userRepository->findOneByEmail('admin@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $this->userRepository->add($user);
        return Command::SUCCESS;
    }
}
