<?php

namespace App\Repository;

use App\Entity\Horario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Horario>
 *
 * @method Horario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Horario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Horario[]    findAll()
 * @method Horario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Horario::class);
    }

    public function add(Horario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Horario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Horario[] Returns an array of Horario objects
    */
   public function gethorariocompleto(): array
   {
       return $this->createQueryBuilder('SELECT h.id, a.actividad, s.nombre_sala,hh.hora, d.dia,h.capacidad FROM horario h
                                        LEFT JOIN actividades a ON a.id=h.Actividad_id
                                        LEFT JOIN sala s ON s.id=h.sala_id
                                        LEFT JOIN hora_horario hh ON hh.id=h.hora_id
                                        LEFT JOIN dias d ON d.id=h.dia_id
                                        ')
//           ->andWhere('h.exampleField = :val')
//           ->setParameter('val', $value)
           ->orderBy('h.id', 'ASC')
//           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findOneByid($value): ?Horario
   {
       return $this->createQueryBuilder('h')
           ->andWhere('h.id = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
}
