<?php
namespace Kryptalabs\AdminPasswordCli\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Magento\User\Model\ResourceModel\User\CollectionFactory;
use Magento\User\Model\UserFactory;

class ChangeAdminPassword extends Command
{
    protected const USERNAME_OPTION = 'username';
    protected const PASSWORD_OPTION = 'password';
    protected const EMAIL_OPTION = 'email';

    private $userCollectionFactory;
    private $userFactory;

    public function __construct(
        CollectionFactory $userCollectionFactory,
        UserFactory $userFactory
    ) {
        $this->userCollectionFactory = $userCollectionFactory;
        $this->userFactory = $userFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('admin:user:password:change')
            ->setDescription('Change admin user password with username and email verification')
            ->addOption(
                self::USERNAME_OPTION,
                'u',
                InputOption::VALUE_REQUIRED,
                'Admin username'
            )
            ->addOption(
                self::PASSWORD_OPTION,
                'p',
                InputOption::VALUE_REQUIRED,
                'New password'
            )
            ->addOption(
                self::EMAIL_OPTION,
                'e',
                InputOption::VALUE_REQUIRED,
                'Admin email for verification'
            );

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $username = $input->getOption(self::USERNAME_OPTION);
            $password = $input->getOption(self::PASSWORD_OPTION);
            $email = $input->getOption(self::EMAIL_OPTION);

            if (!$username || !$password || !$email) {
                throw new \InvalidArgumentException('Username, password and email are required.');
            }

            // Get users with matching username
            $userCollection = $this->userCollectionFactory->create();
            $userCollection->addFieldToFilter('username', $username);

            if ($userCollection->getSize() == 0) {
                throw new \Exception("No user found with username: {$username}");
            }

            // Find user with matching email
            $userFound = false;
            foreach ($userCollection as $user) {
                if ($user->getEmail() == $email) {
                    $userModel = $this->userFactory->create()->load($user->getId());
                    $userModel->setPassword($password);
                    $userModel->save();
                    $userFound = true;
                    $output->writeln("<info>Password successfully changed for user {$username} with email {$email}</info>");
                    break;
                }
            }

            if (!$userFound) {
                throw new \Exception("No user found with username {$username} and email {$email}");
            }

            return \Magento\Framework\Console\Cli::RETURN_SUCCESS;

        } catch (\Exception $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }
}
