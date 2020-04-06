<?php

namespace App\Command;

use App\Entity\Ville;
use League\Csv\Reader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CitiesCommand extends Command
{
    protected static $defaultName = 'cities';

    /**
    * @var EntityManagerInterface
    */
    private $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setName('import:csv')
            ->setDescription('Importer les villes depuis un csv')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
         // yolo
         ini_set("memory_limit", "-1");
 
        //  // On vide la table
        $connection = $this->em->getConnection();
        $platform   = $connection->getDatabasePlatform();

        $connection->executeUpdate($platform->getTruncateTableSQL('ville', true /* whether to cascade */));

        $reader = Reader::createFromPath('%kernel.dir_dir%\..\public\villes.csv', 'r');
        $reader->setHeaderOffset(0);
        // $reader = dirname($this->container->get('kernel')->getRootDir()) . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'villes.csv';
        $lines = explode("\n", file_get_contents($reader));
        $villes = [];

        foreach ($lines as $k => $line) {
            $line = explode(',', $line);

            if (count($line) > 8 && $k > 0) {
                // On sauvegarde la ville
                $ville = new Ville();
                $ville->setNomville($line[5]);
                $ville->setCode($line[4]);
                $villes[] = $line[5];
                $this->em->persist($ville);
            }    
        }
        $this->em->flush();
        $output->writeln(count($villes) . ' villes importées');
    }
}
