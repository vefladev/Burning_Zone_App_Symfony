<?php

namespace App\EventSubscriber;

use App\Repository\TrainingRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $trainingRepository;
    private $router;

    public function __construct(
        TrainingRepository $trainingRepository,
        UrlGeneratorInterface $router
    ) {
        $this->trainingRepository = $trainingRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        // $title = $calendar->getTitle();
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        // $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change booking.beginAt by your start date property
        $trainings = $this->trainingRepository
            ->createQueryBuilder('training')

            ->where('training.startedAt LIKE :start')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            // ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        foreach ($trainings as $training) {
            // this create the events with your data (here training data) to fill calendar
            $trainingEvent = new Event(
                $training->getId(),
                // $training->getTitle(),
                // $training->getCoach(), 
                $training->getStartedAt()
                // $training->getEndedAt(), // If the end date is null or not defined, a all day event is created.
                // $training->getUserNom()
                
            );


            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $trainingEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
            $trainingEvent->addOption(
                'url',
                $this->router->generate('training_show', [
                    'id' => $training->getId(),
                    // 'title' => $training->getTitle(),          
                    // 'start' => $training->getStartedAt(),
                    //  'end' => $training->getEndedAt(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($trainingEvent);
        }
    }
}