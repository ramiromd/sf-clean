<?php

namespace Ramiromd\Sfclean\Rest\Command;

use Ramiromd\Sfclean\IdentityAccess\Application\CreateUser;
use Ramiromd\Sfclean\IdentityAccess\Application\CreateUserRequest;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(
    name: 'crowfunding:create-demo-users',
    description: 'Creates demo users for testing purposes.',
    help: 'This command allows you to create demo users in the system for testing and development purposes.',
    usages: ['crowfunding:create-demo-users users.csv']
)]
class CreateDemoUsersCommand extends Command {

    private CreateUser $createUserService;
    public function __construct(CreateUser $createUserService) {
        parent::__construct();
        $this->createUserService = $createUserService;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('source', null, InputOption::VALUE_REQUIRED, 'The source file for demo users.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $source = $input->getArgument('source');

        $handle = fopen($source, 'r');
        if ($handle === false) {
            $output->writeln('Failed to open source file: ' . $source);
            return Command::FAILURE;
        }

        $i = 0;
        while (($line = fgets($handle)) !== false) {
            if ($i === 0) {
                // Skip header line
                $i++;
                continue;
            }
            $userData = explode(',', trim($line));
            $createUserRequest = new CreateUserRequest(
                $userData[0], // entityId
                $userData[1], // email
                $userData[2], // nickname
                $userData[3], // password
                $userData[4]  // creationDate
            );

            $this->createUserService->__invoke($createUserRequest);

            // Here you would parse the line and create the user accordingly.
            // For demonstration, we just output the line.
            $output->writeln("Creating user from line {$i}: " . trim($line));
        }



        $output->writeln('Demo users created successfully from source: ' . $source);
        return Command::SUCCESS;
    }
}