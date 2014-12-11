<?php

namespace Iut\Domain\Entity;

class Conference
{
    private $title;
    private $date;
    private $place;
    private $maxAttendees;
    private $attendees = [];

    function __construct($title, $date, $place, $maxAttendees)
    {
        $this->title        = $title;
        $this->date         = $date;
        $this->place        = $place;
        $this->maxAttendees = $maxAttendees;
    }

    public function registerAttendee(Attendee $attendee)
    {
        $this->ensureConferenceHasNotBeenReachedMaxAttendees();
        $this->attendees[] = $attendee;
    }

    private function ensureConferenceHasNotBeenReachedMaxAttendees()
    {
        if ((1 + count($this->attendees) > $this->maxAttendees)) {
            throw new MaxAttendeesReached($this->maxAttendees);
        }
    }
}