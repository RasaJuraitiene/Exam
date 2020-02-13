<?php


namespace App\Feedbacks;


class Feedback
{
    private $data = [];

    public function __construct($data = null)
    {
        if ($data) {
            $this->setData($data);
        } else {
            $this->data = [
                'user_id' => null,
                'id' => null,
                'feedback' => null,
                'name' => null,
                'timestamp' => null,
            ];
        }
    }

    public function setData($array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        } else {
            $this->data['id'] = null;
        }
        $this->setUserId($array['user_id'] ?? null);
        $this->setFeedback($array['feedback'] ?? null);
        $this->setTimestamp($array['timestamp'] ?? null);
    }

    public function getData()
    {
        return [
            'user_id' => $this->getUserId(),
            'id' => $this->getId(),
            'feedback' => $this->getfeedback(),
            'timestamp' => $this->getTimestamp()
        ];
    }

    public function setId(int $id)
    {
        $this->data['id'] = $id;
    }

    public function getId()
    {
        return $this->data['id'];
    }

    public function setUserId(int $user_id)
    {
        $this->data['user_id'] = $user_id;
    }

    public function getUserId()
    {
        return $this->data['user_id'];
    }

    public function setFeedback(string $feedback)
    {
        $this->data['feedback'] = $feedback;
    }

    public function getFeedback()
    {
        return $this->data['feedback'] ?? null;
    }

    public function setTimestamp(int $timestamp)
    {
        $this->data['timestamp'] = $timestamp;
    }

    public function getTimestamp()
    {
        return $this->data['timestamp'] ?? null;
    }

}