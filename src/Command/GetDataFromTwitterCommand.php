<?php

namespace App\Command;

use App\Service\DataService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

#[AsCommand(
    name: 'app:get-tweets',
    description: 'The command who retrieves the tweets from LunaWeb.',
    aliases: ['app:tweets'],
    hidden: false
)]
class GetDataFromTwitterCommand extends Command
{
    private DataService $getData;

    public function __construct(DataService $getData)
    {
        parent::__construct();
        $this->getData = $getData;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $this->getData->dataFromTwitter();
        return Command::SUCCESS;
    }
}